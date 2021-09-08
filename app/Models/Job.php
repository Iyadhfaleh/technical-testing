<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $primaryKey = 'reference';
    protected $fillable = ["name", "description", "reference", "schedule_at","status"];

    protected $dates = ["schedule_at"];

    public static $rules = [
        "name" => "required",
        "description" => "required",
        "schedule_at" => "date"
    ];
    public static $status = [
        'scheduled' => 1,
        'run_success' => 2,
        'run_failed' => 3,
        'removed' => 4,
    ];
}
