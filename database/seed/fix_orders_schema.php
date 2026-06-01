<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Client;

define('BASE_PATH', dirname(__DIR__, 2));

require BASE_PATH . '/vendor/autoload.php';

Dotenv::createImmutable(BASE_PATH)->safeLoad();

$config = require BASE_PATH . '/config/config.php';
$database = (new Client($config['database']['uri']))->selectDatabase($config['database']['name']);
$orders = $database->selectCollection('orders');
$offers = $database->selectCollection('offers');

$cursor = $orders->find([
    '$or' => [
        ['nama_barang' => ['$exists' => false]],
        ['item_name' => ['$exists' => false]],
        ['kategori' => ['$exists' => false]],
        ['category' => ['$exists' => false]],
        ['harga_jasa' => ['$exists' => false]],
        ['service_fee' => ['$exists' => false]],
        ['tanggal' => ['$exists' => false]],
        ['needed_date' => ['$exists' => false]],
        ['provider_id' => ['$exists' => false]],
    ],
]);

$updated = 0;

foreach ($cursor as $order) {
    $offer = isset($order['offer_id'])
        ? $offers->findOne(['_id' => $order['offer_id']])
        : null;

    $set = [
        'updated_at' => new UTCDateTime(),
    ];

    $itemName = (string) ($order['item_name'] ?? $order['nama_barang'] ?? itemNames((array) ($order['items'] ?? [])));
    $category = normalizeCategory((string) ($offer['category'] ?? $order['category'] ?? $order['kategori'] ?? ''));
    $serviceFee = (float) ($order['service_fee'] ?? $order['harga_jasa'] ?? $order['total_price'] ?? 0);
    $neededDate = $order['needed_date'] ?? $order['tanggal'] ?? $order['createdAt'] ?? $order['created_at'] ?? new UTCDateTime();

    if (! isset($order['item_name'])) {
        $set['item_name'] = $itemName;
    }

    if (! isset($order['nama_barang'])) {
        $set['nama_barang'] = $itemName;
    }

    if (! isset($order['category'])) {
        $set['category'] = $category;
    }

    if (! isset($order['kategori'])) {
        $set['kategori'] = $category;
    }

    if (! isset($order['service_fee'])) {
        $set['service_fee'] = $serviceFee;
    }

    if (! isset($order['harga_jasa'])) {
        $set['harga_jasa'] = $serviceFee;
    }

    if (! isset($order['needed_date'])) {
        $set['needed_date'] = $neededDate;
    }

    if (! isset($order['tanggal'])) {
        $set['tanggal'] = $neededDate;
    }

    if (! isset($order['provider_id']) && isset($offer['provider_id'])) {
        $set['provider_id'] = $offer['provider_id'];
    }

    if (isset($order['status']) && in_array($order['status'], ['menunggu', 'diproses'], true)) {
        $set['legacy_status'] = $order['status'];
        $set['status'] = 'pending';
    }

    $orders->updateOne(['_id' => $order['_id']], ['$set' => $set]);
    $updated++;
}

echo "Perbaikan schema orders selesai.\n";
echo "Dokumen diperbarui: {$updated}\n";

function itemNames(array $items): string
{
    if ($items === []) {
        return 'Barang tidak tersedia';
    }

    $names = [];

    foreach ($items as $item) {
        $quantity = (int) ($item['quantity'] ?? 1);
        $name = trim((string) ($item['name'] ?? 'Barang'));
        $names[] = ($quantity > 1 ? "{$quantity}x " : '') . $name;
    }

    return $names === [] ? 'Barang tidak tersedia' : implode(', ', $names);
}

function normalizeCategory(string $category): string
{
    return match ($category) {
        'makanan' => 'makanan',
        'fotokopi' => 'fotokopi',
        'perlengkapan', 'alat_tulis', 'alat tulis' => 'perlengkapan',
        'lainnya' => 'lainnya',
        default => 'lainnya',
    };
}
