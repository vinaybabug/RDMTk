@extends('dashboard.dashboard_admin')
<!--
* Copyright (C) 2015  WiSe Lab, Computer Science Department, Western Michigan University
* Project Members Involved: Ajay Gupta, Aakash Gupta, Baba Shiv, Praneet Soni, Shrey Gupta and Vinay B Gavirangaswamy
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
-->

@section('page-content') 

<div class="row">
    <div class="col-lg-12">       
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
<div class="col-lg-12">

   <!-- About Section -->
    <section class="container content-section text-justify">
        <p class="h4 page-header"><b>Tasks</b></p>
        <p>Following are the default tasks in the toolkit:</p>
<br>
         <ol>
             <li><p><i>Balloon Task –</i> In this task, participant can inflate the balloon by clicking. The user can either keep inflating or
collect points. If the user collects the points before the balloon explode, he gets all the points, which is
proportional to the number of clicks.If the balloon explodes, the user will get no points in that trial.</p></li>
             <li><p><i>Iowa Gambling Task –</i> In this experiment, you will be asked to repeatedly select a card from one of four decks.
You select a card by clicking the mouse on one of the decks. With each card, you can win some money, but you
may also lose some. Some decks will be more profitable than others. You try to choose cards from the most
profitable decks so that your total winnings will be as high as possible. You will get 100 chances to select a card
from the decks that you think will give you the highest winnings. Your total earnings and the number of cards
selected will be displayed on screen. You start with $4000.</p></li>
              
             <li><p><i>Cups Task –</i> In this task, you are going to choose cups to get the highest score. On each side of the screen, you
will see a certain number of cups (2, 3, or 5). The cups will have a return value over them, either positive or negative. For each trial, you will be given the option of choosing a cup from either side by clicking on your
choice. The side with multiple cups has one cup with the return value under it. The other cups have nothing
under them. So your goal is to choose the right cups to maximize your score. Please read the payouts for each
trial carefully.</p></li>
             <li><p><i>N Back –</i> Using your right hand, you will put your thumb on the spacebar. You will see a string of letters
presented one at a time. If the letter you saw is the same as the letter before the last one, press the spacebar as
soon as you can. For example, if you see a sequence line '...m k h k p...', then you should press the spacebar on
the second 'k'. The user gets a short practice session before the experiment begins.</p></li>
             <li><p><i>Stroop –</i> In this task, you will be asked to name the color of the ink the words are printed in as fast as you can,
ignoring the actual word that is printed in each item. You will put your left middle finger on ‘D’, left index
finger on 'F', right index finger on 'J' and right middle finger on 'K'. The user should memorize which button to
press in correspondence to different ink colors before the experiment begins.</p></li>
             <li><p><i>Delayed Discounting Task –</i> You will be presented with a series of choices in which you must indicate
preference in a form to receive a given quantity of money. For example, choose between "R$1.00 now" or
"R$10.00 in a year's time." In this task, there is predefined set of sample questions that can be used by the user
or the user can make his own set of questions that can be only used by him and cannot be seen by other
researchers. These questions further can be modified by him only.</p></li>
            
        </ol>


    
<br>
<br>
<br>
 <div class="form-group page-header">            
            <a href="{{URL::to('dashboard')}}" class="btn btn-success">Cancel</a>
 </div> 
</section>
            
  
</div>
</div>


@stop



 
