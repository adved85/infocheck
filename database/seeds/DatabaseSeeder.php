<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // pull role-sider before users
        $this->call(RolesTableSeeder::class);
        // user-sider use the role above
        $this->call(UsersTableSeeder::class);

        $this->call(LangsTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(QuestionsTableSeeder::class);

        $this->call(PostsTableSeeder::class);

        $this->call(CommentsTableSeeder::class);

        $this->call(AnswersTableSeeder::class);

        $this->call(DocumentsTableSeeder::class);

        $this->call(PostersTableSeeder::class);

        $this->call(PostLayoutTableSeeder::class);

        $this->call(AboutCompanyTableSeeder::class);
    }
}
