<?php

namespace PaulVL\Mysql\Console\Commands;

use Illuminate\Console\Command;

class Restore extends Command
{
     /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'mysql:restore
                            {filename : Mysql backup filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore your Mysql database from file';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $host       = env('DB_HOST');
        $database   = env('DB_DATABASE');
        $username   = env('DB_USERNAME');
        $password   = env('DB_PASSWORD');

        $path       = config('backup.path');
        $filename = $this->argument('filename');

        $command = "mysql -u $username -p$password $database < /home/paulvl/Backups/$filename.sql";
        exec($command);
        $this->info('Restore completed!');
    }
}
