<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deputy extends Model
{

    protected $fillable = [
        'name', 'department_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'department_id' => 'required|numeric',
        ];
    }

    public function setNameAttribute($value = '')
    {
        $this->attributes['name'] = mb_convert_case($value, MB_CASE_TITLE, "UTF-8");
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
