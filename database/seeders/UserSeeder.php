<?php

namespace Database\Seeders;

use App\Repositories\User\UserInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private $interface;

    public function __construct(UserInterface $interface)
    {
        $this->interface = $interface;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->interface->createNewUser('user@mail.com', Hash::make('123123123'), 'New User', []);
    }
}
