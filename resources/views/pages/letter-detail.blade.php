<!-- Stored in resources/views/pages/index.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Letter Details')

@section('sidebar')

@section('content')
<div class="wrapper">
  <div class="container">
    <div class="row">
      @include('layouts.sidenav')
      <div class="col"> 
        <div><strong><span>Letter Details</span></strong><hr></div>
	<div class="accordion" id="detailHead">
	<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#letterHead" aria-expanded="true" aria-controls="collapseOne">
          Details
        </button>
<div id="letterHead" class="collapse" aria-labelledby="headingOne" data-parent="#detailHead">	
            <div class="form-group row">
              <label class="col-sm-2" for="inputDispatchNo">Dispatch No:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputDispatchNo" readonly value="{{$letter[0]->reference_no}}">
                </div>
                <label class="col-sm-2" for="inputFrom">From:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputFrom" value="{{$senderemail[0]->email}}" readonly>
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-sm-2" for="sento">To:</label>
                <div class="col-sm-4">
                  <input type="email" class="form-control" id="sento" value="{{$recievers}}" readonly>
                </div>
                <label class="col-sm-2" for="cc">Cc:</label>
                <div class="col-sm-4">
                  <input type="email" class="form-control" id="cc" value="{{$ccedlist}}" readonly>
                </div>
            </div>

            <div class="form-group row"> 
                <label class="col-sm-2" for="inputaddress">Address:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputaddress" value="{{$letter[0]->address}}" readonly>
                </div>
                <label class="col-sm-2" for="inputplace">Place:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputplace" value="{{$letter[0]->place}}" readonly>
                </div>
              </div>

              <div class="form-group row"> 
                <label class="col-sm-2" for="inputSubject">Subject:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSubject" value="{{$letter[0]->subject}}" readonly>
                </div>
              </div>

	</div></div> <!-- collapse end -->

            @if(!empty($letter[0]->file_attachment_link))
              <div class="form-group row"> 
                <div class="col-sm-12"> 
                <!--  <embed src="{{ asset('storage/'.$letter[0]->file_attachment_link) }}" id="img"> -->
		<iframe src="{{ asset('storage/'.$letter[0]->file_attachment_link) }}" style="width:100%; height:500px;" frameborder="0"></iframe>
                </div>
              </div>
            @endif
            <div class="form-group row">
            @if($comments->count() > 0)
            <label class="col-sm-2" for="comments">Comments:</label>
            @endif
              <div class="col-sm-10">
              @foreach($comments as $comment)
                <div class="card text-left">
                  <div class="card-body">
                  <div class="card-title">
                  @if($comment->marked_to !== $comment->markedbyId)
                  <h5>Marked to: {{$comment->markedto}}({{$comment->email}})</h5>
                  @endif
                  </div>
                    <p class="card-text">Comment: {{$comment->comment}}</p>
                    <a href="#" class="btn btn-secondary">
                    By: {{$comment->markedby}} {{$comment->created_at->format('d/m/Y h:m:s')}}
                  </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>  
    <form method="POST" action="{{ route('marked.store') }}" accept-charset="UTF-8" >
          @csrf
          <input type="hidden" id="letterid" name="letter_id" value="{{$letter[0]->id}}">

            <div class="form-group row">
              <label class="col-sm-2" for="markTo">Mark to:</label>
                <div class="col-sm-6">
                  <select class="form-control" id="markTo" name="marked_to" multiple></select>
                </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2" for="inputComment">Comment:</label>
                <div class="col-sm-6">
                  <input type="text" name="comment" class="form-control" id="inputComment" placeholder="Comment">
                </div>
            </div>

            <div class="form-group row">  
            <label class="col-sm-2" for="markid"></label>
                <div class="col-sm-6">
                <input type="hidden" id="statusid" name="status" value="{{$letter[0]->status}}">
                <button id="markid" type="submit" class="btn btn-primary">Mark</button> &nbsp;&nbsp; <input id="closeid" type="submit" class="btn btn-primary" onclick="closecomment();" value="Close"/>
                </div>             
            </div>  
        </form>            
    </div>  
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
   
    <script>
        $(document).ready(function () {
            $('#markTo').select2({
                ajax: {
                    url: '/select2-load-more', //'{{'select2-load-more'}}',
                    data: function (params) {
                        return {
                            search: params.term,
                            page: params.page || 1
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        data.page = data.page || 1;
                        return {
                            results: data.items.map(function (item) {
                                return {
                                    id: item.id,
                                  //  text: item.email.slice(0,item.email.indexOf('@'))
					text: item.email
                                };
                            }),
                            pagination: {
                                more: data.pagination
                            }
                        }
                    },
                    cache: true,
                    delay: 250
                },
                placeholder: 'Select user(s)',
//                minimumInputLength: 2,
                multiple: true
            });
        });

     
 window.onload = pagesetup;

  //page set up.

function pagesetup() {
  
    if(document.getElementById('statusid').value == "closed") {
      document.getElementById("markid").disabled = true;
      document.getElementById("closeid").value = "open";
    } else {  
      document.getElementById("markid").disabled = false;
     
            }
  }


function closecomment() {
  if( document.getElementById('closeid').value == "open")
  { document.getElementById('inputComment').value = "opened"; }
  else { document.getElementById('inputComment').value = "closed";}
  
}

    </script>


@endsection
