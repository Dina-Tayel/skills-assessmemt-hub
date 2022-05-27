<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'email'=>'dinatayel913@gmail.com',
            'phone'=>'01206365247',
            'facebook'=>'https://www.facebook.com/tayelrabiedina',
            'instagram'=>'https://www.instagram.com/',
            'twitter'=>'https://twitter.com/',
            'youtube'=>'https://youtube.com/', 
            'linkedin'=>'https://www.linkedin.com/feed/',
        ]);
    }
}
