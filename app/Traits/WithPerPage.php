<?php

namespace App\Traits;

trait WithPerPage
{
    public $perPage = 100;
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    protected function queryStringWithPerPage()
    {
        return [
            'perPage' => [
                'except' => 100,
                'as' => $this->perPageAs ?? 'perPage'
            ],
        ];
    }
}
