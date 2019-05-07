<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Collective\Html\Eloquent\FormAccessible;

class Department extends Model
{
    use FormAccessible;
    
    protected $fillable = [
        'name', 'prime', 'legal'
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

    public function formPrimeAttribute($value)
    {
        return $value ? true: false;
    }

    public function formLegalAttribute($value)
    {
        return $value ? true: false;
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

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    public function departmentCampaigns()
    {
        return $this->hasMany(DepartmentCampaign::class);
    }
}
