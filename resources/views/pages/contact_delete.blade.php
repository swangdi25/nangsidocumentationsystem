<!-- Stored in resources/views/pages/contact.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Contact list')

@section('sidebar')

@section('content')
<div class="wrapper">
<div class="container">
<div class="row">
  @include('layouts.sidenav')
  <div class="col text-center"> 
    <table class= "table table-bordered table-sm" style="width:70%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">email</th>
            <th scope="col">phone</th>
            <th scope="col"></th>
            <th></th>
            </tr>
        </thead>
    <tbody>
        @foreach($users as $u)
            <tr>
                <td>{{$u->email}}</a></td>
                <td>{{$u->name}}</td>
                <td>{{$u->name}}</td>              
            </tr>

        @endforeach
    </tbody>
    </table>
        {{ $markeds->links() }}
    </div>
 </div>
</div>
</div>

  
@endsection