<footer>
    <div class="container spacet40 spaceb40">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <h3 class="fo-title">লিঙ্কসমূহ</h3>
                <ul class="f1-list">
                    <li>
                        <a href="#">হোম</a>
                    </li>
                    <li>
                        <a href="#">আমাদের সম্পর্কে</a>
                    </li>
                    <li>
                        <a href="#">সেবাসমূহ</a>
                    </li>
                    <li>
                        <a href="#">যোগাযোগ</a>
                    </li>
                </ul>
            </div><!--./col-md-4-->

            <div class="col-md-4 col-sm-6">
                <h3 class="fo-title">আমাদের অনুসরণ করুন</h3>
                <ul class="company-social">
                    <li><a href="#" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>    
                    <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>  
                    <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>    
                    <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="#" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div><!--./col-md-4-->

            <div class="col-md-4 col-sm-6">
                <h3 class="fo-title">প্রতিক্রিয়া</h3>
                <div class="complain">
                    <a href="complain.php"><i class="fa fa-pencil-square-o i-plain"></i>অভিযোগ</a>
                </div>
            </div><!--./col-md-4-->
        </div><!--./row-->
        <div class="row">
            <div class="col-md-12">
                <div class="infoborderb"></div>
                <div class="col-md-4">
                    <div class="contacts-item">
                        <div class="cleft"><i class="fa fa-phone"></i></div>
                        <div class="cright">
                            <a href="#" class="content-title">যোগাযোগ</a>
                            <p class="content-title">০১৩২২৯২৬৮৪৩</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contacts-item">
                        <div class="cleft"><i class="fa fa-envelope"></i></div>
                        <div class="cright">
                            <a href="#" class="content-title">ইমেইল করুন</a>
                            <p><a href="mailto:info@example.com" class="content-title">talimulislamdnj@gmail.com</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contacts-item">
                        <div class="cleft"><i class="fa fa-map-marker"></i></div>
                        <div class="cright">
                            <a href="#" class="content-title">ঠিকানা</a>
                            <p class="sub-title">ঈদগাহ, আ/এ, সি, এন্ড বি, রোড সংলগ্ন, সদর, দিনাজপুর</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--./row-->
    </div><!--./container-->
</footer>

<div class="copy-right">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
                <p>&copy; 2024 সর্বস্বত্ব সংরক্ষিত</p>
            </div>
        </div><!--./row-->
    </div><!--./container-->
</div><!--./copy-right-->

<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

<script>
    function setsitecookies() {
        // Dummy function
        $('.cookieConsent').hide();
    }

    function check_cookie_name(name) {
        var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
        if (match) {
            console.log(match[2]);
            $('.cookieConsent').hide();
        }
        else {
            $('.cookieConsent').show();
        }
    }
    check_cookie_name('sitecookies');
</script>
