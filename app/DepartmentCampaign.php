<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentCampaign extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'department_id',
    ];

    protected $dates = [
        'date',
    ];

    public static function rules()
    {
        return [
            'date' => 'required|date',
            'department_id' => 'required|numeric',
        ];
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
