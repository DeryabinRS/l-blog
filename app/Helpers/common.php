<?php
use App\Models\GeneralSetting;
use App\UserRole;
use App\UserStatus;

if (!function_exists('settings')) {
    function settings()
    {
        $settings = GeneralSetting::take(1)->first();

        if (!is_null($settings)) { return $settings; }
    }
}

if (!function_exists('getUserStatuses')) {
    function getUserStatuses()
    {
        return [
            [ 'value' => UserStatus::ACTIVE->value, 'label' => 'Активный' ],
            [ 'value' => UserStatus::PENDING->value, 'label' => 'На проверке' ],
            [ 'value' => UserStatus::BLOCKED->value, 'label' => 'Заблокирован' ],
        ];
    }
}

if (!function_exists('getUserStatus')) {
    function getUserStatus($status = null)
    {
        $statuses = getUserStatuses();
        $key = array_search($status, array_column($statuses, 'value'));
        if ($key !== false) {
            return $statuses[$key];
        } else {
            return null;
        }
    }
}

if (!function_exists('getUserRoles')) {
    function getUserRoles()
    {
        return [
            [ 'value' => UserRole::USER->value, 'label' => 'Пользователь' ],
            [ 'value' => UserRole::ADMIN->value, 'label' => 'Администратор' ],
            [ 'value' => UserRole::SUPER_ADMIN->value, 'label' => 'Супер администратор' ],
        ];
    }
}

if (!function_exists('getUserRole')) {
    function getUserRole($role = null)
    {
        $roles = getUserRoles();
        $key = array_search($role, array_column($roles, 'value'));
        if ($key !== false) {
            return $roles[$key];
        } else {
            return null;
        }
    }
}


