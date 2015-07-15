<?php


class Tasks extends Eloquent  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tasks';
    protected $fillable = array('id','taskname','created_by','modified_by','created_at','updated_at');
    public $timestamps = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');
        
        
        /**
         * Validation
         */
        
        //protected $guarded = array('id');
        //protected $fillable = array('first_name', 'last_name','email','password','username', 'role');
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
