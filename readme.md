# Mysql

## **Introduction**

## **Quick Installation**

Begin by installing this package through Composer.

You can run:

    composer require paulvl/mysql

Or edit your project's composer.json file to require paulvl/json-api.
```
    "require-dev": {
        "paulvl/mysql": "dev-master"
    }
```
Next, update Composer from the Terminal:

    composer update --dev

Once the package's installation completes, the final step is to add the service provider. Open `config/app.php`, and add a new item to the providers array:

```
PaulVL\Mysql\BackupServiceProvider::class,
```

Finally publish package's configuration file:

    php artisan vendor:publish

Then the file `config/backup.php` will be created.

That's it! You're all set to go. Run the artisan command from the Terminal to see the new `json-api` commands.

    php artisan

## **Creating a backup**
To make a backup of you current aplicationa database you have to run:

    php artisan mysql:dump

This will create an `.sql` file on your configured path like `/this/is/my/path/20150101201505.sql`, this file is named using current datetime. If you want a custom name run:

    php artisan mysql:dump example

This will create an `.sql` file on your configured path like `/this/is/my/path/example.sql`

## **Restoring database from file**
To restore a backup to your current aplicationa database you have to run:

    php artisan mysql:restore filename

This will restore the `filename.sql` file stored on your configured.

## **Programing backups**
If you need to perform a backup for example, every day at midnight, at this like to yor schedule function on `app/Console/Commands/Kernel.php`:
```
protected function schedule(Schedule $schedule)
{
...
	$schedule->command('mysql:dump')->dailyAt('13:00');
...
}
```
## **Contribute and share ;-)**
If you like this little piece of code share it with you friends and feel free to contribute with any improvements.
