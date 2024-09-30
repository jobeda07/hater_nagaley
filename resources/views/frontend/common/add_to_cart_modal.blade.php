<!-- Quick view -->
<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModel"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <!-- <span class="zoom-icon"><i class="fi-rs-search"></i></span> -->
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                <figure class="border-radius-10">
                                    <img id="pimage" src="" class="img-fluid" width="375" alt="product image" />
                                </figure>
                            </div>
                            <!-- THUMBNAILS -->
                            <!-- <div class="slider-nav-thumbnails">
                                <div><img  src="" alt="product image" /></div>
                            </div> -->
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">
                           <!--  <span class="stock-status out-stock"> Sale Off </span> -->
                            <h3 class="title-detail"><a id="product_name" href="#" class="text-heading"></a></h3>
                           <!--  <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                </div>
                            </div> -->
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <span class="current-price mb-2 d-flex text-brand">৳ <span id="pprice"></span></span>
                                    <span>
                                      <!--   <span class="save-price font-md color3 ml-15">26% Off</span> -->
                                        <span id="oldprice" class="old-price font-md ml-15 mb-2">৳</span>
                                    </span>
                                </div>
                            </div>
                            <form id="choice_form">
                                <div class="row " id="attributes">
                                    <div class="form-group col-lg-6" id="colorArea">
                                        {{-- <label style=" font-weight:bold;color: black;">Chose Color <span>**</span></label>
                                        <select class="form-control" id="color" name="color">
                                            <option value="">--Choose Color--</option>
                                        </select> --}}
                                    </div>
                                </div>
                                
                                <div class="row" id="attribute_alert">
                                                
                                </div>
                            </form>
                            <div class="font-xs">
                                <ul>
                                    <li class="mb-5">Category: 
                                        <span class="text-brand" id="pcategory">
                                            
                                        </span>
                                    </li>
                                    <li class="mb-5">Brand: 
                                        <span class="text-brand" id="pbrand">
                                            
                                        </span>
                                    </li>
                                    <li class="mb-5">Product Code: 
                                        <span class="text-brand" id="pcode">
                                            
                                        </span>
                                    </li>
                                    <li class="mb-5">Stock:
                                        <span class="badge badge-pill badge-success" id="pavailable" style="background: green; color: white;">Available</span>
                                        <span class="badge badge-pill badge-danger" id="pstockout" style="background: red; color: white;">Stock Out</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="detail-extralink align-items-baseline d-flex" style="margin-top: 30px;">
                                <div class="mr-10">
                                    <span class="">Quantity:</span>
                                </div>
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="quantity" class="qty-val" value="{{ $product->minimum_buy_qty ?? '1' }}" min="1" id="qty">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                            </div>
                            <div class="d-block" id="qty_alert">
											
                            </div>
                            <div class="detail-extralink d-flex mb-30" style="margin-top: 10px;">
                                <!-- <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>

                                    <input type="text" name="quantity" class="qty-val" id="qty" value="1" min="1">

                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div> -->
                                <div class="product-extra-link2">
                                    <input type="hidden" id="product_id">
                                    <input type="hidden" id="pname">
                                    <input type="hidden" id="product_price">
                                    <input type="hidden" id="discount_amount">
                                    <input type="hidden" id="pfrom" value="modal">
                                    <input type="hidden" id="pvarient" value="">

                                    <input type="hidden" id="minimum_buy_qty" value="">
	                                <input type="hidden" id="stock_qty" value="">

                                    <input type="hidden" id="buyNowCheck" value="0">
    
                                    <div class="d-none show_cart_btn">
									    <button type="submit" class="button button-add-to-cart" onclick="addToCart()"><i class="fi-rs-shoppi ng-cart"></i>Add to cart</button>
                                        <button type="submit" class="button button-add-to-cart ml-5 bg-danger" onclick="buyNow()"><i class="fi-rs-shoppi ng-cart"></i>Buy Now</button>
									</div>
                                    {{-- @if($product->stock_qty>0)
                                        <button  class="button button-add-to-cart" onclick="addToCart()" id="closeModel"><i class="fi-rs-shopping-cart" ></i>Add to cart</button>
                                        <button  class="button button-add-to-cart bg-danger ml-5" onclick="buyNow()" id="closeModel"><i class="fi-rs-shopping-cart" ></i>Buy Now</button>
                                    @else
                                        <p class="stock_out"><i class="fas fa-window-close mr-5"></i>Stock Out</p>
                                    @endif --}}
                                    <button  class="button button-add-to-cart" onclick="addToCart()" id="closeModel"><i class="fi-rs-shopping-cart" ></i>Add to cart</button>
                                    <button  class="button button-add-to-cart bg-danger ml-5" onclick="buyNow()" id="closeModel"><i class="fi-rs-shopping-cart" ></i>Buy Now</button>
                                </div>
                            </div>
                            <div class="row mb-3" id="stock_alert">
											
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>