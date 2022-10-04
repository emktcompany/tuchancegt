<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaborMobilityReturns;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportRequest;
use App\Http\Requests\Admin\LaborMobilityReturns\CreateRequest;
use App\Http\Requests\Admin\LaborMobilityReturns\UpdateRequest;
use App\Http\Resources\LaborMobilityReturnResource;
use App\Imports\ImportLaborMobilityReturns;
use App\TuChance\Models\LaborMobilityReturn;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LaborMobilityReturnsController extends Controller
{
    /**
     * LaborMobilityReturn model
     * @var \App\TuChance\Models\LaborMobilityReturn
     */
    protected $returns;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\LaborMobilityReturn $returns
     * @return void
     */
    public function __construct(LaborMobilityReturn $returns)
    {
        $this->returns = $returns;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\ResourceCollection
     */
    public function index(Request $request)
    {
        $query = $this->returns->newQuery();

        if ($request->has('term')) {
            $query->search($request->get('term'));
        } else {
            $query->latest();
        }

        if (!(
            $request->has('labor_mobility_country_id') &&
            is_numeric($country_id = $request->get('labor_mobility_country_id'))
        )) {
            $country_id = 0;
        }

        $query->where('labor_mobility_country_id', $country_id);

        $returns = $query->paginate(10);

        return LaborMobilityReturnResource::collection($returns);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityReturns\CreateRequest  $request
     * @return \App\Http\Resources\LaborMobilityReturnResource
     */
    public function store(CreateRequest $request)
    {
        $return = $this->returns->newInstance();
        $return->fill($request->all());
        $return->save();

        return new LaborMobilityReturnResource($return->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityReturnResource
     */
    public function show(Request $request, $id)
    {
        $return = $this->returns->findOrFail($id);
        return new LaborMobilityReturnResource($return);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\LaborMobilityReturns\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\LaborMobilityReturnResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $return = $this->returns->findOrFail($id);
        $return->fill($request->all());
        $return->save();

        return new LaborMobilityReturnResource($return->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\LaborMobilityReturnResource
     */
    public function destroy(Request $request, $id)
    {
        $return = $this->returns->findOrFail($id);
        $return->delete();

        return new LaborMobilityReturnResource($return);
    }

    /**
     * Download all returns
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Exports\LaborMobilityReturns
     */
    public function export(Request $request)
    {
        return new LaborMobilityReturns($request);
    }

    /**
     * Import given file to database
     * @param  \App\Http\Requests\Admin\ImportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(ImportRequest $request)
    {
        $job = new ImportLaborMobilityReturns;
        $job->import($request->file('file'));

        return new JsonResponse([
            'success' => $job->wasSuccessful(),
            'message' => $job->getResult(),
        ], $job->wasSuccessful() ? 200 : 422);
    }
}
