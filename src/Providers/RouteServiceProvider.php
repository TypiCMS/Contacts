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
        /*
         * Front office routes
         */
        if ($page = TypiCMS::getPageLinkedToModule('contacts')) {
            $middleware = $page->private ? ['public', 'auth'] : ['public'];
            foreach (locales() as $lang) {
                if ($page->isPublished($lang) && $uri = $page->uri($lang)) {
                    Route::middleware($middleware)->prefix($uri)->name($lang.'::')->group(function (Router $router) {
                        $router->get('/', [PublicController::class, 'form'])->name('index-contacts');
                        $router->get('sent', [PublicController::class, 'sent'])->name('contact-sent');
                        $router->post('/', [PublicController::class, 'store'])->name('store-contact');
                    });
                }
            }
        }

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('contacts', [AdminController::class, 'index'])->name('index-contacts')->middleware('can:read contacts');
            $router->get('contacts/create', [AdminController::class, 'create'])->name('create-contact')->middleware('can:create contacts');
            $router->get('contacts/{contact}/edit', [AdminController::class, 'edit'])->name('edit-contact')->middleware('can:read contacts');
            $router->post('contacts', [AdminController::class, 'store'])->name('store-contact')->middleware('can:create contacts');
            $router->put('contacts/{contact}', [AdminController::class, 'update'])->name('update-contact')->middleware('can:update contacts');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('contacts', [ApiController::class, 'index'])->middleware('can:read contacts');
            $router->patch('contacts/{contact}', [ApiController::class, 'updatePartial'])->middleware('can:update contacts');
            $router->delete('contacts/{contact}', [ApiController::class, 'destroy'])->middleware('can:delete contacts');
        });
    }
}
