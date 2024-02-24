<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompaniesTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_company(): void
    {
        // Arrange
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->company,
            'description' => $this->faker->text,
            'address' => $this->faker->address,
        ];

        // Act
        $response = $this->post('companies', $attributes);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('companies', $attributes);
    }
}
