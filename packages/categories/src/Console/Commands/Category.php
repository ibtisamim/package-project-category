<?php

namespace drafeef\categories\Console\Commands;

use drafeef\categories\Models\Category;
use Illuminate\Console\Command;

class Category extends Command
{


    protected $signature = 'drafeef:category';

    protected $description = 'This command line for create default category in DB';


    public function handle()
    {

         Category::createSelf(
            [
                'title'=>'{"en":"Subject_1" , "ar":"Subject_1"}',
                'slug'=>'{"en":"subject-1" , "ar":"subject-1"}',
                'description'=>'{"en":"subject-1" , "ar":"subject-1"}',
                'icon'=>'',
                'parent_id'=>'',
                'sort'=>'1',,
                'status'=>'1',
            ]);
			
         Category::createSelf(
            [
                'title'=>'{"en":"Chapter_1" , "ar":"Chapter_1"}',
                'slug'=>'{"en":"chapter-1" , "ar":"chapter-1"}',
                'description'=>'{"en":"chapter" , "ar":"chapter"}',
                'icon'=>'',
                'parent_id'=>'1',
                'sort'=>'2',,
                'status'=>'1',
            ]);
			
			
         Category::createSelf(
            [
                'title'=>'{"en":"Topic_1" , "ar":"Topic_1"}',
                'slug'=>'{"en":"topic-1" , "ar":"topic-1"}',
                'description'=>'{"en":"topic" , "ar":"topic"}',
                'icon'=>'',
                'parent_id'=>'2',
                'sort'=>'3',,
                'status'=>'1',
            ]);
    }

}
