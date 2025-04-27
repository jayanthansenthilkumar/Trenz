<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$userid = $_SESSION['username'];
$sql = "SELECT * FROM events WHERE status IN (1, 2)";
$result = mysqli_query($conn, $sql);

$sql1 = "SELECT * FROM intramkce WHERE status IN (1, 2)";
$result1 = mysqli_query($conn, $sql1);

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
    
    <!-- Add export libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
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
                        <li>
                            <a href="manageAdmin.php"><i class="ri-admin-line"></i> Manage Admin</a>
                        </li>
                        <li>
                            <a href="superEvents.php"><i class="ri-calendar-event-line"></i> Events</a>
                        </li>
                        <li class="active">
                            <a href="#"><i class="ri-group-line"></i> Participants</a>
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
                <!-- Tabbed Section for Participants -->
                    <div class="content-section">
                        <h2 class="section-title">Event Participants</h2>
                        <!-- Tab Navigation -->
                        <div class="tabs-header" id="tabs-header">
                            <button class="tab-button active" data-tab="registered-tab">Intercollege</button>
                            <button class="tab-button" data-tab="approved-tab">Intracollege</button>
                        </div>
                        <!-- Registered Participants Tab -->
                        <div id="registered-tab" class="tab-content active">
                            <div class="tab-container">
                                <div class="tab-header-container">
                                    <div class="tab-header-content">
                                        <h3 class="tab-title">Intercollege Participants</h3>
                                        <div class="tab-actions">
                                            <button class="action-btn filter-btn" id="filter-btn"><i class="ri-filter-3-line"></i> Filter</button>
                                            <button class="action-btn export-btn pdf-btn" id="export-pdf-intercollege"><i class="ri-file-pdf-line"></i> PDF</button>
                                            <button class="action-btn export-btn excel-btn" id="export-excel-intercollege"><i class="ri-file-excel-line"></i> Excel</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="datatable-controls">
                                    <div class="controls-row">
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
                                </div>
                                <div class="datatable-wrapper">
                                    <table class="datatable" id="registered-table">
                                        <thead>
                                        <tr>
                                                <th>Trenz ID</th>
                                                <th>Name</th>
                                                <th>Register No</th>
                                                <th>Phone No</th>
                                                <th>Email</th>
                                                <th>College</th>
                                                <th>Event</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $s = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['Trenzid']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['regno']; ?></td>
                                                    <td><?php echo $row['phoneno']; ?></td>
                                                    <td><?php echo $row['emailid']; ?></td>
                                                    <td><?php echo $row['collegename']; ?></td>
                                                    <td><?php echo $row['events1']; ?></td>
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
                        
                        <!-- Approved Participants Tab -->
                        <div id="approved-tab" class="tab-content">
                            <div class="tab-container">
                                <div class="tab-header-container">
                                    <div class="tab-header-content">
                                        <h3 class="tab-title">Intracollege Participants</h3>
                                        <div class="tab-actions">
                                            <button class="action-btn filter-btn" id="filter-btn-intra"><i class="ri-filter-3-line"></i> Filter</button>
                                            <button class="action-btn export-btn pdf-btn" id="export-pdf-intracollege"><i class="ri-file-pdf-line"></i> PDF</button>
                                            <button class="action-btn export-btn excel-btn" id="export-excel-intracollege"><i class="ri-file-excel-line"></i> Excel</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="datatable-controls">
                                    <div class="controls-row">
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
                                </div>
                                <div class="datatable-wrapper">
                                    <table class="datatable" id="approved-table">
                                        <thead>
                                        <tr>
                                                <th>Trenz ID</th>
                                                <th>Name</th>
                                                <th>Register No</th>
                                                <th>Phone No</th>
                                                <th>Email</th>
                                                <th>Department</th>
                                                <th>Event</th>
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
                                                    <td><?php echo $row['regno']; ?></td>
                                                    <td><?php echo $row['phoneno']; ?></td>
                                                    <td><?php echo $row['emailid']; ?></td>
                                                    <td><?php echo $row['depart']; ?></td>
                                                    <td><?php echo $row['events1']; ?></td>
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
            </div>
        </main>
    </div>


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Add export functionality
        document.addEventListener('DOMContentLoaded', function() {
            // PDF Export functions
            function exportTableToPDF(tableId, filename, reportType) {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();
                
                // Add title with report type
                doc.setFontSize(16);
                doc.text('Trenz\'25 Participants Report', 14, 16);
                doc.setFontSize(14);
                doc.text(reportType, 14, 24);
                doc.setFontSize(12);
                doc.text('Generated on: ' + new Date().toLocaleString(), 14, 32);
                
                doc.autoTable({
                    html: '#' + tableId,
                    startY: 40,
                    styles: {
                        fontSize: 8,
                        cellPadding: 2,
                        lineColor: [0, 0, 0],
                        lineWidth: 0.1
                    },
                    headStyles: {
                        fillColor: [41, 128, 185],
                        textColor: 255,
                        fontStyle: 'bold'
                    },
                    alternateRowStyles: {
                        fillColor: [240, 240, 240]
                    }
                });
                
                doc.save(filename + '.pdf');
            }
            
            // Excel Export function
            function exportTableToExcel(tableId, filename, reportType) {
                // Get table data
                const table = document.getElementById(tableId);
                const rows = Array.from(table.querySelectorAll('tr'));
                
                // Extract headers
                const headers = Array.from(rows.shift().querySelectorAll('th')).map(th => th.textContent.trim());
                
                // Extract data
                const data = rows.map(row => {
                    return Array.from(row.querySelectorAll('td')).map(td => td.textContent.trim());
                });
                
                // Create worksheet
                const ws = XLSX.utils.aoa_to_sheet([headers, ...data]);
                
                // Add title and date information at the top of the sheet
                XLSX.utils.sheet_add_aoa(ws, [
                    ['Trenz\'25 Participants Report'],
                    [reportType],
                    ['Generated on: ' + new Date().toLocaleString()],
                    [''] // Empty row before the table data
                ], { origin: 'A1' });
                
                // Adjust column widths
                const colWidths = headers.map(h => ({ wch: Math.max(h.length, 10) }));
                ws['!cols'] = colWidths;
                
                // Create workbook
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Participants');
                
                // Generate Excel file
                XLSX.writeFile(wb, filename + '.xlsx');
            }
            
            // Attach export buttons events
            document.getElementById('export-pdf-intercollege').addEventListener('click', function() {
                exportTableToPDF('registered-table', 'Intercollege_Participants', 'Intercollege Participants Report');
            });
            
            document.getElementById('export-excel-intercollege').addEventListener('click', function() {
                exportTableToExcel('registered-table', 'Intercollege_Participants', 'Intercollege Participants Report');
            });
            
            document.getElementById('export-pdf-intracollege').addEventListener('click', function() {
                exportTableToPDF('approved-table', 'Intracollege_Participants', 'Intracollege Participants Report');
            });
            
            document.getElementById('export-excel-intracollege').addEventListener('click', function() {
                exportTableToExcel('approved-table', 'Intracollege_Participants', 'Intracollege Participants Report');
            });
            
            document.getElementById('export-pdf-all').addEventListener('click', function() {
                exportTableToPDF('spot-registration-table', 'All_Participants', 'Overall Participants Report');
            });
            
            document.getElementById('export-excel-all').addEventListener('click', function() {
                exportTableToExcel('spot-registration-table', 'All_Participants', 'Overall Participants Report');
            });
        });
    </script>
    
    <style>
        .export-buttons {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        
        .export-btn {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .export-btn:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .export-btn i {
            font-size: 16px;
        }

        /* Additional styles for better alignment and appearance */
        .content-section {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 20px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5rem;
            color: #2d3748;
            margin-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 10px;
        }

        .tabs-header {
            display: flex;
            gap: 5px;
            margin-bottom: 20px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .tab-button {
            background-color: #f1f5f9;
            border: none;
            border-radius: 5px 5px 0 0;
            padding: 10px 20px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .tab-button:hover {
            background-color: #e2e8f0;
        }

        .tab-button.active {
            background-color: #2563eb;
            color: white;
        }

        .datatable-controls {
            background-color: #f8fafc;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .controls-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 10px;
            width: 100%;
        }

        .datatable-length, .datatable-filter {
            flex: 1;
            min-width: 200px;
        }

        .datatable-length {
            display: flex;
            align-items: center;
        }

        .datatable-filter {
            display: flex;
            justify-content: flex-end;
        }

        .datatable-length select, 
        .datatable-filter input {
            padding: 8px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            margin: 0 5px;
        }

        .datatable-filter input {
            width: 200px;
        }

        .datatable-wrapper {
            overflow-x: auto;
        }

        .datatable {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .datatable th {
            background-color: #f1f5f9;
            color: #1e293b;
            font-weight: 600;
            text-align: left;
            padding: 12px 15px;
            border-bottom: 2px solid #cbd5e1;
        }

        .datatable td {
            padding: 10px 15px;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
        }

        .datatable tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .datatable tr:hover {
            background-color: #e0f2fe;
        }

        /* Status badges styling */
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-badge.completed {
            background-color: #dcfce7;
            color: #166534;
        }

        /* New styles for the tab header container */
        .tab-header-container {
            background-color: #f8fafc;
            border-radius: 8px 8px 0 0;
            padding: 15px 20px;
            margin-bottom: 0;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        
        .tab-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .tab-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .tab-actions {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .action-btn i {
            font-size: 16px;
        }
        
        .filter-btn {
            background-color: #f1f5f9;
            color: #475569;
        }
        
        .filter-btn:hover {
            background-color: #e2e8f0;
        }
        
        .export-btn {
            color: white;
        }
        
        .pdf-btn {
            background-color: #dc2626;
        }
        
        .pdf-btn:hover {
            background-color: #b91c1c;
        }
        
        .excel-btn {
            background-color: #16a34a;
        }
        
        .excel-btn:hover {
            background-color: #15803d;
        }
        
        /* Responsive adjustments for tab header and controls */
        @media (max-width: 768px) {
            .tab-header-content {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .tab-actions {
                width: 100%;
                justify-content: flex-start;
            }
            
            .controls-row {
                flex-direction: column;
                align-items: stretch;
            }
            
            .datatable-length, .datatable-filter {
                width: 100%;
                display: flex;
                justify-content: flex-start;
            }
            
            .datatable-filter {
                margin-top: 10px;
            }
            
            .datatable-filter input {
                width: 100%;
            }
        }
    </style>
</body>

</html>