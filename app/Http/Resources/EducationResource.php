<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EducationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'institution' => $this->institution,
            'degree' => $this->degree,
            'start_date' => $this->start_date ? \Carbon\Carbon::parse($this->start_date)->toDateString() : null,
            'end_date' => $this->end_date ? \Carbon\Carbon::parse($this->end_date)->toDateString() : null,
            // Add other fields as necessary
        ];
    }
}
