<!-- Stored in resources/views/pages/received.blade.php -->

<?php $__env->startSection('title', 'Letter uploaded'); ?>
<?php $__env->startSection('sidebar'); ?>
<?php $__env->startSection('content'); ?>
<div class="wrapper">
<div class="container">
<div class="row">
  <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Uploaded List</strong></div>
    <table class= "table table-bordered table-sm" style="width:70%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Reference No.</th>          
            <th scope="col">Subject</th>
            <th scope="col">Address</th>
            <th scope="col">Place</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
    <tbody>
        <?php $__currentLoopData = $letters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $letter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td> <a href= "<?php echo e(route('create.show',$letter->id)); ?>"><?php echo e($letter->reference_no); ?></a></td>
                <td><?php echo e($letter->subject); ?></td>
                <td><?php echo e($letter->address); ?></td>
                <td><?php echo e($letter->place); ?></td>
                <td><?php echo e(date('d/m/Y',strtotime($letter->created_at))); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>      
    </div>
 </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nds/resources/views/pages/received.blade.php ENDPATH**/ ?>