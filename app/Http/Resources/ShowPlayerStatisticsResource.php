<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowPlayerStatisticsResource extends JsonResource
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
            'player' => $this->resource['player'],
            'currentStatistics' => $this->resource['statistics'],
            'dataPoints' => DataPointResource::collection($this->resource['dataPoints']),
            'achievements' => $this->resource['achievements']
        ];
    }
}
