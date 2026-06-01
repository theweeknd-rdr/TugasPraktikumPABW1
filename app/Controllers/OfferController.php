<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Offer;

class OfferController extends Controller
{
    public function buyerIndex(): void
    {
        $this->view('buyer.offers.index', [
            'title' => 'Open Jastip Aktif',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'offers' => (new Offer())->activeWithProvider(),
        ]);
    }

    public function providerIndex(): void
    {
        $this->view('provider.offers.index', [
            'title' => 'Open Jastip Saya',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'offers' => (new Offer())->findByProvider($this->currentUser()['_id']),
        ]);
    }

    public function create(): void
    {
        $this->view('provider.offers.create', [
            'title' => 'Buat Open Jastip',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
            'categories' => Offer::CATEGORIES,
        ]);
    }

    public function store(): void
    {
        try {
            (new Offer())->create([
                'provider_id' => $this->currentUser()['_id'],
                'title' => $this->input('title'),
                'description' => $this->input('description'),
                'location' => $this->input('location'),
                'category' => $this->input('category'),
                'status' => 'active',
                'deadline' => $this->input('deadline'),
            ]);

            $this->flash('success', 'Open Jastip berhasil dibuat.');
            $this->redirect('/provider/offers');
        } catch (\Throwable $exception) {
            $this->flash('error', $exception->getMessage());
            $this->back('/provider/offers/create');
        }
    }
}
