<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LaborMobilityPeople\CreateRequest;
use App\Http\Requests\Admin\LaborMobilityPeople\UpdateRequest;
use App\Http\Resources\LaborMobilityPersonResource;
use App\TuChance\Models\LaborMobilityPerson;
use Illuminate\Http\Request;

class LaborMobilityPeopleController extends Controller
{
    /**
     * LaborMobilityPerson model
     * @var \App\TuChance\Models\LaborMobilityPerson
     */
    protected $people;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\LaborMobilityPerson $people
     * @return void
     */
    public function __construct(LaborMobilityPerson $people)
    {
        $this->people = $people;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ResourceCollection
     */
    public function index(Request $request)
    {
        $query = $this->people->newQuery();

        if ($request->has('term')) {
            $query->search($request->get('term'));
        } else {
            $query->latest();
        }

        $people = $query->paginate(10);

        return LaborMobilityPersonResource::collection($people);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityPeople\CreateRequest  $request
     * @return \App\Http\Resources\LaborMobilityPersonResource
     */
    public function store(CreateRequest $request)
    {
        $person = $this->people->newInstance();
        $person->fill($request->all());
        $person->save();

        return new LaborMobilityPersonResource($person->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityPersonResource
     */
    public function show(Request $request, $id)
    {
        $person = $this->people->findOrFail($id);
        return new LaborMobilityPersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityPeople\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\LaborMobilityPersonResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $person = $this->people->findOrFail($id);
        $person->fill($request->all());
        $person->save();

        return new LaborMobilityPersonResource($person->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityPersonResource
     */
    public function destroy(Request $request, $id)
    {
        $person = $this->people->findOrFail($id);
        $person->delete();

        return new LaborMobilityPersonResource($person);
    }
}
