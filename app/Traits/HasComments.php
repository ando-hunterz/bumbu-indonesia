<?php

namespace App\Traits;

use App\Models\Visitor;

trait HasComments
{

    public function getCommentsAttribute()
    {
        $comments = collect([]);
        foreach ($this->comment()->get() as $datum) {
            $visitor = Visitor::find($datum->pivot->visitor_id)->first()->only(['id','name','avatar_url']);
            $data = [
                'comment' => $datum->pivot->comment,
                "user" => $visitor
            ];
            $comments->push($data);
        }
        return $comments;
    }
}
