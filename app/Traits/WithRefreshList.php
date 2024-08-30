<?php

namespace App\Traits;

use Livewire\Attributes\On;
use Masmerise\Toaster\Toaster;

trait WithRefreshList
{
    #[On('refresh-list')]
    public function refresh(?string $message = null)
    {
        if ($message)
            Toaster::success($message);
    }
}
