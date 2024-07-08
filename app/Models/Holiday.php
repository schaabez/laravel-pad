<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model {

    use HasFactory;

    protected $table = "holiday";

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

}
