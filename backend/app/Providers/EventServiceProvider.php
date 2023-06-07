<?php

namespace App\Providers;

use App\Events\AddNewGoodsEvent;
use App\Events\RemoveGoodsEvent;
use App\Events\SoldGoodsEvent;
use App\Events\UpdateGoodsEvent;
use App\Listeners\AddNewGoodsListener;
use App\Listeners\RemoveGoodsListener;
use App\Listeners\SoldGoodsListener;
use App\Listeners\UpdateGoodsListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AddNewGoodsEvent::class => [
            AddNewGoodsListener::class,
        ],
        UpdateGoodsEvent::class => [
            UpdateGoodsListener::class,
        ],
        RemoveGoodsEvent::class => [
            RemoveGoodsListener::class,
        ],
        SoldGoodsEvent::class => [
            SoldGoodsListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
