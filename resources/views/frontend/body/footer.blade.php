<style>
    .form-control {
        border-radius: 0px;
    }

    .form-group input {
        height: 45px !important;
    }

    button.submit,
    button[type="submit"] {
        padding: 5px 20px;
        border-radius: 0px;
    }
</style>
<footer class="main footer-dark">
    <section class="newsletter mb-15 wow animate__animated animate__fadeIn d-none d-md-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner">
                        <div class="newsletter-content">
                            <h2 class="mb-20">
                                @if (get_footer_banner())
                                    @if (session()->get('language') == 'bangla')
                                        {{ get_footer_banner()->title_bn }}
                                    @else
                                        {{ get_footer_banner()->title_en }}
                                    @endif
                                @endif
                            </h2>
                            <p class="mb-110">
                                @if (get_footer_banner())
                                    @if (session()->get('language') == 'bangla')
                                        <?php $b_description_bn = strip_tags(html_entity_decode(get_footer_banner()->description_bn)); ?>
                                        {{ Str::limit($b_description_bn, $limit = 30, $end = '. . .') }}
                                    @else
                                        <?php $b_description_en = strip_tags(html_entity_decode(get_footer_banner()->description_en)); ?>
                                        {{ Str::limit($b_description_en, $limit = 30, $end = '. . .') }}
                                    @endif
                                @endif
                                {{-- <span class="text-brand">eStore Classic</span> --}}
                            </p>
                            <form class="form-subcriber d-flex" method="POST"
                                action="{{ route('subscribers.store') }}">
                                @csrf
                                <input type="email" placeholder="Your emaill address" required="" name="email" />
                                <button class="btn" type="submit">Subscribe</button>
                            </form>
                        </div>
                        @if (get_footer_banner())
                            <img src="{{ asset(get_footer_banner()->banner_img) }}" alt="newsletter" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="featured section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="banner-icon">
                            <img src="{{asset('frontend/assets/imgs/theme/icons/icon-1.svg')}}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Best prices & offers</h3>
                            <p>Orders $50 or more</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                        <div class="banner-icon">
                            <img src="{{asset('frontend/assets/imgs/theme/icons/icon-2.svg')}}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Free delivery</h3>
                            <p>24/7 amazing services</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                        <div class="banner-icon">
                            <img src="{{asset('frontend/assets/imgs/theme/icons/icon-3.svg')}}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Great daily deal</h3>
                            <p>When you sign up</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                        <div class="banner-icon">
                            <img src="{{asset('frontend/assets/imgs/theme/icons/icon-4.svg')}}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Wide assortment</h3>
                            <p>Mega Discounts</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                        <div class="banner-icon">
                            <img src="{{asset('frontend/assets/imgs/theme/icons/icon-5.svg')}}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Easy returns</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp" data-wow-delay=".5s">
                        <div class="banner-icon">
                            <img src="{{asset('frontend/assets/imgs/theme/icons/icon-6.svg')}}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Safe delivery</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="section-padding footer-mid dark-section main-footer-custom">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-6 col-12">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp"
                        data-wow-delay="0">
                        <div class="logo mb-30">
                            <a href="{{ route('home') }}" class="mb-15">
                                @php
                                    $logo = get_setting('site_footer_logo');
                                @endphp
                                @if ($logo != null)
                                    <img src="{{ asset(get_setting('site_footer_logo')->value ?? 'null') }}"
                                        alt="{{ env('APP_NAME') }}" class="w-50">
                                @else
                                    <img src="{{ asset('upload/no_image.jpg') }}" alt="{{ env('APP_NAME') }}"
                                        style="height: 60px !important; width: 80px !important; min-width: 80px !important;">
                                @endif
                            </a>

                            {{-- <div class="fb-page" data-href="https://www.facebook.com/ifradmall?mibextid=ZbWKwL" data-tabs="timeline" data-width="290" data-height="130" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/ifradmall?mibextid=ZbWKwL" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/ifradmall?mibextid=ZbWKwL">IFRAD</a></blockquote>
                           </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6 col-md-9 col-12">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-6">
                            <div class="footer-link-widget wow animate__animated animate__fadeInUp"
                                data-wow-delay=".2s">
                                <h4 class="widget-title">Account</h4>
                                <ul class="footer-list mb-sm-5 mb-md-0">
                                    <li><a href="{{ route('login') }}">Sign In</a></li>
                                    <li><a href="{{ route('cart.show') }}">View Cart</a></li>
                                    <li><a href="{{ route('resellerapply.page') }}">Apply as Reseller</a></li>
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#vendor_service"
                                            class="vendorBtn">Become a Vendor</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-6">
                            <div class="footer-link-widget wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s">
                                <h4 class="widget-title">Company</h4>
                                <ul class="footer-list mb-sm-5 mb-md-0">
                                    @foreach (get_pages_both_footer() as $page)
                                        <li>
                                            <a href="{{ route('page.about', $page->slug) }}">
                                                {{ $page->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="ms-xl-auto col-md-5 col-12 mr-0">
                            <div class="footer-link-widget wow animate__animated animate__fadeInUp"
                                data-wow-delay=".1s">
                                <h4 class="widget-title">Contact Info</h4>
                                <ul class="contact-infor">
                                    <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                            alt="" /><strong>Address: </strong>
                                        <span>{{ get_setting('business_address')->value ?? 'null' }}</span></li>
                                    <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                            alt="" /><strong>Call Us: </strong><a
                                            href="tel:{{ get_setting('phone')->value ?? 'null' }}">{{ get_setting('phone')->value ?? 'null' }}</a>
                                    </li>
                                    <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}"
                                            alt="" /><strong>Email: </strong><a
                                            href="mailto:{{ get_setting('email')->value ?? 'null' }}">{{ get_setting('email')->value ?? 'null' }}</a>
                                    </li>
                                    <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-clock.svg') }}"
                                            alt="" /><strong>Hours:</strong><span>
                                            {{ get_setting('business_hours')->value ?? 'null' }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="pb-30 wow animate__animated animate__fadeInUp dark-section" data-wow-delay="0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <p class="font-sm mb-0">&copy; {{ get_setting('copy_right')->value ?? 'null' }}<br />All rights
                        reserved</p>
                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">
                    <div class="mobile-social-icon justify-content-center">
                        <h6>Follow Us</h6>
                        <a target="_blank" href="{{ get_setting('facebook_url')->value ?? 'null' }}"><img
                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                                alt="" /></a>
                        <a target="_blank" href="{{ get_setting('twitter_url')->value ?? 'null' }}"><img
                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                                alt="" /></a>
                        <a target="_blank" href="{{ get_setting('instagram_url')->value ?? 'null' }}"><img
                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                                alt="" /></a>
                        <a target="_blank" href="{{ get_setting('pinterest_url')->value ?? 'null' }}"><img
                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                                alt="" /></a>
                        <a target="_blank" href="{{ get_setting('youtube_url')->value ?? 'null' }}"><img
                                src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                                alt="" /></a>
                    </div>
                    <p class="font-sm">
                        Developed by:
                        <a target="_blank" href="https://classicit.com.bd/">Classic IT & Sky Mart Ltd</a>
                    </p>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <a href="#">
                        <img class="" src="{{ asset('frontend/assets/imgs/theme/payment-method.png') }}"
                            alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp
<div class="nest-mobile-bottom-nav d-xl-none mobile_fixed_bottom bg-white shadow-lg border-top rounded-top"
    style="box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
    <div class="row align-items-center gutters-5">
        <div class="col mobile_bottom_nav_col">
            <a href="{{ route('home') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="fas fa-home fs-20 opacity-60 opacity-100 {{ $route == 'home' ? 'text-brand' : '' }}"></i>
                <span class="d-block fs-10 fw-600">Home</span>
            </a>
        </div>
        <div class="col mobile_bottom_nav_col">
            <a href="{{ route('product.show') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-inline-block position-relative px-2">
                    <i
                        class="fa-sharp fa-solid fa-bag-shopping {{ $route == 'product.show' ? 'text-brand' : '' }}"></i>
                </span>
                <span class="d-block fs-10 fw-600">Shop</span>
            </a>
        </div>
        <div class="col-auto">
            <a href="{{ route('cart.show') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="mobile-card-nav align-items-center d-flex justify-content-center position-relative"
                    style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                    <i class="fa-solid fa-cart-shopping la-2x text-white"></i>
                </span>
                <span class="d-block mt-1 fs-10 fw-600">
                    Cart
                    (<span class="cart-count cartQty"></span>)
                </span>
            </a>
        </div>
        <div class="col mobile_bottom_nav_col">
            <a href="{{ route('category_list.index') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i
                    class="fas fa-list-ul fs-20 opacity-60 {{ $route == 'category_list.index' ? 'text-brand' : '' }}"></i>
                <span class="d-block fs-10 fw-600">Categories</span>
            </a>
        </div>
        <div class="col mobile_bottom_nav_col">
            @if (Auth()->check())
                <a href="{{ route('dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        <img src="{{ asset('frontend/assets/imgs/avatar-place.png') }}"
                            class="rounded-circle mobile_bottom_nav_account">
                    </span>
                    <span class="d-block fs-10 fw-600">Account</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="text-reset d-block text-center pb-2 pt-3">
                    <span class="d-block mx-auto">
                        <img src="{{ asset('frontend/assets/imgs/avatar-place.png') }}"
                            class="rounded-circle mobile_bottom_nav_account">
                    </span>
                    <span class="d-block fs-10 fw-600">Login</span>
                </a>
            @endif
        </div>
    </div>
</div>

<!-- vendor Modal form -->
<div class="modal fade" id="vendor_service" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Vendor Apply Form</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('vendor.Sellerstore') }}" enctype="multipart/form-data">
                    @csrf
                    <h6 class="mb-2 border-bottom pb-2">Basic Information</h6>
                    <div class="form-group">
                        <label for="name"><strong>Name: </strong><span class="text-danger">*</span></label>
                        <input type="text" id="vendor_name" name="vendor_name" class="form-control"
                            placeholder="Enter Your Name" value="{{ old('vendor_name') }}">
                        @error('vendor_name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone"><strong>Phone Number: </strong><span
                                        class="text-danger">*</span></label>
                                <input type="text" id="phone" name="phone" class="form-control"
                                    placeholder="Enter Your Phone Number" value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email"><strong>Email: </strong><span
                                        class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="Enter Your Email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mb-4">
                                    <img id="showImage3" class="rounded avatar-lg"
                                        src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/no_image.jpg') }}"
                                        alt="Card image cap" width="100px" height="80px;">
                                </div>
                                <label for="nid"><strong>Nid Card: </strong> <span
                                        class="text-danger">*</span></label>
                                <input name="nid" class="form-control" type="file" id="image3">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mb-4">
                                    <img id="showImage4" class="rounded avatar-lg"
                                        src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/no_image.jpg') }}"
                                        alt="Card image cap" width="100px" height="80px;">
                                </div>
                                <label for="trade"><strong>Trade License(if any one have): </strong></label>
                                <input name="trade_license" class="form-control" type="file" id="image4">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password"><strong>Password : </strong><span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="password" type="password" name="password"
                                    placeholder="Enter Your Password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cpassword"><strong>Confirm Password : </strong><span
                                        class="text-danger">*</span></label>
                                <input class="form-control" placeholder="Confirm Password" type="password"
                                    name="password_confirmation" id="rtpassword" />
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <h6 class="mb-2 border-bottom pb-2">Shop Information</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="shopname"><strong>Shop Name : </strong><span
                                        class="text-danger">*</span></label>
                                <input class="form-control" id="shop_name" type="text" name="shop_name"
                                    placeholder="Write vendor shop name" value="{{ old('shop_name') }}">
                                @error('shop_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address"><strong>Address : </strong></label>
                                <input class="form-control" id="address" type="text" name="address"
                                    placeholder="Enter Your Address" value="{{ old('address') }}">
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mb-4">
                                    <img id="showImage1" class="rounded avatar-lg"
                                        src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/no_image.jpg') }}"
                                        alt="Card image cap" width="100px" height="80px;">
                                </div>
                                <label for="image"><strong>Shop Profile : </strong></label>
                                <input name="shop_profile" class="form-control" type="file" id="image1">
                                @error('shop_profile')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="mb-4">
                                    <img id="showImage2" class="rounded avatar-lg"
                                        src="{{ !empty($editData->profile_image) ? url('upload/admin_images/' . $editData->profile_image) : url('upload/no_image.jpg') }}"
                                        alt="Card image cap" width="100px" height="80px;">
                                </div>
                                <label for="image"><strong>Shop Cover Photo : </strong></label>
                                <input name="shop_cover" class="form-control" type="file" id="image2">
                                @error('shop_cover')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="shop"><strong>Bank Information</strong></label>
                        <textarea name="bank_information" id="bank_information" cols="30" rows="5" class="form-control"
                            placeholder="Enter Bank Information"></textarea>
                    </div>
                    <button type="submit" class="additional_menuBtn">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
