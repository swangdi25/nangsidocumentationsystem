@extends('layouts.mainlayout')
@section('title', 'Register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>                               
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="cid" class="col-md-4 col-form-label text-md-right">{{ __('CID Number:') }}</label>

                            <div class="col-md-6">
                                <input id="cid" type="number" class="form-control @error('cid') is-invalid @enderror" name="cid" value="{{ old('cid') }}" required autocomplete="cid" autofocus onfocusout="validateInput('cid');">
                                <input type="hidden" id="scid">                             
                            </div>
                        </div>

                     <div class="form-group row">
                            <label for="eid" class="col-md-4 col-form-label text-md-right">{{ __('Employee ID:') }}</label>
                            <div class="col-md-6">
                                <input id="eid" type="number" class="form-control @error('eid') is-invalid @enderror" name="eid" value="{{ old('eid') }}" required autocomplete="eid" autofocus onfocusout="validateInput('eid');">                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ old('designation') }}" required autocomplete="designation" autofocus>                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Agency') }}</label>
                            <div class="col-md-6">
                                <select name="department" id="department" onchange="finddivisions(this.value)" required>
                                <option value="">Please select...</option>
                                 @foreach($agencies as $agency)
                                 <option value="{{$agency->id}}">{{$agency->name}}</option>
                                 @endforeach
                                </select>
                                <!-- <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autocomplete="department" autofocus>  -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="divisionid" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>

                            <div class="col-md-6">
                                <select name="division" id="divisionid">
                                    <option value="">Select Division</option>                             
                                </select>
                                <!-- <input id="division" type="text" class="form-control @error('division') is-invalid @enderror" name="division" value="{{ old('division') }}" required autocomplete="division" autofocus> -->

                            </div>  
                        </div>                        
                      
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mphone" class="col-md-4 col-form-label text-md-right">{{ __('Mobile number') }}</label>
                            <div class="col-md-6">
                                <input id="mphone" type="number" class="form-control @error('mphone') is-invalid @enderror" name="mphone" value="{{ old('mphone') }}" required autocomplete="mphone" >                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="officephone" class="col-md-4 col-form-label text-md-right">{{ __('Office contact') }}</label>
                            <div class="col-md-6">
                                <input id="officephone" type="number" class="form-control @error('officephone') is-invalid @enderror" name="officephone" value="{{ old('officephone') }}" autocomplete="officephone">                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required onfocusout="pwdMatching();">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required onfocusout="pwdMatching();">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function finddivisions(agencyid) {
  
  var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('divisionid').innerHTML = this.responseText;      
    }
    };
    xmlhttp.open("GET", "/getData?t=divisions&d="+agencyid, true);
    xmlhttp.send();
  }

  function validateInput(inputName) {
      if(inputName == "cid")
      {
          var cidno = document.getElementById('cid').value;
          if(cidno.length != 11)
          {
           document.getElementById('cid').style="border-color:red";
           alert("Please enter 11 digits CID number");           
          }  
          else {
            document.getElementById('cid').style="";
          }        
                      
      }
       if(inputName == "eid")
      {
        var eidno = document.getElementById('eid').value;

        if(eidno.length < 6 || eidno.length > 11)
          {
           document.getElementById('eid').style="border-color:red";
           alert("It should have 6-11 digits ");           
          }  
          else {
            document.getElementById('eid').style="";
          }       

      }
  }

function pwdMatching() {
    var pwd = document.getElementById('password').value;
    var pwdConfirm = document.getElementById('password-confirm').value;
  
    if(pwd.length > 0 && pwdConfirm.length > 0){

        if(pwd !== pwdConfirm) {

            document.getElementById('password').style="border-color:red;";
            document.getElementById('password-confirm').style="border-color:red;";
            alert("Passwords do not match.");

        }
        else {
            document.getElementById('password').style="";
            document.getElementById('password-confirm').style="";
        }
    }
}
  

</script>
@endsection
