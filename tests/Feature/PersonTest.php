<?php

namespace Tests\Feature;

use Tests\TestCase;

class PersonTest extends TestCase
{
    /**
     * List all people
     */
    public function test_list_people_returns_a_successful_response(): void
    {
        $response = $this->get('/api/person');

        $response->assertStatus(200);
    }

    public function test_list_people_returns_array_of_peoples(): void
    {
        $response = $this->get('/api/person');

        $response->assertStatus(200);
        $response->assertJsonIsArray();
    }

    public function test_create_people_return_a_suceful_response_when_send_correct_fieds(): void {
        $response = $this->post('/api/person', [
            'documentNumber' => fake()->numberBetween(10000000000, 99999999999),
            'name' => fake('pt-BR')->name(),
            'motherName' => fake('pt-BR')->name('female'),
            'birthDate' => fake('pt-BR')->date(),
            'email' => fake('pt-BR')->email(),
            'phoneNumber' => fake('pt-BR')->phoneNumber(),
            'password' => "teste",
        ]);

        $response->assertStatus(201);
    }
}