<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetPlayerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetPlayerCurrentStatsEndpoint()
    {
        $response = $this->json('get', route('player.show', ['name' => 'SalvationDMS']));

        $response->assertStatus(200);
        $this->assertDatabaseHas('players', ['name' => 'SalvationDMS']);
        $this->assertDatabaseHas('data_points', ['player_id' => 1]);
    }


}
