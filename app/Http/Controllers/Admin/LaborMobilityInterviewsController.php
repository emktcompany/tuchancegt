<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LaborMobilityInterviews\CreateRequest;
use App\Http\Requests\Admin\LaborMobilityInterviews\UpdateRequest;
use App\Http\Resources\LaborMobilityInterviewResource;
use App\TuChance\Models\LaborMobilityInterview;
use Illuminate\Http\Request;

class LaborMobilityInterviewsController extends Controller
{
    /**
     * LaborMobilityInterview model
     * @var \App\TuChance\Models\LaborMobilityInterview
     */
    protected $interviews;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\LaborMobilityInterview $interviews
     * @return void
     */
    public function __construct(LaborMobilityInterview $interviews)
    {
        $this->interviews = $interviews;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ResourceCollection
     */
    public function index(Request $request)
    {
        $query = $this->interviews->newQuery();

        if ($request->has('term')) {
            $query->search($request->get('term'));
        } else {
            $query->latest();
        }

        $interviews = $query->paginate(10);

        return LaborMobilityInterviewResource::collection($interviews);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityInterviews\CreateRequest  $request
     * @return \App\Http\Resources\LaborMobilityInterviewResource
     */
    public function store(CreateRequest $request)
    {
        $interview = $this->interviews->newInstance();
        $interview->fill($request->all());
        $interview->save();

        return new LaborMobilityInterviewResource($interview->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityInterviewResource
     */
    public function show(Request $request, $id)
    {
        $interview = $this->interviews->findOrFail($id);
        return new LaborMobilityInterviewResource($interview);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityInterviews\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\LaborMobilityInterviewResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $interview = $this->interviews->findOrFail($id);
        $interview->fill($request->all());
        $interview->save();

        return new LaborMobilityInterviewResource($interview->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityInterviewResource
     */
    public function destroy(Request $request, $id)
    {
        $interview = $this->interviews->findOrFail($id);
        $interview->delete();

        return new LaborMobilityInterviewResource($interview);
    }
}
