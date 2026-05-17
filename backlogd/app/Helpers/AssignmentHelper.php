<?php

namespace App\Helpers;

use Carbon\Carbon;

class AssignmentHelper
{
    public static function isOverdue(string $deadline, string $status): bool
    {
        if (in_array($status, ['Completed', 'Abandoned'])) {
            return false;
        }
        return Carbon::parse($deadline)->isPast();
    }
}