<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
$userid = $_SESSION['username'];
$sql = "SELECT * FROM login Where role='1'";
$result = mysqli_query($conn, $sql);

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

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
                            <a href="superDashboard.php"><i class="ri-dashboard-line"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="superEvents.php"><i class="ri-user-star-line"></i>Events</a>
                        </li>
                        <li class="active">
                            <a href="manageAdmin.php"><i class="ri-user-star-line"></i>Manage Admin</a>
                        </li>
                        <li>
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
                        <span class="badge"><?php echo $count ?></span>
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
                    <h2>Manage Admins</h2>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addmodal">Add new user</button>
                    <!-- Tab Navigation -->

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
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Phonenumber</th>
                                        <th>Userid</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $s = 1;
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $s ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['phoneno']; ?></td>
                                            <td><?php echo $row['userid']; ?></td>
                                            <td><?php echo $row['password']; ?></td>

                                            <td>
                                                <button type="button" class="btn btn-danger btndelete" value="<?php echo $row['id']; ?>">Delete user</button>
                                                
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
                    <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="Adduser">
                                    <div class="modal-body">
                                        <label for="Name">Name</label><br>
                                        <input type="text" id="Name" name="Names" class="form-control" placeholder="Enter your Name" required><br>

                                        <label for="phoneno">Phoneno</label><br>
                                        <input type="text" id="phoneno" name="phoneno" class="form-control" placeholder="Enter your phoneno" required><br>

                                        <label for="userid">Userid</label><br>
                                        <input type="text" id="userid" name="userid" class="form-control" placeholder="Enter your Userid" required><br>

                                        <label for="password">Password</label><br>
                                        <input type="text" id="password" name="password" class="form-control" placeholder="Enter your password" required><br>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

            </div>




        </main>
    </div>


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).on('submit', '#Adduser', function(e) {
            e.preventDefault();
            var Formdata = new FormData(this);
            Formdata.append("Addadmins", true);

            $.ajax({
                url: "backend.php",
                method: "POST",
                data: Formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 200) {
                        $('#addmodal').modal('hide');
                        $('#Adduser')[0].reset();
                        // Reload the page and maintain table state
                        location.reload();
                    } else if (res.status == 500) {
                        $('#addmodal').modal('hide');
                        $('#Adduser')[0].reset();
                        alert("Something went wrong! Try again.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax Error:", error);
                    alert("Error occurred while saving data");
                }
            });
        });

        $(document).on('click', '.btndelete', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this data?')) {
                    var id = $(this).val();
                    console.log(id)
                    $.ajax({
                        url: "backend.php",
                        method: "POST",
                        data: {
                            'delete_user': true,
                            'userid': id
                        },
                        success: function(response) {
                            var res = jQuery.parseJSON(response);
                            if (res.status == 500) {
                                alert(res.message);
                            } else {
                                alert("user deleted");
                                location.reload();
                            }
                        }
                    })
                }
            })

    </script>
</body>

</html>