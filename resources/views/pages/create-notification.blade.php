<!-- Stored in resources/views/pages/create-notification.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Notify')

@section('sidebar')

@section('content')
<div class="wrapper">
  <div class="container">
    <div class="row">
      @include('layouts.sidenav')
      <div class="col"> 
      <div class="bg-secondary text-warning"><strong>Notify</strong></div>
          <form method="POST" action="{{ route('notify.store') }}" enctype="multipart/form-data" accept-charset="UTF-8">
            @csrf
            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="referenceno">Reference No.:</label>
                <div class="col-sm-4">
                  <select class="form-control" id="referenceno" name="reference_no" required>
                  @foreach($references as $ref)
                    <option value="{{$ref->reference}}">{{$ref->reference}}</option>
                  @endforeach
                  </select>    
                  <input type="hidden" name="dispatch_reserved_no" id="dispatch_reserved">
                </div>
                <div class="col-sm-2">         
                 <table><tr>                      
                  <td><input id="dispatchId" class="form-control" type="text" name="dispatchno" value="{{$dispatchno}}" disabled></td>
                  <td><input id="useId" type="button" class="form-control btn btn-info" value="Use" onclick="reserve()"></td>
                  </tr></table>
                </div>
            </div>          
             
            <div class="form-group row"> 
              <label class="col-sm-2" for="inputSubject">Subject:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputSubject" name="notification_subject" placeholder="Subject" required>
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-sm-2" for="inputSubject">From:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputfrom" name="notification_from" placeholder="Name of agency">
                </div>
            </div>
        
        
            <div class="form-group row">
              <label class="col-sm-2" for="notification_id">Summary:</label>
                <div class="col-sm-5">
                  <input type="textarea" class="form-control" id="notification_id" name="notification_summary" placeholder="Short description about Notification.">
                </div>
            </div>
            <div class="form-group row"> 
              <label class="col-sm-2" for="notify_file">Attachment:</label>
                <div class="col-sm-4">
                  <input type="file" class="form-control-file" id="notify_file" name="notification_file">
                </div>
            </div>

            <div class="form-group row">  
              <div class="col-sm-3">
                <button type="submit" class="btn btn-primary">Notify</button>
              </div>
            </div>

          </form>
      </div>
    </div>
  </div>
</div>

<script>
function reserve() {
  var dispatch_no = document.getElementById('dispatchId').value;

  var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('useId').disabled = true;
      document.getElementById('dispatch_reserved').value = dispatch_no;
      alert('Successful! '.concat(dispatch_no));
    }
    };
    xmlhttp.open("GET", "/nds/public/getData?t=dispatch&d="+dispatch_no, true);
    xmlhttp.send();
  }

var uploadField = document.getElementById("notify_file");

uploadField.onchange = function() {
    if(this.files[0].size > 5000000){
       alert("File should not be more than 5MB size");
       this.value = "";
    };
};

</script>
@endsection
