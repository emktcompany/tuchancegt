<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TrainingRecords;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportRequest;
use App\Http\Requests\Admin\TrainingRecords\CreateRequest;
use App\Http\Requests\Admin\TrainingRecords\UpdateRequest;
use App\Http\Resources\TrainingRecordResource;
use App\Imports\ImportTrainingRecords;
use App\TuChance\Models\TrainingRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TrainingRecordsController extends Controller
{
    /**
     * TrainingRecord model
     * @var \App\TuChance\Models\TrainingRecord
     */
    protected $returns;

    /**
     * Create a new controller instance
     * @param  \App\TuChance\Models\TrainingRecord $returns
     * @return void
     */
    public function __construct(TrainingRecord $returns)
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
        $query = $this->returns
            ->has('workshop')
            ->has('person');

        if ($request->has('term')) {
            $query->search($request->get('term'));
        } else {
            $query->latest();
        }

        $returns = $query->paginate(10);

        return TrainingRecordResource::collection($returns);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\Admin\TrainingRecords\CreateRequest  $request
     * @return \App\Http\Resources\TrainingRecordResource
     */
    public function store(CreateRequest $request)
    {
        $return = $this->returns->newInstance();
        $return->fill($request->all());
        $return->save();

        return new TrainingRecordResource($return->fresh());
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\TrainingRecordResource
     */
    public function show(Request $request, $id)
    {
        $return = $this->returns->findOrFail($id);
        return new TrainingRecordResource($return);
    }

    /**
     * Update the specified resource in storage.
     * @param  \App\Http\Requests\Admin\TrainingRecords\UpdateRequest  $request
     * @param  int                                             $id
     * @return \App\Http\Resources\TrainingRecordResource
     */
    public function update(UpdateRequest $request, $id)
    {
        $return = $this->returns->findOrFail($id);
        $return->fill($request->all());
        $return->save();

        return new TrainingRecordResource($return->fresh());
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \App\Http\Resources\TrainingRecordResource
     */
    public function destroy(Request $request, $id)
    {
        $return = $this->returns->findOrFail($id);
        $return->delete();

        return new TrainingRecordResource($return);
    }

    /**
     * Download all returns
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Exports\TrainingRecords
     */
    public function export(Request $request)
    {
        return new TrainingRecords($request);
    }

    /**
     * Import given file to database
     * @param  \App\Http\Requests\Admin\ImportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function import(ImportRequest $request)
    {
        $job = new ImportTrainingRecords;
        $job->import($request->file('file'));

        return new JsonResponse([
            'success' => $job->wasSuccessful(),
            'message' => $job->getResult(),
        ], $job->wasSuccessful() ? 200 : 422);
    }
}
