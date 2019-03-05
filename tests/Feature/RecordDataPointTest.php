<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

class RecordDataPointTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCacheIsClearedWhenNewDataPointIsAdded()
    {
        $response = $this->json('post', route('player.record', ['name' => 'SalvationDMS']));

        $this->assertEquals(null, Cache::get('player.1'));

        $response->assertStatus(201);
    }
}
