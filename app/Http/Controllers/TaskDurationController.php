<?php

namespace App\Http\Controllers;

use App\Helpers\DateUtils;
use App\Services\WorkdayService;
use Illuminate\Http\Request;

class TaskDurationController extends Controller {

    public function __construct(private readonly WorkdayService $workdayService) {
        $this->workdayService->setCountry("CZE");
    }

    public function expectedDuration(Request $request): \Illuminate\Http\JsonResponse {

        $taskStart = $request->query("taskStart");
        $duration = $request->query("duration");

        $workingHourStart = $request->query("workingHourStart");
        $workingHourEnd = $request->query("workingHourEnd");

        if (!$taskStart || !$duration || !$workingHourStart || !$workingHourEnd) {
            return response()->json(["message" => "Missing required parameters"], 400);
        }

        $taskStart = new \DateTime($taskStart);
        $workingHourStart = new \DateTime($workingHourStart);
        $workingHourEnd = new \DateTime($workingHourEnd);

        $workingHourRange = DateUtils::getWorkingHourRange($workingHourStart, $workingHourEnd);

        $workingDaysOnly = $request->query("workingDaysOnly", FALSE);

        $expectedDuration = clone $taskStart; // start with task start

        while($duration > 0) {
            $taskCheck = clone $expectedDuration;
            $taskCheckEnd = clone $workingHourEnd;
            $taskCheckEnd->setDate($taskCheck->format("Y"), $taskCheck->format("m"), $taskCheck->format("d"));
            $rangeToEnd = DateUtils::getWorkingHourRange($taskCheck, $taskCheckEnd);

            if ($workingDaysOnly && !$this->workdayService->isWorkday($expectedDuration)) {
                // skip if not a workday
                $expectedDuration->modify("+1 day");
                continue;
            }

            if ($duration > $workingHourRange) {
                // if possible, add full day of work, and skip to next day
                $expectedDuration->modify("+1 day");
                $duration -= $workingHourRange;
                continue;
            }
            else if ($rangeToEnd >= $duration) {
                $expectedDuration->modify("+{$duration} minutes");
                break;
            }

            // adjust dates
            $workingHourStart = DateUtils::setDate($workingHourStart, $expectedDuration);
            $workingHourEnd = DateUtils::setDate($workingHourEnd, $expectedDuration);


            if ($workingHourEnd > $expectedDuration) {
                $range = DateUtils::getWorkingHourRange($expectedDuration, $workingHourEnd);
                $duration -= $range;

                $expectedDuration->modify("+1 day");
                $expectedDuration->setTime(
                    $workingHourStart->format("H"),
                    $workingHourStart->format("i"),
                    $workingHourStart->format("s")
                );
            }

        };

        return response()->json(["expectedDuration" => $expectedDuration->format(\DateTime::ATOM)]);

    }

}
