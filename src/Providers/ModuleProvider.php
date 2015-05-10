<?php
namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Repositories\CacheDecorator;
use TypiCMS\Modules\Contacts\Repositories\EloquentContact;
use TypiCMS\Modules\Contacts\Events\EventHandler;
use TypiCMS\Modules\Core\Observers\FileObserver;
use TypiCMS\Modules\Core\Services\Cache\LaravelCache;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'typicms.contacts'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['contacts' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'contacts');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'contacts');

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/contacts'),
        ], 'views');
        $this->publishes([
            __DIR__ . '/../database' => base_path('database'),
        ], 'migrations');

        // Observers
        Contact::observe(new FileObserver);
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Subscribe to events class
         */
        $app->events->subscribe(new EventHandler);

        /**
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Contacts\Providers\RouteServiceProvider');

        /**
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Contacts\Composers\SidebarViewComposer');

        $app->bind('TypiCMS\Modules\Contacts\Repositories\ContactInterface', function (Application $app) {
            $repository = new EloquentContact(new Contact);
            if (! config('typicms.cache')) {
                return $repository;
            }
            $laravelCache = new LaravelCache($app['cache'], 'contacts', 10);

            return new CacheDecorator($repository, $laravelCache);
        });

    }
}
