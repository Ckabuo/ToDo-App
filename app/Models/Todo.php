<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Todo extends Model
{
    use HasFactory, LogsActivity;

    public $fillable = [
      'title',
      'description',
      'status',
      'user_id'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName('Todo');
    }
}
