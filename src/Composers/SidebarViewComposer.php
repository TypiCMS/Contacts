<?php
namespace TypiCMS\Modules\Contacts\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.contacts'), function (SidebarGroup $group) {
            $group->id = 'contacts';
            $group->weight = 20;
            $group->addItem(trans('contacts::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.contacts.sidebar.icon', 'icon fa fa-fw fa-envelope');
                $item->weight = config('typicms.contacts.sidebar.weight');
                $item->route('admin.contacts.index');
                $item->append('admin.contacts.create');
                $item->authorize(
                    $this->user->hasAccess('contacts.index')
                );
            });
        });
    }
}
