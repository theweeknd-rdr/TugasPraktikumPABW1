<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;

class DatabaseController extends Controller
{
    public function status(): void
    {
        $status = [
            'connected' => false,
            'database' => $this->config['database']['name'],
            'uri' => $this->maskUri($this->config['database']['uri']),
            'collections' => [],
            'error' => null,
        ];

        try {
            $database = Database::connection();
            $database->command(['ping' => 1])->toArray();

            foreach (['users', 'orders', 'offers'] as $collectionName) {
                $status['collections'][] = [
                    'name' => $collectionName,
                    'documents' => $database->selectCollection($collectionName)->countDocuments(),
                ];
            }

            $status['connected'] = true;
        } catch (\Throwable $exception) {
            $status['error'] = $exception->getMessage();
        }

        $this->view('database.status', [
            'title' => 'MongoDB Status',
            'status' => $status,
        ]);
    }

    private function maskUri(string $uri): string
    {
        return preg_replace('/\/\/([^:\/]+):([^@]+)@/', '//***:***@', $uri) ?? $uri;
    }
}
