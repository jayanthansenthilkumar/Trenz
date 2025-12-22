<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$userid = $_SESSION['username'];
$sql = "SELECT * FROM login WHERE role = '1'";
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
    <style>
        /* Custom modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal.show {
            display: flex;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--bg-dark);
        }
        
        .modal-title {
            font-weight: 600;
            margin: 0;
        }
        
        .btn-close {
            background: none;
            border: none;
            color: var(--text-light);
            font-size: 1.5rem;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn-close:hover {
            color: var(--error-color);
        }
        
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--bg-dark);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
        
        /* Form styling for modal */
        .form-group {
            margin-bottom: 1.25rem;
            position: relative;
            width: 100%;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
            font-size: 0.95rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--bg-dark);
            border-radius: var(--radius-md);
            background-color: var(--bg-light);
            color: var(--text-color);
            font-size: 0.95rem;
            transition: all 0.2s ease;
            display: block;
            margin-top: 0.25rem;
        }
        
        /* Enhanced modal container styling */
        .modal-dialog {
            background-color: var(--bg-light);
            border-radius: var(--radius-lg);
            width: 90%;
            max-width: 500px; /* Reduced for better readability */
            box-shadow: var(--shadow-lg);
            animation: modalFadeIn 0.3s ease;
            overflow: hidden; /* Prevent content overflow */
        }
        
        .modal-content {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .modal-body {
            padding: 1.5rem;
            max-height: 70vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        #Adduser {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
        }
        
        /* Improve modal sizes on mobile */
        @media (max-width: 768px) {
            .modal-dialog {
                width: 95%;
            }
            
            .form-control {
                padding: 0.7rem 0.85rem;
                font-size: 0.9rem;
            }
            
            .form-group {
                margin-bottom: 1rem;
            }
        }
        
        /* Content section header with flexbox for button placement */
        .content-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        /* Button styling */
        .btn-danger {
            background-color: var(--error-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-danger:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }
        
        .btn-danger:active {
            transform: translateY(0);
            box-shadow: none;
        }
        
        /* Action buttons container */
        .action-buttons {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        /* Excel button styling */
        .btn-success {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }
        
        /* PDF button styling */
        .btn-danger-light {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-danger-light:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }
        
        @media (max-width: 768px) {
            .btn-danger, .btn-success, .btn-danger-light {
                padding: 0.4rem 0.75rem;
                font-size: 0.85rem;
            }
            
            .action-buttons {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body class="admin-dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Trenz</h2>
                <span class="admin-label">Superadmin</span>
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
                        <li class="active">
                            <a href="#"><i class="ri-admin-line"></i> Manage Admin</a>
                        </li>
                        <li>
                            <a href="superEvents.php"><i class="ri-calendar-event-line"></i> Events</a>
                        </li>
                        <li>
                            <a href="participants.php"><i class="ri-group-line"></i> Participants</a>
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
                    <div class="user-dropdown">
                        <img src="https://ui-avatars.com/api/?name=Jayanthan+Senthilkumar&background=2563eb&color=fff" alt="Event Admin">
                        <span>Super Admin</span>
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
                <div class="content-section">
                    <div class="content-section-header">
                        <h2>Manage Admins</h2>
                        <div class="action-buttons">
                            <button type="button" class="btn-success" id="downloadExcelBtn">
                                <i class="ri-file-excel-line"></i> Excel
                            </button>
                            <button type="button" class="btn-danger-light" id="downloadPdfBtn">
                                <i class="ri-file-pdf-line"></i> PDF
                            </button>
                            <button type="button" class="btn-primary" id="addAdminBtn">Add new user</button>
                        </div>
                    </div>
                    
                    <!-- Simple Table for Admins -->
                    <div class="simple-table-wrapper">
                        <table class="simple-table" id="admins-table">
                            <thead>
                                <tr>
                                    <th>S. No</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>User ID</th>
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
                                            <button type="button" class="btn-danger btndelete" value="<?php echo $row['id']; ?>">
                                                <i class="ri-delete-bin-line"></i> Delete user
                                            </button>
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
            </div>
        </main>
    </div>

    <!-- Add Admin Modal -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Admin</h5>
                    <button type="button" class="btn-close" id="closeModalBtn">×</button>
                </div>
                <form id="Adduser">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" id="Name" name="Names" class="form-control" placeholder="Enter your Name" required>
                        </div>

                        <div class="form-group">
                            <label for="phoneno">Phone Number</label>
                            <input type="text" id="phoneno" name="phoneno" class="form-control" placeholder="Enter your phone number" required>
                        </div>

                        <div class="form-group">
                            <label for="userid">User ID</label>
                            <input type="text" id="userid" name="userid" class="form-control" placeholder="Enter your User ID" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" id="cancelBtn">Cancel</button>
                        <button type="submit" class="btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script>
        // Custom modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const addAdminBtn = document.getElementById('addAdminBtn');
            const addModal = document.getElementById('addModal');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            
            // Show modal
            addAdminBtn.addEventListener('click', function() {
                addModal.classList.add('show');
            });
            
            // Hide modal
            closeModalBtn.addEventListener('click', function() {
                addModal.classList.remove('show');
            });
            
            cancelBtn.addEventListener('click', function() {
                addModal.classList.remove('show');
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === addModal) {
                    addModal.classList.remove('show');
                }
            });
            
            // Search functionality for table
            const searchInput = document.querySelector('.search-bar input');
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const tableRows = document.querySelectorAll('#admins-table tbody tr');
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if(text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Form submission for adding admin
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
                        document.getElementById('addModal').classList.remove('show');
                        document.getElementById('Adduser').reset();
                        // Reload the page
                        location.reload();
                    } else if (res.status == 500) {
                        document.getElementById('addModal').classList.remove('show');
                        document.getElementById('Adduser').reset();
                        alert("Something went wrong! Try again.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Ajax Error:", error);
                    alert("Error occurred while saving data");
                }
            });
        });

        // Delete admin functionality
        $(document).on('click', '.btndelete', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this data?')) {
                var id = $(this).val();
                
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
                            alert("User deleted");
                            location.reload();
                        }
                    }
                });
            }
        });

        // Excel Export functionality with proper error handling
        document.getElementById('downloadExcelBtn').addEventListener('click', function() {
            try {
                // Get the table
                const table = document.getElementById('admins-table');
                
                // Create workbook and worksheet
                const wb = XLSX.utils.book_new();
                
                // Create a modified version of the table data without the Action column
                const headers = Array.from(table.querySelectorAll('thead th')).slice(0, 5).map(th => th.textContent);
                const data = Array.from(table.querySelectorAll('tbody tr')).map(row => 
                    Array.from(row.querySelectorAll('td')).slice(0, 5).map(cell => cell.textContent.trim())
                );
                
                // Combine headers and data
                const exportData = [headers, ...data];
                
                // Create a worksheet from the filtered data
                const ws = XLSX.utils.aoa_to_sheet(exportData);
                
                // Add worksheet to workbook
                XLSX.utils.book_append_sheet(wb, ws, 'Admins');
                
                // Generate Excel file
                const today = new Date();
                const date = today.toISOString().split('T')[0]; // YYYY-MM-DD format
                const filename = `Trenz_Admins_${date}.xlsx`;
                
                // Save the file
                XLSX.writeFile(wb, filename);
            } catch(e) {
                console.error('Excel export error:', e);
                alert('Failed to export Excel. Please try again.');
            }
        });
        
        // PDF Export functionality with proper error handling
        document.getElementById('downloadPdfBtn').addEventListener('click', function() {
            try {
                // Get the table data
                const table = document.getElementById('admins-table');
                const rows = Array.from(table.querySelectorAll('tbody tr'));
                
                // Create PDF document
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                // Add title to PDF
                doc.setFontSize(18);
                doc.text('Trenz Admin Users', 14, 22);
                
                // Add date
                const today = new Date();
                const date = today.toISOString().split('T')[0];
                doc.setFontSize(11);
                doc.text(`Generated on: ${date}`, 14, 30);
                
                // Convert table to array of arrays for autotable, excluding the Action column
                const headerData = Array.from(table.querySelectorAll('thead th'))
                    .slice(0, 5) // Get only the first 5 columns (exclude Action)
                    .map(th => th.textContent);
                    
                const bodyData = rows.map(row => 
                    Array.from(row.querySelectorAll('td'))
                    .slice(0, 5) // Get only the first 5 columns (exclude Action)
                    .map(cell => cell.textContent.trim())
                );
                
                // Generate table in PDF
                doc.autoTable({
                    head: [headerData],
                    body: bodyData,
                    startY: 35,
                    styles: { fontSize: 10, cellPadding: 3 },
                    headStyles: { fillColor: [37, 99, 235] }, // Blue header
                    margin: { top: 35 }
                });
                
                // Save the PDF
                doc.save(`Trenz_Admins_${date}.pdf`);
            } catch(e) {
                console.error('PDF export error:', e);
                alert('Failed to export PDF. Please try again.');
            }
        });
    </script>
</body>

</html>