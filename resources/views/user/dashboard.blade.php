@extends('user.app')
@section('content')
@include('user.slider')
<!-- New Arrival Products -->
<section class="new_arrival_product_wrap">
    <div class="container">
        <div class="row">
            <div class="review_section_title common_style">
                <h2>New Arrival</h2>
            </div>
        </div>
        <div class="row">
            @foreach($newArrivalProducts as $newArrivalProductsData)
            <div
                class="col-6 col-md-4 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="{{ $loop->iteration * 100}}"
            >
                @php $images = json_decode($newArrivalProductsData->image,
                true); $firstImage = $images ? $images[0] : 'default.png';
                @endphp
                <div class="product_item">
                    <div class="product_img">

                        @if($newArrivalProductsData->discount_amount!=null)
                        <div class="marks">
                            <span class="mark">Save: {{$newArrivalProductsData->amount-$newArrivalProductsData->discount_amount}}৳</span>
                        </div>
                        @endif


                        @php
                          $user = Auth::user();
                        @endphp
                        @if($user)
                        <div class="wishlist_icon">
                            <a href="#" class="wishlist-toggle " data-product-id="{{ $newArrivalProductsData->id }}">
                                <i class="bi bi-heart{{ in_array($newArrivalProductsData->id, $userWishlist) ? '-fill' : '' }}"></i>
                            </a>
                        </div>
                        @else
                        <div class="wishlist_icon">
                           <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" >
                               <i class="bi bi-heart"></i>
                           </a>
                        </div>
                        @endif
                        <a
                            href="{{route('frontend.product.details',$newArrivalProductsData->id)}}"
                        >
                            <img
                                src="{{ asset('images/product/'.$firstImage) }}"
                                draggable="false"
                                class="img-fluid"
                                alt=""
                            />

                            @if($newArrivalProductsData->discount_amount!=null)
                            <div class="product_content">
                                <div class="discount_price">
                                    {{$newArrivalProductsData->discount_amount}}
                                    TK.
                                </div>
                                <p class="line_through">
                                    {{$newArrivalProductsData->amount}} TK.
                                </p>
                            </div>
                            @else
                            <div class="product_content">
                                <div class="discount_price">
                                    {{$newArrivalProductsData->amount}}
                                    TK.
                                </div>
                            </div>
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalLabel">User Login</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('user.login.post') }}"> @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" required name="email" placeholder="Enter your email*" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" required name="password" placeholder="Enter your password*" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn_style w-100"> Login </button>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <p> Don't have an account? <a href="{{ route('user.register') }}" class="text-decoration-underline">Register</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Get Our Customize and Bulk Order Product -->
<section class="get_our_customize_wrapper">
    <div class="container">
     <a href="{{route('frontend.customize.product')}}">
        <div class="get_our_customize" data-aos="fade-up">
            <img
                src="{{URL::to('frontend/images/customized_jersey_banner.png')}}"
                class="img-fluid"
                draggable="false"
                alt=""
            />
            <div class="get_our_customize_content_area">
                <div class="heading_style">
                    <h2>Get Our</h2>
                    <h3>Customized</h3>
                    <h4>Sportswear</h4>
                </div>
                <p>
                    We are a custom suportswear design and manufacturer in
                    <strong>Bangladesh</strong>. We guarantee a seamless
                    production process and unhold unwavering standards of
                    quality. If you want our premium quality sportswear for your
                    sports team, sports event or corporate event.
                </p>
                <h5>
                    Please get in touch with us:
                    <a href="tel:+8801619426800">01619-426800</a>
                    (Whatsapp)
                </h5>
            </div>
        </div>
        <!-- Bulk Order -->
        <div class="bulk_order_jersey" data-aos="fade-up">
            <img
                src="{{URL::to('frontend/images/bulk_order_banner.png')}}"
                class="img-fluid"
                draggable="false"
                alt=""
            />
            <div class="bulk_order_content_area">
                <div class="bulk_order_heading">
                    <h2>Bulk</h2>
                    <h3>Order</h3>
                </div>
                <p>
                    We take bulk orders from our designed jersey designs with
                    your player name and jersey number. You can order a minimum
                    of <strong>15 pieces</strong>. If you order in bulk, you
                    will <strong>get 20% less</strong> than the price of single
                    piece jersey.
                </p>
            </div>
        </div>
     </a>
    </div>
</section>
<!-- Most Popular Products -->
<section class="new_arrival_product_wrap most_popular_wrap">
    <div class="container">
        <div class="row">
            <div class="review_section_title common_style">
                <h2>Most Popular Products</h2>
            </div>
        </div>
        <div class="row">
            @foreach($mostPopularProducts as $mostPopularProductsData)
            <div
                class="col-6 col-md-4 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="{{ $loop->iteration * 100}}"
            >
                @php $images = json_decode($mostPopularProductsData->image,
                true); $firstImage = $images ? $images[0] : 'default.png';
                @endphp
                <div class="product_item">
                    <div class="product_img">
                        @if($mostPopularProductsData->discount_amount!=null)
                        <div class="marks">
                            <span class="mark">Save: {{$mostPopularProductsData->amount-$mostPopularProductsData->discount_amount}}৳</span>
                        </div>
                        @endif




                       @php
                         $user = Auth::user();
                       @endphp
                       @if($user)
                       <div class="wishlist_icon">
                         <a href="#" class="wishlist-toggle " data-product-id="{{ $mostPopularProductsData->id }}">
                            <i class="bi bi-heart{{ in_array($mostPopularProductsData->id, $userWishlist) ? '-fill' : '' }}"></i>
                         </a>
                       </div>
                       @else
                        <div class="wishlist_icon">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" >
                                <i class="bi bi-heart"></i>
                            </a>
                        </div>
                       @endif



                        <a
                            href="{{route('frontend.product.details',$mostPopularProductsData->id)}}"
                        >
                            <img
                                src="{{ asset('images/product/'.$firstImage) }}"
                                draggable="false"
                                class="img-fluid"
                                alt=""
                            />

                            @if($mostPopularProductsData->discount_amount!=null)
                            <div class="product_content">
                                <div class="discount_price">
                                    {{$mostPopularProductsData->discount_amount}}
                                    TK.
                                </div>
                                <p class="line_through">
                                    {{$mostPopularProductsData->amount}} TK.
                                </p>
                            </div>
                            @else
                            <div class="product_content">
                                <div class="discount_price">
                                    {{$mostPopularProductsData->amount}}
                                    TK.
                                </div>
                            </div>
                            @endif



                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Official Manufacture -->
<section class="official_manufacture_wrapper">
    <div class="container">
        <div class="official_manufacture">
            <h2>We Are The official Manufacture of</h2>
            <div class="manufacture">
                @foreach($manufacture as $manufactureData)
                <div
                    class="manufacture_item"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->iteration * 100}}"
                >
                    <img
                        draggable="false"
                        src="{{asset('images/manufacture/'.$manufactureData->image)}}"
                        class="img-fluid"
                        alt="BFF Logo"
                    />
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Kit Partner -->
<section class="kit_partner_wrapper">
    <div class="container">
        <div class="kit_partner">
            <h2>Proud Kit Partner</h2>
            <div class="partner_logo_wrap">
                @foreach($partner as $partnerData)
                <div
                    class="logo_item"
                    data-aos="fade-up"
                    data-aos-delay="{{ $loop->iteration * 50}}"
                >
                    <img
                        draggable="false"
                        src="{{asset('images/partner/'. $partnerData->image )}}"
                        class="img-fluid"
                        alt=""
                    />
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Happy Customer -->
<section class="happy_customer_wrapper">
    <div class="container">
        <div class="row">
            <div class="review_section_title common_style">
                <h2>Happy Customer</h2>
            </div>
        </div>
        <div class="swiper customerReview">
            <div class="swiper-wrapper">
                @foreach($productReviews as $productReviewsData)
                <div class="swiper-slide">

                    <div class="review_item">
                        <div class="review_img">
                            @if($productReviewsData->user->profile!=null)
                            <img
                                src="{{asset('images/profile/'.$productReviewsData->user->profile)}}"
                                draggable="false"
                                class="img-fluid"
                                alt=""
                            />
                            @else
                            <img
                                src="{{URL::to('images/default/pro.jpg')}}"
                                draggable="false"
                                class="img-fluid"
                                alt=""
                            />
                            @endif
                        </div>
                        <h2>{{$productReviewsData->user->name}}</h2>
                        <ul>
                            @for ($i = 1; $i <= 5; $i++)
                            <li>
                                <i class="bi {{ $i <= $productReviewsData->ratting ? 'bi-star-fill' : 'bi-star' }}"></i>
                            </li>
                            @endfor
                        </ul>
                        <p>
                           {{$productReviewsData->details}}
                        </p>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfTokenMeta.getAttribute('content');

    document.querySelectorAll('.wishlist-toggle').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const productId = this.getAttribute('data-product-id');

            fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.redirect) {
                    window.location.href = data.redirect; // Redirect to login page
                } else {
                    // Handle toggling heart icon
                    if (data.status === 'added') {
                        this.querySelector('i').classList.add('bi-heart-fill');
                        this.querySelector('i').classList.remove('bi-heart');
                    } else if (data.status === 'removed') {
                        this.querySelector('i').classList.remove('bi-heart-fill');
                        this.querySelector('i').classList.add('bi-heart');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error.message);

            });
        });
    });
});

</script>
@endsection
