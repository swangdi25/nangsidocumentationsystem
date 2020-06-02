<!-- Stored in resources/views/pages/notification.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Notification')

@section('sidebar')

@section('content')
<div class="wrapper">
<div class="container">
<div class="row">
  @include('layouts.sidenav')
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Notification</strong></div>
    <table class= "table table-bordered table-sm" style="width:70%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Reference No.</th>
            <th scope="col">Subject</th>
            <th scope="col">From</th>
            <th scope="col">Summary</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
    <tbody>
        @foreach($notifications as $notification)
            @if($read_status_array[$loop->index] == 0) 
                <tr style="font-weight:bold"  >
            @else
                <tr >
            @endif
                <td><a href= "{{ route('notify.show',$notification->id) }}">{{$notification->reference_no}}</a></td>
                <td>{{$notification->subject}}</td>
                <td>{{$notification->from}}</td>
                <td>{{$notification->summary}}</td>
                <td>{{$notification->created_at->format("d/m/Y")}}</td>              
            </tr>

        @endforeach
    </tbody>
    </table>
        {{ $notifications->links() }}
    </div>
 </div>
</div>
</div>

  
@endsection