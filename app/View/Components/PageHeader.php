<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class PageHeader extends Component
{
    public string $title;
    public string $route;
    public bool $showCreate;
    public bool $showBreadcrumb;
    public bool $showButton;

    public function __construct(bool $showBreadcrumb = true, bool $showButton = true)
    {
        $routeName = Route::currentRouteName();
        $routeMeta = match ($routeName) {
            'admin.employee.index' => [
                'title' => trans('dashboard/sidebar.employee_sidebar_title'),
                'route' => 'admin.employee.index',
                'showCreate' => true,
            ],
            'admin.employees.status' => [
                'title' => trans('dashboard/sidebar.employee_status_title'),
                'route' => 'admin.employees.status',
                'showCreate' => false,
            ],
            default => [
                'title' => trans('dashboard/sidebar.employee_sidebar_title'),
                'route' => 'admin.employee.index',
                'showCreate' => false,
            ],
        };

        $this->title = $routeMeta['title'];
        $this->route = $routeMeta['route'];
        $this->showCreate = $routeMeta['showCreate'] ?? false;
        $this->showBreadcrumb = $showBreadcrumb;
        $this->showButton = $showButton;
    }

    public function render(): View|Closure|string
    {
        return view('components.dashboard.page-header');
    }
}
