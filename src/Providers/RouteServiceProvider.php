<?php
namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use TypiCMS\Facades\TypiCMS;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Contacts\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->model('contacts', 'TypiCMS\Modules\Contacts\Models\Contact');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function($router) {

            /**
             * Front office routes
             */
            if ($page = TypiCMS::getPageLinkedToModule('contacts')) {
                foreach (config('translatable.locales') as $lang) {
                    if ($page->hasTranslation($lang)) {
                        $uri = $page->translate($lang)->uri;
                        $router->get($uri, ['as' => $lang.'.contacts', 'uses' => 'PublicController@form']);
                        $router->get($uri . '/sent', ['as' => $lang.'.contacts.sent', 'uses' => 'PublicController@sent']);
                        $router->post($uri, ['as' => $lang . '.contacts.store', 'uses' => 'PublicController@store']);
                    }
                }
            }

            /**
             * Admin routes
             */
            $router->resource('admin/contacts', 'AdminController');

            /**
             * API routes
             */
            $router->resource('api/contacts', 'ApiController');
        });
    }

}
