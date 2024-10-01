<?php

namespace App\Enum;

enum UserAccountStatusEnum: string
{
    case ACTIVE = 'active';
    case BANNED = 'banned';
    case PENDING = 'pending';
    case BLOCKED = 'blocked';
    case DELETED = 'deleted';
}