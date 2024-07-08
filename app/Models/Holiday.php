<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property string $name
 * @property int    $day
 * @property int    $month
 * @property string $country
 * @property bool   $stateHoliday
 */
class Holiday extends Model {

    use HasFactory;

    protected $table    = "holiday";

    protected $fillable = [
        "name",
        "day",
        "month",
        "country",
        "stateHoliday",
    ];

    protected $casts    = [
        "day"          => "integer",
        "month"        => "integer",
        "stateHoliday" => "boolean",
    ];

    public function isStateHoliday(): bool {
        return $this->stateHoliday;
    }

    public static function checkStateHoliday(\DateTime $date, string $country): bool {
        $holidays = self::getHolidays($date, $country);

        foreach ($holidays as $holiday) {
            if ($holiday->isStateHoliday()) {
                return true;
            }
        }

        return false;
    }

    /** @return array<array-key, Holiday> */
    public static function getHolidays(\DateTime $date, string $country): array {
        return static::query()
            ->where("day", $date->format("d"))
            ->where("month", $date->format("m"))
            ->where("country", $country)
            ->get()
            ->all();
    }

}
