<?php


class DelayDdbController extends baseController{
	public function show(){

		$result = DelayDdata::paginate(10);
		return View::make('dashboard.admin.delayd_edit.edit_db')->with('result',$result);
		
		}

	public function create(){

		return View::make('dashboard.admin.delayd_edit.new_row');

	}

	public function edit(){

		$id = Input::get('id');
		$result= DelayDdata::where('id',$id)->get();
		return View::make('dashboard.admin.delayd_edit.edit_row')->with('result',$result);

	}

	public function update(){

			
		$res= DelayDdata::where('id',Input::get('id'))->update(array('option_a'=>Input::get('option_a'),'option_b'=>Input::get('option_b'),'correct_option'=>Input::get('correct_option')));
		return Redirect::to('/experiments/db/DelayD')->with('message','The entry was successfully updated');

	}

	public function store(){

			DelayDdata::create(array('option_a'=>Input::get('option_a'),'option_b'=>Input::get('option_b'),'correct_option'=>Input::get('correct_option')));
			return Redirect::to('/experiments/db/DelayD')->with('message','A new entry was successfully created');

	}

	public function randomize(){

		$val= Input::get('formGender');
		if($val==0 || $val==1){
		DB::table('random_table')->update(array('dorandom'=>$val));
		return Redirect::to('/experiments/db/DelayD')->with('message','Random table updated');
		}
	}

	public function destroy(){

		$id = Input::get('id');
		$affectedRows = DelayDdata::where('id',$id)->delete();
		if($affectedRows == 1){

			return Redirect::to('/experiments/db/DelayD')->with('message','The entry was successfully deleted');
		}
	}
}	


?>
