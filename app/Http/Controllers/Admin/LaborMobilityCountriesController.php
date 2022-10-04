<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LaborMobilityCountries\CreateRequest;
use App\Http\Requests\Admin\LaborMobilityCountries\UpdateRequest;
use App\Http\Resources\LaborMobilityCountryResource;
use App\TuChance\Models\LaborMobilityCountry;
use Illuminate\Http\Request;

class LaborMobilityCountriesController extends Controller
{
    /**
     * LaborMobilityCountry model
     * @var \App\TuChance\Models\LaborMobilityCountry
     */
    protected $countries;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\LaborMobilityCountry $countries
     * @return void
     */
    public function __construct(LaborMobilityCountry $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ResourceCollection
     */
    public function index(Request $request)
    {
        $query = $this->countries->newQuery();

        if ($request->has('term')) {
            $query->search($request->get('term'));
        } else {
            $query->orderBy('name');
        }

        if ($request->has('all')) {
            $countries = $query->get();
        } else {
            $countries = $query->paginate(10);
        }

        return LaborMobilityCountryResource::collection($countries);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityCountries\CreateRequest  $request
     * @return \App\Http\Resources\LaborMobilityCountryResource
     */
    public function store(CreateRequest $request)
    {
        $country = $this->countries->newInstance();
        $country->fill($request->all());
        $country->save();

        return new LaborMobilityCountryResource($country->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityCountryResource
     */
    public function show(Request $request, $id)
    {
        $country = $this->countries->findOrFail($id);
        return new LaborMobilityCountryResource($country);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityCountries\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\LaborMobilityCountryResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $country = $this->countries->findOrFail($id);
        $country->fill($request->all());
        $country->save();

        return new LaborMobilityCountryResource($country->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityCountryResource
     */
    public function destroy(Request $request, $id)
    {
        $country = $this->countries->findOrFail($id);
        $country->delete();

        return new LaborMobilityCountryResource($country);
    }
}
