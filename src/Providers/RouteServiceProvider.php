<?php

namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
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
     * @return null
     */
    public function map()
    {
        Route::group(['namespace' => $this->namespace], function (Router $router) {

            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('contacts')) {
                $options = $page->private ? ['middleware' => 'auth'] : [];
                foreach (locales() as $lang) {
                    if ($page->translate('status', $lang) && $uri = $page->uri($lang)) {
                        $router->get($uri, $options + ['uses' => 'PublicController@form'])->name($lang.'::index-contacts');
                        $router->get($uri.'/sent', $options + ['uses' => 'PublicController@sent'])->name($lang.'::contact-sent');
                        $router->post($uri, $options + ['uses' => 'PublicController@store'])->name($lang.'::store-contact');
                    }
                }
            }

            /*
             * Admin routes
             */
            $router->group(['middleware' => 'admin', 'prefix' => 'admin'], function (Router $router) {
                $router->get('contacts', 'AdminController@index')->name('admin::index-contacts');
                $router->get('contacts/create', 'AdminController@create')->name('admin::create-contact');
                $router->get('contacts/{contact}/edit', 'AdminController@edit')->name('admin::edit-contact');
                $router->post('contacts', 'AdminController@store')->name('admin::store-contact');
                $router->put('contacts/{contact}', 'AdminController@update')->name('admin::update-contact');
                $router->patch('contacts/{ids}', 'AdminController@ajaxUpdate')->name('admin::update-contact-ajax');
                $router->delete('contacts/{ids}', 'AdminController@destroyMultiple')->name('admin::destroy-contact');
            });
        });
    }
}
