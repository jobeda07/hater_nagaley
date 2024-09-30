<!-- Fillter By Price -->
    <div class="sidebar-widget price_range range mb-30">
        <h5 class="section-title style-1 mb-30">Filter by price</h5>
        <div class="price-filter">
            <div class="price-filter-inner">
                <div id="slider-range" class="mb-20"></div>
                <div class="d-flex justify-content-between">
                    <div class="caption">From: <strong id="slider-range-value1" class="text-brand">@if(isset($_GET['filter_price_start'])) {{ $_GET['filter_price_start'] }} @endif</strong></div>
                    <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                </div>
            </div>
        </div>
        
        <button type="button" class="btn btn-sm btn-default mt-3" onclick="sort_price_filter()"><i class="fi-rs-filter mr-5"></i> Fillter</button>
    </div>
    <form class="" id="search-form">
        <input type="hidden" id="filter_price_start" name="filter_price_start" @if(isset($_GET['filter_price_start'])) value="{{ $_GET['filter_price_start'] }}" @else value="1" @endif>
        <input type="hidden" id="filter_price_end" name="filter_price_end" @if(isset($_GET['filter_price_end'])) value="{{ $_GET['filter_price_end'] }}" @else value="10000" @endif>
    </form>

@push('footer-script')
    <script type="text/javascript">
        function sort_price_filter(){
           var start = $('#slider-range-value1').html();
           var end = $('#slider-range-value2').html();
           $('#filter_price_start').val(start);
           $('#filter_price_end').val(end);
           $('#search-form').submit();
        }
    </script>

    <script type="text/javascript">
        (function ($) {
            ("use strict");
            // Slider Range JS
            if ($("#slider-range").length) {
                $(".noUi-handle").on("click", function () {
                    $(this).width(50);
                });
                var rangeSlider = document.getElementById("slider-range");
                var moneyFormat = wNumb({
                    decimals: 0,
                    // thousand: ",",
                    // prefix: "$"
                });
                var start_price = document.getElementById("filter_price_start").value;
                var end_price = document.getElementById("filter_price_end").value;
                noUiSlider.create(rangeSlider, {
                    start: [start_price, end_price],
                    step: 1,
                    range: {
                        min: [1],
                        max: [10000]
                    },
                    format: moneyFormat,
                    connect: true
                });

                // Set visual min and max values and also update value hidden form inputs
                rangeSlider.noUiSlider.on("update", function (values, handle) {
                    document.getElementById("slider-range-value1").innerHTML = values[0];
                    document.getElementById("slider-range-value2").innerHTML = values[1];
                    document.getElementsByName("min-value").value = moneyFormat.from(values[0]);
                    document.getElementsByName("max-value").value = moneyFormat.from(values[1]);

                    // if(values[0]>1 || values[1]<10000){
                    //     //sort_price_filter();
                    // }
                    //sort_price_filter();
                    //console.log(handle);
                });

                
            }
        })(jQuery);
    </script>
@endpush