<?php

namespace App\Traits;

use Livewire\Attributes\Url;

trait WithSearch
{

    public $search = '';

    public function updatedSearch()
    {
        if (isset($this->perPage) && $this->perPage > 100) {
            $this->perPage = 100;
        }
        $this->resetPage();
    }

    protected function queryStringWithSearch()
    {
        return [
            'search' => [
                'except' => '',
                'as' => $this->searchAs ?? 'search'
            ],
        ];
    }
}
