<?php

namespace Tests\Feature;

use Tests\TestCase;

class StatusTest extends TestCase {

    public function testStatusPing(): void {
        $response = $this->get('/api/status/ping');
        $response->assertStatus(200);
        $response->assertJson(["message" => "pong"]);
    }

    public function testStatusFooPost(): void {
        $response = $this->post('/api/status/foo');
        $response->assertJson(["message" => "bar"]);
    }

    public function testStatusFooGet(): void {
        $response = $this->get('/api/status/foo');
        $response->assertStatus(405);
    }

    public function testStatusUp(): void {
        $response = $this->get('/up');
        $response->assertStatus(200);
    }

}
