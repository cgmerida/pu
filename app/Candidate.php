<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{

    protected $fillable = [
        'first_name', 'last_name', 'position',
        'department_id', 'municipality_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department_id' => 'required|numeric',
            'municipality_id' => 'required|numeric',
        ];
    }

    public static function positions()
    {
        return [
            0 => 'Seleccione una posición',
            'Alcalde' => 'Alcalde',
            'Nacional' => 'Nacional',
            'Distrito' => 'Distrito'
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
