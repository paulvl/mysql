<?php

namespace PaulVL\Mysql\Console\Commands;

use Illuminate\Console\Command;

class Dump extends Command
{
     /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'mysql:dump
                            {filename? : Mysql backup filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump your Mysql database to a file';

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
        $filename   = empty(trim($this->argument('filename'))) ? \Carbon\Carbon::now()->format('YmdHis') : trim($this->argument('filename'));

        $command = "mysqldump -e -f -h $host -u $username -p$password $database > /home/paulvl/Backups/$filename.sql";
        exec($command);
        $this->info('Backup completed!');
    }
}
