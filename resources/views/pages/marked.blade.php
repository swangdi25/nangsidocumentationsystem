<!-- Stored in resources/views/pages/marked.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Marked')

@section('sidebar')

@section('content')
<div class="wrapper">
<div class="container">
<div class="row">
  @include('layouts.sidenav')
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Marked</strong></div>
    <table class= "table table-bordered table-sm" style="width:70%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Sl. No.</th>
            <th scope="col">To</th>
            <th scope="col">Comment</th>
            <th scope="col">Date</th>
            <th scope="col">Document</th>
            </tr>
        </thead>
    <tbody>
        @foreach($markeds as $m)
            <tr>
                <td>{{$loop->iteration}}</a></td>
                <td>{{$m->name}}({{$m->email}})</td>
                <td>{{$m->comment}}</td>
                <td>{{date('d/m/Y',strtotime($m->created_at))}}</td>
                <td><a href= "{{ route('create.show',$m->letter_id) }}">View letter</a></td>
            </tr>

        @endforeach
    </tbody>
    </table>
       
    </div>
 </div>
</div>
</div>

  
@endsection