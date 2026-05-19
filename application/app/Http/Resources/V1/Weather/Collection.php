<?php

namespace App\Http\Resources\V1\Weather;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class Collection extends ResourceCollection
{
    public function __construct($resource, private $pagination)
    {
        parent::__construct($resource);
    }

    public function getWeathers(): array
    {
        return $this->collection
            ->map(function ($post) {
                return new Resource($post);
            })
            ->toArray()
            ;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...[
                'weathers' => $this->getWeathers(),
            ],
            ...collect([
                'pagination' => (($this->pagination)
                    ? (object)$this->pagination
                    : null
                ),
            ])
                ->filter()
                ->all()
        ];
    }
}
