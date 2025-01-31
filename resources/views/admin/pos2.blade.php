<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Bangla Tandoori Restauresnt') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/admin_style.css" rel="stylesheet">
    <link href="/css/pos.css" rel="stylesheet">
    <!-- Add Vue CDN -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
</head>

<body>
    @include('admin.header')


    <div class="container-fluid">
        <div class="row">

            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-2" id="app">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Point of Sale</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a type="button" class="btn btn-sm btn-outline-secondary me-2" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </a>
                        <a type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download"></i> Export
                        </a>
                    </div>
                </div>

                <div class="row" id="pos-container">
                    <div id="menu-container">
                        <!-- Food Categories -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Foods</h5>

                            </div>
                            <div class="card-body">
                                <div class="accordion rounded-0 border-0" id="foodsAccordion">
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Drinks Categories -->
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Drinks</h5>

                            </div>
                            <div class="card-body">
                                <div class="accordion rounded-0 border-0" id="drinksAccordion">
                                    <!-- Similar structure as food categories -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Section -->
                    <div id="total-container">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Cart Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="cart-items">
                                    
                                </div>
                                <hr>
                                <div class="cart-summary">
                                    
                                </div>
                                <div class="order-details mt-2 pt-2 border-top ">
                                    <h6 class="mb-3">Order Details</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Order Type</label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="orderType" id="dineIn" value="dine_in">
                                                <label class="form-check-label" for="dineIn">
                                                    Dine In
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="orderType" id="takeaway" value="takeaway">
                                                <label class="form-check-label" for="takeaway">
                                                    Takeaway
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 d-none" id="tableNoContainer">
                                        <label for="tableNo" class="form-label">Table Number</label>
                                        <input type="number" class="form-control" id="tableNo" min="1">
                                    </div>
                                </div>
                                <button class="btn btn-success w-100">Process Order</button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/admin.js"></script>
    {{ $foods }}
    <script>
        const { createApp, ref, computed } = Vue

        const app = createApp({
            setup() {
                const cartItems = ref([])
                const vatRate = ref(20)
                const foods = ref( {{ $foods }})
                // const drinks = ref( {{{json_encode($drinks)}}})

                // console.log(foods.value)
                // console.log(drinks.value)

                return {
                    cartItems,
                    vatRate
                }
            }
        }).mount('#app')

        $('.sidebar').addClass('autoclose');
    </script>
</body>

</html>