

<?php $__env->startSection('content'); ?>
<div class="row mb-3 mt-3">
    <div class="col-md-6">
        <h4>Create New Account</h4>
    </div>
    <div class="col-md-6 text-end">
        <a href="<?php echo e(route('accounts.index')); ?>" class="btn btn-secondary">Back to List</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form id="createAccountForm" action="<?php echo e(route('accounts.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="name" class="form-label">Account Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" 
                       class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('name')); ?>" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="number" class="form-label">Account Number <span class="text-danger">*</span></label>
                <input type="text" name="number" id="number" 
                       class="form-control <?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('number')); ?>" required>
                <?php $__errorArgs = ['number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="brance_id" class="form-label">Branch <span class="text-danger">*</span></label>
                <select name="brance_id" id="brance_id" 
                        class="form-select <?php $__errorArgs = ['brance_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                    <option value="" selected disabled>Select Brance</option>
                    <?php $__currentLoopData = $brances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($brance->id); ?>" <?php echo e(old('brance_id') == $brance->id ? 'selected' : ''); ?>>
                            <?php echo e($brance->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['brance_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <!-- <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label> -->
                <input type="number" step="0.01" name="amount" id="amount" 
                       class="form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       value="<?php echo e(old('amount', 0)); ?>" required readonly hidden>
                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">Note (Optional)</label>
                <textarea name="note" id="note" class="form-control"><?php echo e(old('note')); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Account</button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(function() {
    $('#createAccountForm').on('submit', function(e) {
        e.preventDefault();
        let form = $(this);

        // Clear previous errors
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').remove();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                toastr.success(response.success || 'Account created successfully.');
                window.location.href = "<?php echo e(route('accounts.index')); ?>";
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    Object.keys(errors).forEach(function(key) {
                        let input = $('[name="'+key+'"]');
                        input.addClass('is-invalid');
                        if(input.next('.invalid-feedback').length === 0) {
                            input.after('<div class="invalid-feedback">'+errors[key][0]+'</div>');
                        } else {
                            input.next('.invalid-feedback').text(errors[key][0]);
                        }
                    });
                } else {
                    console.error(xhr.responseText);
                    toastr.error('Something went wrong!');
                }
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eaccounting\resources\views/admin/account/create.blade.php ENDPATH**/ ?>