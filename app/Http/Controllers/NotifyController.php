<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Agency;
use App\Reference;
use App\Notices;
use App\User;
use App\ReadStatus;

class NotifyController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $notifications =  Notices::orderBy('created_at','desc')->paginate(7);

        $read_status_array[] = null;
        $i = 0;
        foreach($notifications as $nn) {
            $read_status_array[$i] = ReadStatus::where(['reference_id' => $nn->id,'type' => 'n','read_by' => Auth::id()])->count();
            $i++;
        }

        return view('pages.notification',compact('notifications','read_status_array'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();
        $references = Reference::where('agency_id',$user->department_id)->get();        

        $dispatchno = Agency::where('id',$user->department_id)->get();
        if($dispatchno->count() > 0)
        {
            foreach($dispatchno as $d)
            {
                if(isset($d->dispatch_no)) {
                    $dno = $d->dispatch_no+1;
                }
                else {
                    $dispatchno->dispatch_no = 1;
                }
         
            }
            
        }

        return view('pages.create-notification',['dispatchno' => $dno],compact('references'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $notification = new Notices;
        $user = Auth::user();

        if($request->hasfile('notification_file'))
        {
	    $monyear = getdate();

            $attached_file = $request->file('notification_file');
            $filename = $attached_file->getClientOriginalName();
           // $attachment_file->move('directorateServices',$filename);
            $randomfilename = rand();
            $path = $request->file('notification_file')->storeAs('notification/'.$monyear['year'].'/'.$monyear['mon'], $randomfilename . "_" . $filename);
            $notification->file= $path;
            
        }

        $notification->subject = $request->notification_subject;
        $notification->from = $request->notification_from;
        $notification->summary = $request->notification_summary;
        $notification->user_id = $user->id;

        //save reference number with dispatch number if the button use is clicked.
        if(isset($request->dispatch_reserved_no)) {
            $notification->reference_no = $request->reference_no . $request->dispatch_reserved_no;
        }
        else {
        //set starting dispatch number.
            $agency = Agency::find($user->department_id);
            if($agency->count() > 0)
            {
                
                    if(!is_null($agency->dispatch_no)) {
                        $newdispatch = $agency->dispatch_no + 1;
                        $agency->dispatch_no = $newdispatch;
                        $notification->reference_no = $request->reference_no . $newdispatch;

                    }
                    else {
                        $newdispatch = 1;
                        $agency->dispatch_no =  $newdispatch;
                        $notification->reference_no = $request->reference_no . $newdispatch;
                    }                
                
            }

            $agency->save();            
            }

            $notification->save();

            return redirect('/notify')->with('success','notificaton sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $notices = Notices::where('id','=',$id)->get();

          //read status.

          $read = New ReadStatus;
          $read->type = "n";
          $read->reference_id = $id;
          $read->read_by = Auth::id();
          $read->save();

        return view('pages.noticedetail',compact('notices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
