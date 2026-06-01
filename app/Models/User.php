<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use MongoDB\Collection;
use MongoDB\Driver\Exception\BulkWriteException;
use MongoDB\Model\BSONDocument;

class User
{
    public const ROLES = ['buyer', 'provider'];

    private Collection $collection;

    public function __construct()
    {
        $this->collection = Database::collection('users');
        $this->ensureIndexes();
    }

    public function create(array $data): array
    {
        $name = trim((string) ($data['name'] ?? ''));
        $email = strtolower(trim((string) ($data['email'] ?? '')));
        $password = (string) ($data['password'] ?? '');
        $role = (string) ($data['role'] ?? 'buyer');

        if ($name === '' || $email === '' || $password === '') {
            throw new \InvalidArgumentException('Nama, email, dan password wajib diisi.');
        }

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Format email tidak valid.');
        }

        if (! in_array($role, self::ROLES, true)) {
            throw new \InvalidArgumentException('Role hanya boleh buyer atau provider.');
        }

        if ($this->findByEmail($email) !== null) {
            throw new \InvalidArgumentException('Email sudah terdaftar.');
        }

        $now = new UTCDateTime();

        try {
            $result = $this->collection->insertOne([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $role,
                'profileDetails' => [
                    'phone' => trim((string) ($data['phone'] ?? '')),
                    'address' => trim((string) ($data['address'] ?? '')),
                    'avatar' => trim((string) ($data['avatar'] ?? '')),
                ],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } catch (BulkWriteException $exception) {
            throw new \InvalidArgumentException('Email sudah terdaftar.', 0, $exception);
        }

        $createdUser = $this->findById((string) $result->getInsertedId());

        if ($createdUser === null) {
            throw new \RuntimeException('User berhasil dibuat, tetapi gagal dibaca kembali.');
        }

        return $createdUser;
    }

    public function authenticate(string $email, string $password): ?array
    {
        $user = $this->rawByEmail($email);

        if ($user === null || ! password_verify($password, (string) $user['password'])) {
            return null;
        }

        return $this->sanitize($user);
    }

    public function findByEmail(string $email): ?array
    {
        return $this->sanitize($this->rawByEmail($email));
    }

    public function findById(string|ObjectId $id): ?array
    {
        $objectId = $id instanceof ObjectId ? $id : $this->objectId($id);

        if ($objectId === null) {
            return null;
        }

        return $this->sanitize($this->collection->findOne(['_id' => $objectId]));
    }

    public function allProviders(): array
    {
        $providers = [];
        $cursor = $this->collection->find(
            ['role' => 'provider'],
            ['sort' => ['name' => 1]]
        );

        foreach ($cursor as $provider) {
            $providers[] = $this->sanitize($provider);
        }

        return $providers;
    }

    private function rawByEmail(string $email): ?array
    {
        $user = $this->collection->findOne([
            'email' => strtolower(trim($email)),
        ]);

        return $user === null ? null : (array) $user;
    }

    private function sanitize(array|BSONDocument|null $user): ?array
    {
        if ($user === null) {
            return null;
        }

        $user = $this->normalize((array) $user);
        unset($user['password']);

        return $user;
    }

    private function normalize(mixed $value): mixed
    {
        if ($value instanceof ObjectId) {
            return (string) $value;
        }

        if ($value instanceof UTCDateTime) {
            return $value->toDateTime()->format('Y-m-d H:i:s');
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

    private function ensureIndexes(): void
    {
        $this->collection->createIndex(['email' => 1], ['unique' => true]);
    }
}
