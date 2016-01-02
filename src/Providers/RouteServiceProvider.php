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
                    if ($uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['as' => $lang.'.contacts', 'uses' => 'PublicController@form']);
                        $router->get($uri.'/sent', $options + ['as' => $lang.'.contacts.sent', 'uses' => 'PublicController@sent']);
                        $router->post($uri, $options + ['as' => $lang.'.contacts.store', 'uses' => 'PublicController@store']);
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->get('admin/contacts', ['as' => 'admin.contacts.index', 'uses' => 'AdminController@index']);
            $router->get('admin/contacts/create', ['as' => 'admin.contacts.create', 'uses' => 'AdminController@create']);
            $router->get('admin/contacts/{contact}/edit', ['as' => 'admin.contacts.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/contacts', ['as' => 'admin.contacts.store', 'uses' => 'AdminController@store']);
            $router->put('admin/contacts/{contact}', ['as' => 'admin.contacts.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/contacts', ['as' => 'api.contacts.index', 'uses' => 'ApiController@index']);
            $router->put('api/contacts/{contact}', ['as' => 'api.contacts.update', 'uses' => 'ApiController@update']);
            $router->delete('api/contacts/{contact}', ['as' => 'api.contacts.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
