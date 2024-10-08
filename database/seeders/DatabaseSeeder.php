<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TodoSeeder::class,
        ]);
//        $this->seedUserTodoMapsTable();
    }

//    private function seedUserTodoMapsTable(): void
//    {
//        // Get existing users and todos
//        $users = User::all();
//        $todos = Todo::all();
//        foreach ($users as $user) {
//            foreach ($todos->random(3) as $todo) {
//                TodoUserMaps::factory()->create([
//                    'user_id' => $user->id,
//                    'todo_id' => $todo->id,
//                ]);
//            }
//        }
//    }
}
