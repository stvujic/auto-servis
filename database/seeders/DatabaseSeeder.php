<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Review;
use App\Models\ServiceType;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WorkingHour;
use App\Models\Workshop;
use App\Models\WorkshopService;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Fiksni nalozi
        $admin  = User::factory()->create(['email'=>'admin@example.com','role'=>'admin']);
        $owner1 = User::factory()->create(['email'=>'owner1@example.com','role'=>'owner']);
        $cust1  = User::factory()->create(['email'=>'cust1@example.com','role'=>'customer']);

        // 2) Fiksni katalog (ručno, stabilne vrednosti)
        $types = collect([
            ['name'=>'Zamena ulja','slug'=>'zamena-ulja'],
            ['name'=>'Dijagnostika','slug'=>'dijagnostika'],
            ['name'=>'Kočnice','slug'=>'kocnice'],
            ['name'=>'Gume','slug'=>'gume'],
        ]);
        foreach ($types as $t) {
            ServiceType::firstOrCreate(['slug'=>$t['slug']], ['name'=>$t['name']]);
        }

        // 3) Jedan verifikovan workshop za owner1 (factory)
        $ws = Workshop::factory()->create([
            'owner_id' => $owner1->id,
            'is_verified' => true,
        ]);

        // 4) Veži par usluga za taj workshop (factory + ručni tipovi)
        $oil  = ServiceType::where('slug','zamena-ulja')->first();
        $diag = ServiceType::where('slug','dijagnostika')->first();

        WorkshopService::factory()->create([
            'workshop_id' => $ws->id,
            'service_type_id' => $oil->id,
            'duration_minutes' => 45,
            'price' => 3500,
        ]);
        WorkshopService::factory()->create([
            'workshop_id' => $ws->id,
            'service_type_id' => $diag->id,
            'duration_minutes' => 30,
            'price' => 2000,
        ]);

        foreach ([1,2,3,4,5] as $dow) {
            WorkingHour::firstOrCreate(
                ['workshop_id'=>$ws->id,'day_of_week'=>$dow],
                ['open_at'=>'09:00','close_at'=>'17:00']
            );
        }

        Workshop::factory(2)->create(); // još par radionica
        WorkshopService::factory(5)->create();
        Booking::factory(5)->create();
        Review::factory(3)->create();
    }

}
