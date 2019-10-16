Laravel Kingbase database(v8) (lv-kdb)

1. Step1: Install Through Composer
```
composer require i421/kdb
```

2. Step 2: Add the Service Provider (This happens automatically in Laravel 5.5)

Open config/app.php and, to your "providers" array, add:

```
I421\Kdb\KdbServiceProvider::class
```

3. Step 3: Add Database Driver Configuration

Open config/datbase.php and, to your "connections" array, add:

```
'kdb' => [
    'driver' => 'kdb',
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', '54321'),
    'database' => env('DB_DATABASE', 'Database-Name'),
    'username' => env('DB_USERNAME', 'SYSTEM'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'prefix' => '',
],
```

Make sure to update host, port, database, username, password and schema to your configuration.
