<?php

namespace Tests\Feature;

use Tests\TestCase;

class AssignmentControllerTest extends TestCase
{
    public function test_a_valid_assignment_can_be_stored_in_session()
    {
        $response = $this->post('/assignments', [
            'title' => 'Final Exam',
            'course' => 'MATH 53',
            'category' => 'Final Exam',
            'status' => 'Not Started',
            'deadline' => '2026-5-26 23:59:59',
        ]);

        $response->assertRedirect('/assignments');
        $response->assertSessionHas('assignments');
    }

    public function test_field_validation_returns_session_errors()
    {
        $response = $this->post('/assignments', [
            'title' => '', 
            'course' => 'CMSC 129',
            'category' => 'Invalid Category', 
            'status' => 'Not Started',
            'deadline' => '', 
        ]);

        $response->assertSessionHasErrors(['title', 'category', 'deadline']);
    }
}