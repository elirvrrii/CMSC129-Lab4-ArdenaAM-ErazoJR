<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AssignmentSystemTest extends DuskTestCase
{
    /**
     * User can create an assignment.
     */
    public function test_user_can_create_assignment(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/assignments')
                    ->type('title', 'CMSC 129 Lab')
                    ->type('course', 'CMSC 129')
                    ->select('category', 'Homework')
                    ->select('status', 'In Progress')
                    ->type('deadline', '2026-05-20T23:59')
                    ->press('Save')
                    ->assertSee('CMSC 129 Lab');
        });
    }
}