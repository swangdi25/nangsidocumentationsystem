<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Letterdetail;
use App\Letter;
use App\Marked;
use App\Incoming;
use App\Agency;
use App\Reference;
use App\Markview;
use App\User;
use App\ReadStatus;
use Illuminate\Support\Facades\Storage;

class CreateController extends Controller
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
         $letters = Letterdetail::where(['impt' => '0','p' => '0','mode' => 'direct','r_id' => Auth::id()])->orderBy('created_at','desc')->paginate(7);
     //   $letters = IncomingLetters::paginate(7);

          //check if letter is read by the user.
            $read_status_array[] = null;
            $i = 0;
          foreach($letters as $ll) {
            $read_status_array[$i] = ReadStatus::where(['reference_id' => $ll->id,'type' => 'l','read_by' => Auth::id()])->count();
            $i++;
          }

        return view('pages.incoming', compact('letters','read_status_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //get department_id of user.
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
             
        return view('pages.dispatch',['dipatchno' => $dno],compact('references'));
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

        $request->validate([
            'reference_no'  =>  'required',
            'subject'     =>  'required'
        ]);

        $user = Auth::user();

        $letter = new Letter;

        $userlist;
        $cclist;

        //get list of To(receiver) arrays from request.
        if(!empty($request->users))
        { 
            $uu = $request->users; //in json.
            foreach($uu as $u)   //make userlist of To to string:
            {
                 $udecoded = json_decode($u);
                 if(!empty($userlist)) 
                 { $userlist =  $userlist. ",".$udecoded;  }
                else { $userlist =$udecoded; }
            }
            $letter->sent_to =$userlist;        
        } 

        if(!empty($request->cceds))
        { $cc = $request->cceds;//in json.
        // get userlist of Cc to string:
            foreach($cc as $c)
            {
                $cdecode =  json_decode($c);
                if(!empty($cclist))
                { $cclist =  $cclist. ",".$cdecode; }
                else { $cclist = $cdecode; }
            }
            $letter->cc_to = $cclist;
        } 

        if($request->hasfile('attachment_doc'))
        {

	    $monYear = getdate();
            $attached_file = $request->file('attachment_doc');
            $filename = $attached_file->getClientOriginalName();
           // $attachment_file->move('directorateServices',$filename);
            $randomfilename = rand();
            $path = $request->file('attachment_doc')->storeAs($user->department_id.'/'.$monYear['year'].'/'.$monYear['mon'], $randomfilename . "_". $filename);
            $letter->filename= $filename;
            $letter->file_attachment_link = $path;
	
	//'public/'.$user->department_id.'/'.$randomfilename.".". $attached_file->getClientOriginalExtension();
	// store in different server using sftp.	
	//	Storage::disk('sftp')->put('upload/1',$request->file('attachment_doc'));

        }
       
        $letter->subject = $request->subject;
        if($request->important == "on") {
            $letter->important = 1;
        }

        $letter->action_date = $request->action_date;
        $letter->user_id = $user->id;
        $letter->address = $request->address;
        $letter->place = $request->place;

        //save reference number with dispatch number if the button use is clicked.
        if($request->receive_or_dispatch == "dispatch")
        {
                if(isset($request->dispatch_reserved_no)) {
                    $letter->reference_no = $request->reference_no . $request->dispatch_reserved_no;
                }
                else {
                //set starting dispatch number.
                    $agency = Agency::find($user->department_id);
                    if($agency->count() > 0)
                    {
                        
                            if(!is_null($agency->dispatch_no)) {
                                $newdispatch = $agency->dispatch_no + 1;
                                $agency->dispatch_no = $newdispatch;
                                $letter->reference_no = $request->reference_no . $newdispatch;

                            }
                            else {
                                $newdispatch = 1;
                                $agency->dispatch_no =  $newdispatch;
                                $letter->reference_no = $request->reference_no . $newdispatch;
                            }                
                        
                    }

                    $agency->save();            
                }
            }
            else
            {
                $letter->reference_no = $request->reference_no;
            }
       
        //update if the letter is received or dispatched.

        if($request->receive_or_dispatch == "receive")
        {
            $letter->dispatched_received = false; //else default value is true.
        }
        
        $letter->save();
       
        //insert receiver into table incoming.

        //get users to:
        if(!empty($request->users)) 
        {
            foreach($uu as $u)
             {
            $udecoded = json_decode($u);
            $incoming = new Incoming;
            $incoming->letter_id = $letter->id;
            $incoming->mode_of_receive = "direct";
            $incoming->receiver_id = $udecoded;
            $incoming->save();
            }
        }  
                
        // get users cced:
        if(!empty($request->cceds)) 
        {
            foreach($cc as $c)
            {
                $udecoded = json_decode($c);
                $incoming = new Incoming;
                $incoming->letter_id = $letter->id;
                $incoming->mode_of_receive = "cced";
                $incoming->receiver_id = $udecoded;
                $incoming->save();
            }
        }
       
        return redirect('/create')->with('success','letter sent');
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
        $recievers = "";
        $ccedlist = "";

        $letter = Letter::where('id','=',$id)->get();
        $comments = Markview::where('letter_id','=',$id)->get();
        $letterdetail = Letterdetail::where('id','=',$id)->get();

        //get list of receivers and cced.
       foreach($letterdetail as $ll) 
       {
            if($ll->mode == "direct") {
                if(!empty($recievers)) {
                    $recievers = $recievers.",".$ll->receiver;
                }
                else {
                    $recievers = $ll->receiver;
                }
               
            }
            else//($ll->mode == "cced") {
            {
                if(!empty($ccedlist)) {
                $ccedlist = $ccedlist . "," . $ll->receiver;
                } else { $ccedlist = $ll->receiver;}
            }

       }

        //get sender email.
        $senderemail = User::select('email')->where('id',$letter[0]->user_id)->get();

        //read status.

        $read = New ReadStatus;
        $read->type = "l";
        $read->reference_id = $id;
        $read->read_by = Auth::id();
        $read->save();

        return view('pages.letter-detail',compact('id','letter','comments','senderemail','recievers','ccedlist'));

    }

    /**
     * 
     * show important letter(s)
     */
    public function showletters() {

         //
         $letters = Letterdetail::where(['impt' => '1','mode' => 'direct','r_id' => Auth::id()])->paginate(7);
        // $letters = IncomingLetters::paginate(7);

      //check if letter is read by the user.
        $read_status_array[] = null;
        $i = 0;

        foreach($letters as $ll) {
        $read_status_array[$i] = ReadStatus::where(['reference_id' => $ll->id,'type' => 'l','read_by' => Auth::id()])->count();
        $i++;
        }

        return view('pages.important', compact('letters','read_status_array'));
    }

    /**
     * Marked to
     */
    public function marked()
    {
        $markeds = Markview::where('markedbyId','=',Auth::id())->orderBy('created_at','desc')->paginate(10);
        return view('pages.marked',compact('markeds'));
    }

    /**
     * 
     * show important copy letter(s)
     */
    public function copyletter() {

        //
        $letters = Letterdetail::where(['mode' => 'cced','r_id' => Auth::id()])->paginate(7);
    //   $letters = IncomingLetters::paginate(7);

       return view('pages.copyletter', compact('letters'));
   }

   
   /**
     * 
     * show important copy letter(s)
     */
    public function outgoing() {

        //
        $letters = Letter::where(['dispatched_received' => true,'user_id' => Auth::id()])->paginate(10);
    //   $letters = IncomingLetters::paginate(7);

       return view('pages.outgoing', compact('letters'));
   }

   //list of letter received.

   public function received() {

    //
    $letters = Letter::where(['dispatched_received' => false,'user_id' => Auth::id()])->paginate(10);
//   $letters = IncomingLetters::paginate(7);

   return view('pages.received', compact('letters'));
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
