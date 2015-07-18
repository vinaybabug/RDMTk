
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

/**
 * @description This controller handles all CRUD operations on the Delay Dicounting Task's Database of questions.
 *				It also allows the user to select whether order of questions is to be randomized or not.
 * @author 	Praneet Soni praneetsoni.soni@gmail.com
 */

class DelayDdbController extends baseController{

	/**
	* @description Renders a page displaying the current entries in the database
	*/
	public function show(){

		$result = DelayDdata::paginate(10);
		return View::make('dashboard.admin.delayd.show.showdb')->with('result',$result);
		
		}
	/**
	* @description Renders a form through which data for the new table entry can be entered 
	*/
	public function create(){

		return View::make('dashboard.admin.delayd.create.newrow');     

	}
	/**
	* @description Renders a form through updated values of the entry, to be edited , can be entered.  
	*/
	public function edit(){

		$id = Input::get('id');
		$result= DelayDdata::where('id',$id)->get();
		return View::make('dashboard.admin.delayd.edit.editrow')->with('result',$result);

	}
	/**
	* @description Updates the corresponding entry in the database.  
	*/
	public function update(){

			
		$res= DelayDdata::where('id',Input::get('id'))->update(array('option_a'=>Input::get('option_a'),'option_b'=>Input::get('option_b'),'correct_option'=>Input::get('correct_option')));
		return Redirect::to('/experiments/db/DelayD')->with('message','The entry was successfully updated');

	}
	/**
	* @description Creates a new entry in the database.  
	*/
	public function store(){

			DelayDdata::create(array('option_a'=>Input::get('option_a'),'option_b'=>Input::get('option_b'),'correct_option'=>Input::get('correct_option')));
			return Redirect::to('/experiments/db/DelayD')->with('message','A new entry was successfully created');

	}
	/**
	* @description Decides whether randomize should be on or off based on user input.
	*/
	public function randomize(){

		$val= Input::get('formGender');
		if($val==0 || $val==1){
		DB::table('random_table')->update(array('dorandom'=>$val));
		return Redirect::to('/experiments/db/DelayD')->with('message','Random table updated');
		}
	}
	/**
	* @description Deletes an entry from the table.
	*/
	public function destroy(){

		$id = Input::get('id');
		$affectedRows = DelayDdata::where('id',$id)->delete();
		if($affectedRows == 1){

			return Redirect::to('/experiments/db/DelayD')->with('message','The entry was successfully deleted');
		}
	}
}	


?>
