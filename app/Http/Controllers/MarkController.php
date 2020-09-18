<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Marked;
use App\Markview;
use App\Letter;

class MarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $markeds = Markview::where('marked_to','=',Auth::id())->orderBy('created_at','desc')->paginate(10);
        return view('pages.markedToMe',compact('markeds'));
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
    public function store(Request $request)
    {
        //
        
      
            $comment = new Marked;

            $comment->letter_id = $request->letter_id;

            if(is_null($request->marked_to))
            {    $comment->marked_to = Auth::id(); }
            else {$comment->marked_to = $request->marked_to; }

            $comment->created_by = Auth::id();            
            $comment->comment = $request->comment;
            
            $comment->save();
       
            // to close the letter process.
            $letter = Letter::find($request->letter_id);
            //if input is to close.
            if($request->comment == "closed") {
                $letter->status="closed";
            } elseif($request->comment == "opened") {  $letter->status="open";}
          
            $letter->save();

        return redirect(url()->previous())->with('success','comment provided');

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
