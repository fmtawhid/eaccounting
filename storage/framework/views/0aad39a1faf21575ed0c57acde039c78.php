<?php $__env->startSection('styles'); ?>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Purposes</h4>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purpose_add')): ?>
                <a href="<?php echo e(route('purposes.create')); ?>" class="btn btn-primary">Add Purpose</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Expense Heads Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success mb-3">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <table id="expenseHeadsTable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Purpose Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                    </table>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <!-- Initialize DataTables -->
    
    <script>
        $(document).ready(function() {

            // Initialize DataTable
            $("#expenseHeadsTable").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "<?php echo e(route('purposes.index')); ?>",
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'purpose_name',
                        name: 'purpose_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: "actions",
                        name: "actions",
                        orderable: false,
                        searchable: false
                    },
                ],
                initComplete: function(settings, json) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });

                    // Handle Delete Button Clicks
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
                                    that.closest("form").submit();
                                },
                                cancel: function() {
                                    // Do nothing
                                },
                            },
                        });
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Ajax error: ", textStatus, errorThrown);
                },
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eaccounting\resources\views/admin/purposes/index.blade.php ENDPATH**/ ?>