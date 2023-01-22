<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter4.github.io/CodeIgniter4/
 */

function user($data)
{
    $db = \Config\Database::connect();
    $session = \Config\Services::session();
    $user_id = $session->get('user_id');

    $user = $db->query("SELECT users.id, users.name, users.username, users.password, users.phone, roles.role FROM users 
        JOIN roles ON users.role_id = roles.id WHERE users.id = '$user_id'")
        ->getRowArray()[$data];
    
    return $user;
}