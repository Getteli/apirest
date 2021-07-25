<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\LinksGenerator;

class Student extends JsonResource
{

    // public $collects = \App\Models\Student::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $links = new LinksGenerator();

        $links->addGet('show', route('students.show', $this->id));
        $links->addPut('update', route('students.update', $this->id));
        $links->addDelete('delete', route('students.destroy', $this->id));

        // return parent::toArray($request);
        return [
            'id' => (int) $this->id,
            'birth' => $this->birth,
            'nome' => $this->name,
            // 'classroom' => new Classroom($this->classroom),
            'classroom' => new Classroom($this->whenLoaded('classroom')),
            'links' => $links->toArray()
        ];
    }
}
