

<?php $__env->startSection('content'); ?>
<div class="row mb-3 mt-3">
    <div class="col-md-6">
        <h4>Accounts List</h4>
    </div>
    <div class="col-md-6 text-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account_add')): ?>
            <a href="<?php echo e(route('accounts.create')); ?>" class="btn btn-success">+ Add Account</a>
        <?php endif; ?>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <table id="accountTable" class="table dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Brance</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>

<script>
$(function() {
    var table = $('#accountTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(route('accounts.index')); ?>",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'number', name: 'number' },
            { data: 'brance_name', name: 'brance.name' },
            { data: 'amount', name: 'amount' },
            { data: 'note', name: 'note' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        order: [[0, 'desc']],
        responsive: true,
    });

    // Ajax Delete
   // Delete with confirm modal and toastr
    $(document).on("click", ".delete", function(e) {
        e.preventDefault();
        let that = $(this);
        $.confirm({
            icon: "fas fa-exclamation-triangle",
            closeIcon: true,
            title: "Are you sure?",
            content: "You cannot undo this action!",
            type: "red",
            typeAnimated: true,
            buttons: {
                confirm: function() {
                    let form = that.closest("form");
                    const url = form.attr('action');
                    const token = $('input[name="_token"]', form).val();
                    const method = $('input[name="_method"]', form).val();

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: token,
                            _method: method
                        },
                        success: function(response) {
                            if(response.success) {
                                toastr.success(response.message);
                                table.ajax.reload();
                            } else {
                                toastr.error(response.message || 'Delete failed');
                            }
                        },
                        error: function() {
                            toastr.error('Something went wrong while deleting.');
                        }
                    });
                },
                cancel: function() {
                    // nothing
                }
            }
        });
    });

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eaccounting\resources\views/admin/account/index.blade.php ENDPATH**/ ?>