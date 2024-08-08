<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BRTTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_brt()
    {
        $response = $this->post('/api/brts', [
            'brt_code' => 'BRT001',
            'reserved_amount' => 100,
            'status' => 'active',
        ], ['Authorization' => 'Bearer ' . $this->getToken()]);
    
        $response->assertStatus(201);
    }
    
}