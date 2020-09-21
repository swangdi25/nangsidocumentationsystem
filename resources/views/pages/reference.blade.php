<!-- Stored in resources/views/pages/reference.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Reference')

@section('sidebar')
@section('content')
<div class="wrapper">
  <div class="container">
    <div class="row">
      @include('layouts.sidenav')
        <div class="col text-center"> 
          <br>
          <form method="POST" action="{{ route('reference.store') }}" enctype="multipart/form-data" accept-charset="UTF-8">
            @csrf
            <div class="form-group row"> 
              <label class="col-sm-2" for="referenceno">Reference :</label>
                <div class="col-sm-6">
                  <input type="text" name="reference_no" class="form-control" id="referenceno" placeholder="Select reference no." onclick='getDepartment()'>
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="descp"> Description:</label>              
                <div class="col-sm-6">
                <textarea id="descp" name="ref_description" class="form-control" placeholder="Please provide description to help in future searching."></textarea>  
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="dept"> Agency:</label>              
                <div class="col-sm-6">
                  <select id="agency" name="agency_id" class="form-control">
                  @foreach($agencies as $agency)
                  <option value="{{$agency->id}}">{{$agency->name}}</option>
                  @endforeach
                  
                  </select>
                </div>
            </div>
 
            <div class="form-group row">
              <div class="col-sm-5">
                <button type="submit" class="btn btn-secondary">Save</button> 
              </div> 
            </div>
          </form>   
          <div class="row">
            &nbsp;&nbsp;<a href="{{ route('reference.list') }}">Reference List</a>
           </div>     
      </div>
  </div>
</div>

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
