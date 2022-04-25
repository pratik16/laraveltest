<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	public $timestamps = false;

	protected $casts = [
		'user_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'role_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	
}
