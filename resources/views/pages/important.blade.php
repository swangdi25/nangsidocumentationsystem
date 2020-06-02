<!-- Stored in resources/views/pages/important.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Important')

@section('sidebar')

@section('content')
<div class="wrapper">
<div class="container">
<div class="row">
  @include('layouts.sidenav')
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Important</strong></div>
    <table class= "table table-bordered table-sm" style="width:90%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Reference No.</th>
            <th scope="col">Subject</th>
            <th scope="col">From</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
    <tbody>
        @foreach($letters as $letter)
            @if($read_status_array[$loop->index] == 0) 
                <tr style="font-weight:bold"  >
            @else
                <tr >
            @endif
                <td> <a href= "{{ route('create.show',$letter->id) }}">{{$letter->reference_no}}</a></td>
                <td>{{$letter->subject}}</td>
                <td>{{$letter->email}}</td>                
                <td>{{$letter->created_at->format("d/m/Y")}}</td>
            </tr>

        @endforeach
    </tbody>
    </table>
        {{ $letters->links() }}
    </div>
 </div>
</div>
</div>

  
@endsection