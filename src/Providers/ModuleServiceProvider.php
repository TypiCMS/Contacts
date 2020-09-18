<?php

namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Msurguy\Honeypot\HoneypotFacade;
use TypiCMS\Modules\Contacts\Composers\SidebarViewComposer;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.contacts');
        $this->mergeConfigFrom(__DIR__.'/../config/permissions.php', 'typicms.permissions');

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['contacts' => ['linkable_to_page']], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'contacts');

        $this->publishes([
            __DIR__.'/../database/migrations/create_contacts_table.php.stub' => getMigrationFileName('create_contacts_table'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/contacts'),
        ], 'views');

        // Honeypot facade
        AliasLoader::getInstance()->alias('Honeypot', HoneypotFacade::class);

        /*
         * Sidebar view composer
         */
        $this->app->view->composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        $this->app->view->composer('contacts::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('contacts');
        });
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register(RouteServiceProvider::class);

        /*
         * Register Honeypot
         */
        $app->register('Msurguy\Honeypot\HoneypotServiceProvider');

        $app->bind('Contacts', Contact::class);
    }
}
