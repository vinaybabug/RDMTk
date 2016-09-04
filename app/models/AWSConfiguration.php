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

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AWSConfiguration extends Eloquent {
    
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'aws_rdmtk_config';
        

	
        
        /**
         * Validation
         */
        
       
        
        protected $guarded = array('id');
        protected $fillable = array( 'username',
                                     'aws_instanceid',                                     
                                     'aws_key',
                                     'aws_secret',
                                     'aws_region',
                                     'created_by',
                                     'modified_by',
                                     );

        public static $rules = array(
            'username'=> 'required|unique:aws_rdmtk_config',
            'aws_instanceid' => 'required|min:3',            
            'aws_key' => 'required|min:3',
            'aws_secret' => 'required|min:3',
            'aws_region' => 'required|min:3',
            'created_by' => 'required|min:3'            
        );
        
        public static $rulesUpdate = array(            
            'aws_instanceid' => 'required|min:3',            
            'aws_key' => 'required|min:3',
            'aws_secret' => 'required|min:3',
            'aws_region' => 'required|min:3',            
            'modified_by' => 'required|min:3'  
            
        );   
  
             
    

}
