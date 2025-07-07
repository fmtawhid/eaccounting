@extends('layouts.admin_master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">
            <h4 class="page-title">Dashboard</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-0">Welcome to {{ $settings->name }}</h2>
            </div>
        </div>
    </div>
</div>

@can('dashboard_view')

{{-- Filter Dropdown --}}
<form method="GET" class="mb-4">
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

{{-- Summary Cards --}}
<div class="row">
    {{-- Expenses --}}
    <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Expenses</h5>
                        <h3 class="my-3">৳ {{ number_format($totalExpenses, 2) }}</h3>
                        <p class="mb-0 text-muted text-truncate">
                            <span class="badge bg-success me-1">
                                <i class="ri-arrow-up-line"></i> +{{ number_format($totalExpenses, 0) }}
                            </span>
                            <span>Since last update</span>
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-group-line"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Payments --}}
    <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Payment</h5>
                        <h3 class="my-3">৳ {{ number_format($totalAmount, 2) }}</h3>
                        <p class="mb-0 text-muted text-truncate">
                            <span class="badge bg-success me-1">
                                <i class="ri-arrow-up-line"></i> +{{ number_format($totalAmount, 0) }}
                            </span>
                            <span>Since last update</span>
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-money-dollar-circle-line"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Profit --}}
    <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Profit</h5>
                        <h3 class="my-3">৳ {{ number_format($totalProfit, 2) }}</h3>
                        <p class="mb-0 text-muted text-truncate">
                            <span class="badge {{ $totalProfit >= 0 ? 'bg-success' : 'bg-danger' }} me-1">
                                <i class="{{ $totalProfit >= 0 ? 'ri-arrow-up-line' : 'ri-arrow-down-line' }}"></i>
                                {{ number_format($totalProfit, 0) }}
                            </span>
                            <span>Since last update</span>
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-shopping-basket-2-line"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Placeholder Balance --}}
    <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Total Balance</h5>
                        <h3 class="my-3">৳ --</h3>
                        <p class="mb-0 text-muted text-truncate">
                            <span class="badge bg-secondary me-1">
                                <i class="ri-time-line"></i> Waiting
                            </span>
                            <span>Since last update</span>
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-donut-chart-line"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

@endcan
@endsection
