<?php

declare(strict_types=1);

namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Override;
use TypiCMS\Modules\Contacts\Composers\SidebarViewComposer;
use TypiCMS\Modules\Contacts\Models\Contact;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/contacts.php');

        $this->publishes([
            __DIR__.'/../../database/migrations/create_contacts_table.php.stub' => getMigrationFileName(
                'create_contacts_table',
            ),
        ], 'typicms-migrations');
        $this->publishes([
            __DIR__.'/../../resources/views/admin/contacts' => resource_path('views/admin/contacts'),
        ], ['typicms-views', 'typicms-admin-views', 'typicms-admin-contacts-views']);
        $this->publishes([
            __DIR__.'/../../resources/views/public/contacts' => resource_path('views/public/contacts'),
        ], ['typicms-views', 'typicms-public-views', 'typicms-public-contacts-views']);
        $this->publishes([
            __DIR__.'/../../resources/views/mail/contacts' => resource_path('views/mail/contacts'),
        ], ['typicms-views', 'typicms-mail-views', 'typicms-mail-contacts-views']);

        View::composer('admin::core._sidebar', SidebarViewComposer::class);

        /*
         * Add the page in the view.
         */
        View::composer('public::contacts.*', function ($view): void {
            $view->page = getPageLinkedToModule('contacts');
        });
    }

    #[Override]
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/contacts.php', 'typicms.modules.contacts');

        $this->app->bind('Contacts', Contact::class);
    }
}
