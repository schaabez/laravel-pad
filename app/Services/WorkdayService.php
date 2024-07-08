<?php

namespace App\Services;

use App\Models\Holiday;
use Illuminate\Support\Facades\DB;

class WorkdayService {

    private ?string $country     = null;

    // Days of the week that are considered workdays
    // Can be set for each country + can be moved into database
    private array   $workingDays = [
        "CZE" => [1, 2, 3, 4, 5] // Monday - Friday
    ];

    public function isWorkday(\DateTime $date): bool {
        $dayOfWeek = (int) $date->format("N");

        if (!in_array($dayOfWeek, $this->workingDays[$this->country] ?? [])) {
            return false;
        }

        $holiday = Holiday::query()
            ->where("day", $date->format("d"))
            ->where("month", $date->format("m"))
            ->where("country", $this->country)
            ->where("stateHoliday", true) // Only state holidays are considered
            ->first();

        if ($holiday) {
            return false;
        }

        return true;
    }

    final public function setCountry(string $country): self {
        $country = strtoupper($country);

        if (strlen($country) !== 3) {
            throw new \InvalidArgumentException("Country code must be 3 characters long");
        }


        $this->country = $country;
        return $this;
    }

    final public function withCountry(string $country): static {
        $this->setCountry($country);
        return $this;
    }

}
