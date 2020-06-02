<!-- Stored in resources/views/pages/index.blade.php -->



<?php $__env->startSection('title', 'Letter Details'); ?>

<?php $__env->startSection('sidebar'); ?>

<?php $__env->startSection('content'); ?>
<div class="wrapper">
  <div class="container">
    <div class="row">
      <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="col"> 
        <div><strong><span>Letter Details</span></strong><hr></div>

            <div class="form-group row">
              <label class="col-sm-2" for="inputDispatchNo">Dispatch No:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputDispatchNo" readonly value="<?php echo e($letter[0]->reference_no); ?>">
                </div>
                <label class="col-sm-2" for="inputFrom">From:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputFrom" value="<?php echo e($senderemail[0]->email); ?>" readonly>
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-sm-2" for="sento">To:</label>
                <div class="col-sm-4">
                  <input type="email" class="form-control" id="sento" value="<?php echo e($recievers); ?>" readonly>
                </div>
                <label class="col-sm-2" for="cc">Cc:</label>
                <div class="col-sm-4">
                  <input type="email" class="form-control" id="cc" value="<?php echo e($ccedlist); ?>" readonly>
                </div>
            </div>

            <div class="form-group row"> 
                <label class="col-sm-2" for="inputaddress">Address:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputaddress" value="<?php echo e($letter[0]->address); ?>" readonly>
                </div>
                <label class="col-sm-2" for="inputplace">Place:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="inputplace" value="<?php echo e($letter[0]->place); ?>" readonly>
                </div>
              </div>

              <div class="form-group row"> 
                <label class="col-sm-2" for="inputSubject">Subject:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSubject" value="<?php echo e($letter[0]->subject); ?>" readonly>
                </div>
              </div>
            <?php if(!empty($letter[0]->file_attachment_link)): ?>
              <div class="form-group row"> 
                <div class="col-sm-12"> 
                  <embed src="<?php echo e(asset($letter[0]->file_attachment_link)); ?>" id="img" width="640px" height="300px">
                </div>
              </div>
            <?php endif; ?>
            <div class="form-group row">
            <?php if($comments->count() > 0): ?>
            <label class="col-sm-2" for="comments">Comments:</label>
            <?php endif; ?>
              <div class="col-sm-10">
              <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card text-left">
                  <div class="card-body">
                  <div class="card-title">
                  <?php if($comment->marked_to !== $comment->markedbyId): ?>
                  <h5>Marked to: <?php echo e($comment->markedto); ?>(<?php echo e($comment->email); ?>)</h5>
                  <?php endif; ?>
                  </div>
                    <p class="card-text">Comment: <?php echo e($comment->comment); ?></p>
                    <a href="#" class="btn btn-secondary">
                    By: <?php echo e($comment->markedby); ?> <?php echo e($comment->created_at->format('d/m/Y h:m:s')); ?>

                  </a>
                  </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>  
    <form method="POST" action="<?php echo e(route('marked.store')); ?>" accept-charset="UTF-8" >
          <?php echo csrf_field(); ?>
          <input type="hidden" id="letterid" name="letter_id" value="<?php echo e($letter[0]->id); ?>">

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
                <input type="hidden" id="statusid" name="status" value="<?php echo e($letter[0]->status); ?>">
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
                    url: '/select2-load-more', //'<?php echo e('select2-load-more'); ?>',
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
                                    text: item.email.slice(0,item.email.indexOf('@'))
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
      document.getElementById("closeid").value = "Open";
    } else {  
      document.getElementById("markid").disabled = false;
     
            }
  }


function closecomment() {
  if( document.getElementById('closeid').value == "Open")
  { document.getElementById('inputComment').value = "Opened"; }
  else { document.getElementById('inputComment').value = "Closed";}
  
}

    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/html/NDS/resources/views/pages/letter-detail.blade.php ENDPATH**/ ?>