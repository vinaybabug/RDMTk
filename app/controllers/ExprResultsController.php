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

class ExprResultsController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function experRsltDwnld() {

        $input = Input::all();

        $isSummary = Input::get('isSummary');
        $task = Input::get('expertype');
        $experId = Input::get('exprid');

        if ($isSummary != 'true') {
            switch ($task) {
                case 'BART':
                    return $this->bartExprRaw($task, $experId);
                    break;
                case 'CUPS':
                    return $this->cupsExprRaw($task, $experId);
                    break;
                case 'IGT':
                    return $this->igtExprRaw($task, $experId);
                    break;
                case 'STROOP':
                    return $this->stroopExprRaw($task, $experId);
                    break;
                case 'NBACK':
                    return $this->nbackExprRaw($task, $experId);
                    break;
            }
        } else {
            switch ($task) {
                case 'BART':
                    return $this->bartExprSummary($task, $experId);
                    break;
                case 'CUPS':
                    return $this->cupsExprSummary($task, $experId);
                    break;
            }
        }
        $role = Auth::user()->role;
        return View::make('/hello')->with('role',$role);
    }

    private function bartExprRaw($taskId, $experId) {

        $data = BartExprRsltsData::where('experid', '=', $experId)
                ->orderBy('mid', 'asc')
                ->orderBy('trialno', 'asc')
                ->get();

        return Excel::create('ExprParticipantsDataRaw', function($excel) use($data) {

                    $excel->sheet('ExprData', function($sheet) use($data) {

                        $sheet->fromModel($data);
                    });
                })->export('xls');
    }

    private function cupsExprRaw($taskId, $experId) {


        $data = CupsExprRsltsData::where('experid', '=', $experId)
                ->orderBy('mid', 'asc')
                ->orderBy('trialno', 'asc')
                ->get();

        return Excel::create('ExprParticipantsDataRaw', function($excel) use($data) {

                    $excel->sheet('ExprData', function($sheet) use($data) {

                        $sheet->fromModel($data);
                    });
                })->export('xls');
    }

    private function igtExprRaw($taskId, $experId) {

        $data = IGTExprRsltsData::where('experid', '=', $experId)
                ->orderBy('mid', 'asc')
                ->orderBy('trialno', 'asc')
                ->get();

        return Excel::create('ExprParticipantsDataRaw', function($excel) use($data) {

                    $excel->sheet('ExprData', function($sheet) use($data) {

                        $sheet->fromModel($data);
                    });
                })->export('xls');
    }

    private function stroopExprRaw($taskId, $experId) {

        $data = StroopExprRsltsData::where('experid', '=', $experId)
                ->orderBy('mid', 'asc')
                ->orderBy('exp_flag', 'asc')
                ->orderBy('trialno', 'asc')
                ->get();

        return Excel::create('ExprParticipantsDataRaw', function($excel) use($data) {

                    $excel->sheet('ExprData', function($sheet) use($data) {

                        $sheet->fromModel($data);
                    });
                })->export('xls');
    }

    private function nbackExprRaw($taskId, $experId) {

        $data = NbackExprRsltsData::where('experid', '=', $experId)
                ->orderBy('mid', 'asc')
                ->orderBy('exp_flag', 'asc')
                ->orderBy('trialno', 'asc')
                ->get();

        return Excel::create('ExprParticipantsDataRaw', function($excel) use($data) {

                    $excel->sheet('ExprData', function($sheet) use($data) {

                        $sheet->fromModel($data);
                    });
                })->export('xls');
    }

    private function bartExprSummary($taskId, $experId) {
        

        $results = DB::select(DB::raw("SELECT 
                                                expername, 
                                                mid , 
                                                confirmationcode, 
                                                trialno,
                                                trialstopindex,
                                                noofpumps,
                                                trial_pts,
                                                total_pts,
                                                tracktime,
                                                bart.created_at
                                        FROM 
                                                bart_expr_data as bart
                                        JOIN    experiments as exper
                                        ON      exper.id = bart.experid
                                        WHERE   exper.id = :experId
                                        ORDER BY mid, trialno;"), array('experId' => $experId,
        ));
      
        
        $temp01 = Experiments::select('nooftrials')->where('id', '=', $experId)->get();
        $TOTAL_TRIAL_EXPERIMENT = $temp01[0]->nooftrials;
        $avgPerNo = $TOTAL_TRIAL_EXPERIMENT/5;
        
        $count_exp_raw = count($results);
        
        $summaryRow = 0;
        
        $summary[$summaryRow] = array(                          
                          'expername' => 'Experiment Name',
                          'mid' => 'MID',
                          'confirmationcode' => 'Confirmation Code',                                                                                                   
                        );
        $averagePeriod = array();
        for($count = 1; $count <= $avgPerNo; $count++ ){
            $summary[$summaryRow] = $summary[$summaryRow] + array('averagePeriod'.$count => 'Average Period'.$count); 
             $averagePeriod[$count] = 0;
        }
        
        $summary[$summaryRow] = $summary[$summaryRow] + array(  'avgTimePerTrial' => 'Avg. Time Per Trial',
                                            'avgpumps' => 'Avg. No. Pumps',                                                    
                                            'totalPumps' => 'Total No. Pumps',                                                    
                                            'numOfPopped' => 'No. Popped',                                                    
                                            'numOfCollected' => 'No. Collected',                                                    
                                            'created_at' => 'Date');
         
        for ($rowCount = 0; $rowCount < $count_exp_raw; $rowCount += $TOTAL_TRIAL_EXPERIMENT) {
            
            // Advance summary row
            $summaryRow++;
            
            $summary[$summaryRow] = array(                          
                          'expername' => $results[$rowCount]->expername,
                          'mid' => $results[$rowCount]->mid,
                          'confirmationcode' => $results[$rowCount]->confirmationcode,                                                                                                   
                        );
         
            $avgTimePerTrial = 0;
            $totalPumps = 0;
            
            $numOfPopped = 0;
            $numOfCollected = 0;

            $bin = 1;
            $bin_counter = 0;
            
            for ($trialNum = 0; $trialNum < $TOTAL_TRIAL_EXPERIMENT; $trialNum++) {                               
                
                if($bin_counter ==5){
                    $bin++;
                    $bin_counter = 0;
                }
                $bin_counter++;    
                
                $currentWorkingRow = $trialNum + $rowCount;

                $avgTimePerTrial = $avgTimePerTrial + $results[$currentWorkingRow]->tracktime;
                $totalPumps = $totalPumps + $results[$currentWorkingRow]->noofpumps;

                $numOfPopped += $results[$currentWorkingRow]->trialstopindex <= $results[$currentWorkingRow]->noofpumps ? 1 : 0;

                $numOfCollected += $results[$currentWorkingRow]->trialstopindex > $results[$currentWorkingRow]->noofpumps ? 1 : 0;


                $averagePeriod[$bin] = $averagePeriod[$bin] + $results[$currentWorkingRow]->tracktime;

            }


            for ($count = 1; $count <= $avgPerNo; $count++) {
                $summary[$summaryRow] = $summary[$summaryRow] + array('averagePeriod' . $count => $averagePeriod[$bin]/5);                
            }

            $summary[$summaryRow] = $summary[$summaryRow] + array('avgTimePerTrial' => $avgTimePerTrial/$TOTAL_TRIAL_EXPERIMENT,
                'avgpumps' => $totalPumps / $TOTAL_TRIAL_EXPERIMENT,
                'totalPumps' => $totalPumps,
                'numOfPopped' => $numOfPopped,
                'numOfCollected' => $numOfCollected,
                'created_at' => $results[$rowCount]->created_at);
        }
        
       
        return Excel::create('ExprParticipantsDataRaw', function($excel) use($summary) {

                    $excel->sheet('ExprData', function($sheet) use($summary) {

                        //$sheet->fromModel($summary);
                        $sheet->fromArray($summary, null, 'A1', false, false);
                    });
                })->export('xls');
        
        
    }

    
    private function cupsExprSummary($taskId, $experId) {
        

        $results = DB::select(DB::raw("SELECT 
                                                expername, 
                                                mid, 
                                                confirmationcode,
                                                cup_color,
                                                cupsnumber,
                                                count(trialno) as trials,
                                                amountshown,
                                                avg(trial_pts) as avgTrialPts,
                                                avg(tracktime) as avgtracktime,
                                                sum(trial_pts) as totalPts,
                                                cups.created_at 
                                        FROM 
                                                cups_expr_data as cups
                                        JOIN experiments as exper
                                        ON exper.id = cups.experid
                                        WHERE exper.id = :experId group by mid, cup_color, cupsnumber, amountshown"), array('experId' => $experId));
        $summaryRow = 0;
        $summary[$summaryRow] = array(                          
                          'expername' => 'Experiment Name',
                          'mid' => 'MID',
                          'confirmationcode' => 'Confirmation Code',   
                          'cupcolor' => 'Cup Color',
                          'cupsnumber'=> 'Cups No',
                           'trialno' => 'No of Trial',
                           'amountshown' => 'Amount Shown',
                           'avgTrialPts' => 'Avg. Trial Pts',
                           'avgtracktime' => 'Avg Track Time',
                           'sumtrialpts' => 'Total Trial Pts',
                           'created_at' =>'DateTime' 
                        );
        $count_exp_raw = count($results);
        
        for ($rowCount = 0; $rowCount < $count_exp_raw; $rowCount++, $summaryRow++) {
            
            $summary[$summaryRow] = array(                          
                          'expername' => $results[$rowCount]->expername,
                          'mid' => $results[$rowCount]->mid,
                          'confirmationcode' => $results[$rowCount]->confirmationcode,   
                          'cupcolor' => $results[$rowCount]->cup_color,
                          'cupsnumber'=> $results[$rowCount]->cupsnumber,
                           'trialno' => $results[$rowCount]->trials,
                           'amountshown' => $results[$rowCount]->amountshown,
                           'avgTrialPts' => $results[$rowCount]->avgTrialPts,
                           'avgtracktime' => $results[$rowCount]->avgtracktime,
                           'sumtrialpts' => $results[$rowCount]->totalPts,
                           'created_at' =>$results[$rowCount]->created_at 
                        );
            
        }
    //    return $results;
     return Excel::create('ExprParticipantsDataRaw', function($excel) use($summary) {

                    $excel->sheet('ExprData', function($sheet) use($summary) {

                        //$sheet->fromModel($results);
                        $sheet->fromArray($summary, null, 'A1', false);//, false);
                    });
                })->export('xls');
        
        
    }
    
    public function soExperRsltDwnldPg() {
        $tasks = Tasks::lists('taskname', 'id');
        $role = Auth::user()->role;
        return View::make('dashboard.admin.exprRslts.exprRsltsSo')
                        ->with('tasks', $tasks)->with('role',$role);
    }

    public function getExprids($id) {

        $exprs = Experiments::where('expertype', '=', $id)->get(); //->lists('expername', 'id');
        $options = array();

        foreach ($exprs as $expr) {
            $options += array($expr->id => $expr->expername);
        }

        return Response::json($options);
    }
    
    public function storeBart(){
        
        $input = Input::get('data');//Input::all(); 
        
        // check is participant (mid) already took the task/game        
                                  
         $prev = DB::select(DB::raw("SELECT 
                                                *
                                        FROM 
                                                bart_expr_data                                        
                                        WHERE experid = :experId and mid = :mId"), array('experId' => $input[0]['experid'], 'mId' => $input[0]['mid']));
//         return count($prev);
        
        if (count($prev)==0) {
            foreach ($input as $data) {
                BartExprRsltsData::create($data);
            }
            //return Response::json($input[0]['mid']);
            return 'true';
        } else {
            return 'false';
        }
        return 'false';
    }

}
