<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Table Reservation - Bengal Tandoori Restaurant</title>

    <!-- External Libraries -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/table_reservation.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="./Images/logo.png" height="40" alt="Restaurant Logo">
                Bengal Tandoori
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="menu.html">Menu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container reservation-container">
        <h2 class="text-center mb-4">Table Reservation</h2>

        <!-- Search Form -->
        <div class="search-form mb-4">
            <div id="reservationForm" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" id="reservationDate" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Start Time</label>
                    <input type="time" class="form-control" id="startTime" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">End Time</label>
                    <input type="time" class="form-control" id="endTime" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Number of Guests</label>
                    <input type="number" class="form-control" id="guestCount" min="1" max="20" required>
                </div>
                <div class="col-12 text-center mt-4">
                    <button  class="btn btn-primary px-4" id="searchButton">
                        <i class="fas fa-search me-2"></i>Search Available Tables
                    </button>
                </div>
            </div>
        </div>

        <div class="floor-plan-container">
            <!-- Floor Plan Section -->
            <div class="floor-plan mb-4">
                <!-- Entrance and Exit -->
            <div class="entrance" style="top: 0; left: 22%; width: 120px; transform: none;">
                <i class="fas fa-door-open"></i> Main Entrance
            </div>
            <div class="emergency-exit" style="top: 0; right: 22%; width: 120px; transform: none;">
                <i class="fas fa-door-open"></i> Emergency Exit
            </div>

            <!-- Windows -->
            <div class="window" style="top: 0; left: 8%; width: 80px;">Window</div>
            <div class="window" style="top: 0; left: 38%; width: 80px;">Window</div>

            <!-- Center Divider -->
            <div class="divider"></div>

            <!-- Left Side Tables (1-8) -->
            <!-- Tables 1-4 along left wall -->
            <div class="table-layout" style="left: 8%; top: 12%;" data-table="T1">
                <span>Table 1</span>
                <span class="capacity-label">2p</span>
            </div>
            <div class="table-layout" style="left: 8%; top: 24%;" data-table="T2">
                <span>Table 2</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="left: 8%; top: 36%;" data-table="T3">
                <span>Table 3</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="left: 8%; top: 48%;" data-table="T4">
                <span>Table 4</span>
                <span class="capacity-label">4p</span>
            </div>

            <!-- Tables 5-8 along divider -->
            <div class="table-layout" style="left: 38%; top: 12%;" data-table="T5">
                <span>Table 5</span>
                <span class="capacity-label">2p</span>
            </div>
            <div class="table-layout" style="left: 38%; top: 24%;" data-table="T6">
                <span>Table 6</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="left: 38%; top: 36%;" data-table="T7">
                <span>Table 7</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="left: 38%; top: 48%;" data-table="T8">
                <span>Table 8</span>
                <span class="capacity-label">4p</span>
            </div>

            <!-- Right Side Tables (9-21) -->
            <!-- First Column (9-13) -->
            <div class="table-layout" style="right: 38%; top: 12%;" data-table="T9">
                <span>Table 9</span>
                <span class="capacity-label">2p</span>
            </div>
            <div class="table-layout" style="right: 38%; top: 24%;" data-table="T10">
                <span>Table 10</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="right: 38%; top: 36%;" data-table="T11">
                <span>Table 11</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="right: 38%; top: 48%;" data-table="T12">
                <span>Table 12</span>
                <span class="capacity-label">3p</span>
            </div>
            <div class="table-layout" style="right: 38%; top: 60%;" data-table="T13">
                <span>Table 13</span>
                <span class="capacity-label">4p</span>
            </div>

            <!-- Second Column (14-19) -->
            <div class="table-layout" style="right: 8%; top: 12%;" data-table="T14">
                <span>Table 14</span>
                <span class="capacity-label">2p</span>
            </div>
            <div class="table-layout" style="right: 8%; top: 24%;" data-table="T15">
                <span>Table 15</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="right: 8%; top: 36%;" data-table="T16">
                <span>Table 16</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="right: 8%; top: 48%;" data-table="T17">
                <span>Table 17</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="right: 8%; top: 60%;" data-table="T18">
                <span>Table 18</span>
                <span class="capacity-label">6p</span>
            </div>
            <div class="table-layout" style="right: 8%; top: 78%;" data-table="T19">
                <span>Table 19</span>
                <span class="capacity-label">6p</span>
            </div>

            <!-- Bottom Tables -->
            <div class="table-layout" style="right: 23%; bottom: 2%;" data-table="T20">
                <span>Table 20</span>
                <span class="capacity-label">4p</span>
            </div>
            <div class="table-layout" style="right: 38%; bottom: 2%;" data-table="T21">
                <span>Table 21</span>
                <span class="capacity-label">2p</span>
            </div>

        </div>
    </div>

        <!-- Available Tables Section -->
        <div id="availableTablesSection" class="mt-4" style="display: none;">
            <h3 class="mb-3">Available Tables</h3>
            <div class="row" id="tablesList">
                <!-- Table cards will be dynamically inserted here -->
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loader">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>


    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="reservation-details">
                        <!-- Details will be populated dynamically -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmReservation">Confirm Reservation</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script>
        // Updated table data based on the floor plan


        // Set minimum date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('reservationDate').setAttribute('min', today);
        document.getElementById('reservationDate').value = today;

        // Prevent selecting past dates
        document.getElementById('reservationDate').addEventListener('change', function(e) {
            const selectedDate = new Date(e.target.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (selectedDate < today) {
                alert('Please select today or a future date');
                e.target.value = today.toISOString().split('T')[0];
            }
        });
        
        // Show booked tables in red initially
        function showBookedTables() {

            document.querySelectorAll('.table-layout').forEach(table => {
                table.classList.remove('occupied', 'selected', 'available');
                table.classList.add('occupied');
            });
        }
        // showBookedTables();


        $('#searchButton').click(function (e) { 
            e.preventDefault();
            document.querySelector('.loader').style.display = 'flex';
            $.ajax({
                url: '/api/tables/search',
                type: 'POST',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                data: {
                    date: $('#reservationDate').val(),
                    start: $('#startTime').val()+':00',
                    end: $('#endTime').val()+':00',
                },
                success: function (response) {
                    showBookedTables();
                    showAvailableTables(response);
                    document.querySelector('.loader').style.display = 'none';
                },
                error: function (error) {
                    console.error('Error:', error);
                    document.querySelector('.loader').style.display = 'none';
                }
            });
            });
            // showAvailableTables(tables);

        function showAvailableTables(availableTables) {
            const tablesList = document.getElementById('tablesList');
            tablesList.innerHTML = '';

            // Filter available tables based on capacity and booking status
            

            availableTables.forEach(table => {
                // Highlight available tables in green
                const tableElement = document.querySelector(`[data-table="${table.name}"]`);
                if (tableElement) {
                    tableElement.classList.add('available');
                    tableElement.classList.remove('occupied');
                }

                // Create table card
                const tableCard = document.createElement('div');
                tableCard.className = 'col-md-6 col-lg-4';
                tableCard.innerHTML = `
                    <div class="table-card" data-table-id="${table.id}">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="mb-0">Table ${table.name}</h5>
                            <span class="table-status status-available">Available</span>
                        </div>
                        <div class="table-details">
                            <p class="mb-2">
                                <i class="fas fa-users table-info-icon"></i>
                                Capacity: ${table.capacity} persons
                            </p>
                            <p class="mb-2">
                                <i class="fas fa-map-marker-alt table-info-icon"></i>
                                Location: ${table.location ?? 'N/A'}
                            </p>
                            <p class="mb-2">
                                <i class="fa-solid fa-clock table-info-icon"></i>
                                Available: ${table.startTime ?? 'N/A'} - ${table.endTime ?? 'N/A'}
                            </p>
                        </div>
                    </div>
                `;
                tablesList.appendChild(tableCard);
            });

            document.getElementById('availableTablesSection').style.display = 'block';
        }

    



    </script>
</body>

</html>