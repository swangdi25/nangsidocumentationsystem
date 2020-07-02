<!-- Stored in resources/views/pages/contactlist.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Contact List')

@section('sidebar')

@section('content')
<div class="wrapper">
<div class="container">
<div class="row">
  @include('layouts.sidenav')
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Contact List</strong></div>
    <table class= "table table-bordered table-sm" style="width:90%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Designation</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Office Contact</th>
            </tr>
        </thead>
    <tbody>
        @foreach($contacts as $contact)               
             <tr>       
                <td>{{$contact->name}}</a></td>
                <td>{{$contact->designation}},<br> {{$contact->division}}, {{$contact->agency}} </td>
                <td>{{$contact->email}}</td>      
                <td>{{$contact->phone}}</td>           
                <td>{{$contact->officephone}}</td>
            </tr>
        @endforeach
    </tbody>
    </table>
        {{ $contacts->links() }}
    </div>
 </div>
</div>
</div>

  
@endsection