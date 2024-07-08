<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskDurationTest extends TestCase {

    public function testTaskDuration(): void {
        $response = $this->get("/api/task-duration/expected-duration?taskStart=2024-07-02T15:54:00&duration=120&workingHourStart=08:00:00&workingHourEnd=17:00:00");
        $response->assertStatus(200);
        $response->assertJson(["expectedDuration" => "2024-07-03T08:54:00+00:00"]);
    }

    public function testTaskDurationWithWorkingDaysOnly(): void {
        $response = $this->get("/api/task-duration/expected-duration?taskStart=2024-07-04T15:54:00&duration=120&workingHourStart=08:00:00&workingHourEnd=17:00:00&workingDaysOnly=true");
        $response->assertStatus(200);
        $response->assertJson(["expectedDuration" => "2024-07-08T08:54:00+00:00"]);
    }

    public function testTaskDurationEmpty(): void {
        $response = $this->get("/api/task-duration/expected-duration");
        $response->assertStatus(400);
    }

}
