<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $appends = ['spices'];

    /**
     * The spice that belong to the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function spice()
    {
        return $this->belongsToMany(Spice::class);
    }

    public function getSpicesAttribute()
    {
        return $this->spice()->get()->map->only(['id','name']);
    }
}
