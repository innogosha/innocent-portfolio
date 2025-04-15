<?php
// Start the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personal_website";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user information
$user_id = $_SESSION["id"];
$user_query = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();
$stmt->close();

// Get contact form submissions
$contacts_query = "SELECT name, email, subject, submission_date FROM contacts ORDER BY submission_date DESC LIMIT 10";
$contacts_result = $conn->query($contacts_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Innocent G. Shayo</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .btn-logout {
            background-color: #ef4444;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
        }
        .btn-logout:hover {
            background-color: #dc2626;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white py-4 shadow-md">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <div class="flex items-center space-x-4">
                <span>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>
        </div>
    </header>

    <main class="dashboard-container">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- User Profile Card -->
            <div class="card">
                <h2 class="text-xl font-semibold mb-4">Your Profile</h2>
                <div class="space-y-2">
                    <p><span class="font-medium">Username:</span> <?php echo htmlspecialchars($user['username']); ?></p>
                    <p><span class="font-medium">Email:</span> <?php echo htmlspecialchars($user['email']); ?></p>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card">
                <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="form.html" class="bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded">
                        View Contact Form
                    </a>
                    <a href="index.html" class="bg-green-500 hover:bg-green-600 text-white text-center py-2 px-4 rounded">
                        Visit Homepage
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Contacts Card -->
        <div class="card">
            <h2 class="text-xl font-semibold mb-4">Recent Contact Submissions</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $contacts_result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td><?php echo date('M j, Y g:i a', strtotime($row['submission_date'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> Innocent G. Shayo. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
<?php
// Close connection
$conn->close();
?>