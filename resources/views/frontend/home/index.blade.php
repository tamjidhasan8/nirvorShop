@extends('frontend.layouts.app')

@section('contents')
    <!--Start Hero Slider-->
    @include('frontend.home.sections.hero-section')
    <!--End hero slider-->

    <!--Start category slider-->
    @include('frontend.home.sections.category-section')
    <!--End category slider-->

    <!--Start banners-->
    @include('frontend.home.sections.banner-section')
    <!--End banners-->

    <!--Start Products Tabs-->
    @include('frontend.home.sections.products-tab-section')
    <!--End Products Tabs-->

    <!--Start 4 banners-->
    @include('frontend.home.sections.banner-section-two')
    <!--End 4 banners-->

    <!--Start Best Sales-->
    @include('frontend.home.sections.flash-sale-section')
    <!--End Best Sales-->

    <!--Start new arrival -->
    @include('frontend.home.sections.new-arrival-section')
    <!--End new arrival -->

    <!-- Start CTA section-->
    <section class="wsus__ctg mt-40">
        <div class="container">
            <a href="#" class="wsus__ctg_area">
                <img src="{{ asset('/') }}assets/frontend/dist/imgs/cta_bg.png" alt="cta" class="img-fluid w-100" />
            </a>
        </div>
    </section>
    <!--End CTA section -->

    <!-- special products start -->
    @include('frontend.home.sections.special-products-section')
    <!-- special products end -->

    <!--Start 4 columns-->
    @include('frontend.home.sections.four-col-products-section')
    <!--End 4 columns-->

@endsection
