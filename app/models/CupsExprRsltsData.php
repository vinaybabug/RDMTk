<?php


class CupsExprRsltsData extends Eloquent  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cups_expr_data';
        

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
        
        
        /**
         * Validation
         */
        
        protected $guarded = array('id');
        protected $fillable = array(   
                'mid' ,
                'experid' ,  
                'cupsnumber' ,
                'amountshown' ,
                'paychoice' ,
                'position' ,
                'participantchoice' ,
                'participantposition' ,  
                'trialno' ,
                'trial_pts' ,
                'total_pts' ,
                'created_by' ,
                'modified_by' ,
                'updated_at' ,
                'created_at' ,
                'tracktime' ,
                'cup_color' ,
            );
        /*
        public static $rules = array(
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'role' => 'required',
            'username' => 'unique:rdm_user',
            'email' => 'required|email|unique:rdm_user',
            'password' =>'same:password_confirmation'
        );
        
        public static $rulesUpdate = array(
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'role' => 'required',            
            'email' => 'required|email',
            'password' =>'required|same:password_confirmation'
        );
        */        

}
