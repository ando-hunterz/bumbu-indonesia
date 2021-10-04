<?php

namespace App\Models;

use App\Traits\HasPhoto;
use App\Traits\HasComments;
use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spice extends Model
{
    use HasFactory, HasPhoto, HasComments, HasLikes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'is_approved',
        'name_translate'
    ];

    protected $appends = [
        'photo',
        'comments',
        'likes',
        'provinces'
    ];

    public function photos()
    {
        return $this->hasMany(SpicePhoto::class);
    }

    /**
     * The roles that belong to the Spice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function province()
    {
        return $this->belongsToMany(Province::class);
    }

    /**
     * The like that belong to the Spice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function like()
    {
        return $this->belongsToMany(Visitor::class, 'like_visitor');
    }

    /**
     * The comment that belong to the Spice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comment()
    {
        return $this->belongsToMany(Visitor::class, 'comment_visitor')->withPivot('comment');
    }

    public function getProvincesAttribute()
    {
        return $this->province()->get()->map->only('id','name');
    }
}
