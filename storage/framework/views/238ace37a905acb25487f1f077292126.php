<?php $__env->startSection('content'); ?>
<div class="row">

    <div class="row">

    
    <div class="col-12">
        <div class="page-title-box justify-content-between d-flex align-items-lg-center flex-lg-row flex-column">     
            <h4 class="page-title">Dashboard</h4>

            
            <form method="GET" class="d-flex mb-xxl-0 mb-2">
                <div class="d-flex align-items-center gap-2">
                    <label for="filter" class="form-label mb-0">Filter:</label>
                    <select name="filter" id="filter" class="form-select w-auto" onchange="this.form.submit()">
                        <option value="all" <?php echo e($filter == 'all' ? 'selected' : ''); ?>>All</option>
                        <option value="7days" <?php echo e($filter == '7days' ? 'selected' : ''); ?>>Last 7 Days</option>
                        <option value="30days" <?php echo e($filter == '30days' ? 'selected' : ''); ?>>Last 30 Days</option>
                        <option value="this_month" <?php echo e($filter == 'this_month' ? 'selected' : ''); ?>>This Month</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
    
        <!-- <div class="card">
            <div class="card-body">
                <h2 class="mb-0">Welcome to <?php echo e($settings->name); ?></h2>
            </div>
        </div> -->


    </div>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('dashboard_view')): ?>


<div class="row">
    
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-0">
                    <div class="bg-light-subtle border-top border-bottom border-light">
                        <div class="row text-center">

                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Expenses</p>
                                    <h3 class="my-3"> <span>৳ <?php echo e(number_format($totalExpenses, 2)); ?></span></h3>
                            </div>

                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i> Earning</p>
                                <h3 class="my-3"><span>৳ <?php echo e(number_format($totalAmount, 2)); ?></span></h3>                   
                            </div>

                            <div class="col">
                                <p class="text-muted mt-3"><i class="ri-donut-chart-fill"></i>Net Balance</p>
                                <h3 class="my-3"><span>৳ <?php echo e(number_format($totalProfit, 2)); ?></span></h3>
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



        
        <!-- <div class="col-md-3">
            <div class="card widget-icon-box">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="text-muted text-uppercase fs-13 mt-0">Expenses</h5>
                            <h3 class="my-3">৳ <?php echo e(number_format($totalExpenses, 2)); ?></h3>
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

    
    <!-- <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Payment</h5>
                        <h3 class="my-3">৳ <?php echo e(number_format($totalAmount, 2)); ?></h3>

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

    
    <!-- <div class="col-md-3">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0">Profit</h5>
                        <h3 class="my-3">৳ <?php echo e(number_format($totalProfit, 2)); ?></h3>
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


<div class="row mt-2">
    
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
                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($acc->name); ?></td>
                                <td><?php echo e($acc->number); ?></td>
                                <td><?php echo e($acc->brance->name ?? '-'); ?></td>
                                <td>৳ <?php echo e(number_format($acc->amount, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
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
                        <?php $__currentLoopData = $brances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $br): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($br['name']); ?></td>
                                <td>৳ <?php echo e(number_format($br['total_payment'], 2)); ?></td>
                                <td>৳ <?php echo e(number_format($br['total_expense'], 2)); ?></td>
                                <td class="<?php echo e($br['net_balance'] >= 0 ? 'text-success' : 'text-danger'); ?>">
                                    ৳ <?php echo e(number_format($br['net_balance'], 2)); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php endif; ?>

<script>
   var branchPieChartData = <?php echo json_encode($branchPieChart, 15, 512) ?>;
    const expensesData = <?php echo json_encode(array_values($expensesData), 15, 512) ?>;
    const paymentsData = <?php echo json_encode(array_values($paymentsData), 15, 512) ?>;
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\eaccounting\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>