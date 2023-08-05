<?php

namespace App\Providers;

use App\Events\BarangMasukCreated;
use App\Events\BarangKeluarCreated;
use Illuminate\Support\Facades\Event;
use App\Events\BarangTransaksiCreated;
use Illuminate\Auth\Events\Registered;
use App\Listeners\BarangTransaksiListener;
use App\Listeners\BarangMasukCreatedListener;
use Illuminate\Database\Events\QueryExecuted;
use App\Listeners\BarangKeluarCreatedListener;
use App\Listeners\BarangTransaksiCreatedListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // BarangMasukCreated::class => [
        //     BarangMasukCreatedListener::class,
        // ],
        // BarangKeluarCreated::class => [
        //     BarangKeluarCreatedListener::class,
        // ],
        BarangTransaksiCreated::class => [
            // BarangTransaksiCreatedListener::class,
            BarangMasukCreatedListener::class,
            BarangKeluarCreatedListener::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
