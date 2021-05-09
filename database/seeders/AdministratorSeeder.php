<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->name = "admin";
        $administrator->email = "admin@gmail.com";
        $administrator->role_name = "Super Admin";
        $administrator->password = \Hash::make("Secret");
        $administrator->phone_number = "081267872312";
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
