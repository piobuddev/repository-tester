<?php

return [
    'test' => function (\Faker\Generator $faker, array $arguments = []) {
        return array_merge(
            [
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
            ],
            $arguments
        );
    },
];
