<?php

namespace App\Http\Controllers\API;

use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return $this->customeResponse(ServiceResource::collection($services), "All Services Retrieved Successfully", 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $service = Service::create([
                'name'        => $request->name,
                'description' => $request->description,
            ]);
            DB::commit();

            return $this->customeResponse(new ServiceResource($service), 'Service Created Successfully', 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return $this->customeResponse(null, 'Service Not Created', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        try {
            return $this->customeResponse(new ServiceResource($service), 'Service Retrieved Successfully', 200);
        } catch (\Throwable $th) {
            Log::debug($th);
            return $this->customeResponse(null, 'Service Not Found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceUpdateRequest $request, Service $service)
    {
        try {
            DB::beginTransaction();
            $service->update([
                'name'        => $request->name ?? $service->name,
                'description' => $request->description ?? $service->description,
            ]);
            DB::commit();

            return $this->customeResponse(new ServiceResource($service), 'Service Updated Successfully', 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th);
            return $this->customeResponse(null, 'Service Not Updated', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return $this->customeResponse('', 'Service Deleted Successfully', 200);
        } catch (\Throwable $th) {
            Log::debug($th);
            return $this->customeResponse(null, 'Service Not Found', 404);
        }
    }
}
