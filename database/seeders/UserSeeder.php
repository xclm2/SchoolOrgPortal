<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@bcc.com',
            'password' => Hash::make('secret'),
            'role'  => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert($this->getUsers());
    }

    public function getUsers()
    {
        $data = [];

        for ($i = 0; $i < 100; $i++) {
            $name = $this->generateRandomFilipinoName();
            $lastname = $this->generateRandomFilipinoLastName();

            $data[] = [
                'email' => $this->generateRandomEmail($name, $lastname, $i),
                'phone' => $this->generateRandomPhoneNumber(),
                'role' => $this->generateRandomRole(),
                'name' => $name,
                'lastname' => $lastname,
                'password' => Hash::make('secret'),
                'course_id' => $this->generateRandomCourseID(),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        return $data;
    }

    public function generateRandomPhoneNumber() {
        return '9' . str_pad(rand(0, 999999999), 9, '0', STR_PAD_LEFT);
    }

    public function generateRandomRole() {
        $roles = ['adviser', 'admin', 'student'];
        return $roles[array_rand($roles)];
    }

    public function generateRandomEmail($name, $lastname, $index) {
        $domains = ['example.com', 'domain.org', 'school.edu'];
        return strtolower($name . '.' . $lastname . "-$index" . '@' . $domains[array_rand($domains)]);
    }

    public function generateRandomFilipinoName() {
        $names = ['Juan', 'Maria', 'Jose', 'Ana', 'Rizal', 'Luz', 'Andres', 'Lina', 'Sampaguita', 'Bayan'];
        return $names[array_rand($names)];
    }

    public function generateRandomFilipinoLastName() {
        $lastnames = ['Dela Cruz', 'Santos', 'Reyes', 'Garcia', 'Mendoza', 'Bautista', 'Gonzales', 'Torres', 'Cruz', 'Flores'];
        return $lastnames[array_rand($lastnames)];
    }

    public function generateRandomCourseID() {
        return rand(1, 5);
    }
}
