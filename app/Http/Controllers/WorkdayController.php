<?php

namespace App\Http\Controllers;

use App\Services\WorkdayService;

class WorkdayController extends Controller {

    public function __construct(private readonly WorkdayService $workdayService) {
        $this->workdayService->setCountry("CZE"); // Default country
    }

    public function index(string $country, string $date): \Illuminate\Http\JsonResponse {
        // validate country
        if (strlen($country) !== 3) {
            return response()->json(["message" => "Invalid country code"], 400);
        }

        // validate date
        $date = \DateTime::createFromFormat("Y-m-d", $date);

        if (!$date instanceof \DateTime) {
            return response()->json(["message" => "Invalid date"], 400);
        }

        $workday = true;
        $message = "Date is a workday";

        if (!$this->workdayService->withCountry($country)->isWorkday($date)) {
            $message = "Date is not a workday";
            $workday = false;
        }

        return response()->json(["message" => $message, "workday" => $workday], 200);
    }

}
