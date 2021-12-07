<?php declare(strict_types=1);

namespace Tjphippen\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Crud
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $model
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $model)
    {
        list($model, $relation) = array_pad(explode(':', $model), 2, null);
        if($relation) {
            $request->merge(['conf_relation' => $relation]);
        }

        $request->merge(['conf_model' => $model]);

        // TODO validate & transform with Model props

        return $next($request);
    }
}
