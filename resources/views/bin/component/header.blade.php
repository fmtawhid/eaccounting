<header>
    <link href="{{ asset('backend/toast-alert/toastr.css') }}" rel="stylesheet"/>
    <script src="{{ asset('backend/toast-alert/toastr.js') }}"></script>

    <style type="text/css">
        form .form-bottom button.btn {
            min-width: 105px;
        }

        form .form-bottom .input-error {
            border-color: #d03e3e;
            color: #d03e3e;
        }

        form.gauthenticate-form {
            display: none;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-5">
                <a class="logo d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/logoM.png') }}" alt="" class="mr-2"> 
                    <!--
                    <div class="logo-text" style="
                        font-size: 30px;
                        color: #e10049;
                        margin-left: 20px;
                    ">তা’লীমুল ইসলাম স্কুল ও মাদ্রাসা</div>
    -->
                </a>

            </div><!--./col-md-4-->
            <div class="col-md-9 col-sm-7">
            <ul class="header-extras">
            <li><i class="fa fa-phone i-plain"></i><div class="he-text">কল করুন <span style="font-weight:300;">০১৩২২৯২৬৮৪৩</span></div></li>

            

            <!-- Login / Logout Button -->
            <li>
                <a class="complainbtn" href="#">Login</a>
            </li>
        </ul>

            </div><!--./col-md-8-->
        </div><!--./row-->
    </div><!--./container-->
    
    <div class="navborder">
        <div class="container">
            <div class="row">
                <nav class="navbar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse" id="navbar-collapse-3">
                        <!-- Main Menu -->
                        <ul class="nav navbar-nav">
                            <!-- Menu Item 1 -->
                            <li class="active">
                                <a href="#"> হোম পেইজ </a>
                            </li>

                            <!-- Menu Item 2 -->
                            <li>
                                <a href="#">আমাদের সম্পর্কে </a>
                            </li>

                            <!-- Menu Item 3 with Submenu
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">ক্লাস সেকশন <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">নুরানী </a></li>
                                    <li><a href="#">Mobile Development</a></li>
                                    <li><a href="#">SEO Services</a></li>
                                </ul>
                            </li>
                             -->

                            <!-- Menu Item 4 -->
                            <li>
                                <a href="#">যোগাযোগ করুন </a>
                            </li>

                            
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav><!-- /.navbar -->
            </div>
        </div>   
    </div>

</header>

<!---   Guest Signup  --->
<div id="myModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header-small">
                <button type="button" class="close closebtnmodal" data-dismiss="modal">&times;</button>
                <h4>{{ __('guest_registration') }}</h4>
            </div>
            <form action="{{ url('course/guestsignup') }}" method="post" class="signupform" id="signupform">
                <!-- Form Content -->
            </form>
        </div>
    </div>
</div>
<!-- End Guest Signup -->
