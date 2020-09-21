<!-- Stored in resources/views/pages/sendemail.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Send Email')

@section('sidebar')
@section('content')
<div class="wrapper">
  <div class="container">
    <div class="row">
      @include('layouts.sidenav')
        <div class="col text-center"> 
          <br>
          <form method="POST" action="/sentmail" enctype="multipart/form-data" accept-charset="UTF-8">
            @csrf
            <div class="form-group row"> 
              <label class="col-sm-2" for="emailid">Send To:</label>
                <div class="col-sm-6">
                  <input type="text" name="emailid" class="form-control" id="emailid" value="{{$email}}">
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-sm-2" for="subjectid">Subject:</label>
                <div class="col-sm-6">
                  <input type="text" name="subject" class="form-control" id="subjectid" value="{{$subject}}">
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="messageid"> Message:</label>              
                <div class="col-sm-6">
                <textarea id="messageid" name="message" class="form-control"></textarea>  
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="urlid">Attachment:</label>   
              <div class="col-sm-6 text-left">
                <input type="hidden" name="filename" value="{{$filename}}">
                <input type="hidden" class="form-control" id="urlid" name="attachment" value="{{$url}}">
                <a href="{{$url}}">Download</a>
              </div>

            </div>
 
            <div class="form-group row">
              <div class="col-sm-5">
                <button type="submit" class="btn btn-secondary">Send</button> 
              </div> 
            </div>
          </form>
      </div>
  </div>
</div>

<script type="text/javascript">
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>

<script type="text/javascript">
function getDepartment() {

var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dept").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/getData?t=departments", true);
        xmlhttp.send();
      }
</script>
@endsection
