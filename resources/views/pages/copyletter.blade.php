<!-- Stored in resources/views/pages/copyletter.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Copy letter(s)')

@section('sidebar')

@section('content')
<div class="wrapper">
<div class="container">
<div class="row">
  @include('layouts.sidenav')
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Copy of Letter(s)</strong></div>
    <table class= "table table-bordered table-sm" style="width:70%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Reference No.</th>
            <th scope="col">From</th>
            <th scope="col">Subject</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
    <tbody>
        @foreach($letters as $letter)
            <tr>
                <td> <a href= "{{ route('create.show',$letter->id) }}">{{$letter->reference_no}}</a></td>
                <td>{{$letter->email}}</td>
                <td>{{$letter->subject}}</td>
                <td>{{date('d/m/Y',strtotime($letter->created_at))}}</td>
            </tr>

        @endforeach
    </tbody>
    </table>
      
    </div>
 </div>
</div>
</div>

  
@endsection