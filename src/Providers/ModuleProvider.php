<?php
namespace TypiCMS\Modules\Contacts\Providers;

use Config;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Lang;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Repositories\CacheDecorator;
use TypiCMS\Modules\Contacts\Repositories\EloquentContact;
use TypiCMS\Observers\FileObserver;
use TypiCMS\Services\Cache\LaravelCache;
use View;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'contacts');
        $this->publishes([
            __DIR__ . '/../views' => base_path('resources/views/vendor/contacts'),
        ], 'views');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'contacts');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'typicms.contacts'
        );
        $this->publishes([
            __DIR__ . '/../migrations/' => base_path('/database/migrations'),
        ], 'migrations');

        // Observers
        Contact::observe(new FileObserver);
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Contacts\Providers\RouteServiceProvider');

        /**
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Contacts\Composers\SideBarViewComposer');

        $app->bind('TypiCMS\Modules\Contacts\Repositories\ContactInterface', function (Application $app) {
            $repository = new EloquentContact(new Contact);
            if (! Config::get('app.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'contacts', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

    }
}
