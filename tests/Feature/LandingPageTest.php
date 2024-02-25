<?php

namespace Tests\Feature;

use Tests\TestCase;

class LandingPageTest extends TestCase
{
    /** @test */
    public function a_user_can_visit_the_landing_page(): void
    {
        // Arrange
        // Act
        $response = $this->get('/');

        // Assert
        $response
            ->assertStatus(200)
            ->assertSee('this is a landing page')
            ->assertSee('Login')
            ->assertSee('Register');
    }
}
