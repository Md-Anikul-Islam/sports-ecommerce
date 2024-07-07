@extends('user.app')
@section('content')
	<!-- New Arrival Products -->
	<section class="new_arrival_product_wrap product_page_wrap">
		<div class="container">
			<div class="row">

				<div class="col-12 col-md-12 col-lg-12">
					<div class="top-bar theme_ws_box">
						<div class="row">
							<div class="col-4 actions">
								<label class="page-heading"
									>Customized Products</label
								>
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

                                       @php
                                        $user = Auth::user();
                                       @endphp
                                       @if($user)
                                       <div class="wishlist_icon">
                                         <a href="#" class="wishlist-toggle " data-product-id="{{ $product->id }}">
                                            <i class="bi bi-heart{{ in_array($product->id, $userWishlist) ? '-fill' : '' }}"></i>
                                         </a>
                                       </div>
                                       @else
                                       <div class="wishlist_icon">
                                         <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" >
                                             <i class="bi bi-heart"></i>
                                         </a>
                                       </div>
                                       @endif




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
