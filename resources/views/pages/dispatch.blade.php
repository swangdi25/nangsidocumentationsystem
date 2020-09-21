<!-- Stored in resources/views/pages/dispatch.blade.php -->

@extends('layouts.mainlayout')

@section('title', 'Dispatch')

@section('sidebar')
@section('content')
<div class="wrapper">
  <div class="container">
    <div class="row">    
      @include('layouts.sidenav')
        
        <div class="col"> 
        <div><strong><span>Dispatch</span></strong>&nbsp;&nbsp;<a class="btn bg-warning" href="/outgoingletters">Dispatched List</a>
        <hr>
        </div>

          <form method="POST" action="{{ route('create.store') }}" enctype="multipart/form-data" accept-charset="UTF-8">
            @csrf
            <ul class="errorMessages"></ul>
            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="referenceno">Reference No.:</label>
                <div class="col-sm-4">
                  <select class="form-control" id="referenceno" name="reference_no" required>
                  @foreach($references as $ref)
                    <option value="{{$ref->reference}}">{{$ref->reference}}</option>
                  @endforeach
                  </select>    
                  <input type="hidden" name="dispatch_reserved_no" id="dispatch_reserved">
                </div>
                <div class="col-sm-2">         
                 <table><tr>                      
                  <td><input id="dispatchId" class="form-control" type="text" name="dispatchno" value="{{$dipatchno}}"></td>
                  <td><input id="useId" type="hidden" class="form-control btn btn-info" value="Use" onclick="reserve()"></td>
                  <input type="hidden" name="receive_or_dispatch" value="dispatch">
                  <td><button id="viewid" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#dnumbers" value="{{$agencyid}}">View</button></td>
                  </tr></table>
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="user"> To:</label>              
                <div class="col-sm-6">
                <select id="user" name="users[]" class="form-control" multiple></select>  
                </div>
            </div>
 
            <div class="form-group row">
              <label class="col-sm-2" for="cced">Cc:</label>
                <div class="col-sm-6">
                  <select name="cceds[]" class="form-control" id="cced"></select>
                </div>
            </div>        
            <div class="form-group row"> 
              <label class="col-sm-2" for="inputSubject">Subject:</label>
                <div class="col-sm-6">
                  <input type="text" name="subject" class="form-control" id="inputSubject" placeholder="Subject" required>
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-sm-2" for="inputAddress">Address:</label>
                <div class="col-sm-6">
                  <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Address">
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-sm-2" for="inputPlace">Place:</label>
                <div class="col-sm-6">
                  <input type="text" name="place" class="form-control" id="inputPlace" placeholder="place">
                </div>
            </div>
        
            <div class="form-group row"> 
              <label class="col-sm-2" for="attachfile">Attach Document:</label>
                <div class="col-sm-4">
                  <input type="file" name="attachment_doc" class="form-control" id="attachfile">
                </div>
            </div>
        
            <div class="form-group row">  
              <label class="col-sm-2" for="for="datepicker"">Action Date:</label>
                <div class="col-sm-3">
                  <input type="date" name="action_date" class="form-control">
                </div>
            </div>

            <div class="form-group row">  
              <div class="col-sm-5">
                  <input type="checkbox" name="important" aria-label="Checkbox for following text input" placeholder="Important">
                  <label for="inputSubject">Important</label>
              </div>
            </div>
           
            <div class="form-group row">
              <div class="col-sm-5">
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
                <button type="submit" class="btn btn-primary">Send</button> 
                <!-- <a class="btn btn-success" href="create-notification" role="button">Notification</a> -->
              </div> 
            </div>
          </form>
        
          <div>

          <!-- Modal -->
    <div id="dnumbers" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Latest Letter References</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
            <div class="modal-body">
              <div id="dispatchnos">
              
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
      </div>
    <!-- End Modal -->


      </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
    <script>
        $(document).ready(function () {
            $('#user').select2({
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
                placeholder: 'Enter user(s)',
//                minimumInputLength: 2,
                multiple: true
            });

            $('#cced').select2({
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
                                   // text: item.email.slice(0,item.email.indexOf('@'))
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
                placeholder: 'Enter user(s)',
//                minimumInputLength: 2,
                multiple: true
            });
        });

       

function reserve() {
  var dispatch_no = document.getElementById('dispatchId').value;

  var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('useId').disabled = true;
      document.getElementById('dispatch_reserved').value = dispatch_no;
      alert('Successful! '.concat(dispatch_no));
    }
    };
    xmlhttp.open("GET", "/getData?t=dispatch&d="+dispatch_no, true);
    xmlhttp.send();
  }


  var createAllErrors = function() {
        var form = $( this ),
            errorList = $( "ul.errorMessages", form );

        var showAllErrorMessages = function() {
            errorList.empty();

            // Find all invalid fields within the form.
            var invalidFields = form.find( ":invalid" ).each( function( index, node ) {

                // Find the field's corresponding label
                var label = $( "label[for=" + node.id + "] "),
                    // Opera incorrectly does not fill the validationMessage property.
                    message = node.validationMessage || 'Invalid value.';

                errorList
                    .show()
                    .append( "<li><span>" + label.html() + "</span> " + message + "</li>" );
            });
        };

        // Support Safari
        form.on( "submit", function( event ) {
            if ( this.checkValidity && !this.checkValidity() ) {
                $( this ).find( ":invalid" ).first().focus();
                event.preventDefault();
            }
        });

        $( "input[type=submit], button:not([type=button])", form )
            .on( "click", showAllErrorMessages);

        $( "input", form ).on( "keypress", function( event ) {
            var type = $( this ).attr( "type" );
            if ( /date|email|month|number|search|tel|text|time|url|week/.test ( type )
              && event.keyCode == 13 ) {
                showAllErrorMessages();
            }
        });
    };
    
$( "form" ).each( createAllErrors );

var uploadField = document.getElementById("attachfile");

uploadField.onchange = function() {
    if(this.files[0].size > 5000000){
       alert("File should not be more than 5MB size");
       this.value = "";
    };
};

    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

  $("#viewid").on('click',function(e){
           // console.log(e);
            var id = e.target.value;
            $.get('/get-dispatchnumber?agency_id='+id,function(data){              
                console.log(data);
                 $('#dispatchnos').empty(); 
                 $('#dispatchnos').append('<table class="table table-bordered">'); 
                 $('#dispatchnos').append('<thead><tr><th scope="col">Subject</th><th scope="col">Reference No.</th></tr></thead><tbody>'); 
                  $.each(data, function(index, dispatched){
                      $('#dispatchnos').append('<tr><td>'+dispatched.subject+'</td><td>'+dispatched.reference_no+'</td></tr>');                  
                  })
                  $('#dispatchnos').append('</tbody></table>');
            });
    });

});
</script>
@endsection
