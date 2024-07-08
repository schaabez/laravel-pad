<?php

namespace App\Http\Controllers;

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

        $workingHourRange = self::getWorkingHourRange($workingHourStart, $workingHourEnd);

        $workingDaysOnly = $request->query("workingDaysOnly", FALSE);

        $expectedDuration = clone $taskStart; // start with task start

        while($duration > 0) {
            $taskCheck = clone $expectedDuration;
            $taskCheckEnd = clone $workingHourEnd;
            $taskCheckEnd->setDate($taskCheck->format("Y"), $taskCheck->format("m"), $taskCheck->format("d"));
            $rangeToEnd = self::getWorkingHourRange($taskCheck, $taskCheckEnd);

            if ($workingDaysOnly && !$this->workdayService->isWorkday($expectedDuration)) {
                // skip if not a workday
                $expectedDuration->modify("+1 day");
                continue;
            }

            if ($duration > $workingHourRange) {
                // add full day of work
                $expectedDuration->modify("+1 day");
                $duration -= $workingHourRange;
                continue;
            }
            else if ($rangeToEnd >= $duration) {
                $expectedDuration->modify("+{$duration} minutes");
                break;
            }

            $workingHourStart->setDate($expectedDuration->format("Y"), $expectedDuration->format("m"),
                                       $expectedDuration->format("d"));
            $workingHourEnd->setDate($expectedDuration->format("Y"), $expectedDuration->format("m"),
                                     $expectedDuration->format("d"));


            if ($workingHourEnd > $expectedDuration) {

                $range = self::getWorkingHourRange($expectedDuration, $workingHourEnd);
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

    private static function getWorkingHourRange(\DateTime $start, \DateTime $end): int {
        $whDiff = $start->diff($end);
        $minutes = $whDiff->i + ($whDiff->h * 60) + ($whDiff->s / 60);
        return $whDiff->invert ? -$minutes : $minutes;
    }

    private static function setDate(\DateTime $date, \DateTime $time): \DateTime {
        $date->setDate($time->format("Y"), $time->format("m"), $time->format("d"));
        return $date;
    }

    private static function setTime(\DateTime $date, \DateTime $time): \DateTime {
        $date->setTime($time->format("H"), $time->format("i"), $time->format("s"));
        return $date;
    }

}
