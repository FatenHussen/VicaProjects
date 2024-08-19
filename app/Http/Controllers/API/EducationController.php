<?php

namespace App\Http\Controllers\API;

use App\Models\Education;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\EducationResource;
use App\Http\Requests\EducationStoreRequest;
use App\Http\Requests\EducationUpdateRequest;

class EducationController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $education = Education::all();
        return $this->customeResponse(EducationResource::collection($education), "All Retrieve Education Success", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $education = Education::create([
                'institution'   => $request->institution,
                'degree'        => $request->degree,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
            ]);
            DB::commit();

            return $this->customeResponse(new EducationResource($education), 'The education record created successfully', 201);

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return $this->customeResponse(null, 'The education record was not created', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    { 
        try {
            return $this->customeResponse(new EducationResource($education), 'Ok', 200);
        } catch (\Throwable $th) {
            Log::debug($th);
            return $this->customeResponse(null, 'Not Found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EducationUpdateRequest $request, Education $education)
    {
        try {
            DB::beginTransaction();
            $newData = [];

            if (isset($request->institution)) {
                $newData['institution'] = $request->institution;
            }
            if (isset($request->degree)) {
                $newData['degree'] = $request->degree;
            }
            if (isset($request->start_date)) {
                $newData['start_date'] = $request->start_date;
            }
            if (isset($request->end_date)) {
                $newData['end_date'] = $request->end_date;
            }

            $education->update($newData);

            DB::commit();
            return $this->customeResponse(new EducationResource($education), 'Update Success', 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);

            return $this->customeResponse(null, 'Update Failed', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        try {
            $education->delete();
            return $this->customeResponse('', 'Education record deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::debug($th);
            return $this->customeResponse(null, 'Not Found', 404);
        }
    }
}
