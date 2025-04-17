<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
$userid = $_SESSION['username'];

$sql = "SELECT * FROM events Where status='0' ";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);


$sql1 = "SELECT * FROM events Where status='1' ";
$result1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * FROM events Where status='2' ";
$result2 = mysqli_query($conn, $sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trenz'25</title>
    <link href="./assets/images/trenz.png" rel="icon" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</head>

<body class="admin-dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Trenz</h2>
                <span class="admin-label">Events</span>
                <button id="sidebar-toggle" class="sidebar-toggle">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
            <div class="sidebar-content">
                <nav class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="adminDashboard.php"><i class="ri-dashboard-line"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="events.php"><i class="ri-calendar-event-line"></i> Events</a>
                        </li>
                        <li class="active">
                            <a href="participants.php"><i class="ri-user-star-line"></i> Participants</a>
                        </li>
                        <li>
                            <a href="spotRegistration.php"><i class="ri-user-add-line"></i> Spot Registration</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" placeholder="Search participants, events...">
                </div>
                <div class="header-actions">
                    <button class="message-btn">
                        <i class="ri-mail-line"></i>
                        <span class="badge"><?php echo $count?></span>
                    </button>
                    <div class="user-dropdown">
                        <img src="https://ui-avatars.com/api/?name=Event+Admin&background=2563eb&color=fff" alt="Event Admin">
                        <span><?php echo $userid ?></span>
                        <i class="ri-arrow-down-s-line"></i>
                        <!-- User dropdown menu -->
                        <div class="dropdown-menu">
                            <ul>
                                <li><a href="logout.php"><i class="ri-logout-box-r-line"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Tabbed Section for Participants -->
                <div class="content-section">
                    <h2>Event Participants</h2>
                    <!-- Tab Navigation -->
                    <div class="tabs-header" id="tabs-header">
                        <button class="tab-button active" data-tab="registered-tab">Registered Participants</button>
                        <button class="tab-button" data-tab="approved-tab">Approved Participants</button>
                        <button class="tab-button" data-tab="spot-registration-tab">Spot Registration</button>
                    </div>
                    <!-- Registered Participants Tab -->
                    <div id="registered-tab" class="tab-content active">
                        <div class="datatable-controls">
                            <div class="datatable-length">
                                <label>
                                    Show
                                    <select>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    entries
                                </label>
                            </div>
                            <div class="datatable-filter">
                                <label>
                                    Search:
                                    <input type="search" placeholder="Enter keywords...">
                                </label>
                            </div>
                        </div>
                        <div class="datatable-wrapper">
                            <table class="datatable" id="registered-table">
                                <thead>
                                    <tr>
                                        <th>Trenz ID</th>
                                        <th>Register Number</th>
                                        <th>Name</th>
                                        <th>College Name</th>
                                        <th>Events</th>
                                        <th>Payment Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $s = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['Trenzid']; ?></td>
                                            <td><?php echo $row['regno']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['collegename']; ?></td>
                                            <td><?php echo $row['events1']; ?></td>
                                            <td><button class="payment-btn" data-id="<?php echo $row['Trenzid']; ?>">View Payment</button>
                                            </td>
                                            <td class="action-buttons">
                                                <button class="btn-icon accept userapprove" value="<?php echo $row['id']; ?>"><i class="ri-check-line"></i></button>
                                                <!-- <button class="btn-icon reject"><i class="ri-close-line"></i></button> -->
                                            </td>
                                        </tr>
                                    <?php
                                        $s++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Approved Participants Tab -->
                    <div id="approved-tab" class="tab-content">
                        <div class="datatable-controls">
                            <div class="datatable-length">
                                <label>
                                    Show
                                    <select>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    entries
                                </label>
                            </div>
                            <div class="datatable-filter">
                                <label>
                                    Search:
                                    <input type="search" placeholder="Enter keywords...">
                                </label>
                            </div>
                        </div>

                        <div class="datatable-wrapper">
                            <table class="datatable" id="approved-table">
                                <thead>
                                    <tr>
                                        <th>Trenz ID</th>
                                        <th>Name</th>
                                        <th>College Name</th>
                                        <th>Events</th>
                                        <th>Payment Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $s = 1;
                                    while ($row = mysqli_fetch_array($result1)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['Trenzid']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['collegename']; ?></td>
                                            <td><?php echo $row['events1']; ?></td>
                                            <td><span class="status-badge completed">Paid</span></td>

                                        </tr>
                                    <?php
                                        $s++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Spot Registration Tab -->
                    <div id="spot-registration-tab" class="tab-content">
                        <div class="datatable-controls">
                            <div class="datatable-length">
                                <label>
                                    Show
                                    <select>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    entries
                                </label>
                            </div>
                            <div class="datatable-filter">
                                <label>
                                    Search:
                                    <input type="search" placeholder="Enter keywords...">
                                </label>
                            </div>
                        </div>

                        <div class="datatable-wrapper">
                            <table class="datatable" id="spot-registration-table">
                                <thead>
                                    <tr>
                                        <th>Trenz ID</th>
                                        <th>Name</th>
                                        <th>College Name</th>
                                        <th>Events</th>

                                        <th>Payment Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $s = 1;
                                    while ($row = mysqli_fetch_array($result2)) {
                                    ?>
                                    <tr>
                                            <td><?php echo $row['Trenzid']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['collegename']; ?></td>
                                            <td><?php echo $row['events1']; ?></td>
                                            
                                            <td><span class="status-badge completed">Paid</span></td>

                                        </tr>
                                    <?php
                                        $s++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Details Modal -->
            <div class="modal" id="payment-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Payment Details</h3>
                        <button class="modal-close"><i class="ri-close-line"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="payment-info">
                            <div class="info-row">
                                <span class="info-label">Participant ID:</span>
                                <span class="info-value" id="Id"></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Participant Name:</span>
                                <span class="info-value" id="payment-participant-name"></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Participant Email:</span>
                                <span class="info-value" id="payment-participant-Email"></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Participant Phoneno:</span>
                                <span class="info-value" id="payment-participant-phone"></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Payment Status:</span>
                                <span class="info-value status-badge completed" id="payment-status">Paid</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Amount:</span>
                                <span class="info-value" id="payment-amount">$250.00</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Transaction ID:</span>
                                <span class="info-value" id="payment-transaction"></span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Payment Date:</span>
                                <span class="info-value" id="payment-date"></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">ID card:</span>
                                <img src="" id="IdImage" alt="" width="150px" height="150px">
                            </div>
                            <div class="info-row">
                                <span class="info-label">Payment Proof:</span>
                                <img src="" id="PaymentImage" alt="" width="150px" height="150px">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-secondary modal-close">Close</button>
                        <button class="btn-primary">Print Receipt</button>
                    </div>
                </div>
            </div>


        </main>
    </div>


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.payment-btn', function() {
            var participant_id = $(this).data('id'); // Get ID
            console.log(participant_id);

            $.ajax({
                url: 'backend.php',
                type: 'GET',
                data: {
                    'get_user': true,
                    'id': participant_id,
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        console.log(response.data.Trenzid)
                        $('#Id').text(response.data.Trenzid);
                        $('#payment-participant-name').text(response.data.name);
                        $('#payment-transaction').text(response.data.transactionid);
                        $('#payment-date').text(response.data.date);
                        $('#payment-participant-Email').text(response.data.email);
                        $('#payment-participant-phone').text(response.data.phoneno);
                        $('#IdImage').attr('src', 'assets/idcard/' + response.data.idcard);
                        $('#PaymentImage').attr('src', 'assets/payment/' + response.data.paymentproof);
                        $('#payment-modal').show();
                    } else {
                        alert('No Data Found');
                    }
                }
            });
        });

        $(document).on('click', '.userapprove', function(e) {
            e.preventDefault();
            var id = $(this).val();
            console.log(id);
            if (confirm('Are you sure you want to approve the User ?')) {

                $.ajax({
                    type: "POST",
                    url: "backend.php",
                    data: {
                        'approve_user': true,
                        'ids': id
                    },
                    success: function(response) {
                        var res = jQuery.parseJSON(response);
                        if (res.status == 500) {
                            alert(res.message);
                        } else {
                            Swal.fire({
                                title: "Success",
                                text: "User Approved",
                                icon: "success"
                            });
                            
                         
                            $('#registered-table').load(location.href + " #registered-table");
                            $('#approved-table').load(location.href + " #approved-table");
                            
                        }
                    }
                })
            }


        })
    </script>
</body>

</html>