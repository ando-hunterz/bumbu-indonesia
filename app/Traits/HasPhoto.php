<?php

namespace App\Traits;

trait HasPhoto
{

    public function getPhotoAttribute()
    {
        return $this->photos()->select('photo_url')->get();
    }

}