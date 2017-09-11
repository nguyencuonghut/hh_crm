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
        $createLocale->name = 'Hà Nam 1';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '2';
        $createLocale->name = 'Ninh Bình 1';
        $createLocale->save();

        $createLocale = new Locale;
        $createLocale->id = '3';
        $createLocale->name = 'Hà Tây 1';
        $createLocale->save();

        \DB::table('locale_user')->insert([
            'locale_id' => 2,
            'user_id' => 1
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 1,
            'user_id' => 2
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 1,
            'user_id' => 3
        ]);

        \DB::table('locale_user')->insert([
            'locale_id' => 1,
            'user_id' => 4
        ]);
    }
}
