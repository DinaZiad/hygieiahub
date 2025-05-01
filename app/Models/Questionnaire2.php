<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire2 extends Model
{
    protected $fillable = [
        'housekeeper_name',
        'unit_number',
        'service_type', // scheduled, unscheduled, paid
        'status_remarks', // completed, DND, etc.
        'bed_linen',
        'bath_linen',
        'image',
        'status', // pending, completed, etc.
        'task_date',
        'user_id',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
