<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Contacts\Composers\SidebarViewComposer;
use TypiCMS\Modules\Contacts\Models\Contact;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/contacts.php', 'typicms.modules.contacts');

        $this->loadRoutesFrom(__DIR__ . '/../routes/contacts.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views/', 'contacts');

        $this->publishes([
            __DIR__ . '/../../database/migrations/create_contacts_table.php.stub' => getMigrationFileName(
                'create_contacts_table',
            ),
        ], 'typicms-migrations');
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/contacts'),
        ], 'typicms-views');

        View::composer('core::admin._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('contacts::public.*', function ($view): void {
            $view->page = getPageLinkedToModule('contacts');
        });
    }

    public function register(): void
    {
        $this->app->bind('Contacts', Contact::class);
    }
}
