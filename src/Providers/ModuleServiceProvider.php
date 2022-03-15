<?php

namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Msurguy\Honeypot\HoneypotFacade;
use TypiCMS\Modules\Contacts\Composers\SidebarViewComposer;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'typicms.modules.contacts');

        $this->loadViewsFrom(__DIR__.'/../../resources/views/', 'contacts');

        $this->publishes([__DIR__.'/../../database/migrations/create_contacts_table.php.stub' => getMigrationFileName('create_contacts_table')], 'typicms-migrations');
        $this->publishes([__DIR__.'/../../resources/views' => resource_path('views/vendor/contacts')], 'typicms-views');

        // Honeypot facade
        AliasLoader::getInstance()->alias('Honeypot', HoneypotFacade::class);

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('contacts::public.*', function ($view) {
            $view->page = TypiCMS::getPageLinkedToModule('contacts');
        });
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        /*
         * Register Honeypot
         */
        $this->app->register('Msurguy\Honeypot\HoneypotServiceProvider');

        $this->app->bind('Contacts', Contact::class);
    }
}
