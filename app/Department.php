<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'prime',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'prime' => 'required|boolean',
        ];
    }

    public function getPrimeAttribute($value)
    {
        return $value ? "Si" : "No";
    }

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
