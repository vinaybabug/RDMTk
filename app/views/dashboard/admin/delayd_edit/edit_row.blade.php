@extends('dashboard.dashboard_admin')

@section('page-content')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="PraneetSoni">
	<title>Edit DelayD Row</title>
	<body>
	<div class="container col-md-12">
		
			<div class="panel panel-default col-md-12" style="margin-top:20px;padding:0px 0px;">
				<div class="panel-heading">
					<h2>Edit the question</h2>
				</div>
				<div class="panel-body">
					<h3>What would you prefer:</h3>

					<form method="POST" action="{{route('DelayD/update')}}">
						<input type="hidden" name="id" value={{$result[0]['id']}}>
	 					<h3>Choice A:</h3>
						<textarea cols="100" rows="5" placeholder ="{{$result[0]['option_a']}}" name= "option_a"></textarea>
						<br><br>
						<h3>Choice B:</h3>
						<textarea cols="100" rows="5" placeholder ="{{$result[0]['option_b']}}" name= "option_b"></textarea>
						<br>
	                    <h3>Choose Correct Option :</h3>
	                    
	  					<select name="correct_option" role="button"  class="btn btn-info" >
	 
			  				<option value="0">Option A</option>
							<option value="1">Option B</option>
						</select>   
	                <br><br>
	                   
						
					<input type="submit" class="btn btn-primary" value="Go"></input>
					<a href="{{URL::to('/experiments/db/DelayD')}}" class="btn btn-default">Cancel</a>
					</form>

				</div>
			</div>
		
	</div>

</body>
</html>
@endsection