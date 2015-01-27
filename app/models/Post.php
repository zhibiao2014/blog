<?php  

Class Post extends Eloquent {

	public function comments()
	{
		return $this->hasMany('Comment');
	}
}

?>