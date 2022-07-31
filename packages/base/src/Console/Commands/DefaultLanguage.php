<?php

namespace drafeef\base\Console\Commands;

use drafeef\base\Models\Language;
use Illuminate\Console\Command;

class DefaultLanguage extends Command
{


    protected $signature = 'drafeef:default-languages';

    protected $description = 'This command line for default languages';

    public const MAIN_LANGUAGES = [
        [
            'name'=>['en'=>'English','ar'=>'الانجليزيه'],
            'code'=>'en',
            'direction'=>'ltr',
            'sort'=>1,
        ],[
            'name'=>['en'=>'Arabic','ar'=>'العربيه'],
            'code'=>'ar',
            'direction'=>'rtl',
            'sort'=>2,
        ]
    ];

    public function handle()
    {

        foreach (self::MAIN_LANGUAGES as $row) {
            Language::createSelf($row);
        }
    }

}
