<!-- Stored in resources/views/pages/noticedetail.blade.php -->



<?php $__env->startSection('title', 'Notice Detail'); ?>

<?php $__env->startSection('sidebar'); ?>

<?php $__env->startSection('content'); ?>
<div class="wrapper">
  <div class="container">
    <div class="row">
      <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="col"> 
      <div class="bg-secondary text-warning"><strong>Notice</strong></div>
<div class="accordion" id="detailNotice">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#noticeHead" aria-expanded="true" aria-controls="collapseOne">
          Details
        </button>

<div id="noticeHead" class="collapse" aria-labelledby="headingOne" data-parent="#detailNotice">
  <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="referenceno">Reference No.: </label>
                <div class="col-sm-4">                  
                  <input type="text" name="dispatch_reserved_no" id="referenceno" value="<?php echo e($notice->reference_no); ?>" disabled>
                </div>              
            </div>          
             
            <div class="form-group row"> 
              <label class="col-sm-2" for="inputSubject">Subject:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputSubject" value="<?php echo e($notice->subject); ?>" disabled>
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-sm-2" for="inputSubject">From:</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="inputfrom" name="notification_from" value="<?php echo e($notice->from); ?>" disabled>
                </div>
            </div>                
            <div class="form-group row">
              <label class="col-sm-2" for="notification_id">Summary:</label>
                <div class="col-sm-5">
                  <input type="textarea" class="form-control" id="notification_id" name="notification_summary" value="<?php echo e($notice->summary); ?>" disabled>
                  </div>
            </div>
</div></div> <!-- end of collapse -->
            <div class="form-group row"> 
                <div class="col-sm-12">
              <!--  <embed src="<?php echo e(asset('storage/'.$notice->file)); ?>" id="notify_file" width="640px" height="300px"> -->
		 <iframe src="<?php echo e(asset('storage/'.$notice->file)); ?>" style="width:100%; height:500px;" frameborder="0"></iframe>
                </div>
            </div>            
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nds/resources/views/pages/noticedetail.blade.php ENDPATH**/ ?>