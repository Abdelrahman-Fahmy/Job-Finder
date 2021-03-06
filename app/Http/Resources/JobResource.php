<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
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
            'id'=>$this->id,
            'title'=>$this->title,
            'company_name'=>$this->company_name,
            'job_type'=>$this->job_type,
            'location'=>$this->location,
            'job_details'=>$this->job_details,
            'salary'=>$this->salary,
            'category'=>$this['category']['name']
        ];
    }
}
