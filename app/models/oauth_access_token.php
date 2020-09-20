<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

Class oauth_access_token extends Model {

	public function user(){
		return $this->belongsTo('App\Models\user\User');
	}
}

