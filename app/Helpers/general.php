<?php
if (!function_exists('admin_guard')) {
    function admin_guard() {
        return auth('admin');
    }
}

if (!function_exists('company_guard')) {
    function company_guard() {
        return auth('web');
    }
}

if (!function_exists('get_user_data')) {
    function get_user_data() {
        $guards = ['admin', 'web'];
        foreach ($guards as $guard) {
            if (auth($guard)->check())
                return auth($guard)->user();
        }
        return null;
    }
}