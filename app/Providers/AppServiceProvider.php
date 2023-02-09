<?php

namespace App\Providers;

use App\Services\Newsletter;
use App\Services\MailchimpNewsletter;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        app()->bind(MailchimpNewsletter::class, function () {
//            $client = (new ApiClient())->setConfig([
//                'apiKey' => config('services.mailchimp.key'),
//                'server' => config('services.mailchimp.server'),
//            ]);
//            return new MailchimpNewsletter($client);
//        });

        app()->bind(Newsletter::class, function () {
            $client = (new ApiClient())->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => config('services.mailchimp.server'),
            ]);
            return new MailchimpNewsletter($client);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Paginator::useBootstrap();

        Gate::define('admin', function (User $user) {
            return $user->email === 'admin@mail.com';
        });

        Blade::if('admin', function () {
//            return request()->user()->can('admin');
            return request()->user()?->email === 'admin@mail.com';
        } );

    }
}
