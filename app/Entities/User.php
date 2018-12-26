<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lastname', 'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function scopeEmployee($q)
    {
        return $q->whereRoleIs('employee');
    }
    
    public function scopeAdmin($q)
    {
        return $q->whereRoleIs('admin');
    }    

    /**
     * This scope allows to retrive the users with a specific roles.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $roles
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereRolesAre($query, $roles)
    {
        return $query->whereHas('roles', function ($roleQuery) use ($roles) {
            $roleQuery->whereIn('name', $roles);
        });
    }
    
    /**
     * @return MorphMany
     */
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'target');
    }
    
    /**
     * @return HasMany
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }     
    
    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->lastname . ' ' . $this->name;
    }
    
    public function createOrUpdateNote($note)
    {
        if (!empty($note)) {
            if ($this->notes->isEmpty()) {
                $this->notes()->create(['text' => $note]);
            } else {
                $userNote = $this->notes()->first();
                $userNote->text = $note;
                $userNote->save();
            }

        }
    }       
        
}
