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
        Route::namespace($this->namespace)->group(function (Router $router) {
            /*
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('contacts')) {
                $router->middleware('public')->group(function (Router $router) use ($page) {
                    $options = $page->private ? ['middleware' => 'auth'] : [];
                    foreach (locales() as $lang) {
                        if ($page->translate('status', $lang) && $uri = $page->uri($lang)) {
                            $router->get($uri, $options + ['uses' => 'PublicController@form'])->name($lang.'::index-contacts');
                            $router->get($uri.'/sent', $options + ['uses' => 'PublicController@sent'])->name($lang.'::contact-sent');
                            $router->post($uri, $options + ['uses' => 'PublicController@store'])->name($lang.'::store-contact');
                        }
                    }
                });
            }

            /*
             * Admin routes
             */
            $router->middleware('admin')->prefix('admin')->group(function (Router $router) {
                $router->get('contacts', 'AdminController@index')->name('admin::index-contacts')->middleware('can:see-all-contacts');
                $router->get('contacts/create', 'AdminController@create')->name('admin::create-contact')->middleware('can:create-contact');
                $router->get('contacts/{contact}/edit', 'AdminController@edit')->name('admin::edit-contact')->middleware('can:update-contact');
                $router->post('contacts', 'AdminController@store')->name('admin::store-contact')->middleware('can:create-contact');
                $router->put('contacts/{contact}', 'AdminController@update')->name('admin::update-contact')->middleware('can:update-contact');
            });

            /*
             * API routes
             */
            $router->middleware('api')->prefix('api')->group(function (Router $router) {
                $router->middleware('auth:api')->group(function (Router $router) {
                    $router->get('contacts', 'ApiController@index')->middleware('can:see-all-contacts');
                    $router->patch('contacts/{contact}', 'ApiController@updatePartial')->middleware('can:update-contact');
                    $router->delete('contacts/{contact}', 'ApiController@destroy')->middleware('can:delete-contact');
                });
            });
        });
    }
}
