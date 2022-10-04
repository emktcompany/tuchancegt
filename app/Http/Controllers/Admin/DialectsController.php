<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Dialects\CreateRequest;
use App\Http\Requests\Admin\Dialects\UpdateRequest;
use App\Http\Resources\DialectResource;
use App\TuChance\Models\Dialect;
use Illuminate\Http\Request;

class DialectsController extends Controller
{
    /**
     * Dialect model
     * @var \App\TuChance\Models\Dialect
     */
    protected $dialects;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\Dialect $dialects
     * @return void
     */
    public function __construct(Dialect $dialects)
    {
        $this->dialects = $dialects;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ResourceCollection
     */
    public function index(Request $request)
    {
        $query = $this->dialects->newQuery();

        if ($request->has('term')) {
            $query->search($request->get('term'), null, true, true);
        } else {
            $query->orderBy('code');
        }

        if (
            $request->has('ethnicity_id') &&
            $ethnicity_id = $request->get('ethnicity_id')
        ) {
            $query->where(function ($query) use ($ethnicity_id) {
                $query->where('ethnicity_id', $ethnicity_id)
                    ->orWhereNull('ethnicity_id');
            });
        }

        if ($request->has('all')) {
            $dialects = $query->get();
        } else {
            $dialects = $query->with('ethnicity')->paginate(10);
        }

        return DialectResource::collection($dialects);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\Dialects\CreateRequest  $request
     * @return \App\Http\Resources\DialectResource
     */
    public function store(CreateRequest $request)
    {
        $dialect = $this->dialects->newInstance();
        $dialect->fill($request->all());
        $dialect->save();

        return new DialectResource($dialect->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\DialectResource
     */
    public function show(Request $request, $id)
    {
        $dialect = $this->dialects->findOrFail($id);
        return new DialectResource($dialect);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\Dialects\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\DialectResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $dialect = $this->dialects->findOrFail($id);
        $dialect->fill($request->all());
        $dialect->save();

        return new DialectResource($dialect->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\DialectResource
     */
    public function destroy(Request $request, $id)
    {
        $dialect = $this->dialects->findOrFail($id);
        $dialect->delete();

        return new DialectResource($dialect);
    }
}
