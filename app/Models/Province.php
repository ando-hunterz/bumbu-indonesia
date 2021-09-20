<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * The spice that belong to the Province
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function spice()
    {
        return $this->belongsToMany(Spice::class);
    }
}
