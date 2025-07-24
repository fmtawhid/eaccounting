<?php $__env->startSection('styles'); ?>
    <!-- Include any additional CSS if needed -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Start page title -->
    <div class="row">
        <div class="offset-col-2 col-8 offset-col-2 text-center">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Add Expense Head</h4>
                <a href="<?php echo e(route('expense_heads.index')); ?>" class="btn btn-primary">Expense Heads List</a>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Create Expense Head Form -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('expense_heads.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="expense_head_name" class="form-label">Expense Head Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="expense_head_name" name="expense_head_name" value="<?php echo e(old('expense_head_name')); ?>" required>
                            <?php $__errorArgs = ['expense_head_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4"><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-2"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="btn btn-success">Create Expense Head</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- Include any additional JS if needed -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eaccounting\resources\views/admin/expense_heads/create.blade.php ENDPATH**/ ?>