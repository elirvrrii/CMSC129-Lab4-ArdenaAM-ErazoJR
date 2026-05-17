<?php

namespace Tests\Browser;

<<<<<<< HEAD
use Illuminate\Foundation\Testing\DatabaseMigrations;
=======
>>>>>>> e523afb4a9b63e01629d5a670422479b5444c997
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AssignmentSystemTest extends DuskTestCase
{
    /**
<<<<<<< HEAD
     * A Dusk test example.
     */
    public function test_example(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Laravel');
        });
    }
}
=======
     * User can create an assignment.
     */
    public function test_user_can_create_assignment(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/assignments')
                    ->type('title', 'CMSC 129 Lab')
                    ->type('course', 'CMSC 129')
                    ->select('category', 'Homework')
                    ->select('status', 'In Progress');

            $browser->script("document.getElementById('deadline').value = '2026-05-20T23:59';");

            $browser->press('Save')
                    ->assertSee('CMSC 129 Lab');
        });
    }
}
>>>>>>> e523afb4a9b63e01629d5a670422479b5444c997
