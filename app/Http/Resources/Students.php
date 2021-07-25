<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Students extends ResourceCollection
{

    public $collects = Student::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request)
    {
        // esta me retornando os dados ja formatado pelo model
        // return parent::toArray($request);

        return [
            "dados" => $this->collection,
            "link" => [
                "self" => "Treina Web"
            ]
        ];
    }
}
