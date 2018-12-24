<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use SoftDeletes;

    protected $casts = [
		'target_id' => 'integer'
	];

    protected $fillable = [
        'text',
		'target_id',
		'target_type',
    ];

    /**
	 * Get all of the owning targetable models.
	 */
	public function target()
	{
		return $this->morphTo();
	}
}
