@extends('layouts.frontend')

@section('page-content')
<!-- Welcome Page -->
<!--Breadcrumb-->
<section class="Breadcrumb" style="background-image: linear-gradient(90deg,  #1d1d1d9a, #1d1d1d9a, #1a223ba2), url(https://res.cloudinary.com/greenmouse-tech/image/upload/v1671549922/lazreb/bread-faq_nal74q.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>FAQs</h1>
                <p><a href="{{ route('index')}}">Home</a> <i class="bi bi-arrow-left-right"></i> FAQs</p>
            </div>
        </div>
    </div>
</section>
<!--Breadcrumb Ends-->

<!--FAQ Page-->
<main class="faqPage">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2>FAQ</h2>
                <div class="line-rule"></div>
            </div>
            <div class="col-lg-10">
                <div class="faq-box">
                    <details>
                        <summary>How can i rent a car</summary>
                        <div class="faq-content">
                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi doloribus amet recusandae odit quam magni, assumenda deleniti quisquam nihil explicabo adipisci, sed officia mollitia fuga! Magni eum placeat exercitationem totam.</p>
                        </div>
                    </details>
                    <details>
                        <summary>Is there refund for failed delivery?</summary>
                        <div class="faq-content">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia animi fuga maiores ea commodi nihil adipisci quod quasi tempore vitae. Architecto alias doloremque, corporis modi sed omnis itaque animi voluptate!</p>
                        </div>
                    </details>
                    <details>
                        <summary>Can I lease my personal vehicle?</summary>
                        <div class="faq-content">
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repudiandae assumenda ipsam, asperiores commodi nemo vel perspiciatis iste accusamus reprehenderit totam sapiente laboriosam doloribus recusandae saepe nobis amet minima animi consequatur?</p>
                        </div>
                    </details>
                    <details>
                        <summary>How long does delivery take?</summary>
                        <div class="faq-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat aperiam explicabo magni, sunt sapiente sint provident alias autem expedita molestiae facere, voluptatum voluptate minima dolor magnam doloribus quae. Nesciunt, ducimus.</p>
                        </div>
                    </details>

                </div>
            </div>
        </div>
    </div>
</main>

@endsection