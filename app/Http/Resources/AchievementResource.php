<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AchievementResource extends JsonResource
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
            'name' => $this->name,
            'skill' => $this->skill,
            'timespan' => $this->timespan,
            'score' => $this->pivot->score,
            'achieved' => $this->pivot->created_at->toDateTimeString()
        ];
    }
}
