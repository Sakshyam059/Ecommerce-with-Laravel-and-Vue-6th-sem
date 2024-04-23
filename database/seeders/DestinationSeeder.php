<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('destinations')->count() == 0){
            $destination =  [
                [
                  'address' => 'Bharatpur',
                  'zipcode'=>'123456'
                ],
                [
                  'address' => 'Nawalpur',
                  'zipcode'=>'123456'
                  
                ],
                [
                  'address' => 'Kathmandu',
                  'zipcode'=>'123456'
                ],
                [
                  'address' => 'Pokhara',
                  'zipcode'=>'123456'
                ]
              
              ];
    
              Destination::insert($destination);
            }
    }
}
