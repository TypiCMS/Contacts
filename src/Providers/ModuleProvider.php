<?php

namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Msurguy\Honeypot\HoneypotFacade;
use TypiCMS\Modules\Contacts\Composers\SidebarViewComposer;
use TypiCMS\Modules\Contacts\Events\EventHandler;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Repositories\EloquentContact;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.contacts'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['contacts' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'contacts');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'contacts');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/contacts'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        // Honeypot facade
        AliasLoader::getInstance()->alias('Honeypot', HoneypotFacade::class);
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Subscribe to events class
         */
        $app->events->subscribe(new EventHandler());

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        /*
         * Register Honeypot
         */
        $app->register('Msurguy\Honeypot\HoneypotServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $app->view->composer('contacts::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('contacts');
        });

        $app->bind('Contacts', EloquentContact::class);
    }
}
