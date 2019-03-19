<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

class Municipality extends Model
{
    use FormAccessible;

    protected $fillable = [
        'name', 'prime', 'legal', 'department_id'
    ];
    
    public $timestamps = false;

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'prime' => 'boolean',
            'legal' => 'boolean',
            'department_id' => 'required|numeric'
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

    public function formPrimeAttribute($value)
    {
        return $value ? true : false;
    }

    public function formLegalAttribute($value)
    {
        return $value ? true : false;
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function mayor()
    {
        return $this->hasOne(Mayor::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }
}
