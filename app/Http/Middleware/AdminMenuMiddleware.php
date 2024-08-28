<?php

namespace App\Http\Middleware;

use App\Enums\StoreStatus;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Link;

class AdminMenuMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $menu = $this->buildAdminMenu();
        Menu::macro('admin', function () use ($menu) {
            return $menu;
        });

        return $next($request);
    }


    public function buildAdminMenu(): Menu
    {
        $menu = Menu::new();
        $menu->addClass("menu-inner py-1 ps");
        $menu->addItemClass("menu-link");
        $menu->addItemParentClass("menu-item");
        $menu->setActiveFromRequest();

        $this->addHomeMenu($menu);
        $this->addStoresMenu($menu);
        $this->addUsersMenu($menu);
        $this->addManageMenu($menu);
        $this->addSupportMenu($menu);
        $this->addSettingsMenu($menu);


        return $menu;
    }

    private function addHomeMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __('Info and Statistics'));

        $this->addRouteLink($menu, route("admin.home.index"), __('Home'), asset("assets/admin/img/icons/store.png"));
    }

    private function addManageMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __('Admin Manage Area'));

        $this->addRouteLink($menu, route("admin.plans.index"), __('Plans'), asset("assets/admin/img/icons/price-tag.png"));
        $this->addRouteLink($menu, route("admin.payment-methods.index"), __('Payment methods'), asset("assets/admin/img/icons/payment.png"));
    }

    private function addStoresMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __('Stores Area'));

        $this->addRouteLink($menu, route("admin.stores.index"), __('Stores'), asset("assets/admin/img/icons/store (1).png"));
        $this->addRouteLink($menu, route("admin.stores.status", ['status' => StoreStatus::in_review->value]), __('In review stores'), asset("assets/admin/img/icons/inreview.png"));
        $this->addRouteLink($menu, route("admin.stores.status", ['status' => StoreStatus::inactive->value]), __('Inactive stores'), asset("assets/admin/img/icons/inactive.png"));
        $this->addRouteLink($menu, route("admin.stores.status", ['status' => StoreStatus::blocked->value]), __('Rejected stores'), asset("assets/admin/img/icons/rejected.png"));
        $this->addRouteLink($menu, route("admin.wallet-transactions.index"), __('Wallet transactions'), asset("assets/admin/img/icons/wallet (1).png"));
    }

    private function addSupportMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __('Support Area'));

        $this->addRouteLink($menu, route("admin.help-tickets.index"), __('Help tickets'), asset("assets/admin/img/icons/customer-service.png"));
        $this->addRouteLink($menu, route("admin.notifications.index"), __('Notifications'), asset("assets/admin/img/icons/notification.png"));
    }

    private function addSettingsMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __('Settings Area'));

        $this->addRouteLink($menu, route("admin.settings.index"), __('Settings'), asset("assets/admin/img/icons/settings.png"));
        $this->addRouteLink($menu, route("admin.roles.index"), __('Roles'), asset("assets/admin/img/icons/roles.png"));
        $this->addRouteLink($menu, route("admin.settings.index"), __('Permissions Manager'), asset("assets/admin/img/icons/permissions.png"));
        $this->addRouteLink($menu, route("admin.settings.index"), __('Error Log'), asset("assets/admin/img/icons/error.png"));
        $this->addRouteLink($menu, route("admin.settings.index"), __('Dev Log'), asset("assets/admin/img/icons/code.png"));
        $this->addRouteLink($menu, route("admin.settings.index"), __('Activity Log'), asset("assets/admin/img/icons/record.png"));
        $this->addRouteLink($menu, route("admin.settings.index"), __('Activity Log 2'), asset("assets/admin/img/icons/recording.png"));
    }


    private function addUsersMenu(Menu $menu): void
    {
        $this->addHtmlTitle($menu, __("Users Area"));

        $this->addRouteLink($menu, route("admin.admins.index"), __('Admins List'), asset("assets/admin/img/icons/unauthorized-person.png"));
        $this->addRouteLink($menu, route("admin.taggers.index"), __('Toggar List'), asset("assets/admin/img/icons/store-manager3.png"));
        $this->addRouteLink($menu, route("admin.customer-reviews.index"), __('Customers Reviews'), asset("assets/admin/img/icons/team.png"));
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
