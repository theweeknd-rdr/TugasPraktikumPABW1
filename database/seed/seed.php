<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Client;

define('BASE_PATH', dirname(__DIR__, 2));

require BASE_PATH . '/vendor/autoload.php';

Dotenv::createImmutable(BASE_PATH)->safeLoad();

$config = require BASE_PATH . '/config/config.php';
$client = new Client($config['database']['uri']);
$database = $client->selectDatabase($config['database']['name']);

$usersCollection = $database->selectCollection('users');
$offersCollection = $database->selectCollection('offers');
$ordersCollection = $database->selectCollection('orders');

$users = json_decode(file_get_contents(__DIR__ . '/users.json'), true, flags: JSON_THROW_ON_ERROR);
$offers = json_decode(file_get_contents(__DIR__ . '/offers.json'), true, flags: JSON_THROW_ON_ERROR);
$orders = json_decode(file_get_contents(__DIR__ . '/orders.json'), true, flags: JSON_THROW_ON_ERROR);
$now = new UTCDateTime();

$usersCollection->createIndex(['email' => 1], ['unique' => true]);
$offersCollection->createIndex(['provider_id' => 1]);
$offersCollection->createIndex(['status' => 1]);
$offersCollection->createIndex(['deadline' => 1]);
$offersCollection->createIndex(['category' => 1]);
$ordersCollection->createIndex(['buyer_id' => 1]);
$ordersCollection->createIndex(['provider_id' => 1]);
$ordersCollection->createIndex(['offer_id' => 1]);
$ordersCollection->createIndex(['category' => 1]);
$ordersCollection->createIndex(['kategori' => 1]);
$ordersCollection->createIndex(['status' => 1]);

foreach ($users as $user) {
    $usersCollection->updateOne(
        ['email' => $user['email']],
        [
            '$set' => [
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => password_hash($user['password'], PASSWORD_DEFAULT),
                'role' => $user['role'],
                'profileDetails' => $user['profileDetails'],
                'updated_at' => $now,
                'seed_source' => 'jastipin_seed',
            ],
            '$setOnInsert' => [
                '_id' => new ObjectId($user['_id']),
                'created_at' => $now,
            ],
        ],
        ['upsert' => true]
    );
}

$offersCollection->deleteMany(['seed_source' => 'jastipin_seed']);
$ordersCollection->deleteMany(['seed_source' => 'jastipin_seed']);

foreach ($offers as $offer) {
    $offersCollection->insertOne([
        '_id' => new ObjectId($offer['_id']),
        'provider_id' => new ObjectId($offer['provider_id']),
        'title' => $offer['title'],
        'description' => $offer['description'],
        'location' => $offer['location'],
        'category' => $offer['category'],
        'status' => $offer['status'],
        'deadline' => new UTCDateTime(strtotime($offer['deadline']) * 1000),
        'createdAt' => $now,
        'updatedAt' => $now,
        'seed_source' => 'jastipin_seed',
    ]);
}

foreach ($orders as $order) {
    $itemName = $order['nama_barang'];
    $category = $order['kategori'];
    $serviceFee = (float) $order['harga_jasa'];
    $neededDate = new UTCDateTime(strtotime($order['tanggal']) * 1000);

    $ordersCollection->insertOne([
        '_id' => new ObjectId($order['_id']),
        'offer_id' => new ObjectId($order['offer_id']),
        'buyer_id' => new ObjectId($order['buyer_id']),
        'provider_id' => new ObjectId($order['provider_id']),
        'item_name' => $itemName,
        'category' => $category,
        'service_fee' => $serviceFee,
        'needed_date' => $neededDate,
        'status' => $order['status'],
        'createdAt' => $now,
        'updatedAt' => $now,
        'nama_barang' => $itemName,
        'kategori' => $category,
        'harga_jasa' => $serviceFee,
        'tanggal' => $neededDate,
        'created_at' => $now,
        'updated_at' => $now,
        'seed_source' => 'jastipin_seed',
    ]);
}

echo "Seed berhasil masuk ke database {$config['database']['name']}.\n";
echo "Users: " . $usersCollection->countDocuments() . "\n";
echo "Offers: " . $offersCollection->countDocuments() . "\n";
echo "Orders: " . $ordersCollection->countDocuments() . "\n";
