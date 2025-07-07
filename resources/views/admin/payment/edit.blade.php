@extends('layouts.admin_master')

@section('styles')
    <!-- Dropzone CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        .existing-attachment {
            position: relative;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        .existing-attachment img,
        .existing-attachment .fa-file-pdf {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }
        .existing-attachment .remove-existing-attachment {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255,0,0,0.7);
            border: none;
            color: #fff;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 22px;
            cursor: pointer;
        }
        .existing-attachment .remove-existing-attachment:hover {
            background-color: rgba(255,0,0,1);
        }
        .upload-btn {
            background-color: rgb(88, 94, 84);
        }
        .upload-btn:hover {
            background-color: rgb(55, 56, 54);
            color: #fff;
        }
    </style>
@endsection

@section('content')
<div class="row mt-3">
    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
        <h4>Edit Payment</h4>
        <a href="{{ route('payments.index') }}" class="btn btn-primary">Payment List</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form id="editPaymentForm" action="{{ route('payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="mb-3 col-md-6">
                            <label for="purpose_id" class="form-label">Purpose <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="purpose_id" name="purpose_id" style="width: 100%;" required>
                                <option value="">Select Purpose</option>
                                @foreach ($purposes as $purpose)
                                    <option value="{{ $purpose->id }}" {{ old('purpose_id', $payment->purpose_id) == $purpose->id ? 'selected' : '' }}>
                                        {{ $purpose->purpose_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('purpose_id')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="reciept_no" class="form-label">Receipt No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="reciept_no" name="reciept_no" value="{{ old('reciept_no', $payment->reciept_no) }}" placeholder="Enter Receipt Number" required readonly>
                            @error('reciept_no')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="brance_id" class="form-label">Branch <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="brance_id" name="brance_id" style="width: 100%;" required>
                                <option value="">Select Branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ old('brance_id', $payment->brance_id) == $branch->id ? 'selected' : '' }}>
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
                                    <option value="{{ $account->id }}" {{ old('account_id', $payment->account_id) == $account->id ? 'selected' : '' }}>
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
                            <input type="text" class="form-control" id="date" name="date" placeholder="dd-mm-yy" value="{{ old('date', \Carbon\Carbon::parse($payment->date)->format('d-m-Y')) }}" required>
                            @error('date')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount', $payment->amount) }}" placeholder="Enter Amount" required>
                            @error('amount')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="amount_in_words" class="form-label">Amount in Words <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="amount_in_words" name="amount_in_words" value="{{ old('amount_in_words', $payment->amount_in_words) }}" placeholder="Amount in Words" required>
                            @error('amount_in_words')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $payment->name) }}" placeholder="Enter Name" required>
                            @error('name')
                                <div class="text-danger my-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Attachments Section -->
                        <div class="mb-3 col-md-12">
                            <button type="button" class="btn btn-dark upload-btn" data-bs-toggle="modal" data-bs-target="#attachmentsModal">
                                <i class="fas fa-upload"></i> Upload Attachments
                            </button>
                            <div id="attachmentsPreview" class="mt-3 d-flex flex-wrap gap-3">
                                {{-- Existing attachments --}}
                                @foreach ($attachments as $attachment)
                                    <div class="existing-attachment position-relative" data-id="{{ $attachment->id }}">
                                        @php
                                            $ext = strtolower(pathinfo($attachment->file_path, PATHINFO_EXTENSION));
                                        @endphp
                                        @if (in_array($ext, ['jpg','jpeg','png','gif','svg']))
                                            <a href="{{ asset('assets/attachements/' . $attachment->file_path) }}" data-lightbox="attachments" data-title="{{ $attachment->file_name }}">
                                                <img src="{{ asset('assets/attachements/' . $attachment->file_path) }}" alt="{{ $attachment->file_name }}" class="img-thumbnail attachment-image">
                                            </a>
                                        @elseif ($ext === 'pdf')
                                            <a href="{{ asset('assets/attachements/' . $attachment->file_path) }}" target="_blank" data-title="{{ $attachment->file_name }}">
                                                <i class="fa fa-file-pdf fa-5x text-danger attachment-icon"></i>
                                            </a>
                                        @else
                                            <a href="{{ asset('assets/attachements/' . $attachment->file_path) }}" target="_blank" data-title="{{ $attachment->file_name }}">
                                                <i class="fas fa-file fa-5x text-secondary attachment-icon"></i>
                                            </a>
                                        @endif
                                        <span class="d-block mt-2 text-center attachment-name">{{ $attachment->file_name }}</span>
                                        <button type="button" class="btn btn-danger btn-sm remove-existing-attachment" data-id="{{ $attachment->id }}">&times;</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mt-3">
                        <button type="submit" id="submit" class="btn btn-success">Update Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Attachments Modal -->
<div class="modal fade" id="attachmentsModal" tabindex="-1" aria-labelledby="attachmentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Attachments</h5>
                <button type="button" class="btn-close btn-dark upload-btn" data-bs-dismiss="modal" aria-label="Close"></button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<script>
    $("#date").flatpickr({
        dateFormat: "d-m-Y"
    });
</script>

<script>
    Dropzone.autoDiscover = false;

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        var selectedFiles = [];

        var dropzone = new Dropzone("#attachmentsDropzone", {
            url: "#",
            autoProcessQueue: false,
            uploadMultiple: false,
            parallelUploads: 10,
            maxFilesize: 0.512,
            acceptedFiles: 'image/*,.pdf',
            addRemoveLinks: true,
            dictDefaultMessage: "Drag and drop files here or click to upload.",
            init: function() {
                var dz = this;

                dz.on("addedfile", function(file) {
                    if (selectedFiles.length >= 10) {
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

        $('#saveAttachments').click(function() {
            // Append new file previews only (do NOT clear existing ones)
            selectedFiles.forEach(function(file, index) {
                if (file.type === "application/pdf") {
                    $('#attachmentsPreview').append(`
                        <div class="position-relative attachment-container m-2">
                            <a href="#" target="_blank" data-title="${file.name}">
                                <i class="fa fa-file-pdf fa-5x text-danger attachment-icon"></i>
                            </a>
                            <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                            <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">&times;</button>
                            <input type="hidden" name="attachments[]" value="${file.name}">
                        </div>
                    `);
                } else if (file.type.startsWith("image/")) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#attachmentsPreview').append(`
                            <div class="position-relative attachment-container m-2">
                                <a href="${e.target.result}" data-lightbox="attachments" data-title="${file.name}">
                                    <img src="${e.target.result}" alt="${file.name}" class="img-thumbnail attachment-image">
                                </a>
                                <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                                <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">&times;</button>
                                <input type="hidden" name="attachments[]" value="${file.name}">
                            </div>
                        `);
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#attachmentsPreview').append(`
                        <div class="position-relative attachment-container m-2">
                            <a href="#" target="_blank" data-title="${file.name}">
                                <i class="fas fa-file fa-5x text-secondary attachment-icon"></i>
                            </a>
                            <span class="d-block mt-2 text-center attachment-name">${file.name}</span>
                            <button type="button" class="btn btn-danger btn-sm remove-preview position-absolute top-0 end-0" data-index="${index}" aria-label="Delete attachment ${file.name}">&times;</button>
                            <input type="hidden" name="attachments[]" value="${file.name}">
                        </div>
                    `);
                }
            });

            $('#attachmentsModal').modal('hide');
        });

        // Remove new preview attachments
        $(document).on('click', '.remove-preview', function() {
            var index = $(this).data('index');
            selectedFiles.splice(index, 1);
            $(this).parent().remove();
        });

        // Remove existing attachments
        $(document).on('click', '.remove-existing-attachment', function() {
            var attachmentId = $(this).data('id');
            var $attachmentDiv = $(this).closest('.existing-attachment');

            // Add hidden input to mark for deletion
            $('#editPaymentForm').append(`<input type="hidden" name="delete_attachments[]" value="${attachmentId}">`);

            // Remove from UI
            $attachmentDiv.remove();
        });

        // Optional: AJAX form submission, else default form submit
        /*
        $('#editPaymentForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            selectedFiles.forEach(function(file) {
                formData.append('attachments[]', file);
            });

            $('#submit').prop('disabled', true).text('Submitting...');

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response.success){
                        toastr.success(response.success);
                        window.location.href = "{{ route('payments.index') }}";
                    } else {
                        toastr.error('Something went wrong!');
                        $('#submit').prop('disabled', false).text('Update Payment');
                    }
                },
                error: function(xhr){
                    if(xhr.status === 422){
                        $.each(xhr.responseJSON.errors, function(key, value){
                            toastr.error(value[0]);
                        });
                    } else {
                        toastr.error('Unexpected error!');
                    }
                    $('#submit').prop('disabled', false).text('Update Payment');
                }
            });
        });
        */

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
