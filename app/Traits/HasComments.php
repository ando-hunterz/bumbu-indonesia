<?php

namespace App\Traits;

trait HasComments
{

    public function getCommentsAttribute()
    {
        $comments = collect([]);
        foreach ($this->comment()->get() as $datum) {
            $comments->push($datum->pivot->comment);
        }
        return $comments;
    }
}
