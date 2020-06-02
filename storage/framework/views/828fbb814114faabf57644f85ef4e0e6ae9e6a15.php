<!-- Stored in resources/views/pages/reference.blade.php -->



<?php $__env->startSection('title', 'Reference'); ?>

<?php $__env->startSection('sidebar'); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper">
  <div class="container">
    <div class="row">
      <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="col text-center"> 
          <br>
          <form method="POST" action="<?php echo e(route('reference.store')); ?>" enctype="multipart/form-data" accept-charset="UTF-8">
            <?php echo csrf_field(); ?>
            <div class="form-group row"> 
              <label class="col-sm-2" for="referenceno">Reference :</label>
                <div class="col-sm-6">
                  <input type="text" name="reference_no" class="form-control" id="referenceno" placeholder="Select reference no." onclick='getDepartment()'>
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="descp"> Description:</label>              
                <div class="col-sm-6">
                <textarea id="descp" name="ref_description" class="form-control" placeholder="Please provide description to help in future searching."></textarea>  
                </div>
            </div>

            <div class="form-group row"> 
              <label class="col-form-label col-sm-2" for="dept"> Agency:</label>              
                <div class="col-sm-6">
                  <select id="agency" name="agency_id" class="form-control">
                  <?php $__currentLoopData = $agencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($agency->id); ?>"><?php echo e($agency->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  
                  </select>
                </div>
            </div>
 
            <div class="form-group row">
              <div class="col-sm-5">
                <button type="submit" class="btn btn-secondary">Save</button> 
              </div> 
            </div>
          </form>
      </div>
  </div>
</div>

<script type="text/javascript">
function getDepartment() {

var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("dept").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/getData?t=departments", true);
        xmlhttp.send();
      }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nds/resources/views/pages/reference.blade.php ENDPATH**/ ?>