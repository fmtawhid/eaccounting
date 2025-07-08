<?php $__env->startSection('styles'); ?>
    <!-- Include any additional CSS if needed -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Edit Purpose</h4>
                <a href="<?php echo e(route('purposes.index')); ?>" class="btn btn-primary">Purposes List</a>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Edit Expense Head Form -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('purposes.update', ['purpose' => $purpose->id])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label for="purpose_name" class="form-label">Purpose Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="purpose_name" name="purpose_name" value="<?php echo e(old('purpose_name', $purpose->purpose_name)); ?>" required>
                            <?php $__errorArgs = ['purpose_name'];
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
                            <textarea class="form-control" id="description" name="description" rows="4"><?php echo e(old('description', $purpose->description)); ?></textarea>
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

                        <button type="submit" class="btn btn-success">Update Purpose</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- Include any additional JS if needed -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eaccounting\resources\views/admin/purposes/edit.blade.php ENDPATH**/ ?>