<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserAndRolesSeedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_role = new Role;

        $new_role->name = 'admin';
        $new_role->display_name = 'Admin';
        $new_role->description = "Khusus Untuk Admin";
        $new_role->save();

        $this->info('Role user dengan nama : Admin . berhasil dibuat!');

        $new_user = new User;

        $new_user->name  = 'Admin';
        $new_user->email = 'admin@mail.com';
        $new_user->password = bcrypt('rahasiaku');
        $new_user->save();

        $namaRole = 'admin';
        $role = Role::where('name', $namaRole)->first();

        $new_user->attachRole($role);

        $this->info('User dengan email : admin@mail.com . berhasil dibuat!');
    }
}
