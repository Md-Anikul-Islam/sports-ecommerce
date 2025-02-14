@extends('user.app')
@section('content')
    <section class="product_details_block_wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product_image_gallery">
                        <div class="swiper productImageThumb">
                            <div class="swiper-wrapper">
                                @foreach(json_decode($product->image) as $image)
                                <div class="swiper-slide easyzoom easyzoom--overlay">
                                    <a
                                        href="{{ URL::to('images/product/' . $image) }}"
                                    >
                                        <img
                                            src="{{ URL::to('images/product/' . $image) }}"
                                            class="img-fluid"
                                            draggable="false"
                                            alt=""
                                        />
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div thumbsSlider="" class="swiper productImage">
                            <div class="swiper-wrapper">
                                @foreach(json_decode($product->image) as $image)
                                <div class="swiper-slide">
                                    <img src="{{ URL::to('images/product/' . $image) }}" class="img-fluid" draggable="false" alt="">
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product_block_content">
                        <h1>{{ $product->name }}</h1>
                        <div class="price_and_stock">

                          @if($product->discount_amount!=null)
                            <p class="price">TK. {{ $product->discount_amount }}</p>
							<p class="line_through details_page_discount">TK. {{ $product->amount }}</p>
                          @else
                            <p class="price">TK. {{ $product->amount }}</p>
                          @endif


                            @if($product->available_stock > 0)
                            <p class="stock">In Stock</p>
                            @else
                            <p class="stock">Out Of Stock</p>
                            @endif
                        </div>
                        <div class="add_to_cart_and_increment">
                            <div class="increment">
                                <button type="button" id="decrement">-</button>
                                <input type="text" id="quantity" name="quantity" value="1" />
                                <button type="button" id="increment">+</button>
                            </div>
                            <div class="add_to_cart">
                                <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="size_id" id="size_id" >
                                    <input type="hidden" name="qty" id="cart_qty" >
                                    {{--<input type="hidden" name="price" value="{{ $product->amount }}">--}}
                                    <input type="hidden" name="price" value="{{ $product->discount_amount ?? $product->amount }}">
                                    <button type="submit" class="btn btn-success">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                        <div class="available_size">
                            <h3>Available Size:</h3>
                            <div class="form-group available_sizes">
                                @foreach(json_decode($product->size_id) as $sizeId)
                                @php
                                $size = \App\Models\Size::find($sizeId);
                                @endphp
                                @if ($size)
                                <div class="size_item">
                                    <input type="radio" name="available_size" value="{{ $size->id }}" id="size_{{ $size->id }}">
                                    <label for="size_{{ $size->id }}">{{ $size->size }}</label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="product_specification">
                            <h2>Product Specification:</h2>

                            {!!$product->details!!}
                        </div>
                        <div class="our_size_chart">
                            <h2>Our Size Chart: <span>in inches</span></h2>
                            <div class="size_chart_wrapper">
                                <div class="size_chart_head">
                                    <div>Size</div>
                                    <div>Chest</div>
                                    <div>Length</div>
                                </div>
                                <div class="size_chart_body">
                                    @foreach(json_decode($product->size_id) as $sizeId)
                                    @php
                                    $size = \App\Models\Size::find($sizeId);
                                    @endphp
                                    @if ($size)
                                    <div class="size_chart_row">
                                        <div>{{ $size->size }}</div>
                                        <div>{{ $size->chest }}</div>
                                        <div>{{ $size->length }}</div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="{{URL::to('frontend/images/review.jpeg')}}"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="{{URL::to('frontend/images/review.jpeg')}}"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="assets/images/review.jpeg"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="{{URL::to('frontend/images/review.jpeg')}}"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="{{URL::to('frontend/images/review.jpeg')}}"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="{{URL::to('frontend/images/review.jpeg')}}"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="{{URL::to('frontend/images/review.jpeg')}}"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="{{URL::to('frontend/images/review.jpeg')}}"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review_item">
                            <div class="review_img">
                                <img
                                    src="{{URL::to('frontend/images/review.jpeg')}}"
                                    draggable="false"
                                    class="img-fluid"
                                    alt=""
                                />
                            </div>
                            <h2>Nibir Ahmed</h2>
                            <ul>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                                <li>
                                    <i class="bi bi-star-fill"></i>
                                </li>
                            </ul>
                            <p>
                                Excellent product quality with very nice
                                behaved sellsman. Satisfide with all of
                                these. Highly recomended.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>
    <section class="new_arrival_product_wrap related_product">
        <div class="container">
            <div class="row">
                <div class="review_section_title common_style">
                    <h2>Related Products</h2>
                </div>
            </div>
            <div class="row">
                @foreach($relatedProducts as $relatedProductsData)
                <div class="col-12 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100}}">
					@php
						$images = json_decode($relatedProductsData->image, true);
						$firstImage = $images ? $images[0] : 'default.png';
                    @endphp
					<div class="product_item">
						<div class="product_img">
                            @if($relatedProductsData->discount_amount!=null)
                            <div class="marks">
                                <span class="mark">Save: {{$relatedProductsData->amount-$relatedProductsData->discount_amount}}৳</span>
                            </div>
                            @endif


                           <div class="wishlist_icon">
                             <a href="#" class="wishlist-toggle " data-product-id="{{ $relatedProductsData->id }}">
                                <i class="bi bi-heart{{ in_array($relatedProductsData->id, $userWishlist) ? '-fill' : '' }}"></i>
                             </a>
                           </div>


							<a href="{{route('frontend.product.details',$relatedProductsData->id)}}">
								<img
									src="{{ asset('images/product/' . $firstImage) }}"
									draggable="false"
									class="img-fluid"
									alt=""
								/>

								@if($relatedProductsData->discount_amount!=null)
                                <div class="product_content">
                                    <div class="discount_price">
                                        {{$relatedProductsData->discount_amount}}
                                        TK.
                                    </div>
                                    <p class="line_through">
                                        {{$relatedProductsData->amount}} TK.
                                    </p>
                                </div>
                                @else
                                <div class="product_content">
                                    <div class="discount_price">
                                        {{$relatedProductsData->amount}}
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
    <section class="get_our_customize_wrapper">
        <div class="container">
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
                        We are a custom suportswear design and
                        manufacturer in <strong>Bangladesh</strong>. We guarantee a
                        seamless production process and unhold
                        unwavering standards of quality. If you want our
                        premium quality sportswear for your sports team,
                        sports event or corporate event.
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
                        We take bulk orders from our designed jersey
                        designs with your player name and jersey number.
                        You can order a minimum of <strong>15 pieces</strong>. If you
                        order in bulk, you will <strong>get 20% less</strong> than the
                        price of single piece jersey.
                    </p>
                </div>
            </div>
        </div>
    </section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle size selection
        const sizeRadios = document.querySelectorAll('input[name="available_size"]');
        sizeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                document.getElementById('size_id').value = this.value;
            });
        });

        // Handle quantity increment and decrement
        const decrementButton = document.getElementById('decrement');
        const incrementButton = document.getElementById('increment');
        const quantityInput = document.getElementById('quantity');

        decrementButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        incrementButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value);
            let newValue = currentValue + 1;
            quantityInput.value = newValue;
        });

        // Update quantity for cart submission
        const addToCartForm = document.getElementById('addToCartForm');
        addToCartForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            // Get selected size and quantity
            let sizeId = document.querySelector('input[name="available_size"]:checked');
            let qty = parseInt(document.getElementById('quantity').value);

            if (sizeId === null) {
                alert('Please select a size.');
                return;
            }

            // Update form inputs with selected size and quantity
            document.getElementById('size_id').value = sizeId.value;
            document.getElementById('cart_qty').value = qty;

            // Submit the form
            this.submit();
        });
    });
</script>

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

