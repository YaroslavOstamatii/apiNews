<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    protected $signature = 'create:admin';
    protected $description = 'Create an admin user';

    public function handle()
    {
        $name = $this->ask('Enter the admin name:');
        $email = $this->ask('Enter the admin email:');
        $password = $this->secret('Enter the admin password:');

        $admin = Admin::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        $token=$admin->createToken('token-name')->plainTextToken;
        $this->info('token = '.$token);

        $this->info('Admin user created successfully!');
    }
}
