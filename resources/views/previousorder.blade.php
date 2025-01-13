<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Culinary Journey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/previousorder.css" />

    <style>
        body {
            background-color: #f7f7f7;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        
    </style>
</head>

<body>
    <div class="container">
        <h1><i class="fas fa-utensils order-icon"></i>Your Culinary Journey</h1>
        <div class="input-group mb-4">
            <input type="text" id="searchBar" class="form-control" placeholder="Search orders..."
                oninput="filterOrders()" />
        </div>
        <div id="orderList" class="row"></div>
        <div id="paginationControls" class="d-flex justify-content-center mt-3"></div>
        <div id="loadingSpinner" class="d-none text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="actionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-primary d-none" id="modalConfirm"></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const orders = [
            {
                id: 1,
                date: "2023-06-01",
                total: 25.99,
                items: ["Gourmet Burger", "Truffle Fries", "Craft Soda"],
                icon: "fa-burger",
            },
            {
                id: 2,
                date: "2023-06-15",
                total: 32.5,
                items: ["Margherita Pizza", "Caesar Salad", "Garlic Focaccia"],
                icon: "fa-pizza-slice",
            },
            {
                id: 3,
                date: "2023-07-02",
                total: 18.75,
                items: ["Club Sandwich", "Sweet Potato Chips", "Iced Green Tea"],
                icon: "fa-sandwich",
            },
            {
                id: 4,
                date: "2023-06-15",
                total: 32.5,
                items: ["Margherita Pizza", "Caesar Salad", "Garlic Focaccia"],
                icon: "fa-pizza-slice",
            }
        ];

        let currentPage = 1;
        const ordersPerPage = 4;

        function createOrderCard(order) {
            return `
        <div class="col-md-3 mb-4"> <!-- Updated to col-md-3 -->
            <div class="card order-card">
                <div class="card-header">
                    <i class="fas ${order.icon} order-icon"></i>Order #${order.id
                }
                </div>
                <div class="card-body">
                    <h5 class="card-title"><i class="far fa-calendar-alt"></i> ${order.date
                }</h5>
                    <p class="card-text"><i class="fas fa-dollar-sign"></i> Total: $${order.total.toFixed(
                    2
                )}</p>
                    <p class="card-text"><i class="fas fa-list-ul"></i> Items: ${order.items.join(
                    ", "
                )}</p>
                    <div class="btn-group">
                        <button class="btn btn-view-details" onclick="showModal('Order Details', ${order.id
                })">
                            <i class="fas fa-eye"></i> View Details
                        </button>
                        <button class="btn btn-reorder" onclick="showModal('Reorder Items', ${order.id
                })">
                            <i class="fas fa-redo"></i> Reorder
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
        }

        function renderOrders() {
            const start = (currentPage - 1) * ordersPerPage;
            const paginatedOrders = orders.slice(start, start + ordersPerPage);

            const orderList = document.getElementById("orderList");
            orderList.innerHTML = paginatedOrders.length
                ? paginatedOrders.map(createOrderCard).join("")
                : '<p class="no-orders">You haven\'t placed any orders yet. Time to treat yourself!</p>';

            renderPaginationControls();
        }

        function renderPaginationControls() {
            const totalPages = Math.ceil(orders.length / ordersPerPage);
            const paginationControls = Array.from(
                { length: totalPages },
                (_, i) => `
                <button class="btn btn-outline-primary ${i + 1 === currentPage ? "active" : ""
                    }" onclick="goToPage(${i + 1})">
                    ${i + 1}
                </button>
            `
            ).join("");
            document.getElementById("paginationControls").innerHTML =
                paginationControls;
        }

        function goToPage(page) {
            currentPage = page;
            renderOrders();
        }

        function showModal(title, orderId) {
            const modalTitle = document.getElementById("modalTitle");
            const modalBody = document.getElementById("modalBody");
            const modalConfirm = document.getElementById("modalConfirm");

            modalTitle.innerText = title;
            const order = orders.find((o) => o.id === orderId);

            if (title === "Order Details") {
                modalBody.innerHTML = `
                    <p><strong>Date:</strong> ${order.date}</p>
                    <p><strong>Total:</strong> $${order.total.toFixed(2)}</p>
                    <p><strong>Items:</strong></p>
                    <ul>${order.items
                        .map((item) => `<li>${item}</li>`)
                        .join("")}</ul>
                `;
                modalConfirm.classList.add("d-none");
            } else if (title === "Reorder Items") {
                modalBody.innerHTML = `
                    <p>Select items to reorder:</p>
                    ${order.items
                        .map(
                            (item) => `
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="${item}" checked>
                            <label class="form-check-label" for="${item}">${item}</label>
                        </div>
                    `
                        )
                        .join("")}
                `;
                modalConfirm.classList.remove("d-none");
                modalConfirm.innerText = "Confirm Reorder";
                modalConfirm.onclick = () => confirmReorder(orderId);
            }

            const modal = new bootstrap.Modal(
                document.getElementById("actionModal")
            );
            modal.show();
        }

        function confirmReorder(orderId) {
            const order = orders.find((o) => o.id === orderId);
            console.log(`Reordering items from Order #${orderId}`);
            alert(`Your order has been placed! Total: $${order.total.toFixed(2)}`);
        }

        function filterOrders() {
            const query = document.getElementById("searchBar").value.toLowerCase();
            const filteredOrders = orders.filter(
                (order) =>
                    order.date.includes(query) ||
                    order.total.toString().includes(query) ||
                    order.items.some((item) => item.toLowerCase().includes(query))
            );
            const orderList = document.getElementById("orderList");
            orderList.innerHTML = filteredOrders.length
                ? filteredOrders.map(createOrderCard).join("")
                : '<p class="no-orders">No orders match your search criteria.</p>';
            renderPaginationControls();
        }

        function showLoading() {
            document.getElementById("loadingSpinner").classList.remove("d-none");
        }

        function hideLoading() {
            document.getElementById("loadingSpinner").classList.add("d-none");
        }

        window.onload = () => {
            showLoading();
            setTimeout(() => {
                hideLoading();
                renderOrders();
            }, 1000); // Simulate a delay for loading
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>