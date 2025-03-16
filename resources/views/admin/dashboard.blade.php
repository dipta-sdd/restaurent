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
    <style>
        .table-container {
            display:grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
        }
        .table-container .table-item {
            border-radius: 5px;
        }
    </style>
</head>

<body>
    @include('admin.header')


    <div class="container-fluid">
        <div class="row">

            @include('admin.sidebar')

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-2">
                <h1>Dashboard</h1>
                <hr style="margin-inline: -25px;">
                <div id="dashboard">
                    <div class="table-container">
                        <div v-for="table in tables" class="table-item border">
                            <div class="p-3 d-flex flex-column align-items-center justify-content-between" >
                                <h3>Table @{{ table.id }}</h3>
                                <div class="d-flex justify-content-between w-100 align-items-center">
                                    <span class="text-muted">Capacity: @{{ table.capacity }}</span>
                                    <span class="badge text-light" :class="table.status == 'available' ? 'bg-primary' :  table.status == 'occupied' ? 'bg-info' : 'bg-danger' " style="height:20px"> @{{ table.status }}</span>
                                </div>
                                <a v-if="table.status == 'available'" href="/admin/pos" class="btn btn-outline-primary mt-2">Order</a>

                                <div v-if="table.r_id" class="d-flex flex-column w-100 align-items-center">
                                    <span >Next Order:</span><span class="text-muted"> @{{ table.start }} - @{{ table.end }} </span>
                                </div>
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
<!-- Vue.js 3 -->
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const { createApp, ref, onMounted } = Vue

    createApp({
        setup() {
            // Reactive state
            const count = ref(0)
            const message = ref('Hello Vue 3 Composition API!')
            const tables = ref([])

            // Methods
            const increment = () => {
                count.value++
            }

            const fetchTables = async () => {
                try {
                    const request = await fetch('/api/dashboard/tables')
                    const data = await request.json()
                    tables.value = data
                } catch (error) {
                    console.error('Error fetching tables:', error)
                }
            }
            // Set up polling interval to fetch tables every 30 seconds
            onMounted(() => {
                setInterval(() => {
                    fetchTables()
                }, 30000) // 30000 milliseconds = 30 seconds
            })
            // Lifecycle hooks
            onMounted(async () => {
                fetchTables()
            })

            // Expose managed state and methods
            return {
                count,
                message,
                increment,
                tables
            }
        }
    }).mount('#dashboard')
</script>
</body>

</html>