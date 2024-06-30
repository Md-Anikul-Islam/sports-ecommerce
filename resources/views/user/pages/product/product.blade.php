@extends('user.app')
@section('content')
	<!-- New Arrival Products -->
	<section class="new_arrival_product_wrap product_page_wrap">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-4 col-lg-3" id="columnLeft">
					<div class="product_filter_area">
						<div class="accordion" id="availabilityAccordion">
							<div class="accordion-item">
								<h2 class="accordion-header" id="availabilityHeading">
									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#availabilitycollapse" aria-expanded="true" aria-controls="availabilitycollapse">
										Categories
										<i class="bi bi-chevron-down"></i>
									</button>
								</h2>


                                <div id="availabilitycollapse" class="accordion-collapse collapse show" aria-labelledby="availabilityHeading" data-bs-parent="#availabilityAccordion">
                                    <ul class="sub_category_wrapper">
                                        @foreach($categories as $category)
                                            <li class="{{ $category->subCategories->count() ? 'sub_category_wrap' : '' }}">
                                                <a href="{{ route('frontend.all.product', ['category' => $category->id]) }}" class="parent_category">
                                                    {{ $category->name }}
                                                    @if($category->subCategories->count())
                                                        <i class="bi bi-chevron-right"></i>
                                                    @endif
                                                </a>
                                                @if($category->subCategories->count())
                                                    <ul class="sub_category">
                                                        @foreach($category->subCategories as $subCategory)
                                                            <li><a href="{{ route('frontend.all.product', ['category' => $category->id, 'subcategory' => $subCategory->id]) }}">{{ $subCategory->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>




							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-8 col-lg-9">
					<div class="top-bar theme_ws_box">
						<div class="row">
							<div class="col-4 actions">
								<label class="page-heading"
									>All Products</label
								>
							</div>
                                <div class="col-8 show-sort">
                                    <div class="form-group rs-none">
                                        <label>Show:</label>
                                        <div class="custom-select">
                                            <select id="input-limit" onchange="location.href = this.value;">
                                                <option value="{{ request()->fullUrlWithQuery(['limit' => 20]) }}" {{ request('limit') == 20 ? 'selected' : '' }}>20</option>
                                                <option value="{{ request()->fullUrlWithQuery(['limit' => 50]) }}" {{ request('limit') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="{{ request()->fullUrlWithQuery(['limit' => 80]) }}" {{ request('limit') == 80 ? 'selected' : '' }}>80</option>
                                                <option value="{{ request()->fullUrlWithQuery(['limit' => 100]) }}" {{ request('limit') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
					</div>
					<div class="row">
						@foreach($products as $product)
							<div class="col-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100}}">
								<div class="product_item">
									<div class="product_img">
										@if($product->discount_amount!=null)
                                        <div class="marks">
                                            <span class="mark">Save: {{$product->amount-$product->discount_amount}}৳</span>
                                        </div>
                                        @endif


                                       <div class="wishlist_icon">
                                         <a href="#" class="wishlist-toggle " data-product-id="{{ $product->id }}">
                                            <i class="bi bi-heart{{ in_array($product->id, $userWishlist) ? '-fill' : '' }}"></i>
                                         </a>
                                       </div>




										<a href="{{ route('frontend.product.details', $product->id) }}">
											@php
												$images = json_decode($product->image, true);
												$firstImage = $images ? $images[0] : 'default.png';
											@endphp
											<img src="{{ asset('images/product/' . $firstImage) }}" draggable="false" class="img-fluid" alt="{{ $product->name }}" />

                                            @if($product->discount_amount!=null)
                                                <div class="product_content">
                                                    <div class="discount_price">
                                                        {{$product->discount_amount}}
                                                        TK.
                                                    </div>
                                                    <p class="line_through">
                                                        {{$product->amount}} TK.
                                                    </p>
                                                </div>
                                            @else
                                                <div class="product_content">
                                                    <div class="discount_price">
                                                        {{$product->amount}}
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


                     <div class="bottom-bar theme_ws_box">
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    {{ $products->links('pagination::bootstrap-4') }}
                                </div>
                                <div class="col-md-4 rs-none text-end">
                                    <p>Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} ({{ $products->lastPage() }} Pages)</p>
                                </div>
                            </div>
                      </div>
				</div>
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
