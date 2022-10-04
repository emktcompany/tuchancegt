<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrainingPeople\CreateRequest;
use App\Http\Requests\Admin\TrainingPeople\UpdateRequest;
use App\Http\Resources\TrainingPersonResource;
use App\TuChance\Models\TrainingPerson;
use Illuminate\Http\Request;

class TrainingPeopleController extends Controller
{
    /**
     * TrainingPerson model
     * @var \App\TuChance\Models\TrainingPerson
     */
    protected $people;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\TrainingPerson $people
     * @return void
     */
    public function __construct(TrainingPerson $people)
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

        return TrainingPersonResource::collection($people);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\TrainingPeople\CreateRequest  $request
     * @return \App\Http\Resources\TrainingPersonResource
     */
    public function store(CreateRequest $request)
    {
        $person = $this->people->newInstance();
        $person->fill($request->all());
        $person->save();

        return new TrainingPersonResource($person->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\TrainingPersonResource
     */
    public function show(Request $request, $id)
    {
        $person = $this->people->findOrFail($id);
        return new TrainingPersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\TrainingPeople\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\TrainingPersonResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $person = $this->people->findOrFail($id);
        $person->fill($request->all());
        $person->save();

        return new TrainingPersonResource($person->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\TrainingPersonResource
     */
    public function destroy(Request $request, $id)
    {
        $person = $this->people->findOrFail($id);
        $person->delete();

        return new TrainingPersonResource($person);
    }
}
