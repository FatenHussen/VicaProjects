<?php

namespace App\Http\Resources;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     
   
     public function toArray($request)
     {
         return [
             'id' => $this->id,
             'company' => $this->company,
             'role' => $this->role,
             'start_date' => $this->start_date ? Carbon::parse($this->start_date)->toDateString() : null,
             'end_date' => $this->end_date ? Carbon::parse($this->end_date)->toDateString() : null,
             'description' => $this->description,
         ];
}}
