<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionnaireOne extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;


    protected $fillable = [
        'housekeeper_name',
        'unit_number',
        'service_type',
        'status_remarks',
        'provided_items',
        'removed_items',
        'bedroom_tasks',
        'bathroom_tasks',
        'general_tasks',
        'image',
        'task_date',
        'status',
        'user_id',
        'supervisor_id',
        'images',

    ];

    protected $casts = [
        'provided_items' => 'array',
        'removed_items' => 'array',
        'completed_tasks' => 'array',
    ];
    
  function user()
    {
        return $this->belongsTo(User::class);
    }

   
}
