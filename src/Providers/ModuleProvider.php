<?php
namespace TypiCMS\Modules\Contacts\Providers;

use Config;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Lang;
use TypiCMS\Modules\Contacts\Models\Contact;
use TypiCMS\Modules\Contacts\Repositories\CacheDecorator;
use TypiCMS\Modules\Contacts\Repositories\EloquentContact;
use TypiCMS\Modules\Contacts\Services\Form\ContactForm;
use TypiCMS\Modules\Contacts\Services\Form\ContactFormLaravelValidator;
use TypiCMS\Observers\FileObserver;
use TypiCMS\Services\Cache\LaravelCache;
use View;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {
        // Add dirs
        View::addNamespace('contacts', __DIR__ . '/../views/');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'contacts');
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

        $app->bind('TypiCMS\Modules\Contacts\Services\Form\ContactForm', function (Application $app) {
            return new ContactForm(
                new ContactFormLaravelValidator($app['validator']),
                $app->make('TypiCMS\Modules\Contacts\Repositories\ContactInterface')
            );
        });

    }
}
