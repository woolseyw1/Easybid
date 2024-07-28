<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "easybid_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
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

// Function to fetch status
function getRfpDetails($conn, $id) {
    $sql = "SELECT title, category, release_date, submission_deadline, estimated_value, status FROM rfps WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $category, $release_date, $submission_deadline, $estimated_value, $status);
    $stmt->fetch();
    $stmt->close();

    $formatted_value = number_format($estimated_value, 0, '.', ',');

    return ['title' => $title, 'category' => $category, 'release_date' => $release_date, 'submission_deadline' => $submission_deadline, 'estimated_value' => $formatted_value,'status' => $status];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>EasyBidSolutions RFP</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">EasyBidSolutions.</a>
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
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Request For Proposals</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Search RFPs</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                RFPs Overview
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>RFP ID</th>
                                            <th>RFP</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Release Date</th>
                                            <th>Submission Deadline</th>
                                            <th>Estimated Value ($)</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>RFP ID</th>
                                            <th>RFP</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Release Date</th>
                                            <th>Submission Deadline</th>
                                            <th>Estimated Value ($)</th>
                                            <th>Status</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $rfps = [
                                            ["id" => 101, "description" => "Upgrade IT systems and hardware."],
                                            ["id" => 102, "description" => "Supply office materials."],
                                            ["id" => 103, "description" => "Develop new software application."],
                                            ["id" => 104, "description" => "Provide security services."],
                                            ["id" => 105, "description" => "Manage corporate events."],
                                            ["id" => 106, "description" => "Provide IT support for government offices."],
                                            ["id" => 107, "description" => "Consulting services for healthcare improvement."],
                                            ["id" => 108, "description" => "Construct new public library."],
                                            ["id" => 109, "description" => "Conduct cybersecurity audit for government systems."],
                                            ["id" => 110, "description" => "Redesign the government portal website."],
                                            ["id" => 111, "description" => "Study the environmental impact of a new project."],
                                        ];

                                        foreach ($rfps as $rfp) {
                                            $details = getRfpDetails($conn, $rfp['id']);
                                            echo "<tr>";
                                            echo "<td>" . $rfp['id'] . "</td>";
                                            echo "<td><a href='details.php?id=" . $rfp['id'] . "'>" . $details['title'] . "</a></td>";
                                            echo "<td>" . $details['category'] . "</td>";
                                            echo "<td>" . $rfp['description'] . "</td>";
                                            echo "<td>" . $details['release_date'] . "</td>";
                                            echo "<td>" . $details['submission_deadline'] . "</td>";
                                            echo "<td>$" . $details['estimated_value'] . "</td>";
                                            echo "<td>" . $details['status'] . "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
