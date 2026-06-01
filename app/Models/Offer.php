<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Collection;
use MongoDB\Model\BSONArray;
use MongoDB\Model\BSONDocument;

class Offer
{
    public const CATEGORIES = ['makanan', 'fotokopi', 'perlengkapan', 'lainnya'];
    public const STATUSES = ['active', 'closed'];

    private Collection $collection;

    public function __construct()
    {
        $this->collection = Database::collection('offers');
        $this->ensureIndexes();
    }

    public function create(array $data): array
    {
        $providerId = $this->objectId((string) ($data['provider_id'] ?? ''));
        $title = trim((string) ($data['title'] ?? ''));
        $description = trim((string) ($data['description'] ?? ''));
        $location = trim((string) ($data['location'] ?? ''));
        $category = (string) ($data['category'] ?? '');
        $status = (string) ($data['status'] ?? 'active');
        $deadline = trim((string) ($data['deadline'] ?? ''));

        if ($providerId === null) {
            throw new \InvalidArgumentException('Provider tidak valid.');
        }

        if ($title === '' || $description === '' || $location === '' || $deadline === '') {
            throw new \InvalidArgumentException('Judul, deskripsi, lokasi, dan deadline wajib diisi.');
        }

        if (! in_array($category, self::CATEGORIES, true)) {
            throw new \InvalidArgumentException('Kategori offer tidak valid.');
        }

        if (! in_array($status, self::STATUSES, true)) {
            throw new \InvalidArgumentException('Status offer tidak valid.');
        }

        $deadlineDate = $this->dateFromInput($deadline);

        if ($deadlineDate->toDateTime()->getTimestamp() < strtotime(date('Y-m-d'))) {
            throw new \InvalidArgumentException('Deadline offer tidak boleh sudah lewat.');
        }

        $result = $this->collection->insertOne([
            'provider_id' => $providerId,
            'title' => $title,
            'description' => $description,
            'location' => $location,
            'category' => $category,
            'status' => $status,
            'deadline' => $deadlineDate,
            'createdAt' => new UTCDateTime(),
        ]);

        $offer = $this->findById((string) $result->getInsertedId());

        if ($offer === null) {
            throw new \RuntimeException('Offer berhasil dibuat, tetapi gagal dibaca kembali.');
        }

        return $offer;
    }

    public function activeWithProvider(): array
    {
        $today = new UTCDateTime(strtotime(date('Y-m-d')) * 1000);

        return $this->normalizeCursor($this->collection->aggregate([
            [
                '$match' => [
                    'status' => 'active',
                    'deadline' => ['$gte' => $today],
                ],
            ],
            [
                '$lookup' => [
                    'from' => 'users',
                    'localField' => 'provider_id',
                    'foreignField' => '_id',
                    'as' => 'provider',
                ],
            ],
            [
                '$unwind' => [
                    'path' => '$provider',
                    'preserveNullAndEmptyArrays' => true,
                ],
            ],
            ['$sort' => ['deadline' => 1]],
        ]));
    }

    public function findByProvider(string $providerId): array
    {
        $objectId = $this->objectId($providerId);

        if ($objectId === null) {
            return [];
        }

        return $this->normalizeCursor($this->collection->find(
            ['provider_id' => $objectId],
            ['sort' => ['createdAt' => -1]]
        ));
    }

    public function findById(string|ObjectId $id): ?array
    {
        $objectId = $id instanceof ObjectId ? $id : $this->objectId($id);

        if ($objectId === null) {
            return null;
        }

        $cursor = $this->collection->aggregate([
            ['$match' => ['_id' => $objectId]],
            [
                '$lookup' => [
                    'from' => 'users',
                    'localField' => 'provider_id',
                    'foreignField' => '_id',
                    'as' => 'provider',
                ],
            ],
            [
                '$unwind' => [
                    'path' => '$provider',
                    'preserveNullAndEmptyArrays' => true,
                ],
            ],
            ['$limit' => 1],
        ]);

        $items = $cursor->toArray();

        return isset($items[0]) ? $this->normalizeDocument($items[0]) : null;
    }

    public function findActiveById(string $id): ?array
    {
        $offer = $this->findById($id);

        if ($offer === null || ! $this->isActive($offer)) {
            return null;
        }

        return $offer;
    }

    public function isActive(array $offer): bool
    {
        $deadlineTimestamp = strtotime((string) ($offer['deadline'] ?? ''));

        return ($offer['status'] ?? '') === 'active'
            && $deadlineTimestamp !== false
            && $deadlineTimestamp >= strtotime(date('Y-m-d'));
    }

    private function normalizeCursor(iterable $cursor): array
    {
        $offers = [];

        foreach ($cursor as $offer) {
            $offers[] = $this->normalizeDocument($offer);
        }

        return $offers;
    }

    private function normalizeDocument(array|BSONDocument|null $document): ?array
    {
        if ($document === null) {
            return null;
        }

        return $this->normalize((array) $document);
    }

    private function normalize(mixed $value): mixed
    {
        if ($value instanceof ObjectId) {
            return (string) $value;
        }

        if ($value instanceof UTCDateTime) {
            return $value->toDateTime()->format('Y-m-d');
        }

        if ($value instanceof BSONDocument || $value instanceof BSONArray) {
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
            throw new \InvalidArgumentException('Format deadline tidak valid.');
        }

        return new UTCDateTime($timestamp * 1000);
    }

    private function ensureIndexes(): void
    {
        $this->collection->createIndex(['provider_id' => 1]);
        $this->collection->createIndex(['status' => 1]);
        $this->collection->createIndex(['deadline' => 1]);
        $this->collection->createIndex(['category' => 1]);
    }
}
