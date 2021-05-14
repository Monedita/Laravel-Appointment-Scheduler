<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use DateTime;

class AppointmentController extends Controller
{

    /**
    * Display a listing of available shifts.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
        if (auth()->check())
        {
            ///////////////////////////////////////////////////////////
            //get the date or the current date
            if ($request->input('date'))
            {
                $date = $request->input('date');
            }   
            else
            {
                $date = date('Y-m-d'); 
            }
            $myDateTime = DateTime::createFromFormat('Y-m-d', $date);
            

            ///////////////////////////////////////////////////////////
            //5 next week days
            $days = [];
            for ($d = 0; $d <= 4; $d++)
            {
                //I check if the day is workable in the constants configuration
                $numberOfDay = $myDateTime->format("N");
                while (config('constants.scheduler.'.$numberOfDay.'') == false)
                {
                    //If it isn´t, I add 1 day until it is a working day
                    date_add($myDateTime, date_interval_create_from_date_string("1 day"));
                    $numberOfDay = $myDateTime->format("N");
                }
                //record the current day formated Y-m-d like the database
                $days[$d] = $myDateTime->format('Y-m-d');
                //pass $date to the next day for the loop to work
                date_add($myDateTime, date_interval_create_from_date_string("1 day"));
            }

            ///////////////////////////////////////////////////////////
            //Available shifts vs appointments
            $appointments = [];
            for ($d = 0; $d <= 4; $d++)
            {
                $appointments[$days[$d]] = Appointment::where('date', $days[$d])
                ->orderBy('hour')
                ->pluck('hour','hour');
            }

            ///////////////////////////////////////////////////////////
            //scheduler
            $scheduler = [];
            for ($d = 0; $d <= 4; $d++)
            {
                for ($h = config('constants.scheduler.start_hour'); $h < config('constants.scheduler.end_hour'); $h++)
                {
                    $scheduler[$days[$d]][$h] = $h;
                    if (isset($appointments[$days[$d]][$h]))
                    {
                        $scheduler[$days[$d]][$h] = "taken";
                    }
                }
            }

            //errase temporal vars
            unset($days, $date, $numberOfDay, $appointments);

            ///////////////////////////////////////////////////////////
            //print the view in blade
            return view('appointment',[
                'scheduler' => $scheduler,
                'next5days' => $myDateTime->format('Y-m-d'),
            ]);
        }
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexadmin(Request $request)
    {
        if(auth()->check() && auth()->user()->admin)
        {
            ///////////////////////////////////////////////////////////
            //get the date or the current date
            if ($request->input('date'))
            {
                $date = $request->input('date');
            }   
            else
            {
                $date = date('Y-m-d'); 
            }
            $myDateTime = DateTime::createFromFormat('Y-m-d', $date);

            ///////////////////////////////////////////////////////////
            //5 next week days
            $days = [];
            for ($d = 0; $d <= 4; $d++)
            {
                //I check if the day is workable in the constants configuration
                $numberOfDay = $myDateTime->format("N");
                while (config('constants.scheduler.'.$numberOfDay.'') == false)
                {
                    //If so, I add 1 day until it is a working day
                    date_add($myDateTime, date_interval_create_from_date_string("1 day"));
                    $numberOfDay = $myDateTime->format("N");
                }
                //record the current day formated Y-m-d like the database
                $days[$d] = $myDateTime->format('Y-m-d');
                //pass $date to the next day for the loop to work
                date_add($myDateTime, date_interval_create_from_date_string("1 day"));
            }

            ///////////////////////////////////////////////////////////
            //List of the appointments for the next 5 days
            return view('admin',[
                'appointments' => Appointment::whereBetween('date', [$days[0], $days[4]])
                    ->orderBy('date')
                    ->orderBy('hour')
                    ->get(),
                'next5days' => $myDateTime->format('Y-m-d'),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($date, $hour)//(Request $request)
    {
        $appointment = Appointment::create([
            'user_id' => auth()->user()->id,
            'treatment' => 'Inserte texto aquí',
            'date' => $date,
            'hour' => $hour,
        ]);
        return redirect()->route('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('show',[
            'appointments' => Appointment::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        return view('destroyConfirmation',['appointment' => $appointment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->check())
        {
            if (auth()->user()->admin)
            {
                Appointment::where('id',$id)->delete();
                return redirect()->route('admin');
            }
            else
            {
                Appointment::where('user_id', auth()->user()->id)->delete();
                return redirect()->route('appointment');
            }
        
        }
    }


}