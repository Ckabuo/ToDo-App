<?php

namespace App\Models;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Relations\BelongsToMany;
 use Illuminate\Database\Eloquent\Relations\HasMany;
 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;
 use Laravel\Sanctum\HasApiTokens;
 use Spatie\Activitylog\LogOptions;
 use Spatie\Activitylog\Traits\LogsActivity;

 class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    protected $guarded = [
      'id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function todos(): HasMany
    {
        return $this->hasMany(Todo::class);
    }

     public function getActivitylogOptions(): LogOptions
     {
         return LogOptions::defaults()
             ->logUnguarded()
             ->useLogName('User');
     }
 }
