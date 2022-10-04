<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LaborMobilityEstates\CreateRequest;
use App\Http\Requests\Admin\LaborMobilityEstates\UpdateRequest;
use App\Http\Resources\LaborMobilityEstateResource;
use App\TuChance\Models\LaborMobilityEstate;
use Illuminate\Http\Request;

class LaborMobilityEstatesController extends Controller
{
    /**
     * LaborMobilityEstate model
     * @var \App\TuChance\Models\LaborMobilityEstate
     */
    protected $estates;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\LaborMobilityEstate $estates
     * @return void
     */
    public function __construct(LaborMobilityEstate $estates)
    {
        $this->estates = $estates;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ResourceCollection
     */
    public function index(Request $request)
    {
        $query = $this->estates->newQuery();

        if ($request->has('term')) {
            $query->search($request->get('term'));
        } else {
            $query->latest();
        }

        if (
            $request->has('labor_mobility_country_id') &&
            is_numeric($country_id = $request->get('labor_mobility_country_id'))
        ) {
            $query->where('labor_mobility_country_id', $country_id);
        }


        $estates = $query->paginate(10);

        return LaborMobilityEstateResource::collection($estates);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityEstates\CreateRequest  $request
     * @return \App\Http\Resources\LaborMobilityEstateResource
     */
    public function store(CreateRequest $request)
    {
        $estate = $this->estates->newInstance();
        $estate->fill($request->all());
        $estate->save();

        return new LaborMobilityEstateResource($estate->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityEstateResource
     */
    public function show(Request $request, $id)
    {
        $estate = $this->estates->findOrFail($id);
        return new LaborMobilityEstateResource($estate);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityEstates\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\LaborMobilityEstateResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $estate = $this->estates->findOrFail($id);
        $estate->fill($request->all());
        $estate->save();

        return new LaborMobilityEstateResource($estate->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityEstateResource
     */
    public function destroy(Request $request, $id)
    {
        $estate = $this->estates->findOrFail($id);
        $estate->delete();

        return new LaborMobilityEstateResource($estate);
    }
}
