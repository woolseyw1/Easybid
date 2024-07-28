<?php
// details.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "easybid_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start session and fetch user ID
session_start();

// Fetch user details
$user_id = $_SESSION['user_id']; // Make sure 'user_id' is set in the session during login
$sql = "SELECT first_name, last_name FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name);
$stmt->fetch();
$stmt->close();

// Get RFP ID from URL
$id = intval($_GET['id']);

// Fetch RFP details
$sql = "SELECT * FROM rfps WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$rfp = $result->fetch_assoc();

if (!$rfp) {
    echo "RFP not found.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .card {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 15px;
        background-color: #f9f9f9; /* Background color for the card */
    }

    table {
        width: 100%;
        border-collapse: collapse; /* Ensure borders are collapsed */
        text-align: left;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd; /* Bottom border for all cells */
        border-left: 1px solid #ddd; /* Vertical line for separation */
    }

    th {
        background-color: #f2f2f2; /* Background color for table headers */
        text-align: left;
    }

    td {
        text-align: left;
    }

    .button-container {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .btton {
        padding: 10px 20px;
        margin: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-return {
        background-color: #0092CC;
        color: white;
    }

    .btn-generate {
        text-align: left;
        background-color: #0092CC;
        color: white;
    }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">EasyBidSolutions.</a>
        <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php">Profile Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="reg.html">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard Home
                            </a>
                            <a class="nav-link" href="rfp.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Search RFPs
                            </a>
                            
                            <a class="nav-link" href="contracts.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                My Contracts
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                </nav>
                            </div>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                RFP Notifications
                            </a>
                            <a class="nav-link" href="bid_stat.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Bid Status Updates
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <strong><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></strong>
                    </div>
                </nav>
            </div>
    <!-- Navbar and other components -->
    <div id="layoutSidenav_content">

    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo htmlspecialchars($rfp['title']); ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">RFP <?php echo htmlspecialchars($rfp['id']); ?> Details</li>
            </ol>
            <!-- Display RFP Details -->
            <!-- Use PHP to insert values from $rfp array -->

            <h4 class="mt-4">RFP Overview:</h4>
            <div class="card mb-4">

                <table>
                    <thead>
                        <tr>
                            <th>RFP Title</th>
                            <th><?php echo htmlspecialchars($rfp['title']); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>RFP ID</td>
                            <td><?php echo htmlspecialchars($rfp['id']); ?></td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td><?php echo htmlspecialchars($rfp['category']); ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?php echo htmlspecialchars($rfp['status']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">Description:</h4>
            <div class="card mb-4">
                <table>
                    <thead>
                        <tr>
                            <th>Detailed Description</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($rfp['description']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">Key Dates:</h4>
            <div class="card mb-4">
                <table>
                    <thead>
                        <tr>
                            <th>Release Date</th>
                            <th><?php echo htmlspecialchars($rfp['release_date']); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Submission Deadline </td>
                            <td><?php echo htmlspecialchars($rfp['submission_deadline']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">Estimated Value</h4>
            <div class="card mb-4">
                <table>
                    <thead>
                        <tr>
                            <th>Budget</th>
                            <th>$<?php echo number_format(htmlspecialchars($rfp['estimated_value'])); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>

            <h4 class="mt-4">Project Scope:</h4>
            <div class="card mb-4">
                <table>
                    <thead>
                        <tr>
                            <th>Scope of Work</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($rfp['project_scope']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">Submission Requirements:</h4>
            <div class="card mb-4">
                <table>
                    <thead>
                        <tr>
                            <th>Proposal Submission Guidelines</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo htmlspecialchars($rfp['submission_requirements']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">Contact Information:</h4>
            <div class="card mb-4">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th><?php echo htmlspecialchars($rfp['contact_name']); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Position</td>
                            <td><?php echo htmlspecialchars($rfp['contact_position']); ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo htmlspecialchars($rfp['contact_email']); ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo htmlspecialchars($rfp['contact_phone']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="button-container">
                <button class="btton btn-return" onclick="window.location.href='rfp.php';">Return</button>
                <?php if ($rfp['status'] !== 'Closed') { ?>
                    <button class="btton btn-generate" id="generateBidButton">Generate Bid</button>
                <?php } ?>
            </div>
        </div>
    </main>

    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">&copy; 2023 <strong><span>EasyBidSolutions.</span></strong> All Rights Reserved</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>

    <div class="modal fade" id="bidGeneratedModal" tabindex="-1" aria-labelledby="bidGeneratedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bidGeneratedModalLabel">Bid Generated</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your bid has been successfully generated and is pending review. 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var status = <?php echo json_encode($rfp['status']); ?>;

        if (status !== 'closed') {
            document.getElementById('generateBidButton').addEventListener('click', function() {
                var rfpId = <?php echo json_encode($rfp['id']); ?>;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_status.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var bidGeneratedModal = new bootstrap.Modal(document.getElementById('bidGeneratedModal'));
                        bidGeneratedModal.show();
                        document.querySelector('td:contains("Status") + td').textContent = 'closed';
                    } else {
                        console.error('Failed to update status:', xhr.responseText);
                    }
                };

                xhr.send('id=' + rfpId);
            });
        }
    });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    </body>
</html>


