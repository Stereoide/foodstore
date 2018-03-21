<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'amount',
    ];

    /* Scopes */

    public function scopeAvailable($query)
    {
        return $query->whereNull('depleted_at');
    }

    public function scopeWithDepleted($query)
    {
        return $query->orWhereNotNull('depleted_at');
    }

    public function scopeOrderByAmount($query)
    {
        return $query->orderBy('amount');
    }

    public function scopeOrderByName($query)
    {
        return $query->orderBy('name');
    }

    /* Methods */

    public function deplete()
    {
        $this->amount = 0;
        $this->depleted_at = time();
        $this->save();
    }

    public function replenish(int $amount)
    {
        $this->amount = $amount;
        $this->depleted_at = null;
        $this->save();
    }
}
