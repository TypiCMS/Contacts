<?php

namespace TypiCMS\Modules\Contacts\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.contacts'), function (SidebarGroup $group) {
            $group->id = 'contacts';
            $group->weight = 20;
            $group->addItem(trans('contacts::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.contacts.sidebar.icon', 'icon fa fa-fw fa-envelope');
                $item->weight = config('typicms.contacts.sidebar.weight');
                $item->route('admin::index-contacts');
                $item->append('admin::create-contact');
                $item->authorize(
                    Gate::allows('index-contacts')
                );
            });
        });
    }
}
