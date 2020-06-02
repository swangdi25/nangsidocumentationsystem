<!-- Stored in resources/views/pages/markedToMe.blade.php -->



<?php $__env->startSection('title', 'Marked'); ?>

<?php $__env->startSection('sidebar'); ?>

<?php $__env->startSection('content'); ?>
<div class="wrapper">
<div class="container">
<div class="row">
  <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="col"> 
  <div class="bg-secondary text-warning"><strong>Marked To Me</strong></div>
    <table class= "table table-bordered table-sm" style="width:70%">
    <thead class="thead-primary">
            <tr>
            <th scope="col">Sl. No.</th>
            <th scope="col">From</th>
            <th scope="col">Comment</th>
            <th scope="col">Date</th>
            <th scope="col">Document</th>
            </tr>
        </thead>
    <tbody>
        <?php $__currentLoopData = $markeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></a></td>
                <td><?php echo e($m->markedby); ?>(<?php echo e($m->email); ?>)</td>
                <td><?php echo e($m->comment); ?></td>
                <td><?php echo e($m->created_at->format('d/m/Y')); ?></td>
                <td><a href= "<?php echo e(route('create.show',$m->letter_id)); ?>">View letter</a></td>
            </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
        <?php echo e($markeds->links()); ?>

    </div>
 </div>
</div>
</div>

  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nds/resources/views/pages/markedToMe.blade.php ENDPATH**/ ?>