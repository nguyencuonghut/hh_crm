<?php

use Illuminate\Database\Seeder;

use App\Models\Locale;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createLocale = new Locale;
        $createLocale->id = '1';
        $createLocale->name = 'Vùng 1';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '2';
        $createLocale->name = 'Vùng 2';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '3';
        $createLocale->name = 'Vùng 3';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '4';
        $createLocale->name = 'Vùng 4';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '5';
        $createLocale->name = 'Vùng 5';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '6';
        $createLocale->name = 'Vùng 6';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '7';
        $createLocale->name = 'Vùng 7';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '8';
        $createLocale->name = 'Vùng 8';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '9';
        $createLocale->name = 'Vùng 9';
        $createLocale->save();

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 1
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 2
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 3
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 4
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 5
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 6
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 7
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 8
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 9
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 10
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 11
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 12
        ]);
    }
}
