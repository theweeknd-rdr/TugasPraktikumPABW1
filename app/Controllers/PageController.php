<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

class PageController extends Controller
{
    public function landing(): void
    {
        $this->view('pages.landing', [
            'title' => 'Home',
            'useTailwind' => true,
            'fullBleed' => true,
            'hideAppHeader' => true,
        ]);
    }
}
