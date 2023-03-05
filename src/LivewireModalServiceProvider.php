<?php

namespace Markrefaat\LivewireModal;

use Illuminate\Support\ServiceProvider;

class LivewireModalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'livewire-modal');
    }
}
