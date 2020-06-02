<!-- Stored in resources/views/pages/outgoing.blade.php -->



<?php $__env->startSection('title', 'Dispatched letter(s)'); ?>

<?php $__env->startSection('sidebar'); ?>

<?php $__env->startSection('content'); ?>
<div class="wrapper">
<div class="container">
<div class="row">
  <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Dispatched List</strong></div>
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
                <td><?php echo e($letter->created_at->format('d/m/Y')); ?></td>
            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
        <?php echo e($letters->links()); ?>

    </div>
 </div>
</div>
</div>

  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nds/resources/views/pages/outgoing.blade.php ENDPATH**/ ?>