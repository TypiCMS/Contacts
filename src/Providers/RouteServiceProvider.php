<?php

namespace TypiCMS\Modules\Contacts\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Contacts\Http\Controllers\AdminController;
use TypiCMS\Modules\Contacts\Http\Controllers\ApiController;
use TypiCMS\Modules\Contacts\Http\Controllers\PublicController;
use TypiCMS\Modules\Core\Facades\TypiCMS;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define the routes for the application.
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
                            $router->get($uri, $options + ['uses' => [PublicController::class, 'form']])->name($lang.'::index-contacts');
                            $router->get($uri.'/sent', $options + ['uses' => [PublicController::class, 'sent']])->name($lang.'::contact-sent');
                            $router->post($uri, $options + ['uses' => [PublicController::class, 'store']])->name($lang.'::store-contact');
                        }
                    }
                });
            }

            /*
             * Admin routes
             */
            $router->middleware('admin')->prefix('admin')->group(function (Router $router) {
                $router->get('contacts', [AdminController::class, 'index'])->name('admin::index-contacts')->middleware('can:read contacts');
                $router->get('contacts/create', [AdminController::class, 'create'])->name('admin::create-contact')->middleware('can:create contacts');
                $router->get('contacts/{contact}/edit', [AdminController::class, 'edit'])->name('admin::edit-contact')->middleware('can:update contacts');
                $router->post('contacts', [AdminController::class, 'store'])->name('admin::store-contact')->middleware('can:create contacts');
                $router->put('contacts/{contact}', [AdminController::class, 'update'])->name('admin::update-contact')->middleware('can:update contacts');
            });

            /*
             * API routes
             */
            $router->middleware('api')->prefix('api')->group(function (Router $router) {
                $router->middleware('auth:api')->group(function (Router $router) {
                    $router->get('contacts', [ApiController::class, 'index'])->middleware('can:read contacts');
                    $router->patch('contacts/{contact}', [ApiController::class, 'updatePartial'])->middleware('can:update contacts');
                    $router->delete('contacts/{contact}', [ApiController::class, 'destroy'])->middleware('can:delete contacts');
                });
            });
        });
    }
}
