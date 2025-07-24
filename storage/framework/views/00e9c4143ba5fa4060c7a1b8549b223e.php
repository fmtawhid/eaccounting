<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Edit Role</h4>
                    <form action="<?php echo e(route('roles.update', $role->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(old('name', $role->name)); ?>" placeholder="Enter Role Name">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assign Permissions</label>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Permission Name</th>
                                        <th scope="col">Add</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $permission_groups = [];
                                    ?>

                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            // Extract the base name before the suffix (_add, _view, _edit, _delete)
                                            $base_name = preg_replace('/_(add|view|edit|delete)$/', '', $permission->name);

                                            // Group permissions by base name
                                            if (!isset($permission_groups[$base_name])) {
                                                $permission_groups[$base_name] = [];
                                            }
                                            $permission_groups[$base_name][] = $permission;
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php $__currentLoopData = $permission_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $base_name => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($base_name); ?></td>

                                            <!-- Add permissions -->
                                            <td>
                                                <?php $has_add = false; ?>
                                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(str_ends_with($permission->name, '_add')): ?>
                                                        <input type="checkbox" name="permissions[]" value="<?php echo e($permission->id); ?>"
                                                        <?php echo e($role->permissions->contains($permission->id) ? 'checked' : ''); ?>>
                                                        <?php $has_add = true; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!$has_add): ?> <span>X</span> <?php endif; ?>
                                            </td>

                                            <!-- View permissions -->
                                            <td>
                                                <?php $has_view = false; ?>
                                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(str_ends_with($permission->name, '_view')): ?>
                                                        <input type="checkbox" name="permissions[]" value="<?php echo e($permission->id); ?>"
                                                        <?php echo e($role->permissions->contains($permission->id) ? 'checked' : ''); ?>>
                                                        <?php $has_view = true; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!$has_view): ?> <span>X</span> <?php endif; ?>
                                            </td>

                                            <!-- Edit permissions -->
                                            <td>
                                                <?php $has_edit = false; ?>
                                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(str_ends_with($permission->name, '_edit')): ?>
                                                        <input type="checkbox" name="permissions[]" value="<?php echo e($permission->id); ?>"
                                                        <?php echo e($role->permissions->contains($permission->id) ? 'checked' : ''); ?>>
                                                        <?php $has_edit = true; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!$has_edit): ?> <span>X</span> <?php endif; ?>
                                            </td>

                                            <!-- Delete permissions -->
                                            <td>
                                                <?php $has_delete = false; ?>
                                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(str_ends_with($permission->name, '_delete')): ?>
                                                        <input type="checkbox" name="permissions[]" value="<?php echo e($permission->id); ?>"
                                                        <?php echo e($role->permissions->contains($permission->id) ? 'checked' : ''); ?>>
                                                        <?php $has_delete = true; ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!$has_delete): ?> <span>X</span> <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php $__errorArgs = ['permissions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-danger"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eaccounting\resources\views/auth/roles/edit.blade.php ENDPATH**/ ?>