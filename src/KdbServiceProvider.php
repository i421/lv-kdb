<?php

namespace I421\Kdb;

use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;

class KdbServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //todo
    }

    public function register()
    {
		Connection::resolverFor('kdb', function ($connection, $database, $prefix, $config) {
			$connector = new KdbConnector();                                                
			$connection = $connector->connect($config);                                           
																								  
			return new KdbConnection($connection, $database, $prefix, $config);             
		});                                                                                       

    }
}
