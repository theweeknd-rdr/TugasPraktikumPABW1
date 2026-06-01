<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Offer;
use App\Models\Order;

class OrderController extends Controller
{
    public function create(): void
    {
        $offerId = (string) $this->input('offer_id', '');
        $offer = (new Offer())->findActiveById($offerId);

        if ($offer === null) {
            $this->flash('error', 'Offer tidak ditemukan, sudah expired, atau tidak aktif.');
            $this->redirect('/buyer/offers');
        }

        $this->view('buyer.orders.create', [
            'title' => 'Titip Barang',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'offer' => $offer,
            'categories' => Order::CATEGORIES,
        ]);
    }

    public function store(): void
    {
        try {
            $offer = (new Offer())->findActiveById((string) $this->input('offer_id'));

            if ($offer === null) {
                throw new \RuntimeException('Offer tidak ditemukan, sudah expired, atau tidak aktif.');
            }

            $providerId = (string) ($offer['provider_id'] ?? '');
            $hiddenProviderId = (string) $this->input('provider_id', '');

            if ($hiddenProviderId !== '' && $hiddenProviderId !== $providerId) {
                throw new \RuntimeException('Provider tidak sesuai dengan offer.');
            }

            (new Order())->create([
                'offer_id' => $offer['_id'],
                'provider_id' => $offer['provider_id'],
                'buyer_id' => $this->currentUser()['_id'],
                'item_name' => $this->input('item_name'),
                'category' => $this->orderCategory((string) ($offer['category'] ?? '')),
                'service_fee' => (int) $this->input('service_fee', 0),
                'needed_date' => $this->input('needed_date'),
                'status' => 'pending',
            ]);

            $this->flash('success', 'Pesanan berhasil dibuat dari Open Jastip.');
            $this->redirect('/buyer/orders/history');
        } catch (\Throwable $exception) {
            $this->flash('error', $exception->getMessage());
            $this->back('/buyer/offers');
        }
    }

    private function orderCategory(string $category): string
    {
        return match ($category) {
            'makanan' => 'makanan',
            'fotokopi' => 'fotokopi',
            'perlengkapan', 'alat_tulis', 'alat tulis' => 'perlengkapan',
            'lainnya' => 'lainnya',
            default => 'lainnya',
        };
    }

    public function index(): void
    {
        $orderModel = new Order();
        $category = (string) $this->input('category', '');

        try {
            $orders = $category === ''
                ? $orderModel->latest()
                : $orderModel->findByCategory($category);
        } catch (\Throwable $exception) {
            $this->flash('error', $exception->getMessage());
            $orders = [];
        }

        $this->view('orders.index', [
            'title' => 'Daftar Pesanan',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'orders' => $orders,
            'categories' => Order::CATEGORIES,
            'selectedCategory' => $category,
            'stats' => [
                'total' => count($orders),
                'pending' => count(array_filter($orders, fn(array $order): bool => ($order['status'] ?? '') === 'pending')),
                'diproses' => count(array_filter($orders, fn(array $order): bool => ($order['status'] ?? '') === 'diproses')),
                'selesai' => count(array_filter($orders, fn(array $order): bool => ($order['status'] ?? '') === 'selesai')),
            ],
        ]);
    }

    public function averageServiceFee(): void
    {
        $this->view('orders.avg_service_fee', [
            'title' => 'Rata-Rata Harga Jasa',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'average' => (new Order())->averageServiceFee(),
        ]);
    }
}
