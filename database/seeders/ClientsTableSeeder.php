<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['Abdul Rahman','Eslam','Juba'];
        foreach($clients as $client){

            \App\Models\Client::create([
              'name' => $client,
              'phone' => '01280702035',
              'Address' => 'Sidi Bashir',
            ]);
        }
    }
}
