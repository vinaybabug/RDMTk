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
 * User variables
 */
var freq = 45;			// Threshold to log mouse tracking movements, in milliseconds. In other words, 1000/freq is the frequency in hertz.
var detect_resize = false;

/**
 * System variables.
 */
var mouse_str= new Array();  //Array to store all the mouse events and the corresponding coordinates
var offset =0; 				 //time instant at which page loads
var mmd= 5;					 //minimum mouse movement to consider a new location
var freq_control = true;
var dx=0;					 //last recorded X coordinate
var dy=0;	     			 //last recorded Y coordinate

var tmp,tmp1,tmp2;
var expid,userid;
var width,height;            //window width and height used for normalization of recorded x and y coords
var norm_x, norm_y;          //x and y coords mapped to 1024x720p screen size



function getTime(){

	var time= new Date();
	time-=0;
	return time;
}

function generateData(){
 
		tmp = $(location).attr('search');
		tmp1 = tmp.match(/exp=[^&]+/g);
		tmp2= tmp.match(/MID=[^&]+/g);
		expid= tmp1[0].substr(4);
		userid = tmp2[0].substr(4);

		var tmp_url= $(location).attr('pathname').split('/',4);
//		var url= $(location).attr('protocol')+"//"+$(location).attr('hostname')+"/"+tmp_url[1]+"/"+tmp_url[2]+"/index.php/track/store";
                // Uncomment on localhost for developing
                var url= $(location).attr('protocol')+"//"+$(location).attr('hostname')+"/index.php/track/store";
                // Uncomment on live server
//                var url= "https://"+$(location).attr('hostname')+"/"+"index.php/track/store";
		var data = new Array();
		data[0]=expid;
		data[1]=userid;
		data[2]=url;
		return data;
}

$(document).ready(function(){
	
	var btn = document.createElement("BUTTON");
	btn.setAttribute("style","display:none");
	btn.setAttribute("id","unload");
	document.body.appendChild(btn);

	offset = getTime();
	width = $(document).width();
	height= $(document).height();

	$(document).mousemove(function(e){
		if(freq_control && (Math.abs(e.pageX - dx)>=mmd || Math.abs(e.pageY- dy)>=mmd)){
			freq_control =false;
			dx= e.pageX;
			dy= e.pageY;

			norm_x = (dx/width) * 1024;
			norm_y = (dy/height) * 720;
			mouse_str.push((getTime()-offset)+":"+norm_x+":"+norm_y );
			setTimeout('freq_control=true;', freq);

		}
	});

	/*$(document).mousedown(function(e){
    	
		norm_x = (dx/width) * 1024;
		norm_y = (dy/height) * 720;
		mouse_str.push((getTime()-offset)+":"+norm_x+":"+norm_y);
			
	});*/
    
    $(window).resize(function() {
	  // This will execute whenever the window is resized
	  height=  $(document).height(); // New height
	  width = $(document).width(); // New width
	});

	$("#unload").click(function(){
		var data =generateData();
		
		//sending the data to store when window is unloaded
		
		var xmlRequest = $.ajax({
			method:"POST",
			url:data[2],
			data:{'expid':data[0],'userid':data[1],'coordinates':mouse_str.join('#')}
		}).done(function(){

			//alert('in the loop');
		});	
		
	});

});

