<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class SanitizeFilters
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
        if ($request->filter) {

            $filters = [];
            $operatorMap = [
                'e' => 'e',
                'gt' => '>',
                'lt' => '<',
                'gte' => '>=',
                'lte' => '<=',

            ];
            
            $root = 'App\Http\Controllers\CenterEdge';

            switch (Route::currentRouteAction()) {

                case $root . '\AreaController@index':
                case $root . '\AreaController@show':
                case $root . '\ArrivalController@indexWithAreas':
                case $root . '\ArrivalController@showWithAreas':

                    $fieldMap = \App\CenterEdge\Area::fieldMap;

                    break;

                case $root . '\ArrivalController@index':
                case $root . '\ArrivalController@show':
                case $root . '\AreaController@indexWithArrivals':
                case $root . '\AreaController@showWithArrivals':

                    $fieldMap = \App\CenterEdge\Arrival::fieldMap;

                    break;

            }

            foreach ($request->filter as $filter => $operators) {

                foreach ($operators as $operator => $arg) {
                    $filters[] = [$fieldMap['table'] . '.' . $fieldMap['fields'][$filter], $operatorMap[strtolower($operator)], $arg];
                }
            }

            $request->filter = $filters;

        }
        
        return $next($request);
    }
}