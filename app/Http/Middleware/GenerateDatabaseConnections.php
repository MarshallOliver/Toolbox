<?php

namespace App\Http\Middleware;

use Closure;

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

        foreach(\App\Database::all() as $database) {

            \Config::set('database.connections.' . $database->id, [
                'driver' => 'sqlsrv',
                'url' => NULL,
                'host' => $database->host,
                'port' => $database->port,
                'database' => $database->catalog,
                'username' => $database->username,
                'password' => decrypt($database->password),
                'charset' => 'utf8',
                'prefix' => '',
                'prefix_indexes' => TRUE,
                'encrypt' => env('DB_ENCRYPT', 'yes'),
                'trust_server_certificate' => env('DB_TRUST_SERVER_CERTIFICATE', 'true'),
            ]);

        }

        return $next($request);
    }
}
