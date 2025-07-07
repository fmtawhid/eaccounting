@extends('layouts.admin_master')

@section('styles')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endsection

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex justify-content-between align-items-center">
                <h4 class="page-title">Payment Report</h4>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <!-- Date Filters -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3 align-items-end">
            <div class="col-md-2">
                <label for="from_date" class="form-label">From Date</label>
                <input type="text" id="from_date" class="form-control" placeholder="From Date">
            </div>

            <div class="col-md-2">
                <label for="to_date" class="form-label">To Date</label>
                <input type="text" id="to_date" class="form-control" placeholder="To Date">
            </div>

            <div class="col-md-2">
                <label for="purpose_id" class="form-label">Purpose</label>
                <select class="form-select select2" id="purpose_id" name="purpose_id" required>
                    <option selected disabled value="">Select Purpose</option>
                    @foreach ($purposes as $p)
                        <option value="{{ $p->id }}" {{ $p->id == old('purpose_id') ? 'selected' : '' }}>
                            {{ $p->purpose_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="brance_id" class="form-label">Branch</label>
                <select class="form-select select2" id="brance_id" name="brance_id">
                    <option selected disabled value="">Select Branch</option>
                    @foreach ($branches as $b)
                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label for="account_id" class="form-label">Account</label>
                <select class="form-select select2" id="account_id" name="account_id">
                    <option selected disabled value="">Select Account</option>
                    @foreach ($accounts as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
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
                            <h4>Total Payments: <span id="totalAmount">{{ number_format($totalAmount, 2) }} TK</span></h4>
                        </div>
                    </div>

                    <!-- Payments DataTable -->
                    <table id="paymentsTable" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Serial No</th>
                                <th>Receipt No</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Purpose</th>
                                <th>Branch</th>
                                <th>Account</th>
                                <th>Amount</th>
                                <th>Amount in Words</th>
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
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        var table = $("#paymentsTable").DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('payments.report') }}",
                data: function(d) {
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                    d.purpose_id = $('#purpose_id').val();
                    d.brance_id = $('#brance_id').val();   // <-- Add this
                    d.account_id = $('#account_id').val(); // <-- Add this
                  
                    
                }
            },
            lengthMenu: [
                        [10, 25, 50, 100, -1], // -1 will be used for "All items"
                        [10, 25, 50, 100, "All items"] // The text for "All items"
                    ],
            pageLength: 10, // Default value
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'reciept_no', name: 'reciept_no' },
                { data: 'date', name: 'date' },
                { data: 'name', name: 'name' },
                { data: 'purpose', name: 'purpose' },
                { data: 'branch', name: 'brance.name' }, // <-- Branch Column
                { data: 'account', name: 'account.name' }, // <-- Account Column
                { data: 'amount', name: 'amount' },
                { data: 'amount_in_words', name: 'amount_in_words' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ]
        });

        // Handle Filter Button Click
        $('#filter').click(function() {
            table.draw();
        });

        // Handle Reset Button Click
        $('#reset').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#purpose_id').val('');
            $('#brance_id').val('').trigger('change'); 
            $('#account_id').val('').trigger('change'); 
            $('#bibag_id').val('').trigger('change');
            table.draw();
        });

        // Handle the Draw event (when the table is reloaded with new data)
        table.on('draw', function() {
            var totalAmount = 0;
            table.rows({ search: 'applied' }).every(function(rowIdx, tableLoop, rowLoop) {
                var data = this.data();
                // Sum the amount column for the rows that are currently visible
                totalAmount += parseFloat(data.amount.replace(' TK', '').replace(',', ''));
            });

            // Update the total amount on the page
            $('#totalAmount').text(totalAmount.toFixed(2) + ' TK');
        });

        // Export Excel
        $('#export_excel').click(function(e) {
            e.preventDefault();
            let fromDate = $('#from_date').val() || '';
            let toDate = $('#to_date').val() || '';
            let purposeId = $('#purpose_id').val() || '';
            let branceId = $('#brance_id').val() || '';
            let accountId = $('#account_id').val() || '';

            let url = "{{ route('payments.export.excel') }}" +
                "?from_date=" + encodeURIComponent(fromDate) +
                "&to_date=" + encodeURIComponent(toDate) +
                "&purpose_id=" + encodeURIComponent(purposeId) +
                "&brance_id=" + encodeURIComponent(branceId) +
                "&account_id=" + encodeURIComponent(accountId);

            window.location.href = url;
        });

        // Export PDF
        $('#export_pdf').click(function(e) {
            e.preventDefault();
            let fromDate = $('#from_date').val() || '';
            let toDate = $('#to_date').val() || '';
            let purposeId = $('#purpose_id').val() || '';
            let branceId = $('#brance_id').val() || '';
            let accountId = $('#account_id').val() || '';

            let url = "{{ route('payments.export.pdf') }}" +
                "?from_date=" + encodeURIComponent(fromDate) +
                "&to_date=" + encodeURIComponent(toDate) +
                "&purpose_id=" + encodeURIComponent(purposeId) +
                "&brance_id=" + encodeURIComponent(branceId) +
                "&account_id=" + encodeURIComponent(accountId);

            window.location.href = url;
        });

    });

</script>

<script>
    $(document).on('submit', '.dform', function (e) {
        e.preventDefault(); // ফর্ম সাবমিট থামাও

        if (!confirm('Are you sure you want to delete this payment?')) return;

        const form = $(this);
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
            success: function (response) {
                if (response.success) {
                    toastr.success(response.message);
                    $('#paymentsTable').DataTable().ajax.reload(); // টেবিল রিফ্রেশ
                } else {
                    toastr.error(response.message || 'Delete failed');
                }
            },
            error: function (xhr) {
                toastr.error('Something went wrong while deleting.');
                console.error(xhr.responseText);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Handle Delete Button Clicks (like expense report)
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
                        // Submit the form via AJAX
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
                            success: function (response) {
                                if (response.success) {
                                    toastr.success(response.message);
                                    $('#paymentsTable').DataTable().ajax.reload();
                                } else {
                                    toastr.error(response.message || 'Delete failed');
                                }
                            },
                            error: function (xhr) {
                                toastr.error('Something went wrong while deleting.');
                                console.error(xhr.responseText);
                            }
                        });
                    },
                    cancel: function() {
                        // Do nothing
                    }
                }
            });
        });
    });
</script>
@endsection
