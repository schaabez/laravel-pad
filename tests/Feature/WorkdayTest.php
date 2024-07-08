<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WorkdayTest extends TestCase
{

    public function testValidWorkday(): void
    {
        $response = $this->get('/api/workday/cze/2024-07-04');
        $response->assertStatus(200);
        $response->assertJson(["message" => "Date is a workday", "workday" => true]);
    }

    public function testHolidayWorkday(): void
    {
        $response = $this->get('/api/workday/cze/2024-07-05');
        $response->assertStatus(200);
        $response->assertJson(["message" => "Date is not a workday", "workday" => false]);
    }

    public function testInvalidWorkday(): void
    {
        $response = $this->get('/api/workday/cze/2024-07-07');
        $response->assertStatus(200);
        $response->assertJson(["message" => "Date is not a workday", "workday" => false]);
    }

    public function testEmptyWorkday(): void
    {
        $response = $this->get('/api/workday/cze/');
        $response->assertStatus(404);
    }

    public function testInvalidCountryWorkday(): void
    {
        $response = $this->get('/api/workday/cz/2024-07-04');
        $response->assertStatus(400);
        $response->assertJson(["message" => "Invalid country code"]);
    }

    public function testInvalidDateWorkday(): void
    {
        $response = $this->get('/api/workday/cze/354654654');
        $response->assertStatus(400);
        $response->assertJson(["message" => "Invalid date"]);
    }


}
