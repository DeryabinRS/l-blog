<?php

namespace App;

enum UserRole: string
{
    case SUPER_ADMIN = 'superAdmin';
    case ADMIN = 'admin';
    case USER = 'user';
}


