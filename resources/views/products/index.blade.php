@extends('includes.app')

@section('content')



<header class="userMenuePageHeader">
    <nav>
        <div class="hamBurgerIcon">
            <i onclick="theAppend()" class="fas fa-bars"></i>
        </div>
        <div class="theHeadLine">
            <h5>Royal Fook Long Amsterdam - 53</h5>
        </div>
    </nav>
    <div class="theTopImages">
        <img src="{{ asset('images/pexels-engin-akyurt-2673353.jpg') }}" alt="">
    </div>
</header>




<section class="theConditionSearch">
    <div class="theSearch">
        <input type="text" id="search-product" placeholder="Search a food You Like">
        <div class="product-suggestion">



             <!-- <div class="row bg-light rounded mb-2 suggested-product" product-id="1">
                <div class="col-3 suggestion-image">
                    <img src="http://127.0.0.1:8000/images/1628323939.small.techbot gig (1).png" alt="PRODUCT"
                       >
                </div>
                <div class="col-7 font-weight-bold">
                    product one two three four
                </div>
                <div class="col-2 p-2 suggestion-price">
                    <span>12</span>
                </div>
            </div> -->
          


        </div>
    </div>

    <div class="condition">

        <div class="conditionBox">
            <div class="theTimeIcon">
                <i class="far fa-clock"></i>
            </div>
            <div class="timeAndTitle">
                <div class="time">
                    <b>1: 59 min</b>
                </div>
                <div class="title">
                    <span>Time</span>
                </div>
            </div>
        </div>

        <div class="conditionBox">
            <div class="theTimeIcon">
                <i class="far fa-clock"></i>
            </div>
            <div class="timeAndTitle">
                <div class="time">
                    <b>1: 59 min</b>
                </div>
                <div class="title">
                    <span>Time</span>
                </div>
            </div>
        </div>

        <div class="conditionBox">
            <div class="theTimeIcon">
                <i class="far fa-clock"></i>
            </div>
            <div class="timeAndTitle">
                <div class="time">
                    <b>1: 59 min</b>
                </div>
                <div class="title">
                    <span>Time</span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- product section here -->
<section class="productSection">


    <!-- catagory slider code  -->
    <div class="swiper-container catagory-slider-swiper-slider mb-4">
        <div class="swiper-wrapper">

            @foreach($categories as $category)

                <a href="#category_tab_{{ $category->id }}" class="classForlinkCategory">

                    <div class="swiper-slide activetab" id="swapperDliderActiveTab">
                        {{ $category->name }}

                    </div>
                </a>
            @endforeach


        </div>
    </div>

    <div class="CategoryWisedProducts">
        <div class="tab-container-wrapper">

            <!-- tab items here -->
            <!-- tab item -->

            @foreach($categories as $category)

                <div class="theCategoryTitle" id="category_tab_{{ $category->id }}">
                    <b>{{ $category->name }}</b>
                </div>

                @php
                    $categoryWisedProducts = $category->products;
                @endphp



                @if($categoryWisedProducts->count() != 0)

                    @foreach($categoryWisedProducts as $categoryWisedProduct)


                        <div class="product" id="singleProduct" data="1"
                            data-item-id="{{ $categoryWisedProduct->id }}">
                            <div class="productImg">
                                <img src="{{ asset($categoryWisedProduct->image_small) }}" alt="">
                            </div>


                            <div class="infoPart">
                                <div class="productName">
                                    <h5>
                                        Name: <span>{{ $categoryWisedProduct->name }}</span></h5>
                                </div>

                                <div class="productPriceAndNumber">
                                    <div class="thePrice">
                                        <span><b>{{ $categoryWisedProduct->price }}</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @else
                    <div class="alertforNoProduct text-center">
                        <div class="alert alert-warning" role="alert">
                            Sorry ! There is no Product on this category
                        </div>
                    </div>


                @endif




            @endforeach
        </div>

    </div>

</section>

<!-- the pop up product view section here -->

<section class="theProductView">
    <div class="theProductViewLayOut">
        <div class="tab-content">
            <div class="theCros" onclick="theProductViewHider()">
                <span class="font-weight-bold" style="cursor: pointer"> X</span>
            </div>
            <div class="theProductImage mb-4">
                <img class="theProductImageSrc" alt="">
            </div>
            <div class="productNameAndPrice">
                <div class="productName">
                    <h6>Name</h6>
                </div>
                <div class="productPrice">
                    <h6 id="productViewName"></h6>
                </div>
            </div>

            <div class="quantityAndTotalPrice">
                <div class="quantity">
                    Price
                </div>
                <div class="totalPrice">
                    <b id="productViewPrice"></b>
                </div>
            </div>

            <div class="theButton">
                <button class="addToOrder" onclick="theProductViewAdder()">ADD TO ORDER</button>
            </div>
        </div>
    </div>
</section>




<!-- The Footer start here -->
<footer class="userFooter">

    <div class="iconBox">


        <a href="">

            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <div class="iconName">
                <h6>Menu</h6>
            </div>
        </a>
    </div>

    <div class="iconBox">


        <a href="/pages/service.html">

            <div class="icon">
                <i class="fas fa-user-alt"></i>
            </div>
            <div class="iconName">
                <h6>Service</h6>
            </div>
        </a>
    </div>

    <div class="iconBox">

        <a id="orderPageLink" href="{{ route('orders', $requestedTable->id) }}">

            <div class="icon">
                <i class="fas fa-bell"></i>
            </div>
            <div class="iconName">
                <h6>Order</h6>
            </div>
        </a>
    </div>

    <div class="iconBox">


        <a href="pages/bill.html">

            <div class="icon">
                <i class="fas fa-euro-sign"></i>
            </div>
            <div class="iconName">
                <h6>Bill</h6>
            </div>
        </a>
    </div>

</footer>


<form id="form_for_add_cart" hidden>
    @csrf
    <input type="text" name="table_id" id="cart_input_for_table_id" value="{{ $requestedTable->id }}">
    <input type="text" name="product_id" id="cart_input_for_table_product_id">
    <input type="text" name="quantity" id="cart_input_for_table_quantity" value="1">

</form>




<script>
    // the home page funtions

    const allProducts = document.querySelectorAll(".product");
    const theProductView = document.querySelector(".theProductView");
    let addToOrder = document.querySelector("button.addToOrder");


    function theAppend() {
        var theElement = document.querySelector(".theAppentSection");
        theElement.classList.add("theAppendCome");
    }

    function theAppendRemove() {
        var theElement = document.querySelector(".theAppentSection");
        theElement.classList.remove("theAppendCome");
    }



    var products = @json($products);
    console.log(products)

    $(document).on('click', '#singleProduct', function () {

        $(this).addClass('cliecked_on_product');
        var el = $('.cliecked_on_product');
        var itemId = el.data('item-id');

        $('.theProductView').addClass("theProductVisible");

        $.each(products, function (key) {

            if (products[key].id == itemId) {

                $('#productViewName').html(products[key].name);
                $('#productViewPrice').html(products[key].price);
                $('#cart_input_for_table_product_id').val(products[key].id);

                var route = '{{ route('dashboard') }}';
                var image = route.trim() + '/' + products[key].image_big;
                $('.theProductImageSrc').attr('src', image);

            }

        })

        $('.cliecked_on_product').removeClass('cliecked_on_product');


    })


    // product suggestion
    $('.product-suggestion').hide();
    $(document).on('input','#search-product',function(){
        var inputData = $('#search-product').val();
        if(! inputData){
            $('.product-suggestion').hide();
        }
        else{

        var expression = new RegExp(inputData, "i");
        var count = 0;
        var html ='';
        var home = '{{route('dashboard') }}';  
        $.each(products, function (key, value) {


            if ( value.name.search(expression) != -1 ) {
                if (count == 10) {
                    return false;
                }
                count++;
                html += ' <div class="row bg-light rounded mb-2 suggested-product" product-id="'+ value.id +'">';
                html += '     <div class="col-3 suggestion-image"> <img src="'+home.trim() + '/'+ value.image_small +'" alt="'+ value.name+'"> </div>';
                html += '     <div class="col-7 font-weight-bold"> '+value.name +' </div>';
                html += '     <div class="col-2 p-2 suggestion-price"> <span>'+ value.price+'</span>  </div>';
                html += ' </div>';
            }

        });

        $('.product-suggestion').html(html);

        $('.product-suggestion').show();
                

        }
    });

    //click on suggestion
    $(document).on('click','.suggested-product',function(){
         var product_id = $(this).attr('product-id');
         $('#singleProduct').attr('data-item-id')
        var target = $('div[id="singleProduct"][data-item-id="'+product_id+'"]');
        target.trigger( "click" );
    });





    function theProductViewHider() {
        theProductView.classList.remove("theProductVisible");

    }

    function theProductViewAdder() {

        var data = $('#form_for_add_cart').serialize();
        var route = '{{ route('addtocart') }}'.trim();

        $.ajax({
            url: route,
            type: "post",
            data: data,
            success: function (data) {
                alert('Product added to Your Cart');

            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        });

        theProductView.classList.remove("theProductVisible");

    }



    /* catagory slider here */

    try {
        var swiper = new Swiper(".catagory-slider-swiper-slider", {
            slidesPerView: "auto",
            spaceBetween: 10,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    } catch (err) {
        console.log(err);
    }

    /* tab for catagory */
    try {
        const allTabs = document.querySelectorAll("[data-tab-caller]");
        const allTabsContent = document.querySelectorAll("[data-tab-content]");
        let activetab = "";

        allTabs.forEach((element, index) => {
            element.onclick = () => {
                allTabs.forEach((x) => x.classList.remove("activetab"));
                element.classList.add("activetab");
                selectingActiveTab();
                showingtab();
            };
        });

        const selectingActiveTab = () => {
            allTabs.forEach((x) => {
                if (x.classList.contains("activetab")) {
                    activetab = x.dataset.tabCaller;
                }
            });
        };
        selectingActiveTab();

        const showingtab = () => {
            allTabsContent.forEach((x) => {
                if (x.dataset.tabContent === activetab) {
                    x.classList.add("active", "show");
                } else {
                    x.classList.remove("active", "show");
                }
            });
        };
        showingtab();
    } catch (err) {}

</script>


@endsection
