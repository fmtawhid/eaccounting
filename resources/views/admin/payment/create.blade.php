@extends('layouts.admin_master')

@section('content')
    <!-- Create Payment Form and Payments List -->
    <div class="row mt-3">
        <!-- Create Payment Form -->
        @can('payment_add')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4 class="page-title">Add Payment</h4>
                        </div>
                    </div>
                    <form id="createPaymentForm" action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">

                            <!-- Purpose -->
                            <div class="mb-3 col-md-6">
                                <label for="purpose_id" class="form-label">Purpose <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="purpose_id" name="purpose_id" style="width: 100%;" required>
                                    <option value="">Select Purpose</option>
                                    @foreach ($purposes as $purpose)
                                        <option value="{{ $purpose->id }}" {{ old('purpose_id') == $purpose->id ? 'selected' : '' }}>
                                            {{ $purpose->purpose_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('purpose_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Receipt No -->
                            <div class="mb-3 col-md-6">
                                <label for="receipt_no" class="form-label">Receipt No <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="receipt_no" name="reciept_no" value="{{ old('reciept_no') }}" placeholder="Enter Receipt Number" required>
                                @error('reciept_no')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Branch -->
                            <div class="mb-3 col-md-6">
                                <label for="brance_id" class="form-label">Branch <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="brance_id" name="brance_id" style="width: 100%;" required>
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('brance_id') == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option> 
                                    @endforeach
                                </select>
                                @error('brance_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Account -->
                            <div class="mb-3 col-md-6">
                                <label for="account_id" class="form-label">Account <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="account_id" name="account_id" style="width: 100%;" required>
                                    <option value="">Select Account</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                            {{ $account->name }} ({{ $account->number }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('account_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
                            

                            <!-- Date -->
                            <div class="mb-3 col-md-6">
                                <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="date" name="date" placeholder="dd-mm-yy" value="{{ old('date') }}" required>
                                @error('date')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Amount -->
                            <div class="mb-3 col-md-6">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Enter Amount" required>
                                @error('amount')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Amount in Words -->
                            <div class="mb-3 col-md-6">
                                <label for="amount_in_words" class="form-label">Amount in Words <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="amount_in_words" name="amount_in_words" value="{{ old('amount_in_words') }}" placeholder="Amount in Words" required>
                                @error('amount_in_words')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Present Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="Enter Address" required>
                                @error('address')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- Mobile -->
                            <div class="mb-3 col-md-6">
                                <label for="mobile" class="form-label">Send Payment SMS <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Enter Mobile" required>
                                @error('mobile')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Attachments Section -->
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <button type="button" class="btn btn-dark upload-btn" data-bs-toggle="modal" data-bs-target="#attachmentsModal">
                                        <i class="fas fa-upload"></i> Upload Attachments
                                    </button>
                                    <div id="attachmentsPreview" class="mt-3 d-flex flex-wrap gap-3">
                                        <!-- Image and PDF previews will appear here -->
                                    </div>
                                </div>
 
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="col-md-6 align-right">
                            <button type="submit" id="submit" class="btn btn-success">Submit Payment</button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
        @endcan

        
    </div> <!-- end row -->

    <!-- Attachments Upload Modal -->
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
                        @csrf
                        <div class="dz-message">
                            Drag and drop files here or click to upload.<br>
                            <span class="note">(Only images and PDFs, max size 512KB each)</span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveAttachments">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Attachments Gallery Modal -->
    <div class="modal fade" id="attachmentsModalGal" tabindex="-1" aria-labelledby="attachmentsModalGalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Student Attachments</h5>
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
@endsection

@section('scripts')
    <script>
        $("#date").flatpickr({
            dateFormat: "d-m-Y"
        });
    </script>

    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            // Initialize Select2 for dropdowns
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true
            });

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

                    dz.on("addedfile", function(file) {
                        if (selectedFiles.length >= 10) { // Limit example
                            dz.removeFile(file);
                            toastr.warning('Maximum 10 files are allowed.');
                        } else {
                            selectedFiles.push(file);
                        }
                    });

                    dz.on("removedfile", function(file) {
                        var index = selectedFiles.indexOf(file);
                        if (index > -1) {
                            selectedFiles.splice(index, 1);
                        }
                    });
                }
            });

            // Helper function to append preview for one file (returns Promise)
            function appendPreview(file, index) {
                return new Promise(function(resolve) {
                    if (file.type === "application/pdf") {
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
                        resolve();
                    } else if (file.type.startsWith("image/")) {
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
                            resolve();
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // Other file types fallback
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
                        resolve();
                    }
                });
            }

            $('#saveAttachments').click(async function() {
                // Append previews for all files asynchronously and in order
                for (let i = 0; i < selectedFiles.length; i++) {
                    await appendPreview(selectedFiles[i], i);
                }

                // Close modal after previews are added
                $('#attachmentsModal').modal('hide');
            });

            // Remove attachment preview
            $(document).on('click', '.remove-preview', function() {
                var index = $(this).data('index');
                selectedFiles.splice(index, 1);
                $(this).parent().remove();

                // Re-index remaining previews' data-index attributes
                $('#attachmentsPreview .remove-preview').each(function(i) {
                    $(this).attr('data-index', i);
                });
            });

            // Submit form with attachments via AJAX
            $('#createPaymentForm').submit(function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                selectedFiles.forEach(function(file) {
                    formData.append('attachments[]', file);
                });

                $('#submit').prop('disabled', true).text('Submitting...');

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                            window.location.href = "{{ route('payments.index') }}";
                        } else {
                            toastr.error('An error occurred while submitting the form.');
                            $('#submit').prop('disabled', false).text('Submit Payment');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, messages) {
                                toastr.error(messages[0]);
                            });
                        } else {
                            toastr.error('An unexpected error occurred.');
                        }
                        $('#submit').prop('disabled', false).text('Submit Payment');
                    }
                });
            });

            var attachmentsRouteTemplate = "{{ route('payments.attachments', ':id') }}";

            // Initialize DataTable for Payments
            $('#paymentsTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('payments.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'reciept_no', name: 'reciept_no' },
                    { data: 'date', name: 'date' },
                    { data: 'name', name: 'name' },
                    { data: 'address', name: 'address' },
                    { data: 'purpose', name: 'purpose' },
                    { data: 'amount', name: 'amount' },
                    { data: 'amount_in_words', name: 'amount_in_words' },
         
                    { data: 'actions', name: 'actions', orderable: false, searchable: false },
                ],
                initComplete: function(settings, json) {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                    });

                    // Confirm delete dialog
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
                                cancel: function() {},
                            },
                        });
                    });

                    // View attachments modal
                    $(document).on('click', '.view-attachments', function() {
                        let studentId = $(this).data('id');
                        let attachmentsRoute = attachmentsRouteTemplate.replace(':id', studentId);

                        $('#attachmentsGallery').empty();

                        $.ajax({
                            url: attachmentsRoute,
                            type: 'GET',
                            success: function(response) {
                                if (response.attachments.length > 0) {
                                    response.attachments.forEach(function(attachment) {
                                        let ext = attachment.file_type.toLowerCase();
                                        if (['jpg', 'jpeg', 'png', 'gif', 'svg'].includes(ext)) {
                                            $('#attachmentsGallery').append(`
                                                <div class="col-md-3 mb-3">
                                                    <a href="${attachment.url}" data-lightbox="attachments" data-title="${attachment.name}">
                                                        <img src="${attachment.url}" alt="${attachment.name}" class="img-fluid img-thumbnail">
                                                    </a>
                                                </div>
                                            `);
                                        } else if (ext === 'pdf') {
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
                                        }
                                    });
                                } else {
                                    $('#attachmentsGallery').append(`
                                        <div class="col-12">
                                            <p class="text-center">No attachments found for this student.</p>
                                        </div>
                                    `);
                                }
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
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dhakila_number').on('change', function() {
                var dhakilaNumber = $(this).val();

                if (dhakilaNumber) {
                    $.ajax({
                        url: "{{ url('panel/get-student-details') }}/" + dhakilaNumber,
                        type: 'GET',
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                            } else {
                                $('#name').val(response.student_name);
                                $('#address').val(response.district);
                                $('#bibag_id').val(response.bibag_id).trigger('change');
                                $('#sreni_id').val(response.sreni_id).trigger('change');
                                $('#mobile').val(response.mobile);
                            }
                        },
                        error: function() {
                            alert('An error occurred while fetching the student details.');
                        }
                    });
                }
            });
        });
    </script>

    <script>
    $(document).ready(function () {
        $('#brance_id').on('change', function () {
            let branceId = $(this).val();
            let accountSelect = $('#account_id');

            accountSelect.empty().append('<option value="">Loading...</option>');

            if (branceId) {
                $.ajax({
                    url: "{{ route('accounts.by.branch', '') }}/" + branceId,
                    type: "GET",
                    success: function (response) {
                        accountSelect.empty().append('<option value="">Select Account</option>');

                        if (response.length > 0) {
                            response.forEach(function (account) {
                                accountSelect.append(
                                    `<option value="${account.id}">${account.name} (${account.number})</option>`
                                );
                            });
                        } else {
                            accountSelect.append('<option value="">No accounts found</option>');
                        }

                        // যদি select2 ব্যবহার করো, তাহলে এটা রিফ্রেশ করতে হবে:
                        accountSelect.trigger('change');
                    },
                    error: function () {
                        toastr.error('Failed to load accounts.');
                        accountSelect.empty().append('<option value="">Select Account</option>');
                    }
                });
            } else {
                accountSelect.empty().append('<option value="">Select Account</option>');
            }
        });
    });
</script>

@endsection
