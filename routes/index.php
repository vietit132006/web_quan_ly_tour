<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
    'booking'   => (new BookingController)->index(),
    'users-roles'     => (new UserController)->listUser(),
    'users_add'   => (new UserController)->addUser(),
    'users_store' => (new UserController)->storeUser(),
};
