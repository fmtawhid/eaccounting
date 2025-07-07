<?php $__env->startSection('styles'); ?>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Expense Report</h4>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="text" id="from_date" class="form-control" placeholder="dd-mm-yy">
                </div>

                <div class="col-md-2">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="text" id="to_date" class="form-control" placeholder="dd-mm-yy">
                </div>

                <div class="col-md-2">
                    <label for="expense_head_id" class="form-label">Expense Head</label>
                    <select class="form-select select2" id="expense_head_id" name="expense_head_id" required>
                        <option selected disabled value="">Select Expense Head</option>
                        <?php $__currentLoopData = $expenseHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eh): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($eh->id); ?>" <?php echo e($eh->id == old('expense_head_id') ? 'selected' : ''); ?>>
                                <?php echo e($eh->expense_head_name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="brance_id" class="form-label">Brance</label>
                    <select class="form-select select2" id="brance_id" name="brance_id" required>
                        <option selected disabled value="">Select Brance</option>
                        <?php $__currentLoopData = $brances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brance->id); ?>" <?php echo e($brance->id == old('brance_id') ? 'selected' : ''); ?>>
                                <?php echo e($brance->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="account_id" class="form-label">Accounts</label>
                    <select class="form-select select2" id="account_id" name="account_id" required>
                        <option selected disabled value="">Select Account</option>
                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($account->id); ?>" <?php echo e($account->id == old('account_id') ? 'selected' : ''); ?>>
                                <?php echo e($account->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-md-2 d-flex flex-wrap gap-2">
                    <button id="filter" class="btn btn-success w-100">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <button id="reset" class="btn btn-secondary w-100">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </button>
                </div>

                <div class="col-md-12 d-flex flex-wrap gap-2 mt-3">
                    <a href="#" id="export_excel" class="btn btn-outline-success">
                        <i class="fas fa-file-excel me-1"></i> Export Excel
                    </a>
                    <a href="#" id="export_pdf" class="btn btn-outline-danger">
                        <i class="fas fa-file-pdf me-1"></i> Export PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("export_excel").classList.add("disabled");
            document.getElementById("export_pdf").classList.add("disabled");

            document.getElementById("filter").addEventListener("click", function() {
                document.getElementById("export_excel").classList.remove("disabled");
                document.getElementById("export_pdf").classList.remove("disabled");
            });

            document.getElementById("reset").addEventListener("click", function() {
                document.getElementById("export_excel").classList.add("disabled");
                document.getElementById("export_pdf").classList.add("disabled");
            });
        });
    </script>
    <!-- End Date Filters -->

    <!-- Create Expense Form -->
    <div class="row mt-3">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h4>Total Expenses: <span id="totalAmount"><?php echo e(number_format($totalAmount ?? 0, 2)); ?> TK</span></h4>
                        </div>
                    </div>


                    <!-- Expenses DataTable -->
                    <table id="expensesTable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Expense Head</th>
                                <th>Brance </th>
                                <th>Accounts</th>
                                <th>Name</th>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Note</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated via DataTables AJAX -->
                        </tbody>
                    </table>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->



    <!-- Attachments Modal -->
    <div class="modal fade" id="attachmentsModalGal" tabindex="-1" aria-labelledby="attachmentsModalGalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="attachmentsGallery" class="row">
                        <!-- Attachments will be loaded here dynamically -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $("#to_date").flatpickr({
            dateFormat: "d-m-Y"
        })

        $("#from_date").flatpickr({
            dateFormat: "d-m-Y"
        })
    </script>
    <script>
        $(document).ready(function() {
            // Define the route template with a placeholder for student ID
            var attachmentsRouteTemplate = "<?php echo e(route('expenses.attachments', ':id')); ?>";

            // Initialize DataTable
            var table = $("#expensesTable").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "<?php echo e(route('expense.report')); ?>",
                    data: function(d) {
                        d.from_date = $('#from_date').val();
                        d.to_date = $('#to_date').val();
                        d.expense_head_id = $('#expense_head_id').val();
                        d.brance_id = $('#brance_id').val();
                        d.account_id = $('#account_id').val();
                        // Add any other filters you want to apply
                    }
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1], // -1 will be used for "All items"
                    [10, 25, 50, 100, "All items"] // The text for "All items"
                ],
                pageLength: 10, // Default value
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'expense_head',
                        name: 'expense_head'
                    },
                    {
                        data: 'brance_name',
                        name: 'brance.name'
                    },
                    {
                        data: 'account_name',
                        name: 'account.name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'note',
                        name: 'note'
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

                    // Handle View Attachments Button Click
                    $(document).on('click', '.view-attachments', function() {
                        let studentId = $(this).data('id');

                        // Generate the actual route by replacing the placeholder with the student ID
                        let attachmentsRoute = attachmentsRouteTemplate.replace(':id',
                            studentId);

                        // Clear previous attachments
                        $('#attachmentsGallery').empty();

                        // Fetch attachments via AJAX
                        $.ajax({
                            url: attachmentsRoute,
                            type: 'GET',
                            success: function(response) {
                                if (response.attachments.length > 0) {
                                    response.attachments.forEach(function(
                                        attachment) {
                                        if (['jpg', 'jpeg', 'png', 'gif',
                                                'svg'
                                            ].includes(attachment.file_type
                                                .toLowerCase())) {
                                            // Display image using Lightbox
                                            $('#attachmentsGallery').append(`
                                            <div class="col-md-3 mb-3">
                                                <a href="${attachment.url}" data-lightbox="attachments" data-title="${attachment.name}">
                                                    <img src="${attachment.url}" alt="${attachment.name}" class="img-fluid img-thumbnail">
                                                </a>
                                            </div>
                                        `);
                                        } else if (['pdf'].includes(
                                                attachment.file_type
                                                .toLowerCase())) {
                                            // Display PDF icon with link to view/download
                                            $('#attachmentsGallery').append(`
                                            <div class="col-md-3 mb-3 text-center">
                                                <a href="${attachment.url}" target="_blank" data-title="${attachment.name}">
                                                    <i class="fa fa-file-pdf-o fa-5x text-danger"></i>
                                                    <p>${attachment.name}</p>
                                                </a>
                                                  <a href="${attachment.url}" download class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                            </div>
                                        `);
                                        } else {
                                            // Handle other file types if necessary
                                        }
                                    });
                                } else {
                                    $('#attachmentsGallery').append(`
                                    <div class="col-12">
                                        <p class="text-center">No attachments found for this student.</p>
                                    </div>
                                `);
                                }

                                // Show the modal
                                $('#attachmentsModalGal').modal('show');
                            },
                            error: function(xhr) {
                                toastr.error('Failed to fetch attachments.');
                            }
                        });
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Ajax error: ", textStatus, errorThrown);
                },
            });

            table.on('draw', function() {
                var totalAmount = 0;
                table.rows({ search: 'applied' }).every(function(rowIdx, tableLoop, rowLoop) {
                    var data = this.data();
                    totalAmount += parseFloat(data.amount.replace(' TK', '').replace(',', ''));
                });

                // Update total amount on the page
                $('#totalAmount').text(totalAmount.toFixed(2) + ' TK');
            });




            // Filter button click
            $('#filter').click(function() {
                let fromDate = $('#from_date').val();
                let toDate = $('#to_date').val();
                if (fromDate && toDate && new Date(fromDate) > new Date(toDate)) {
                    toastr.error('From Date cannot be later than To Date.');
                    return;
                }
                table.draw();
            });

            // Reset button click
            $('#reset').click(function() {
                $('#from_date').val('');
                $('#to_date').val('');
                $('#expense_head_id').val('');
                $('#brance_id').val('');
                $('#account_id').val('');
                table.draw();
            });

            // Export Excel
            $('#export_excel').click(function(e) {
                e.preventDefault();

                let fromDate = $('#from_date').val() || '';
                let toDate = $('#to_date').val() || '';
                let expense_head_id = $('#expense_head_id').val() || '';
                let brance_id = $('#brance_id').val() || '';
                let account_id = $('#account_id').val() || '';

                let url = "<?php echo e(route('expenses.export.excel')); ?>" +
                    "?from_date=" + encodeURIComponent(fromDate) +
                    "&to_date=" + encodeURIComponent(toDate) +
                    "&expense_head_id=" + encodeURIComponent(expense_head_id) +
                    "&brance_id=" + encodeURIComponent(brance_id) +
                    "&account_id=" + encodeURIComponent(account_id);

                window.location.href = url;
            });


            $('#export_pdf').click(function(e) {
                e.preventDefault();

                let fromDate = $('#from_date').val() || '';
                let toDate = $('#to_date').val() || '';
                let expense_head_id = $('#expense_head_id').val() || '';
                let brance_id = $('#brance_id').val() || '';
                let account_id = $('#account_id').val() || '';

                let url = "<?php echo e(route('expenses.export.pdf')); ?>" +
                    "?from_date=" + encodeURIComponent(fromDate) +
                    "&to_date=" + encodeURIComponent(toDate) +
                    "&expense_head_id=" + encodeURIComponent(expense_head_id) +
                    "&brance_id=" + encodeURIComponent(brance_id) +
                    "&account_id=" + encodeURIComponent(account_id);

                window.location.href = url;
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eco\resources\views/admin/expenses/expense_report.blade.php ENDPATH**/ ?>