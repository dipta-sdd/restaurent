<div class="toast-container" id="toast-container"></div>
<div class="sidebar-overlay"></div>
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel"> {{ config('app.name', 'My POS') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                        <i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard
                    </button>
                    <div class="collapse" id="dashboard-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Overview</a>
                            </li>
                            <li><a href="#"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Weekly</a>
                            </li>
                            <li><a href="#"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Monthly</a>
                            </li>
                            <li><a href="#"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Annually</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <a href="/admin/pos"
                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 icon-only">
                        <i class="fas fa-cash-register"></i> &nbsp; POS
                    </a>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#cat-collapse" aria-expanded="false">
                        <i class="fas fa-box"></i> &nbsp;
                        Category
                    </button>
                    <div class="collapse" id="cat-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="/admin/categories"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">All
                                    categories</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#item-collapse" aria-expanded="false">
                        <i class="fas fa-box"></i> &nbsp;
                        Items
                    </button>
                    <div class="collapse" id="item-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="/admin/items"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">All
                                    Items</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i> &nbsp; Orders
                    </button>
                    <div class="collapse" id="orders-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="/admin/orders"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">All Orders</a>
                            </li>
                            <li><a href="/admin/orders?status=pending"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Pending</a>
                            </li>
                            <li><a href="/admin/orders?status=processing"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Processing</a>
                            </li>
                            <li><a href="/admin/orders?status=out_for_delivery"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Out for
                                    Delivery</a></li>
                            <li><a href="/admin/orders?status=delivered"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Delivered</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#branch-collapse" aria-expanded="false">
                        <i class="fas fa-code-branch"></i> &nbsp; Branch
                    </button>
                    <div class="collapse" id="branch-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="/branches"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">All Branch</a>
                            </li>
                            <li><a href="/admin/tables"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add Table</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#payment-collapse" aria-expanded="false">
                        <i class="fas fa-credit-card"></i> &nbsp; Payment
                    </button>
                    <div class="collapse" id="payment-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="/admin/payment-methods"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Payment Methods</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
                        data-bs-toggle="collapse" data-bs-target="#users-collapse" aria-expanded="false">
                        <i class="fas fa-users"></i> &nbsp; Users
                    </button>
                    <div class="collapse" id="users-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="/admin/users"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">All Users</a>
                            </li>
                            <li><a href="/admin/users?role=manager"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Managers</a>
                            </li>
                            <li><a href="/admin/users?role=staff"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Staff</a>
                            </li>
                            <li><a href="/admin/users?role=rider"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Riders</a>
                            </li>
                            <li><a href="/admin/users?role=user"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Customers</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="border-top my-3"></li>
                <li class="mb-1">
                    <button
                        class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed text-capitalize"
                        data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                        <i class="fas fa-user"></i> &nbsp; Account
                    </button>
                    <div class="collapse" id="account-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="#"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">New...</a>
                            </li>
                            <li><a href="#"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Profile</a>
                            </li>
                            <li><a href="#"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Settings</a>
                            </li>
                            <li><a href="/api/logout"
                                    class="link-body-emphasis d-inline-flex text-decoration-none rounded">Sign
                                    out</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>