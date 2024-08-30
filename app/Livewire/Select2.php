<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Select2 extends Component
{

    #[Modelable]
    public $value = null;

    public $name;

    #[Reactive]
    public $options;

    public function mount($name, $options)
    {
        $this->name = $name;
        $this->options = $options;
    }

    public function render()
    {
        return view('livewire.select2');
    }
}
