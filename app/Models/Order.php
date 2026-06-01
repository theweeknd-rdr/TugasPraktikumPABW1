<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Collection;
use MongoDB\Model\BSONDocument;

class Order
{
    public const CATEGORIES = ['makanan', 'fotokopi', 'perlengkapan', 'lainnya'];
    public const STATUSES = ['pending', 'diproses', 'selesai'];

    private Collection $collection;

    public function __construct()
    {
        $this->collection = Database::collection('orders');
        $this->ensureIndexes();
    }

    public function create(array $data): array
    {
        $offerId = $this->objectId((string) ($data['offer_id'] ?? ''));
        $buyerId = $this->objectId((string) ($data['buyer_id'] ?? ''));
        $providerId = $this->objectId((string) ($data['provider_id'] ?? ''));
        $itemName = trim((string) ($data['item_name'] ?? $data['nama_barang'] ?? ''));
        $category = (string) ($data['category'] ?? $data['kategori'] ?? '');
        $status = (string) ($data['status'] ?? 'pending');
        $serviceFee = (float) ($data['service_fee'] ?? $data['harga_jasa'] ?? 0);
        $neededDate = trim((string) ($data['needed_date'] ?? $data['tanggal'] ?? ''));

        if ($offerId === null) {
            throw new \InvalidArgumentException('Offer tidak valid.');
        }

        if ($buyerId === null || $providerId === null) {
            throw new \InvalidArgumentException('Buyer atau provider tidak valid.');
        }

        if ($itemName === '') {
            throw new \InvalidArgumentException('Nama barang wajib diisi.');
        }

        if ($neededDate === '') {
            throw new \InvalidArgumentException('Tanggal dibutuhkan wajib diisi.');
        }

        if (! in_array($category, self::CATEGORIES, true)) {
            throw new \InvalidArgumentException('Kategori tidak valid.');
        }

        if (! in_array($status, self::STATUSES, true)) {
            throw new \InvalidArgumentException('Status tidak valid.');
        }

        if ($serviceFee < 0) {
            throw new \InvalidArgumentException('Harga jasa tidak boleh negatif.');
        }

        $now = new UTCDateTime();
        $neededDateValue = $this->dateFromInput($neededDate);
        $result = $this->collection->insertOne([
            'offer_id' => $offerId,
            'buyer_id' => $buyerId,
            'provider_id' => $providerId,
            'item_name' => $itemName,
            'category' => $category,
            'service_fee' => $serviceFee,
            'needed_date' => $neededDateValue,
            'status' => $status,
            'createdAt' => $now,
            'updatedAt' => $now,
            // Backward-compatible aliases for existing list/report pages.
            'nama_barang' => $itemName,
            'kategori' => $category,
            'harga_jasa' => $serviceFee,
            'tanggal' => $neededDateValue,
        ]);

        $createdOrder = $this->findById((string) $result->getInsertedId());

        if ($createdOrder === null) {
            throw new \RuntimeException('Pesanan berhasil dibuat, tetapi gagal dibaca kembali.');
        }

        return $createdOrder;
    }

    public function findById(string|ObjectId $id): ?array
    {
        $objectId = $id instanceof ObjectId ? $id : $this->objectId($id);

        if ($objectId === null) {
            return null;
        }

        return $this->normalizeDocument($this->collection->findOne(['_id' => $objectId]));
    }

    public function findByBuyer(string $buyerId): array
    {
        $objectId = $this->objectId($buyerId);

        if ($objectId === null) {
            return [];
        }

        return $this->normalizeCursor($this->collection->find(
            ['buyer_id' => $objectId],
            ['sort' => ['createdAt' => -1, 'created_at' => -1]]
        ));
    }

    public function findByProvider(string $providerId): array
    {
        $objectId = $this->objectId($providerId);

        if ($objectId === null) {
            return [];
        }

        return $this->normalizeCursor($this->collection->find(
            ['provider_id' => $objectId],
            ['sort' => ['createdAt' => -1, 'created_at' => -1]]
        ));
    }

    public function findByProviderAndStatuses(string $providerId, array $statuses): array
    {
        $objectId = $this->objectId($providerId);
        $validStatuses = array_values(array_intersect($statuses, self::STATUSES));

        if ($objectId === null || $validStatuses === []) {
            return [];
        }

        return $this->normalizeCursor($this->collection->find(
            [
                'provider_id' => $objectId,
                'status' => ['$in' => $validStatuses],
            ],
            ['sort' => ['createdAt' => -1, 'created_at' => -1]]
        ));
    }

    public function findPendingOrders(): array
    {
        return $this->normalizeCursor($this->collection->find(
            ['status' => 'pending'],
            ['sort' => ['createdAt' => -1, 'created_at' => -1]]
        ));
    }

    public function acceptForProvider(string $orderId, string $providerId): bool
    {
        $orderObjectId = $this->objectId($orderId);
        $providerObjectId = $this->objectId($providerId);

        if ($orderObjectId === null || $providerObjectId === null) {
            throw new \InvalidArgumentException('Order atau provider tidak valid.');
        }

        $result = $this->collection->updateOne(
            [
                '_id' => $orderObjectId,
                'provider_id' => $providerObjectId,
                'status' => 'pending',
            ],
            [
                '$set' => [
                    'status' => 'diproses',
                    'updatedAt' => new UTCDateTime(),
                    'updated_at' => new UTCDateTime(),
                ],
            ]
        );

        return $result->getMatchedCount() > 0;
    }

    public function updateStatusForProvider(string $orderId, string $providerId, string $status): bool
    {
        if (! in_array($status, self::STATUSES, true)) {
            throw new \InvalidArgumentException('Status pesanan tidak valid.');
        }

        $orderObjectId = $this->objectId($orderId);
        $providerObjectId = $this->objectId($providerId);

        if ($orderObjectId === null || $providerObjectId === null) {
            throw new \InvalidArgumentException('Order atau provider tidak valid.');
        }

        $result = $this->collection->updateOne(
            [
                '_id' => $orderObjectId,
                'provider_id' => $providerObjectId,
            ],
            [
                '$set' => [
                    'status' => $status,
                    'updatedAt' => new UTCDateTime(),
                    'updated_at' => new UTCDateTime(),
                ],
            ]
        );

        return $result->getMatchedCount() > 0;
    }

    public function findByCategory(string $category): array
    {
        if (! in_array($category, self::CATEGORIES, true)) {
            throw new \InvalidArgumentException('Kategori tidak valid.');
        }

        return $this->normalizeCursor($this->collection->find(
            [
                '$or' => [
                    ['category' => $category],
                    ['kategori' => $category],
                ],
            ],
            ['sort' => ['createdAt' => -1, 'created_at' => -1]]
        ));
    }

    public function latest(int $limit = 100): array
    {
        return $this->normalizeCursor($this->collection->find(
            [],
            [
                'sort' => ['createdAt' => -1, 'created_at' => -1],
                'limit' => $limit,
            ]
        ));
    }

    public function providerSummary(string $providerId): array
    {
        $objectId = $this->objectId($providerId);

        if ($objectId === null) {
            return [
                'total_pendapatan' => 0,
                'jumlah_pesanan_selesai' => 0,
            ];
        }

        $cursor = $this->collection->aggregate([
            [
                '$match' => [
                    'provider_id' => $objectId,
                    'status' => 'selesai',
                ],
            ],
            [
                '$group' => [
                    '_id' => null,
                    'total_pendapatan' => [
                        '$sum' => ['$ifNull' => ['$service_fee', '$harga_jasa']],
                    ],
                    'jumlah_pesanan_selesai' => ['$sum' => 1],
                ],
            ],
        ]);

        $items = $cursor->toArray();
        $summary = $items[0] ?? [];

        return [
            'total_pendapatan' => (float) ($summary['total_pendapatan'] ?? 0),
            'jumlah_pesanan_selesai' => (int) ($summary['jumlah_pesanan_selesai'] ?? 0),
        ];
    }

    public function averageServiceFee(): float
    {
        $cursor = $this->collection->aggregate([
            ['$match' => ['status' => 'selesai']],
            [
                '$group' => [
                    '_id' => null,
                    'rata_rata_harga_jasa' => [
                        '$avg' => ['$ifNull' => ['$service_fee', '$harga_jasa']],
                    ],
                ],
            ],
        ]);

        $items = $cursor->toArray();
        $summary = $items[0] ?? [];

        return (float) ($summary['rata_rata_harga_jasa'] ?? 0);
    }

    private function normalizeCursor(iterable $cursor): array
    {
        $orders = [];

        foreach ($cursor as $order) {
            $orders[] = $this->normalizeDocument($order);
        }

        return $orders;
    }

    private function normalizeDocument(array|BSONDocument|null $document): ?array
    {
        if ($document === null) {
            return null;
        }

        return $this->withDisplayDefaults($this->normalize((array) $document));
    }

    private function withDisplayDefaults(array $order): array
    {
        $order['offer_id'] = $order['offer_id'] ?? '-';
        $order['item_name'] = $order['item_name'] ?? $order['nama_barang'] ?? $this->itemNames($order['items'] ?? []);
        $order['nama_barang'] = $order['nama_barang'] ?? $order['item_name'];
        $order['category'] = $order['category'] ?? $this->normalizeCategory($order['kategori'] ?? '');
        $order['kategori'] = $order['kategori'] ?? $this->normalizeCategory($order['category'] ?? '');
        $order['status'] = $this->normalizeStatus((string) ($order['status'] ?? 'pending'));
        $order['service_fee'] = (float) ($order['service_fee'] ?? $order['harga_jasa'] ?? $order['total_price'] ?? 0);
        $order['harga_jasa'] = (float) ($order['harga_jasa'] ?? $order['service_fee']);
        $order['needed_date'] = $order['needed_date'] ?? $order['tanggal'] ?? $order['createdAt'] ?? $order['created_at'] ?? '-';
        $order['tanggal'] = $order['tanggal'] ?? $order['needed_date'];
        $order['createdAt'] = $order['createdAt'] ?? $order['created_at'] ?? '-';
        $order['buyer_id'] = $order['buyer_id'] ?? '-';
        $order['provider_id'] = $order['provider_id'] ?? '-';

        return $order;
    }

    private function itemNames(mixed $items): string
    {
        if (! is_array($items) || $items === []) {
            return 'Barang tidak tersedia';
        }

        $names = [];

        foreach ($items as $item) {
            if (! is_array($item)) {
                continue;
            }

            $quantity = (int) ($item['quantity'] ?? 1);
            $name = trim((string) ($item['name'] ?? 'Barang'));
            $names[] = ($quantity > 1 ? "{$quantity}x " : '') . $name;
        }

        return $names === [] ? 'Barang tidak tersedia' : implode(', ', $names);
    }

    private function normalizeCategory(string $category): string
    {
        return match ($category) {
            'makanan' => 'makanan',
            'fotokopi' => 'fotokopi',
            'perlengkapan', 'alat_tulis', 'alat tulis' => 'perlengkapan',
            'lainnya' => 'lainnya',
            default => '-',
        };
    }

    private function normalizeStatus(string $status): string
    {
        return match ($status) {
            'selesai' => 'selesai',
            'diproses' => 'diproses',
            'pending', 'menunggu', 'active' => 'pending',
            default => $status !== '' ? $status : 'pending',
        };
    }

    private function normalize(mixed $value): mixed
    {
        if ($value instanceof ObjectId) {
            return (string) $value;
        }

        if ($value instanceof UTCDateTime) {
            return $value->toDateTime()->format('Y-m-d');
        }

        if ($value instanceof BSONDocument) {
            $value = (array) $value;
        }

        if (is_array($value)) {
            return array_map(fn (mixed $item): mixed => $this->normalize($item), $value);
        }

        return $value;
    }

    private function objectId(string $id): ?ObjectId
    {
        return preg_match('/^[a-f\d]{24}$/i', $id) ? new ObjectId($id) : null;
    }

    private function dateFromInput(string $date): UTCDateTime
    {
        $timestamp = strtotime($date);

        if ($timestamp === false) {
            $timestamp = time();
        }

        return new UTCDateTime($timestamp * 1000);
    }

    private function ensureIndexes(): void
    {
        $this->collection->createIndex(['buyer_id' => 1]);
        $this->collection->createIndex(['provider_id' => 1]);
        $this->collection->createIndex(['offer_id' => 1]);
        $this->collection->createIndex(['category' => 1]);
        $this->collection->createIndex(['kategori' => 1]);
        $this->collection->createIndex(['status' => 1]);
    }
}
