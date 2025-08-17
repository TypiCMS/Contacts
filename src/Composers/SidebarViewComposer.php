<?php

namespace TypiCMS\Modules\Contacts\Composers;

use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view): void
    {
        if (Gate::denies('read contacts')) {
            return;
        }
        $view->offsetGet('sidebar')->group(__('Contacts'), function (SidebarGroup $group) {
            $group->id = 'contacts';
            $group->weight = 20;
            $group->addItem(__('Contacts'), function (SidebarItem $item) {
                $item->id = 'contacts';
                $item->icon = config('typicms.modules.contacts.sidebar.icon');
                $item->weight = config('typicms.modules.contacts.sidebar.weight');
                $item->route('admin::index-contacts');
            });
        });
    }
}
