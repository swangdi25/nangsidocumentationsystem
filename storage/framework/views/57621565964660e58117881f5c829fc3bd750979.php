<?php $__env->startSection('title', 'Register'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Register')); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus>                               
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="cid" class="col-md-4 col-form-label text-md-right"><?php echo e(__('CID Number:')); ?></label>

                            <div class="col-md-6">
                                <input id="cid" type="number" class="form-control <?php $__errorArgs = ['cid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="cid" value="<?php echo e(old('cid')); ?>" required autocomplete="cid" autofocus onfocusout="validateInput('cid');">
                                <input type="hidden" id="scid">                             
                            </div>
                        </div>

                     <div class="form-group row">
                            <label for="eid" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Employee ID:')); ?></label>
                            <div class="col-md-6">
                                <input id="eid" type="number" class="form-control <?php $__errorArgs = ['eid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="eid" value="<?php echo e(old('eid')); ?>" required autocomplete="eid" autofocus onfocusout="validateInput('eid');">                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Designation')); ?></label>

                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="designation" value="<?php echo e(old('designation')); ?>" required autocomplete="designation" autofocus>                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Agency')); ?></label>
                            <div class="col-md-6">
                                <select name="department" id="department" onchange="finddivisions(this.value)" required>
                                <option value="">Please select...</option>
                                 <?php $__currentLoopData = $agencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($agency->id); ?>"><?php echo e($agency->name); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <!-- <input id="department" type="text" class="form-control <?php $__errorArgs = ['department'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="department" value="<?php echo e(old('department')); ?>" required autocomplete="department" autofocus>  -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="divisionid" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Division')); ?></label>

                            <div class="col-md-6">
                                <select name="division" id="divisionid">
                                    <option value="">Select Division</option>                             
                                </select>
                                <!-- <input id="division" type="text" class="form-control <?php $__errorArgs = ['division'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="division" value="<?php echo e(old('division')); ?>" required autocomplete="division" autofocus> -->

                            </div>  
                        </div>                        
                      
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mphone" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Mobile number')); ?></label>
                            <div class="col-md-6">
                                <input id="mphone" type="number" class="form-control <?php $__errorArgs = ['mphone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="mphone" value="<?php echo e(old('mphone')); ?>" required autocomplete="mphone" >                             
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="officephone" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Office contact')); ?></label>
                            <div class="col-md-6">
                                <input id="officephone" type="number" class="form-control <?php $__errorArgs = ['officephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="officephone" value="<?php echo e(old('officephone')); ?>" autocomplete="officephone">                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required onfocusout="pwdMatching();">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm Password')); ?></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required onfocusout="pwdMatching();">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Register')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function finddivisions(agencyid) {
  
  var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('divisionid').innerHTML = this.responseText;      
    }
    };
    xmlhttp.open("GET", "/getData?t=divisions&d="+agencyid, true);
    xmlhttp.send();
  }

  function validateInput(inputName) {
      if(inputName == "cid")
      {
          var cidno = document.getElementById('cid').value;
          if(cidno.length != 11)
          {
           document.getElementById('cid').style="border-color:red";
           alert("Please enter 11 digits CID number");           
          }  
          else {
            document.getElementById('cid').style="";
          }        
                      
      }
       if(inputName == "eid")
      {
        var eidno = document.getElementById('eid').value;

        if(eidno.length < 8 || eidno.length > 11)
          {
           document.getElementById('eid').style="border-color:red";
           alert("It should have 9-11 digits ");           
          }  
          else {
            document.getElementById('eid').style="";
          }       

      }
  }

function pwdMatching() {
    var pwd = document.getElementById('password').value;
    var pwdConfirm = document.getElementById('password-confirm').value;
  
    if(pwd.length > 0 && pwdConfirm.length > 0){

        if(pwd !== pwdConfirm) {

            document.getElementById('password').style="border-color:red;";
            document.getElementById('password-confirm').style="border-color:red;";
            alert("Passwords do not match.");

        }
        else {
            document.getElementById('password').style="";
            document.getElementById('password-confirm').style="";
        }
    }
}
  

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/html/NDS/resources/views/auth/register.blade.php ENDPATH**/ ?>