<?php

namespace App\Http\Controllers\API;

use App\Models\Experience;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ExperienceResource;
use App\Http\Requests\ExperienceStoreRequest;
use App\Http\Requests\ExperienceUpdateRequest;

class ExperienceController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::all();
        return $this->customeResponse(ExperienceResource::collection($experiences), "All Experiences Retrieved Successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExperienceStoreRequest $request)
    { 
        try {
            DB::beginTransaction();
            $experience = Experience::create([
                'company'     => $request->company,
                'role'        => $request->role,
                'start_date'  => $request->start_date,
                'end_date'    => $request->end_date,
                'description' => $request->description,
            ]);
            DB::commit();

            return $this->customeResponse(new ExperienceResource($experience), 'Experience Created Successfully', 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return $this->customeResponse(null, 'Experience Not Created', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        try {
            return $this->customeResponse(new ExperienceResource($experience), 'Experience Retrieved Successfully', 200);
        } catch (\Throwable $th) {
            Log::debug($th);
            return $this->customeResponse(null, 'Experience Not Found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExperienceUpdateRequest $request, Experience $experience)
    {
        try {
            DB::beginTransaction();
            $experience->update([
                'company'     => $request->company ?? $experience->company,
                'role'        => $request->role ?? $experience->role,
                'start_date'  => $request->start_date ?? $experience->start_date,
                'end_date'    => $request->end_date ?? $experience->end_date,
                'description' => $request->description ?? $experience->description,
            ]);
            DB::commit();

            return $this->customeResponse(new ExperienceResource($experience), 'Experience Updated Successfully', 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return $this->customeResponse(null, 'Experience Not Updated', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        try {
            $experience->delete();
            return $this->customeResponse('', 'Experience Deleted Successfully', 200);
        } catch (\Throwable $th) {
            Log::debug($th);
            return $this->customeResponse(null, 'Experience Not Found', 404);
        }
    }
}
