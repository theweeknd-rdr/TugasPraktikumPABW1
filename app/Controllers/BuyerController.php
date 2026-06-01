<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;

class BuyerController extends Controller
{
    public function dashboard(): void
    {
        $orders = (new Order())->findByBuyer($this->currentUser()['_id']);

        $this->view('buyer.dashboard', [
            'title' => 'Dashboard Buyer',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'orders' => array_slice($orders, 0, 5),
            'totalOrders' => count($orders),
            'pendingOrders' => count(array_filter($orders, fn (array $order): bool => ($order['status'] ?? '') === 'pending')),
            'processedOrders' => count(array_filter($orders, fn (array $order): bool => ($order['status'] ?? '') === 'diproses')),
            'completedOrders' => count(array_filter($orders, fn (array $order): bool => ($order['status'] ?? '') === 'selesai')),
        ]);
    }

    public function createOrder(): void
    {
        $this->flash('error', 'Pilih Open Jastip aktif terlebih dahulu sebelum titip barang.');
        $this->redirect('/buyer/offers');
    }

    public function storeOrder(): void
    {
        $this->flash('error', 'Pesanan baru harus dibuat dari Open Jastip aktif.');
        $this->redirect('/buyer/offers');
    }

    public function orderHistory(): void
    {
        $this->view('buyer.order_history', [
            'title' => 'Riwayat Pesanan',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'orders' => (new Order())->findByBuyer($this->currentUser()['_id']),
        ]);
    }
}
