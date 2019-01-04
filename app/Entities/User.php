<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'name', 'lastname', 'email', 'template_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /** @var array $casts */
    protected $casts = [
        'template_id' => 'integer',
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
     * @return BelongsTo
     */
    public function template(): BelongsTo
    {
        return $this->belongsTo(Template::class);
    } 
    
    /**
     * @return HasOne
     */
    public function area(): HasOne
    {
        return $this->hasOne(UserArea::class);
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
    
    public function createOrUpdateArea($area)
    {
        if (!empty($area['radius']) && !empty($area['latitude']) && !empty($area['longitude'])) {
            if (!empty($this->area)) {
                $this->area->update($area);                
            } else {
                $this->area()->create($area);
            }
        }
    }       
        
}
