<!DOCTYPE html>
<html lang="en">

<head>
    <?php $settings = app('App\Models\Setting'); ?>
    <?php
    $setting = $settings::find(1);
    ?>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($setting->name); ?></title>
    <link rel="icon" type="image/x-icon" href='<?php echo e(asset("assets/setting/$setting->favicon")); ?>'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- remix icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">


    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/admin/assets/images/apon_favicon.png')); ?>">

    <!-- Daterangepicker css -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/assets/vendor/daterangepicker/daterangepicker.css')); ?>">

    <!-- Vector Map css -->
    <link rel="stylesheet"
        href="<?php echo e(asset('assets/admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')); ?>">

    <!-- Theme Config Js -->
    <script src="<?php echo e(asset('assets/admin/assets/js/config.js')); ?>"></script>

    
    <link rel="stylesheet" href="<?php echo e(asset('assets/image_upload/dist/image-uploader.min.css')); ?>">


    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/cropper.css')); ?>">


    <!-- Datatables css -->
    <link href="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css')); ?>"
        rel="stylesheet" type="text/css" />
    <link
        href="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')); ?>"
        rel="stylesheet" type="text/css" />
    <link
        href="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')); ?>"
        rel="stylesheet" type="text/css" />
    <link
        href="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')); ?>"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')); ?>"
        rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')); ?>"
        rel="stylesheet" type="text/css" />

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- Include jQuery Confirm CSS (optional for styling) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">


    <!-- Quill css -->
    <link href="<?php echo e(asset('assets/admin/assets/vendor/quill/quill.core.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/assets/vendor/quill/quill.snow.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/admin/assets/vendor/quill/quill.bubble.css')); ?>" rel="stylesheet" type="text/css" />

    <!-- Flatpickr Timepicker css -->
    <link href="<?php echo e(asset('assets/admin/assets/vendor/flatpickr/flatpickr.min.css')); ?>" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Lightbox2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">



    <!-- Icons css -->
    <link href="<?php echo e(asset('assets/admin/assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />

    
    

    <!-- Select2 css -->
    <link href="<?php echo e(asset('assets/admin/assets/vendor/select2/css/select2.min.css')); ?>" rel="stylesheet"
        type="text/css" />


    <!-- App css -->
    <link href="<?php echo e(asset('assets/admin/assets/css/app.min.css')); ?>" rel="stylesheet" type="text/css" id="app-style" />
    
    
    <style>
        /* .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: #007bff !important;
            border-color: #006fe6 !important;
        } */

        .toast-success {
            background-color: #347433 !important;
        }
    </style>

    <style>
        .multi-line-truncate {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>


    <style>
        /* Custom styles for the upload button */
        .upload-btn {
            position: relative;
            overflow: hidden;
        }

        .upload-btn .fa-upload {
            margin-right: 8px;
        }
        .btn-success{
            background-color:rgb(51, 126, 49);
            color  : #fff;
        }
        .btn-success:hover {
            background-color:rgb(37, 94, 38);
            color: #fff;
        }
        .upload-btn{
            background-color:rgb(88, 94, 84)
        }
        .upload-btn:hover {
            background-color:rgb(55, 56, 54);
            /* Darker shade for hover */
            color: #fff;
        }
        .btn-primary{
            background-color:rgb(51, 126, 49);
            color  : #fff;
        }
        .btn-primary:hover {
            background-color:rgb(37, 94, 38);
            color: #fff;
        }

        /* Custom styles for the save button in modal */
        .save-btn {
            position: relative;
            overflow: hidden;
            color: #fff;
        }

        .save-btn .fa-save {
            margin-right: 8px;
        }

        .save-btn:hover {
            background-color: #347433;
            /* Darker shade for hover */
            color: #fff;
        }

        /* Style for attachment previews */
        .attachment-preview {
            position: relative;
        }

        .attachment-preview img {
            border-radius: 5px;
        }

        .attachment-preview .remove-preview {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.7);
            border: none;
            color: #fff;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 22px;
            cursor: pointer;
        }

        .attachment-preview .remove-preview:hover {
            background-color: rgba(255, 0, 0, 1);
        }

        .toast-error {
            background: rgba(255, 0, 0, 0.7) !important;
            color: #fff !important;
        }

        #toast-container>.toast-error {
            background-image: inherit !important;
        }


        .existing-attachment {
            width: 150px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 5px;
            background-color: #f8f9fa;
        }

        /* Ensure images fit within the container */
        .attachment-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* Style for PDF and other file icons */
        .attachment-icon {
            display: block;
            margin: 0 auto;
            padding-top: 10px;
        }

        /* Positioning and styling the delete button */
        .remove-existing-attachment {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(220, 53, 69, 0.9);
            /* Bootstrap danger color with transparency */
            border: none;
            color: #fff;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 20px;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
        }

        .remove-existing-attachment:hover {
            background-color: rgba(220, 53, 69, 1);
            /* Fully opaque on hover */
        }

        /* Attachment name styling */
        .attachment-name {
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Hover effect for attachment containers */
        .existing-attachment:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #e9ecef;
        }


        .attachment-container {
            width: 150px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 5px;
            background-color: #f8f9fa;
            position: relative;
        }

        .attachment-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .attachment-icon {
            display: block;
            margin: 10px auto 0 auto;
        }

        .attachment-name {
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }

        .remove-preview {
            background-color: rgba(220, 53, 69, 0.9);
            border: none;
            color: #fff;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            text-align: center;
            line-height: 20px;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
        }
        .remove-preview:hover {
            background-color: rgba(220, 53, 69, 1);
        }
        .attachment-container:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #e9ecef;
        }
        .heading-light {
            color: #000;
            font-size: 12px;
            padding: 15px 16px;
            margin-bottom: 0px !important;
            font-weight: bold;

        }

        .heading-dark {
            color: #fff;
            font-size: 12px;
            padding: 15px 16px;
            margin-bottom: 0px !important;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <div class="navbar-custom">
            <div class="topbar container-fluid">
                <div class="d-flex align-items-center gap-lg-2 gap-1">

                    <!-- Topbar Brand Logo -->
                    <div class="logo-topbar">
                        <!-- Logo light -->
                        <a href="<?php echo e(url('/panel/dashboard')); ?>" class="logo-light">
                            <h2 class="heading-dark">E-ACCOUNT</h2>
                            
                        </a>

                        <!-- Logo Dark -->
                        <a href="<?php echo e(url('/panel/dashboard')); ?>" class="logo-dark">
                            <h2 class="heading-light">E_ACCOUNT</h2>
                            
                        </a>
                    </div>

                    <!-- Sidebar Menu Toggle Button -->
                    <button class="button-toggle-menu">
                        <i class="ri-menu-2-fill"></i>
                    </button>

                    <!-- Horizontal Menu Toggle Button -->
                    <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </button>
                </div>

                <ul class="topbar-menu d-flex align-items-center gap-3">


                    <li class="d-none d-sm-inline-block">
                        <div class="nav-link" id="light-dark-mode">
                            <i class="ri-moon-fill fs-22"></i>
                        </div>
                    </li>


                    <li class="d-none d-md-inline-block">
                        <a class="nav-link" href="#" data-toggle="fullscreen">
                            <i class="ri-fullscreen-line fs-22"></i>
                        </a>
                    </li>

                    <li class="dropdown me-md-2">
                        <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-user-avatar">
                                <img src="<?php echo e(asset('assets/admin/assets/images/users/avatar-1.jpg')); ?>" alt="user-image"
                                    width="32" class="rounded-circle">
                            </span>
                            <span class="d-lg-flex flex-column gap-1 d-none">
                                <h5 class="my-0"><?php echo e(Auth::user()->name); ?></h5>
                                <h6 class="my-0 fw-normal"><?php echo e(Auth::user()->roles[0]->name ?? 'Student'); ?>

                                </h6>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a href="pages-profile.html" class="dropdown-item">
                                <i class="ri-account-circle-fill align-middle me-1"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a href="pages-profile.html" class="dropdown-item">
                                <i class="ri-settings-4-fill align-middle me-1"></i>
                                <span>Settings</span>
                            </a>

                            <!-- item-->
                            <a href="pages-faq.html" class="dropdown-item">
                                <i class="ri-customer-service-2-fill align-middle me-1"></i>
                                <span>Support</span>
                            </a>

                            <!-- item-->
                            <a href="auth-lock-screen.html" class="dropdown-item">
                                <i class="ri-lock-password-fill align-middle me-1"></i>
                                <span>Lock Screen</span>
                            </a>

                            <!-- item-->
                            <a href="#" class="dropdown-item d-flex align-items-center">
                                <i class="ri-logout-box-fill align-middle me-1"></i>

                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ========== Topbar End ========== -->

        <!-- ========== Left Sidebar Start ========== -->

        <div class="leftside-menu">
            <!-- Brand Logo Light -->
            <a href="<?php echo e(url('/panel/dashboard')); ?>" class="logo logo-light">
                <h2 class="heading-dark">
                    
                    E-ACCOUNT</h2>
                
            </a>

            <!-- Brand Logo Dark -->
            <a href="<?php echo e(url('/panel/dashboard')); ?>" class="logo logo-dark">
                <h2 class="heading-light">E-ACCOUNT</h2>
                
            </a>

            <!-- Sidebar Hover Menu Toggle Button -->
            <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
                <i class="ri-checkbox-blank-circle-line align-middle"></i>
            </div>

            <!-- Full Sidebar Menu Close Button -->
            <div class="button-close-fullsidebar">
                <i class="ri-close-fill align-middle"></i>
            </div>

            <!-- Sidebar -left -->
            <div class="h-100" id="leftside-menu-container" data-simplebar>
                <!-- Leftbar User -->
                <div class="leftbar-user p-3 text-white">
                    <a href="<?php echo e(url('/panel/dashboard')); ?>" class="d-flex align-items-center text-reset">
                        <div class="flex-shrink-0">
                            <img src="<?php echo e(asset('assets/admin/assets/images/users/avatar-1.jpg')); ?>" alt="user-image"
                                height="42" class="rounded-circle shadow">
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <span class="fw-semibold fs-15 d-block"><?php echo e(Auth::user()->name); ?></span>
                            <span class="fs-13"><?php echo e(Auth::user()->roles[0]->name ?? 'Admin'); ?></span>
                        </div>
                        
                    </a>
                </div>

                <!--- Sidemenu -->
                <ul class="side-nav">


                    <li class="side-nav-title mt-1"> Main</li>
                    <?php if(auth()->user()->role == 'student'): ?>
                    <li class="side-nav-item">
                        <a href="<?php echo e(url('/panel/studentD')); ?>" class="side-nav-link">
                            <i class="ri-dashboard-line"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <li class="side-nav-item">
                        <a href="<?php echo e(route('users.change-password')); ?>" class="side-nav-link">
                            <i class="ri-dashboard-2-line"></i>
                            <span> Change Password </span>
                        </a>
                    </li>
                    <?php else: ?>


                    <li class="side-nav-item">
                        <a href="<?php echo e(url('/panel/dashboard')); ?>" class="side-nav-link">
                           <i class="ri-dashboard-line"></i>
                            <span> Dashboard </span>
                        </a>
                    </li>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['account_view'])): ?>
                    <li class="side-nav-item">
                        <a href="<?php echo e(route('accounts.index')); ?>" class="side-nav-link d-flex align-items-center w-100 h-100">
                            <i class="ri-bank-line"></i> 
                            <span>Accounts</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['brance_view'])): ?>
                    <li class="side-nav-item">
                        <a href="<?php echo e(route('brances.index')); ?>" class="side-nav-link d-flex align-items-center w-100 h-100">
                            <i class="ri-building-2-line"></i> 
                            <span>Branches</span>
                        </a>
                    </li>
                    <?php endif; ?>


                    <!-- Expenses Section -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['expense_view', 'expense_add', 'expense_edit', 'expense_delete', 'expense_head_view', 'expense_head_add', 'expense_head_edit', 'expense_head_delete'])): ?>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#expensesmenu" aria-expanded="false" class="side-nav-link">
                            <i class="ri-money-dollar-circle-line"></i>
                            <span>Expenses</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="expensesmenu">
                            <ul class="side-nav-second-level">
                                <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_add')): ?>
                                <li><a href="<?php echo e(route('expenses.index')); ?>">Expenses</a></li>
                                <?php endif; ?> -->
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_add')): ?>
                                    <li><a href="<?php echo e(route('expenses.create')); ?>">Add Expense</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_view')): ?>
                                <li><a href="<?php echo e(route('expense.report')); ?>">Expense List</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_head_add')): ?>
                                <li><a href="<?php echo e(route('expense_heads.create')); ?>">Add Expense Head</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_head_view')): ?>
                                <li><a href="<?php echo e(route('expense_heads.index')); ?>">All Expense  Head</a></li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </li>
                    <?php endif; ?>

                    <!-- Payments Section -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['payment_view', 'payment_add', 'payment_edit', 'payment_delete', 'purpose_view', 'purpose_add', 'purpose_edit', 'purpose_delete'])): ?>
                    <li class="side-nav-item">
                        <a data-bs-toggle="collapse" href="#paymentsmenu" aria-expanded="false" class="side-nav-link">
                            <i class="ri-bank-card-line"></i>
                            <span>Earnings</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="paymentsmenu">
                            <ul class="side-nav-second-level">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['payment_add', 'payment_view'])): ?>
                                <li><a href="<?php echo e(route('payments.index')); ?>">Add Earning</a></li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('payment_view')): ?>
                                <li><a href="<?php echo e(route('payments.report')); ?>">Earning Report</a></li>
                                <?php endif; ?>
                               
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['purpose_view', 'purpose_add', 'purpose_edit', 'purpose_delete'])): ?>
                                <li><a href="<?php echo e(route('purposes.index')); ?>">Purposes</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </li>
                    <?php endif; ?>


                    <!-- Role manager -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['role_view'])): ?>
                    <li class="side-nav-item">
                        <a href="<?php echo e(route('roles.index')); ?>" class="side-nav-link d-flex align-items-center w-100 h-100">
                            <i class="ri-user-shared-line"></i>
                            <span>Role Manager</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Permissions -->
                    <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['permission_view'])): ?>
                    <li class="side-nav-item">
                        <a href="<?php echo e(route('permissions.index')); ?>" class="side-nav-link d-flex align-items-center w-100 h-100">
                            <i class="ri-key-line"></i>
                            <span>Permissions</span>
                        </a>
                    </li>
                    <?php endif; ?> -->

                    <!-- Users -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['user_view'])): ?>
                    <li class="side-nav-item">
                        <a href="<?php echo e(route('users.index')); ?>" class="side-nav-link d-flex align-items-center w-100 h-100">
                            <i class="ri-user-line"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <?php endif; ?>

                    
                    <!-- Setting  Section -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['setting_view'])): ?>
                    <li class="side-nav-item">
                        <a href="<?php echo e(route('setting.index')); ?>" class="side-nav-link d-flex align-items-center w-100 h-100">
                             <i class="ri-settings-line"></i>
                            <span>Setting</span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>


        <!-- Trush Section
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#trush" aria-expanded="false" aria-controls="sidebarTasks"
                    class="side-nav-link">
                    <i class="ri-notification-3-line"></i>
                    <span>Trush</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="trush">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="#">Trush Notice</a>
                        </li>
                    </ul>
                </div>
            </li> -->


                </ul>
                <!--- End Sidemenu -->

                <div class="clearfix"></div>
            </div>
        </div>

        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <?php echo $__env->yieldContent('content'); ?>

                </div>
                <!-- container -->

            </div>
            <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © <a href="https://rafusoft.com" target="_blank">Rafusoft</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
            <h5 class="text-white m-0">Theme Settings</h5>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            <div data-simplebar class="h-100">
                <div class="card mb-0 p-3">
                    <div class="alert alert-warning" role="alert">
                        <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                    </div>

                    <h5 class="mt-0 fs-16 fw-bold mb-3">Choose Layout</h5>
                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input id="customizer-layout01" name="data-layout" type="checkbox" value="vertical"
                                class="form-check-input">
                            <label class="form-check-label" for="customizer-layout01">Vertical</label>
                        </div>
                        <div class="form-check form-switch">
                            <input id="customizer-layout02" name="data-layout" type="checkbox" value="horizontal"
                                class="form-check-input">
                            <label class="form-check-label" for="customizer-layout02">Horizontal</label>
                        </div>
                    </div>

                    <h5 class="my-3 fs-16 fw-bold">Color Scheme</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light"
                                value="light">
                            <label class="form-check-label" for="layout-color-light">Light</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark"
                                value="dark">
                            <label class="form-check-label" for="layout-color-dark">Dark</label>
                        </div>
                    </div>

                    <div id="layout-width">
                        <h5 class="my-3 fs-16 fw-bold">Layout Mode</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                    id="layout-mode-fluid" value="fluid">
                                <label class="form-check-label" for="layout-mode-fluid">Fluid</label>
                            </div>

                            <div id="layout-boxed">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                        id="layout-mode-boxed" value="boxed">
                                    <label class="form-check-label" for="layout-mode-boxed">Boxed</label>
                                </div>
                            </div>

                            <div id="layout-detached">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                        id="data-layout-detached" value="detached">
                                    <label class="form-check-label" for="data-layout-detached">Detached</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h5 class="my-3 fs-16 fw-bold">Topbar Color</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color"
                                id="topbar-color-light" value="light">
                            <label class="form-check-label" for="topbar-color-light">Light</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color"
                                id="topbar-color-dark" value="dark">
                            <label class="form-check-label" for="topbar-color-dark">Dark</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-topbar-color"
                                id="topbar-color-brand" value="brand">
                            <label class="form-check-label" for="topbar-color-brand">Brand</label>
                        </div>
                    </div>

                    <div>
                        <h5 class="my-3 fs-16 fw-bold">Menu Color</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color"
                                    id="leftbar-color-light" value="light">
                                <label class="form-check-label" for="leftbar-color-light">Light</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color"
                                    id="leftbar-color-dark" value="dark">
                                <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-menu-color"
                                    id="leftbar-color-brand" value="brand">
                                <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-size">
                        <h5 class="my-3 fs-16 fw-bold">Sidebar Size</h5>

                        <div class="d-flex flex-column gap-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-default" value="default">
                                <label class="form-check-label" for="leftbar-size-default">Default</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-compact" value="compact">
                                <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-small" value="condensed">
                                <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-small-hover" value="sm-hover">
                                <label class="form-check-label" for="leftbar-size-small-hover">Hover View</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-full" value="full">
                                <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                    id="leftbar-size-fullscreen" value="fullscreen">
                                <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen
                                    Layout</label>
                            </div>
                        </div>
                    </div>

                    <div id="layout-position">
                        <h5 class="my-3 fs-16 fw-bold">Layout Position</h5>

                        <div class="btn-group checkbox" role="group">
                            <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed"
                                value="fixed">
                            <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                            <input type="radio" class="btn-check" name="data-layout-position"
                                id="layout-position-scrollable" value="scrollable">
                            <label class="btn btn-soft-primary w-sm ms-0"
                                for="layout-position-scrollable">Scrollable</label>
                        </div>
                    </div>

                    <div id="sidebar-user">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <label class="fs-16 fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="sidebar-user"
                                    id="sidebaruser-check">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="offcanvas-footer border-top p-3 text-center">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                </div>
                <div class="col-6">
                    <a href="#" role="button" class="btn btn-primary w-100">Buy Now</a>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>

    <!-- Vendor js -->
    <script src="<?php echo e(asset('assets/admin/assets/js/vendor.min.js')); ?>"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    
    
    <!--  Select2 Plugin Js -->
    <script src="<?php echo e(asset('assets/admin/assets/vendor/select2/js/select2.min.js')); ?>"></script>

    
    <script type="text/javascript" src="<?php echo e(asset('assets/image_upload/dist/image-uploader.min.js')); ?>"></script>

    
    
    <script src="https://unpkg.com/cropperjs@1.6.1/dist/cropper.js"></script>
    <script src="<?php echo e(asset('assets/dist/js/cropper.js')); ?>"></script>


    <!-- Datatables js -->
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js')); ?>">
    </script>
    <script
        src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js')); ?>">
    </script>
    <script
        src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js')); ?>">
    </script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')); ?>">
    </script>
    <script
        src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js')); ?>">
    </script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-buttons/js/buttons.print.min.js')); ?>"></script>
    <script
        src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/datatables.net-select/js/dataTables.select.min.js')); ?>"></script>

    <!-- DataTables Buttons Extension JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

    <!-- Buttons ColVis JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>


    <!-- Daterangepicker js -->
    <script src="<?php echo e(asset('assets/admin/assets/vendor/daterangepicker/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/admin/assets/vendor/daterangepicker/daterangepicker.js')); ?>"></script>

    <!-- Apex Charts js -->
    <script src="<?php echo e(asset('assets/admin/assets/vendor/apexcharts/apexcharts.min.js')); ?>"></script>

    <!-- Vector Map js -->
    <script
        src="<?php echo e(asset('assets/admin/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')); ?>">
    </script>
    <script
        src="<?php echo e(asset('assets/admin/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js')); ?>">
    </script>

    <!-- Quill Editor js -->
    <script src="<?php echo e(asset('assets/admin/assets/vendor/quill/quill.min.js')); ?>"></script>

    <!-- Quill Demo js -->
    

    <!-- Include jQuery Confirm plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>

    <!-- Bootstrap Wizard Form js -->
    <script src="<?php echo e(asset('assets/admin/assets/vendor/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')); ?>">
    </script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <!-- Dashboard App js -->
    

    <!-- Lightbox2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <!-- Flatpickr Timepicker Plugin js -->
    <script src="<?php echo e(asset('assets/admin/assets/vendor/flatpickr/flatpickr.min.js')); ?>"></script>



    <!-- App js -->
    <script src="<?php echo e(asset('assets/admin/assets/js/app.min.js')); ?>"></script>



    <?php if(session()->has('success')): ?>
    <script>
        toastr.success("<?php echo e(session()->get('success')); ?>");
    </script>
    <?php endif; ?>

    <?php if(session()->has('error')): ?>
    <script>
        toastr.error("<?php echo e(session()->get('error')); ?>");
    </script>
    <?php endif; ?>

    <?php if(session()->has('warning')): ?>
    <script>
        toastr.info("<?php echo e(session()->get('warning')); ?>");
    </script>
    <?php endif; ?>
    <!-- Apexcharts -->
    <script src="<?php echo e(asset('assets/admin/assets/vendor/apexcharts/apexcharts.min.js')); ?>"></script>


<script>

// Column Chart
        var colors = ["#F65B4C", "#4254BA"];
        var dataColors = $("#basic-column").data("colors");

        var options = {
            chart: {
                height: 314,
                type: "bar",
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: "rounded",
                    columnWidth: "60%"
                }
            },
            dataLabels: { enabled: false },
            stroke: {
                show: true,
                width: 1,
                colors: ["transparent"]
            },
            colors: dataColors ? dataColors.split(",") : colors,
            series: [
                {
                    name: "Expenses",
                    data: expensesData
                },
                {
                    name: "Earning",
                    data: paymentsData
                }
            ],
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                labels: {
                    rotate: -45,
                    hideOverlappingLabels: false,
                    trim: false,
                    style: { fontSize: '12px' }
                }
            },
            legend: { offsetY: 5 },
            fill: { opacity: 1 },
            grid: {
                row: {
                    colors: ["transparent", "transparent"],
                    opacity: 0.2
                },
                borderColor: "#f1f3fa",
                padding: { bottom: 5 }
            },
            
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "৳ " + val.toFixed(2);
                    }
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#basic-column"), options);
        chart.render();




   /// Pie Chart (Expense vs Earning)
    document.addEventListener("DOMContentLoaded", function () {
    var pieColors = $("#simple-pie").data("colors");
    var defaultColors = ['#4254ba', '#6c757d', '#17a497', '#fa5c7c', '#f06548'];

    const labels = branchPieChartData.map(item => item.name);
    const series = branchPieChartData.map(item => item.value);

    var pieOptions = {
        chart: {
            height: 360,
            type: 'pie',
        },
        series: series,
        labels: labels,
        colors: pieColors ? pieColors.split(",") : defaultColors,
        legend: {
            position: 'bottom',
            horizontalAlign: 'center',
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "৳ " + val.toLocaleString();
                }
            }
        }
    };

    var pieChart = new ApexCharts(document.querySelector("#simple-pie"), pieOptions);
    pieChart.render();
});

</script>


    <?php echo $__env->yieldContent('scripts'); ?>

</body>

</html><?php /**PATH C:\laragon\www\eaccounting\resources\views/layouts/admin_master.blade.php ENDPATH**/ ?>