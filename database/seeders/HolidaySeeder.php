<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {
        //

        /**
         * 1. ledna 2024    pondělí    Den obnovy samostatného českého státu
         * 1. ledna 2024    pondělí    Nový rok
         * 29. březen 2024    pátek    Velký pátek
         * 1. dubna 2024    pondělí    Velikonoční pondělí
         * 1. května 2024    středa    Svátek práce
         * 8. května 2024    středa    Den vítězství
         * 5. července 2024    pátek    Den slovanských věrozvěstů Cyrila a Metoděje
         * 6. července 2024    sobota    Den upálení mistra Jana Husa
         * 28. září 2024    sobota    Den české státnosti
         * 28. října 2024    pondělí    Den vzniku samostatného československého státu
         * 17. listopadu 2024    neděle    Den boje za svobodu a demokracii
         * 24. prosince 2024    úterý    Štědrý den
         * 25. prosince 2024    středa    1. svátek vánoční
         * 26. prosince 2024    čtvrtek    2. svátek vánoční
         */

        DB::table("holiday")->insert([
                                          "name"         => "Den obnovy samostatného českého státu",
                                          "day"          => 1,
                                          "month"        => 1,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Nový rok",
                                          "day"          => 1,
                                          "month"        => 1,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Velký pátek",
                                          "day"          => 29,
                                          "month"        => 3,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Velikonoční pondělí",
                                          "day"          => 1,
                                          "month"        => 4,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Svátek práce",
                                          "day"          => 1,
                                          "month"        => 5,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Den vítězství",
                                          "day"          => 8,
                                          "month"        => 5,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Den slovanských věrozvěstů Cyrila a Metoděje",
                                          "day"          => 5,
                                          "month"        => 7,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Den upálení mistra Jana Husa",
                                          "day"          => 6,
                                          "month"        => 7,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Den české státnosti",
                                          "day"          => 28,
                                          "month"        => 9,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Den vzniku samostatného československého státu",
                                          "day"          => 28,
                                          "month"        => 10,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Den boje za svobodu a demokracii",
                                          "day"          => 17,
                                          "month"        => 11,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "Štědrý den",
                                          "day"          => 24,
                                          "month"        => 12,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "1. svátek vánoční",
                                          "day"          => 25,
                                          "month"        => 12,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
        DB::table("holiday")->insert([
                                          "name"         => "2. svátek vánoční",
                                          "day"          => 26,
                                          "month"        => 12,
                                          "country"      => "CZE",
                                          "stateHoliday" => TRUE,
                                      ]);
    }

}
