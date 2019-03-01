<?php

namespace App\Contracts\Achievements;

interface AchievementInterface
{
    /**
     * Determine if the achievement should be recorded
     *
     * @return bool
     */
    public function shouldRecord();

    /**
     * Action to perform if achievement passes
     * 
     * @return mixed
     */
    public function handle();
}