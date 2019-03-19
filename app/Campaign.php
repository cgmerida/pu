<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'date', 'department_id', 'municipality_id',
    ];

    protected $dates = [
        'date',
        'created_at',
        'updated_at'
    ];

    public static function rules()
    {
        return [
            'number' => 'required|numeric',
            'date' => 'required|date',
            'department_id' => 'required|numeric',
            'municipality_id' => 'required|numeric',
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
