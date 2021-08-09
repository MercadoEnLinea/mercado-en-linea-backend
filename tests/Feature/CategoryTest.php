<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->post('/api/categories', ['name' => 'Feature Category Test',
            'description' => 'Testing description']);

        $response->assertCreated();

        $response->assertStatus(201);

        $this->assertDatabaseHas('categories', [
            'name' => 'Feature Category Test',
                'description' => 'Testing description'
        ]);
    }
}
