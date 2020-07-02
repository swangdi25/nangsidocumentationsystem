<!-- Stored in resources/views/pages/contactlist.blade.php -->



<?php $__env->startSection('title', 'Contact List'); ?>

<?php $__env->startSection('sidebar'); ?>

<?php $__env->startSection('content'); ?>
<div class="wrapper">
<div class="container">
<div class="row">
  <?php echo $__env->make('layouts.sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
        <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>               
             <tr>       
                <td><?php echo e($contact->name); ?></a></td>
                <td><?php echo e($contact->designation); ?>,<br> <?php echo e($contact->division); ?>, <?php echo e($contact->agency); ?> </td>
                <td><?php echo e($contact->email); ?></td>      
                <td><?php echo e($contact->phone); ?></td>           
                <td><?php echo e($contact->officephone); ?></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
        <?php echo e($contacts->links()); ?>

    </div>
 </div>
</div>
</div>

  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/nds/resources/views/pages/contactlist.blade.php ENDPATH**/ ?>