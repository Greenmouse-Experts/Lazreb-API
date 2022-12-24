<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="link-ft">
                    <h4>Join our mailing list</h4>
                    <div class="line-rule mb-3"></div>
                    <P>
                        <a>Subscribe to our newsletter and be the first to recieve emails on our latest updates and offers</a>
                    </P>
                    <div class="box input-box">
                        <form></form>
                        <div><input type="text" required placeholder="Enter your email"></div>
                        <div><input type="button" value="Subscribe"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <div class="link-ft">
                    <div class="control">
                    <h4>Quick Link</h4>
                    <div class="line-rule mb-3"></div>
                    <p>
                        <a href="{{ route('index')}}">Home</a>
                    </p>
                    <p>
                        <a href="{{ route('about')}}">About us</a>
                    </p>
                    <p>
                        <a href="{{ route('services')}}">Our Services</a>
                    </p>
                    <p>
                        <a href="{{ route('faqs')}}">FAQs</a>
                    </p>
                    
                    <p><a href="{{ route('contact')}}">Contact us</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="link-ft">
                    <h4>Contact Us</h4>
                    <div class="line-rule mb-3"></div>
                    <p><a>106, Isawo Road, Agric Bus Stop, Owutu, Ikorodu, Lagos State.</a></p>
                    <p><a>Branch office at 12, Alhaja Senabu Street, Akute, Ogun State.</a></p>
                    <p>
                        support@lazrebleasinglogistics.com
                    </p>
                    <div class="main-ft">
                        <div class="social">
                            <a href="#" target="_blank" title="Like us on Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" target="_blank" title="Follow us on telegram"><i class="bi bi-telegram"></i></a>
                            <a href="#" target="_blank" title="Follow us on Twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" target="_blank" title="Follow us on Instagram"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container copyright">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p>
                    <a href="{{ route('terms')}}">Terms & Conditions</a> | <span><a href="{{ route('policy')}}">Privacy Policy</a></span>
                </p>
                <p>
                    &copy; 2022 {{config('app.name')}} - All Rights Reserved. <a href="https://greenmousetech.com/">Site Credit</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Ends -->