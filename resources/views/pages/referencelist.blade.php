<!-- Stored in resources/views/pages/referencelist.blade.php -->
@extends('layouts.mainlayout')
@section('title', 'References')
@section('sidebar')
@section('content')
<div class="wrapper">
<div class="container">
<div class="row">
  @include('layouts.sidenav')
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Reference List</strong></div>
    <table class= "table table-bordered table-sm" style="width:70%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Reference No.</th>
            <th scope="col">Description</th>
            </tr>
        </thead>
    <tbody>
        @foreach($refList as $letter)
            <tr>
                <td>{{$letter->reference}}</td>
                <td>{{$letter->description}}</td>
            </tr>
        @endforeach
    </tbody>
    </table>      
    </div>
 </div>
</div>
</div>
@endsection