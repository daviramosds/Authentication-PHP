<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed

{
    public function run()
    {
        $faker = Faker\Factory::create();

        $data = [
            [
                'username' => $faker->username(),
                'email' => $faker->email(),
                'password' => password_hash('123', PASSWORD_DEFAULT),
            ],
            [
                'username' => $faker->username(),
                'email' => $faker->email(),
                'password' => password_hash('123', PASSWORD_DEFAULT),
            ],
            [
                'username' => $faker->username(),
                'email' => $faker->email(),
                'password' => password_hash('123', PASSWORD_DEFAULT),
            ],
            [
                'username' => $faker->username(),
                'email' => $faker->email(),
                'password' => password_hash('123', PASSWORD_DEFAULT),
            ],
            [
                'username' => $faker->username(),
                'email' => $faker->email(),
                'password' => password_hash('123', PASSWORD_DEFAULT),
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)->saveData();

    }
}
