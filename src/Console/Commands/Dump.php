<?php

namespace PaulVL\Mysql\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

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
        $host           = config('database.connections.mysql.host');
        $database       = config('database.connections.mysql.database');
        $username       = config('database.connections.mysql.username');
        $password       = config('database.connections.mysql.password');

        $backupPath    = config('backup.path');

        $cloudStorage    = config('backup.cloud-storage');
        $cloudDisk    = config('backup.cloud-disk');
        $cloudPath    = config('backup.cloud-path');
        $keepLocal    = config('backup.keep-local');


        $path       = config('backup.path');
        $filename   = $database . '_' . empty(trim($this->argument('filename'))) ? \Carbon\Carbon::now()->format('YmdHis') : trim($this->argument('filename'));

        $mysqldumpCommand = "mysqldump -e -f -h $host -u $username -p$password $database > $backupPath$filename.sql";
        exec($mysqldumpCommand);

        $this->info('Backup completed!');

        if($cloudStorage)
        {
            $fileContents = file_get_contents("$backupPath$filename.sql");
            Storage::disk($cloudDisk)->put("$cloudPath$filename.sql", $fileContents);

            if(!$keepLocal)
            {
                $rmCommand = "rm $backupPath$filename.sql";
                exec($rmCommand);
            }

            $this->info('Backup uploaded to cloud storage!');
        }
    }
}
