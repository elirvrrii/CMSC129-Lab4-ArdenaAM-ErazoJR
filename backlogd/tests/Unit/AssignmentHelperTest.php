<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Helpers\AssignmentHelper;

class AssignmentHelperTest extends TestCase
{
    public function test_it_returns_true_if_past_deadline_and_not_completed()
    {
        $this->assertTrue(
            AssignmentHelper::isOverdue(now()->subDay()->toDateTimeString(), 'In Progress')
        );
    }

    public function test_it_returns_false_if_completed_regardless_of_deadline()
    {
        $this->assertFalse(
            AssignmentHelper::isOverdue(now()->subDay()->toDateTimeString(), 'Completed')
        );
    }

    public function test_it_returns_false_if_deadline_is_in_the_future()
    {
        $this->assertFalse(
            AssignmentHelper::isOverdue(now()->addDay()->toDateTimeString(), 'Not Started')
        );
    }
}