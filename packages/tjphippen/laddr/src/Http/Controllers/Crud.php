<?php declare(strict_types=1);

namespace Tjphippen\Laddr\Http\Controllers;

use Illuminate\Http\Request;

class Crud extends Controller
{
    protected $namespace = 'App\\Models\\';

    protected function relate(Request $request)
    {
        $model = ($this->namespace . $request->conf_model);
        if($relation = $request->conf_relation) {
            $parent_id = $request->route()->parameter(strtolower($request->conf_model));
            $parent = $model::findOrFail($parent_id);
            return $parent->{$relation}();
        }
        $request->replace($request->except(['conf_model', 'conf_relation']));

        return new $model;
    }

    public function index(Request $request)
    {
        $collection = $this->relate($request)
            // TODO filter/sort/include
            // ->where() // in relate()?
            ->get();

        return response()->json($collection);
    }

    public function show(Request $request, $id)
    {
        $model = $this->relate($request)->findOrFail($id);
        // TODO e.g. /user/123/account <--singular
        // TODO includes

        return response()->json($model);
    }

    public function store(Request $request)
    {
        $model = $this->relate($request);

        // TODO validate from Model properties

        if($model->create($request->all()))
        {
            return response()->json($model->get(), 201);
        }
        // TODO return error
    }

    public function update(Request $request, $id)
    {
        // TODO validate from Model properties
        $model = $this->relate($request)->findOrFail($id);

        if($model->update($request->all()))
        {
            return response()->json($model->get());
        }
        // TODO return error
    }

    public function destroy(Request $request, $id)
    {
        $model = $this->relate($request)->findOrFail($id);
        return response()->json($model, 204);
    }
}

