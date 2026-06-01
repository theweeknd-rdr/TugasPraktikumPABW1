<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;

class ProviderController extends Controller
{
    public function dashboard(): void
    {
        $orderModel = new Order();
        $userId = $this->currentUser()['_id'];

        $this->view('provider.dashboard', [
            'title' => 'Dashboard Provider',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'summary' => $orderModel->providerSummary($userId),
            'incomingOrders' => $orderModel->findByProviderAndStatuses($userId, ['pending']),
            'activeOrders' => $orderModel->findByProviderAndStatuses($userId, ['diproses']),
            'orders' => array_slice($orderModel->findByProvider($userId), 0, 5),
        ]);
    }

    public function deliveryHistory(): void
    {
        $orders = (new Order())->findByProvider($this->currentUser()['_id']);

        $this->view('provider.delivery_history', [
            'title' => 'Riwayat Pengantaran',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'orders' => $orders,
            'stats' => [
                'total' => count($orders),
                'diproses' => count(array_filter($orders, fn(array $order): bool => ($order['status'] ?? '') === 'diproses')),
                'selesai' => count(array_filter($orders, fn(array $order): bool => ($order['status'] ?? '') === 'selesai')),
                'pendapatan' => array_sum(array_map(
                    fn(array $order): float => ($order['status'] ?? '') === 'selesai' ? (float) ($order['harga_jasa'] ?? 0) : 0,
                    $orders
                )),
            ],
        ]);
    }

    public function acceptOrder(): void
    {
        try {
            $updated = (new Order())->acceptForProvider(
                (string) $this->input('order_id'),
                $this->currentUser()['_id']
            );

            if (! $updated) {
                throw new \RuntimeException('Pesanan tidak ditemukan, sudah di-ACC, atau bukan milik Open Jastip provider ini.');
            }

            $this->flash('success', 'Pesanan berhasil di-ACC dan masuk status diproses.');
        } catch (\Throwable $exception) {
            $this->flash('error', $exception->getMessage());
        }

        $this->back('/provider/dashboard');
    }

    public function completeOrder(): void
    {
        $this->updateOrderStatus('selesai', 'Pesanan berhasil diselesaikan.');
    }

    private function updateOrderStatus(string $status, string $successMessage): void
    {
        try {
            $updated = (new Order())->updateStatusForProvider(
                (string) $this->input('order_id'),
                $this->currentUser()['_id'],
                $status
            );

            if (! $updated) {
                throw new \RuntimeException('Pesanan tidak ditemukan untuk provider ini.');
            }

            $this->flash('success', $successMessage);
        } catch (\Throwable $exception) {
            $this->flash('error', $exception->getMessage());
        }

        $this->back('/provider/dashboard');
    }
}
