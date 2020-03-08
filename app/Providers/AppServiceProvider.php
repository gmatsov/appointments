<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $client = new \GuzzleHttp\Client();
        $weather = [];
        try {
            $weather = json_decode($client->request('GET', 'http://api.openweathermap.org/data/2.5/weather?id=727011&appid=ec154a0e5add4f72e5b6f530ddce6171&units=metric')->getBody(), true);
        } catch (\Exception $e) {
        }
        view()->share('weather', $weather);
    }
}
