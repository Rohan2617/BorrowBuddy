<?php

use \Illuminate\Support\Facades\Cache;

/**
 * Get roles
 *
 * @return array<string, int> Roles titles and ids
 */
function user_roles() : array | null
{
    return Cache::get('roles', []);
}

/**
 * Determine if the user is admin
 *
 * @return bool True if user is admin, otherwise false
 */
function is_admin($roleId = null) : bool
{
    $roles = user_roles();

    $adminId     = $roles['admin'];

    if($roleId === null)
        $roleId = auth()->user()?->role_id ?? -1;

    if($adminId !== $roleId)
        return false;

    return true;
}

