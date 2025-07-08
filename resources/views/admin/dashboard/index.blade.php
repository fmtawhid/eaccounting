@extends('layouts.admin_master')

@section('content')
<div class="row">

    <div class="row">

    
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">     
            <h4 class="page-title">Dashboard</h4>

            {{-- Filter Dropdown --}}
            <form method="GET" class="d-flex mb-xxl-0 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <label for="filter" class="form-label mb-0">Filter:</label>
                    <select name="filter" id="filter" class="form-select w-auto" onchange="this.form.submit()">
                        <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All</option>
                        <option value="7days" {{ $filter == '7days' ? 'selected' : '' }}>Last 7 Days</option>
                        <option value="30days" {{ $filter == '30days' ? 'selected' : '' }}>Last 30 Days</option>
                        <option value="this_month" {{ $filter == 'this_month' ? 'selected' : '' }}>This Month</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    
        <!-- <div class="card">
            <div class="card-body">
                <h2 class="mb-0">Welcome to {{ $settings->name }}</h2>
            </div>
        </div> -->


    </div>

@can('dashboard_view')

{{-- Summary Cards --}}
<div class="row">
    
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-0">
                    <div class="bg-light-subtle border-top border-bottom border-light">
                        <div class="row text-center">

                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Expenses</p>
                                    <h3 class="my-3"> <span>৳ {{ number_format($totalExpenses, 2) }}</span></h3>
                            </div>

                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Earning</p>
                                <h3 class="my-3"><span>৳ {{ number_format($totalAmount, 2) }}</span></h3>                   
                            </div>

                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>Net Balance</p>
                                <h3 class="my-3"><span>৳ {{ number_format($totalProfit, 2) }}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">
                <div class="">
                        <div id="basic-column" style="width: 100%; min-height: 400px;"></div>
                </div>
                </div> <!-- end card-body-->

            </div> <!-- end card-->
        </div> <!-- end col-->


        <div class="col-lg-4">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Branch Overview</h4>
                </div>

                <div class="card-body pt-0">
                    <div id="average-sales" class="apex-charts mb-3 mt-n5"
                        data-colors="#4254ba">
                    </div>
                    <!-- pie chart -->
                    <div class="">
                        <div dir="ltr">
                            <div id="simple-pie" class="apex-charts" data-colors="#4254ba,#6c757d"></div>
                        </div>
                    </div>

                    <!-- <h5 class="mb-1 mt-0 fw-normal">Rafusoft Mirpur</h5>
                    <div class="progress-w-percent">
                        <span class="progress-value fw-bold">72k</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar" role="progressbar" style="width: 72%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                    </div>

                    <h5 class="mb-1 mt-0 fw-normal">Rafusoft Dinajpur</h5>
                    <div class="progress-w-percent">
                        <span class="progress-value fw-bold">39k</span>
                    <div class="progress progress-sm">
                        <div class="progress-bar" role="progressbar" style="width: 39%;" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> -->
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
        </div> <!-- end col-->



        {{-- Expenses --}}
        <!-- <div class="col-md-3">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">Expenses</h5>
                            <h3 class="my-3">৳ {{ number_format($totalExpenses, 2) }}</h3>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                                <i class="ri-group-line"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    {{-- Payments --}}
    <!-- <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Payment</h5>
                        <h3 class="my-3">৳ {{ number_format($totalAmount, 2) }}</h3>

                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-money-dollar-circle-line"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    {{-- Profit --}}
    <!-- <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Profit</h5>
                        <h3 class="my-3">৳ {{ number_format($totalProfit, 2) }}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-shopping-basket-2-line"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    {{-- Placeholder Balance --}}
    <!-- <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Total Balance</h5>
                        <h3 class="my-3">৳ --</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-donut-chart-line"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>

{{-- Account & Brance Summary --}}
<div class="row mt-2">
    {{-- Accounts Summary --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light"><strong>Accounts Summary</strong></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Account Name</th>
                            <th>Number</th>
                            <th>Branch</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $acc)
                            <tr>
                                <td>{{ $acc->name }}</td>
                                <td>{{ $acc->number }}</td>
                                <td>{{ $acc->brance->name ?? '-' }}</td>
                                <td>৳ {{ number_format($acc->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Brance Summary --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light"><strong>Brance Summary</strong></div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Branch</th>
                            <th>Total Payment</th>
                            <th>Total Expense</th>
                            <th>Net Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brances as $br)
                            <tr>
                                <td>{{ $br['name'] }}</td>
                                <td>৳ {{ number_format($br['total_payment'], 2) }}</td>
                                <td>৳ {{ number_format($br['total_expense'], 2) }}</td>
                                <td class="{{ $br['net_balance'] >= 0 ? 'text-success' : 'text-danger' }}">
                                    ৳ {{ number_format($br['net_balance'], 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <!-- Start Content-->
    <div class="container-fluid">
        <!-- start page title -->
        <!-- <div class="row">

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">All Transaction</h4>
                        <div id="basic-column" style="width: 100%; min-height: 400px;"></div>
                    </div>
                </div>
            </div> -->
        
            
            <!-- <div class="col-xl-6">
                <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Account overview</h4>
                    <div dir="ltr">
                        <div id="simple-pie" class="apex-charts" data-colors="#4254ba,#6c757d,#17a497,#fa5c7c,#e3eaef"></div>
                    </div>
                </div> -->
                <!-- end card body-->
            </div>
            <!-- end card -->
        </div>
        
    </div>
    <!-- end container-fluid -->

@endcan

<script>
   var branchPieChartData = @json($branchPieChart);
    const expensesData = @json(array_values($expensesData));
    const paymentsData = @json(array_values($paymentsData));
</script>

@endsection