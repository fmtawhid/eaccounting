@extends('layouts.admin_master')

@section('content')
    <div class="row mt-3">
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

                            <div class="mb-3 col-md-6">
                                <label for="receipt_no" class="form-label">Receipt No <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="receipt_no" name="reciept_no" value="{{ old('reciept_no') }}" placeholder="Enter Receipt Number" required>
                                @error('reciept_no')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>
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
                            <div class="mb-3 col-md-6">
                                <label for="account_id" class="form-label">Account <span class="text-danger">*</span></label>
                                <select class="form-control select2" id="account_id" name="account_id" style="width: 100%;" required>
                                    <option value="">Select Account</option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}" {{ old('account_id') == $account->id ? 'selected' : '' }}>
                                            {{ $account->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('account_id')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="date" name="date" placeholder="dd-mm-yy" value="{{ old('date') }}" required>
                                @error('date')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Enter Amount" required>
                                @error('amount')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="amount_in_words" class="form-label">Amount in Words <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="amount_in_words" name="amount_in_words" value="{{ old('amount_in_words') }}" placeholder="Amount in Words" required>
                                @error('amount_in_words')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Name" required>
                                @error('name')
                                    <div class="text-danger my-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <button type="button" class="btn btn-dark upload-btn" data-bs-toggle="modal" data-bs-target="#attachmentsModal">
                                        <i class="fas fa-upload"></i> Upload Attachments
                                    </button>
                                    <div id="attachmentsPreview" class="mt-3 d-flex flex-wrap gap-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 align-right">
                            <button type="submit" id="submit" class="btn btn-success">Submit Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan
    </div>

    <div class="modal fade" id="attachmentsModal" tabindex="-1" aria-labelledby="attachmentsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Attachments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            window.location.href = "{{ route('payments.report') }}";

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