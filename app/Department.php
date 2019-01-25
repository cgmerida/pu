<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name', 'prime', 'legal'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'prime' => 'boolean',
            'legal' => 'boolean',
        ];
    }

    public function getPrimeAttribute($value)
    {
        return $value ? "Si" : "No";
    }

    public function getLegalAttribute($value)
    {
        return $value ? "Si" : "No";
    }

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function mayors()
    {
        return $this->hasMany(Mayor::class);
    }

    public function deputies()
    {
        return $this->hasMany(Deputy::class);
    }
}
