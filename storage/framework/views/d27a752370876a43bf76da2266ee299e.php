<?php $__env->startSection('content'); ?>
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Add Expense</h4>
                <a href="<?php echo e(route('expenses.index')); ?>" class="btn btn-primary">Expenses List</a>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Create Expense Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form id="createExpenseForm" action="<?php echo e(route('expenses.store')); ?>" method="POST"
                        enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <!-- Expense Head -->
                            <div class="mb-3 col-md-6">
                                <label for="expense_head_id" class="form-label">Expense Head <span
                                        class="text-danger">*</span></label>
                                <select class="form-control select2" id="expense_head_id" name="expense_head_id"
                                    style="width: 100%;" required>
                                    <option value="">Select Expense Title</option>
                                    <?php $__currentLoopData = $expenseHeads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expenseHead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($expenseHead->id); ?>"
                                            <?php echo e(old('expense_head_id') == $expenseHead->id ? 'selected' : ''); ?>>
                                            <?php echo e($expenseHead->expense_head_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['expense_head_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger my-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Name -->
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Expense Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="<?php echo e(old('name')); ?>" placeholder="Enter Expense Name" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger my-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Invoice No -->
                            <div class="mb-3 col-md-6">
                                <label for="invoice_no" class="form-label">Invoice No <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="invoice_no" name="invoice_no"
                                    value="<?php echo e(old('invoice_no')); ?>" placeholder="Enter Invoice Number" required>
                                <?php $__errorArgs = ['invoice_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger my-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <!-- Date -->
                            <div class="mb-3 col-md-6">
                                <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="date" name="date"
                                    value="<?php echo e(old('date')); ?>" required placeholder="dd-mm-yy">
                                <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger my-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Branch -->
                            <div class="mb-3 col-md-6">
                                <label for="brance_id" class="form-label">Branch <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="brance_id" name="brance_id" style="width: 100%;"
                                    required>
                                    <option value="">Select Branch</option>
                                    <?php $__currentLoopData = $brances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($brance->id); ?>"
                                            <?php echo e(old('brance_id') == $brance->id ? 'selected' : ''); ?>>
                                            <?php echo e($brance->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['brance_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger my-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Account -->
                            <div class="mb-3 col-md-6">
                                <label for="account_id" class="form-label">Account <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="account_id" name="account_id" style="width: 100%;"
                                    required>
                                    <option value="">Select Account</option>
                                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($account->id); ?>"
                                            <?php echo e(old('account_id') == $account->id ? 'selected' : ''); ?>>
                                            <?php echo e($account->name); ?> <?php echo e($account->number); ?> (<?php echo e($account->amount); ?>)
                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['account_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger my-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="row">
                            

                            <!-- Amount -->
                            <div class="mb-3 col-md-6">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount"
                                    value="<?php echo e(old('amount')); ?>" placeholder="Enter Amount" required>
                                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger my-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Note -->
                            <div class="mb-3 col-md-6">
                                <label for="note" class="form-label">Note</label>
                                <input type="text" class="form-control" id="note" name="note"
                                    value="<?php echo e(old('note')); ?>" placeholder="Enter Note">
                                <?php $__errorArgs = ['note'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger my-2"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Attachments Section -->
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <button type="button" class="btn btn-dark upload-btn" data-bs-toggle="modal"
                                    data-bs-target="#attachmentsModal">
                                    <i class="fas fa-upload"></i> Upload Attachments
                                </button>
                                <div id="attachmentsPreview" class="mt-3 d-flex flex-wrap gap-3">
                                    <!-- Image and PDF previews will appear here -->
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" id="submit" class="btn btn-success">Submit Expense</button>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->


    <!-- Attachments Modal -->
    <div class="modal fade" id="attachmentsModal" tabindex="-1" aria-labelledby="attachmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Dropzone Form -->
                    <form action="#" class="dropzone" id="attachmentsDropzone">
                        <?php echo csrf_field(); ?>
                        <div class="dz-message">
                            Drag and drop files here or click to upload.<br>
                            <span class="note">(Only images and PDFs, max size 512KB each)</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="saveAttachments">Save</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $("#date").flatpickr({
            dateFormat: "d-m-Y"
        })
    </script>
    <script>
        Dropzone.autoDiscover = false; // Prevent Dropzone from auto-initializing

        $(document).ready(function() {
            // Initialize Select2 for dropdowns
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });

            // Initialize Dropzone
            var selectedFiles = []; // Array to hold selected files

            var dropzone = new Dropzone("#attachmentsDropzone", {
                url: "#", // No upload URL since we'll handle files on form submission
                autoProcessQueue: false,
                uploadMultiple: false,
                parallelUploads: 10,
                maxFilesize: 0.5, // MB
                acceptedFiles: 'image/*,.pdf',
                addRemoveLinks: true,
                dictDefaultMessage: "Drag and drop files here or click to upload.",
                init: function() {
                    var dz = this;

                    // Handle file added
                    dz.on("addedfile", function(file) {
                        // Limit number of files if needed
                        if (selectedFiles.length >= 10) { // Example limit
                            dz.removeFile(file);
                            toastr.warning('Maximum 10 files are allowed.');
                        } else {
                            selectedFiles.push(file);
                        }
                    });

                    // Handle file removed
                    dz.on("removedfile", function(file) {
                        var index = selectedFiles.indexOf(file);
                        if (index > -1) {
                            selectedFiles.splice(index, 1);
                        }
                    });
                }
            });

            $('#saveAttachments').click(function() {
                // Clear previous previews for new attachments
                // (existing attachments are handled separately)
                // $('#attachmentsPreview').empty(); // Don't clear existing attachments

                // Append selected files to the main form
                selectedFiles.forEach(function(file, index) {
                    // Check if the file is PDF or image and append the corresponding preview
                    if (file.type === "application/pdf") {
                        // Display PDF icon with file name and remove button
                        $('#attachmentsPreview').append(`
                            <div class="position-relative attachment-container m-2">
                                <a href="#" target="_blank" data-title="${file.name}">
                                    <i class="fa fa-file-pdf-o fa-5x text-danger attachment-icon"></i>
                                </a>
                                <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                                <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">
                                    &times;
                                </button>
                                <input type="hidden" name="attachments[]" value="${file.name}">
                            </div>
                        `);
                    } else if (file.type.startsWith("image/")) {
                        // Create a FileReader to generate image previews
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#attachmentsPreview').append(`
                                <div class="position-relative attachment-container m-2">
                                    <a href="${e.target.result}" data-lightbox="attachments" data-title="${file.name}">
                                        <img src="${e.target.result}" alt="${file.name}" class="img-thumbnail attachment-image">
                                    </a>
                                    <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                                    <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">
                                        &times;
                                    </button>
                                    <input type="hidden" name="attachments[]" value="${file.name}">
                                </div>
                            `);
                        }
                        reader.readAsDataURL(file);
                    } else {
                        // Handle other file types if necessary
                        $('#attachmentsPreview').append(`
                            <div class="position-relative attachment-container m-2">
                                <a href="#" target="_blank" data-title="${file.name}">
                                    <i class="fas fa-file fa-5x text-secondary attachment-icon"></i>
                                </a>
                                <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                                <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">
                                    &times;
                                </button>
                                <input type="hidden" name="attachments[]" value="${file.name}">
                            </div>
                        `);
                    }
                });

                // Close the modal
                $('#attachmentsModal').modal('hide');
            });

            // Handle removal of previewed attachments
            $(document).on('click', '.remove-preview', function() {
                var index = $(this).data('index');
                // Remove from selectedFiles array
                selectedFiles.splice(index, 1);
                // Remove the preview
                $(this).parent().remove();
            });

            // Handle form submission
            $('#createExpenseForm').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                // Create FormData object
                var formData = new FormData(this);

                // Append selected files
                selectedFiles.forEach(function(file, index) {
                    formData.append('attachments[]', file);
                });

                // Disable the submit button to prevent multiple submissions
                $('#submit').prop('disabled', true).text('Submitting...');

                // Send the form data via AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false, // Important
                    contentType: false, // Important
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                            // Optionally, redirect or reset the form
                            window.location.href = "<?php echo e(route('expense.report')); ?>";
                        } else {
                            toastr.error('An error occurred while submitting the form.');
                            $('#submit').prop('disabled', false).text('Submit');
                        }
                    },
                    error: function(xhr) {
                        // Handle validation errors
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, messages) {
                                toastr.error(messages[0]); // 5000ms = 5 seconds
                            });
                        } else {
                            toastr.error('An unexpected error occurred.');
                        }
                        $('#submit').prop('disabled', false).text('Submit');
                    }
                });
            });
        }); 
    </script>
    <script>
    $(document).ready(function() {
        $('#brance_id').on('change', function() {
            let branceId = $(this).val();

            if (branceId) {
                // Get route URL from meta tag and replace ":id" with actual branceId
                let baseUrl = $('meta[name="accounts-by-branch-url"]').attr('content');
                let url = baseUrl.replace(':id', branceId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#account_id').empty().append('<option value="">Select Account</option>');
                        $.each(data, function(key, account) {
                            $('#account_id').append('<option value="' + account.id + '">' + account.name + ' (' + account.number + ')</option>');
                        });

                        // আবার Select2 রিফ্রেশ করতে চাইলে
                        // $('#account_id').trigger('change.select2');
                    },
                    error: function() {
                        toastr.error('Failed to load accounts for selected branch');
                    }
                });
            } else {
                $('#account_id').empty().append('<option value="">Select Account</option>');
            }
        });
    });
</script>
    <meta name="accounts-by-branch-url" content="<?php echo e(route('accounts.by.branch', ':id')); ?>">


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eaccounting\resources\views/admin/expenses/create.blade.php ENDPATH**/ ?>