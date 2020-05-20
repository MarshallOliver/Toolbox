<?php

namespace App\Http\Middleware;

use Closure;
use App\Database;

class GenerateDatabaseConnections
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {



        foreach(Database::all() as $database) {

            \Config::set('database.connections.' . $database->location->short_name, [
                'driver' => 'sqlsrv',
                'url' => NULL,
                'host' => $database->host,
                'port' => $database->port,
                'database' => $database->catalog,
                'username' => $database->username,
                'password' => $database->password,
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => TRUE,
            ]);

        }

        return $next($request);
    }
}