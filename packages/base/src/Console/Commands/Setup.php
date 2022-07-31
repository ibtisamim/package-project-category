<?php

namespace drafeef\base\Console\Commands;


use Illuminate\Console\Command;

class Setup extends Command
{


    protected $signature = 'setup';

    protected $description = 'This command line for setup and set default data';


    public function handle()
    {
//        exec('composer install');
        $this->call('migrate:fresh', []);
        $this->call('drafeef:default-role', []);
        $this->call('drafeef:default-Permission', []);
        $this->call('drafeef:default-role-Permission', []);
        $this->call('drafeef:default-places', []);
        $this->call('drafeef:default-languages', []);
        $this->call('drafeef:default-user', []);
        $this->call('drafeef:default-app-setting', []);
        $this->call('passport:install', ['--force' => 'force',]);
        $this->call('storage:link', []);

    }

}
