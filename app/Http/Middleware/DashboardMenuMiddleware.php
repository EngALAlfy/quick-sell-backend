<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Link;

class DashboardMenuMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $menu = $this->buildMenu();
        Menu::macro('dashboard', function () use ($menu) {
            return $menu;
        });

        return $next($request);
    }


    public function buildMenu(): Menu
    {
        $menu = Menu::new();
        $menu->addClass("menu-inner py-1 ps");
        $menu->addItemClass("menu-link");
        $menu->addItemParentClass("menu-item");
        $menu->setActiveFromRequest();

        $this->addHomeMenu($menu);
        $this->addManageMenu($menu);
        $this->addSalesMenu($menu);
        $this->addReportsMenu($menu);
        $this->addUsersMenu($menu);
        $this->addSettingsMenu($menu);


        return $menu;
    }

    private function addHomeMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __('Info and Statistics'));

        $this->addRouteLink($menu, route("dashboard.home.index"), __('Home'), asset("assets/admin/img/icons/store.png"));
    }

    private function addSettingsMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __('Settings Area'));

        $this->addRouteLink($menu, route("dashboard.settings.index"), __('Settings'), asset("assets/admin/img/icons/settings.png"));
        $this->addRouteLink($menu, route("dashboard.roles.index"), __('Roles'), asset("assets/admin/img/icons/roles.png"));
        $this->addRouteLink($menu, route("dashboard.permissions.index"), __('Permissions Manager'), asset("assets/admin/img/icons/permissions.png"));
        $this->addRouteLink($menu, "/error-log", __('Error Log'), asset("assets/admin/img/icons/error.png"));
        $this->addRouteLink($menu, "/dev-log", __('Dev Log'), asset("assets/admin/img/icons/code.png"));
        $this->addRouteLink($menu, route("dashboard.activity"), __('Activity Log'), asset("assets/admin/img/icons/record.png"));
        $this->addRouteLink($menu, route("dashboard.activity-log"), __('Activity Log 2'), asset("assets/admin/img/icons/recording.png"));
    }


    private function addUsersMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __("Users Area"));

        $this->addRouteLink($menu, route("dashboard.users.index"), __('Users List'), asset("assets/admin/img/icons/unauthorized-person.png"));
    }

    private function addHtmlTitle(Menu $menu, $title): void
    {
        $menu->html(
            "<li class='menu-header small text-uppercase'>
                   <span class='menu-header-text'>" . Str::ucfirst($title) . "</span>
                </li>"
        );
    }

    private function addRouteLink(Menu $menu, $route, $title, $image): void
    {
        $menu->add(Link::to($route, '<img alt="' . Str::ucfirst($title) . '" src="' . $image . '" class="menu-icon"><div>' . $title . '</div>'));
    }
}
