<?php

namespace App\Helpers;

use Carbon\Carbon;

class AssignmentHelper
{
    public static function isOverdue(string $deadline, string $status): bool
    {
        return !in_array($status, ['Completed', 'Abandoned']) && Carbon::parse($deadline)->isPast();
    }
}