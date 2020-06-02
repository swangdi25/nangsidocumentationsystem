
@extends('layouts.mainlayout')

@section('title', 'Profile')

@section('sidebar')

@section('content')

<div class="wrapper">
  <div class="container">
    <div class="row">
      @include('layouts.sidenav')
       
      <div class="col">

      <form method="POST" action="{{ route('profile.update',$profile->id) }}">
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
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autocomplete="department" autofocus> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="divisionid" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>

                            <div class="col-md-6">
                               
                                <input id="division" type="text" class="form-control @error('division') is-invalid @enderror" name="division" value="{{ old('division') }}" required autocomplete="division" autofocus>

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

                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
       
      </div>
    </div>
  </div>
</div>
@endsection
