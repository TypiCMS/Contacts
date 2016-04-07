<?php

namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Contacts\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {

            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('contacts')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (config('translatable.locales') as $lang) {
                    if ($page->translate($lang)->status && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.contacts', 'uses' => 'PublicController@form']);
                        $router->get($uri.'/sent', $options + ['as' => $lang.'.contacts.sent', 'uses' => 'PublicController@sent']);
                        $router->post($uri, $options + ['as' => $lang.'.contacts.store', 'uses' => 'PublicController@store']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/contacts', 'AdminController@index')->name('admin::index-contacts');
            $router->get('admin/contacts/create', 'AdminController@create')->name('admin::create-contact');
            $router->get('admin/contacts/{contact}/edit', 'AdminController@edit')->name('admin::edit-contact');
            $router->post('admin/contacts', 'AdminController@store')->name('admin::store-contact');
            $router->put('admin/contacts/{contact}', 'AdminController@update')->name('admin::update-contact');

            /*
             * API routes
             */
            $router->get('api/contacts', 'ApiController@index')->name('api::index-contacts');
            $router->put('api/contacts/{contact}', 'ApiController@update')->name('api::update-contact');
            $router->delete('api/contacts/{contact}', 'ApiController@destroy')->name('api::destroy-contact');
        });
    }
}
