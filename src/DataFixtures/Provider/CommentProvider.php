<?php

namespace App\DataFixtures\Provider;

use App\Enum\CommentStatusEnum;

class CommentProvider
{
    public static function commentStatus(): CommentStatusEnum
    {
        return CommentStatusEnum::PUBLISHED;
    }
}
