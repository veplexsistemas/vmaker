<?php

namespace VMaker;

use Illuminate\Support\ServiceProvider;

class VMakerServiceProvider extends ServiceProvider
{
  public function boot()
  {
    $this->publishes([
      // Assets
      __DIR__.'/../resources/js' => public_path('vendor/vmaker/js')
    ], 'vmaker');
  }
}
