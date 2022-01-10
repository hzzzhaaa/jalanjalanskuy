<?php

use App\PaymentMethod;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $faker = Faker\Factory::create('id_ID');
        // for($i=0;$i<20;$i++) {
        //     App\User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'password' => bcrypt('123123'),
        //         'role' => $faker->numberBetween(0,2)
        //     ]);
        // }
        $default = App\Organizer::create([
            'name' => 'DEFAULT',
            'picture' => 'ceritanya gambar',
            'description' => 'desc aja'
        ]);
        $aldi = App\User::create([
            'name' => 'aldi',
            'email' => 'aldi@aldi.aldi',
            'phone'=> '0123',
            'password' => bcrypt('123123123'),
            'role' => 0,
            'organizer_id' => $default->id,
            'accepted' => 1,
            'admin' => 1
        ]);

        $anjar = App\User::create([
            'name' => 'anjar',
            'email' => 'anjar@anjar.anjar',
            'phone'=> '0123',
            'password' => bcrypt('123123123'),
            'role' => 0,
            'organizer_id' => $default->id
        ]);

        $admin = App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'phone'=> '0123',
            'password' => bcrypt('123123123'),
            'role' => 1
        ]);

        $apid = App\User::create([
            'name' => 'apid',
            'email' => 'apid@apid.apid',
            'phone'=> '0123',
            'password' => bcrypt('123123123'),
            'role' => 0,
            'organizer_id' => $default->id,
            'accepted' => 1
        ]);

        $biner = App\Event::create([
            'name' => 'BINER',
            'description' => 'Desc',
            'location' => 'helpdesk',
            'image' => 'gabakal ngeload.jpg',
            'date' => '2019-11-26',
            'timeStart' => '08:00:00',
            'timeEnd' => '10:00:00',
            'organizer_id' => $default->id
        ]);

        $method = PaymentMethod::create([
            'bank' => 'Mandiri',
            'bankAccountName'=> 'Aldi',
            'bankAccountNumber'=> 38572052,
            'event_id'=>$biner->id
        ]);

        $ticket = App\Ticket::create([
            'name' => 'VVIP',
            'price' => 50000,
            'limit' => 20,
            'onsale' => 1,
            'event_id' =>$biner->id
        ]);


        $ticket->users()->attach($apid->id);
        $ticket->users()->attach($admin->id,['receipt' => 'bukti.jpg']);
        $ticket->users()->attach($anjar->id,['approved'=> 1,'receipt'=> 'bukti.jpg']);


    }
}
