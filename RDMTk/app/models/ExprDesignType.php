<?php

/**
* Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
*Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>
*/

class ExprDesignType extends Eloquent  {

	

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'expr_design_type';
        

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
            'id' ,
            'name' ,
            'created_by' ,
            'modified_by' ,
            'updated_at' ,
            'created_at' 
            ); 
        
        public function exprReln(){
            
            return $this->hasMany('\ExprReln', 'foreign_key', 'expr_design_id');
            
        }
        
        
}
