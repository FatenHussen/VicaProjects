<?php

namespace App\Http\Controllers\API;

use App\Models\Skill;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\SkillStoreRequest;
use App\Http\Requests\SkillUpdateRequest;

class SkillController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skill = Skill::all();
        return $this->customeResponse(SkillResource::collection($skill), "All Retrieve  skill Success", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $skill = Skill::create([
                'name'=> $request->name,
                'description'=> $request->description,

            ]);
            DB::commit();

            return $this->customeResponse(new SkillResource($skill),'the skill created successfully',201);


        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return $this->customeResponse(null,' the skill not created',500);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    { try {
        return $this->customeResponse(new SkillResource($skill), 'ok', 200);
    } catch (\Throwable $th) {
        Log::debug($th);
        return $this->customeResponse(null, 'Not Found', 404);
    }

    }
    public function update(SkillUpdateRequest $request, Skill $skill)
    {
        try {
            DB::beginTransaction();
            $newData = [];

            if (isset($request->name)) {
                $newData['name'] = $request->name;
            }
            if (isset($request->description)) {
                $newData['description'] = $request->description;
            }
        
            
            $skill->update($newData);

            DB::commit();
            return $this->customeResponse(new SkillResource($skill), 'Update Success', 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);

            return $this->customeResponse(null, 'Update Failed', 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        try {
            $skill ->delete();
            return $this->customeResponse('', 'skill  deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::debug($th);
            return $this->customeResponse(null, 'Not Found', 404);
        }
    }
}
