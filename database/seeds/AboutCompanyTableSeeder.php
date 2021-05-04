<?php

use Illuminate\Database\Seeder;
use App\AboutCompany;

class AboutCompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new AboutCompany();
        $data->html_code = 'Hayeren - Introduction
        Laravel includes a simple method of seeding your database with test data using seed classes. All seed classes are stored in the database/seeds directory. Seed classes may have any name you wish, but probably should follow some sensible convention, such as UsersTableSeeder, etc. By default, a DatabaseSeeder class is defined for you. From this class, you may use the call method to
        run other seed classes, allowing you to control the seeding order.';
        $data->lang_id=1;
        $data->save();

        $data = new AboutCompany();
        $data->html_code = 'Introduction
        Laravel includes a simple method of seeding your database with test data using seed classes. All seed classes are stored in the database/seeds directory. Seed classes may have any name you wish, but probably should follow some sensible convention, such as UsersTableSeeder, etc. By default, a DatabaseSeeder class is defined for you. From this class, you may use the call method to
        run other seed classes, allowing you to control the seeding order.';
        $data->lang_id=2;
        $data->save();

        $data = new AboutCompany();
        $data->html_code = 'Ruseren Introduction
        Laravel includes a simple method of seeding your database with test data using seed classes. All seed classes are stored in the database/seeds directory. Seed classes may have any name you wish, but probably should follow some sensible convention, such as UsersTableSeeder, etc. By default, a DatabaseSeeder class is defined for you. From this class, you may use the call method to
        run other seed classes, allowing you to control the seeding order.';
        $data->lang_id=3;
        $data->save();

    }
}
