<?php     

class DelayDdata extends Eloquent{
	
	protected $table ="delayed_discount_que";
	public $timestamps = false;
	protected $fillable = array('option_a','option_b','correct_option');
}

?>