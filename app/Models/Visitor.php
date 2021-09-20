<?php

namespace App\Models;

use App\Traits\HasComments;
use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory, HasLikes, HasComments;

    protected $table = 'visitors';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'ip'
    ];

    protected $appends = [
        'comments',
        'likes'
    ];

    /**
     * The like that belong to the Visitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function like()
    {
        return $this->belongsToMany(Spice::class, 'like_visitor');
    }

    /**
     * Get the comment that belong to the Visitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comment()
    {
        return $this->belongsToMany(Spice::class, 'comment_visitor')->withPivot('comment');
    }
}
