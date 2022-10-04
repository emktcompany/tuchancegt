<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ethnicities\CreateRequest;
use App\Http\Requests\Admin\Ethnicities\UpdateRequest;
use App\Http\Resources\EthnicityResource;
use App\TuChance\Models\Ethnicity;
use Illuminate\Http\Request;

class EthnicitiesController extends Controller
{
    /**
     * Ethnicity model
     * @var \App\TuChance\Models\Ethnicity
     */
    protected $ethnicities;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\Ethnicity $ethnicities
     * @return void
     */
    public function __construct(Ethnicity $ethnicities)
    {
        $this->ethnicities = $ethnicities;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ResourceCollection
     */
    public function index(Request $request)
    {
        $query = $this->ethnicities->newQuery();

        if ($request->has('term')) {
            $query->search($request->get('term'), null, true, true);
        } else {
            $query->orderBy('name');
        }

        if ($request->has('all')) {
            $ethnicities = $query->get();
        } else {
            $ethnicities = $query->paginate(10);
        }

        return EthnicityResource::collection($ethnicities);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\Ethnicities\CreateRequest  $request
     * @return \App\Http\Resources\EthnicityResource
     */
    public function store(CreateRequest $request)
    {
        $ethnicity = $this->ethnicities->newInstance();
        $ethnicity->fill($request->all());
        $ethnicity->save();

        return new EthnicityResource($ethnicity->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\EthnicityResource
     */
    public function show(Request $request, $id)
    {
        $ethnicity = $this->ethnicities->findOrFail($id);
        return new EthnicityResource($ethnicity);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\Ethnicities\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\EthnicityResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $ethnicity = $this->ethnicities->findOrFail($id);
        $ethnicity->fill($request->all());
        $ethnicity->save();

        return new EthnicityResource($ethnicity->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\EthnicityResource
     */
    public function destroy(Request $request, $id)
    {
        $ethnicity = $this->ethnicities->findOrFail($id);
        $ethnicity->delete();

        return new EthnicityResource($ethnicity);
    }
}
