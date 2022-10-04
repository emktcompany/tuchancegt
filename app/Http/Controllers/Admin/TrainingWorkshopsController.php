<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrainingWorkshops\CreateRequest;
use App\Http\Requests\Admin\TrainingWorkshops\UpdateRequest;
use App\Http\Resources\TrainingWorkshopResource;
use App\TuChance\Models\TrainingWorkshop;
use Illuminate\Http\Request;

class TrainingWorkshopsController extends Controller
{
    /**
     * TrainingWorkshop model
     * @var \App\TuChance\Models\TrainingWorkshop
     */
    protected $training_workshops;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\TrainingWorkshop $training_workshops
     * @return void
     */
    public function __construct(TrainingWorkshop $training_workshops)
    {
        $this->training_workshops = $training_workshops;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ResourceCollection
     */
    public function index(Request $request)
    {
        $query = $this->training_workshops->newQuery();

        if ($request->has('term')) {
            $query->search($request->get('term'), null, true, true);
        } else {
            $query->orderBy('name');
        }

        $training_workshops = $query->paginate(10);

        return TrainingWorkshopResource::collection($training_workshops);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\TrainingWorkshops\CreateRequest  $request
     * @return \App\Http\Resources\TrainingWorkshopResource
     */
    public function store(CreateRequest $request)
    {
        $training_workshop = $this->training_workshops->newInstance();
        $training_workshop->fill($request->all());
        $training_workshop->save();

        return new TrainingWorkshopResource($training_workshop->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\TrainingWorkshopResource
     */
    public function show(Request $request, $id)
    {
        $training_workshop = $this->training_workshops->findOrFail($id);
        return new TrainingWorkshopResource($training_workshop);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\TrainingWorkshops\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\TrainingWorkshopResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $training_workshop = $this->training_workshops->findOrFail($id);
        $training_workshop->fill($request->all());
        $training_workshop->save();

        return new TrainingWorkshopResource($training_workshop->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\TrainingWorkshopResource
     */
    public function destroy(Request $request, $id)
    {
        $training_workshop = $this->training_workshops->findOrFail($id);
        $training_workshop->delete();

        return new TrainingWorkshopResource($training_workshop);
    }
}
