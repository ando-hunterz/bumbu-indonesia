<?php

namespace App\Traits;

trait HasLikes
{

    public function getLikesAttribute()
    {
        return $this->like()->count();
    }

}