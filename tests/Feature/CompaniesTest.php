<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Support\CompanyFactory;
use Tests\TestCase;

class CompaniesTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_company(): void
    {
        // Arrange
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

    /** @test */
    public function a_user_sees_created_company(): void
    {
        // Arrange
        $name = 'Acme';
        CompanyFactory::create(['name' => $name]);

        // Act
        $response = $this->get('companies');

        // Assert
        $response
            ->assertStatus(200)
            ->assertSee($name);
    }

}
