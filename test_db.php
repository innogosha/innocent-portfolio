<?php
// Database connection test script
header('Content-Type: text/plain');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "personal_website";

// 1. Test basic connection
try {
    echo "Attempting to connect to MySQL server...\n";
    $conn = new mysqli($servername, $username, $password);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    echo "✓ Connected to MySQL server successfully\n\n";
    
    // 2. Test database exists
    echo "Checking if database '$dbname' exists...\n";
    $result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");
    
    if ($result->num_rows == 0) {
        throw new Exception("Database '$dbname' not found. Please run setup_database.sql");
    }
    echo "✓ Database exists\n\n";
    
    // 3. Select the database
    echo "Selecting database...\n";
    if (!$conn->select_db($dbname)) {
        throw new Exception("Could not select database: " . $conn->error);
    }
    echo "✓ Database selected\n\n";
    
    // 4. Check required tables
    $tables = ['contacts', 'users'];
    foreach ($tables as $table) {
        echo "Checking if table '$table' exists...\n";
        $result = $conn->query("SELECT 1 FROM $table LIMIT 1");
        
        if ($result === false) {
            throw new Exception("Table '$table' not found. Please run setup_database.sql");
        }
        echo "✓ Table exists\n\n";
    }
    
    // 5. Test sample query
    echo "Testing sample query on contacts table...\n";
    $result = $conn->query("SELECT COUNT(*) AS count FROM contacts");
    if ($result === false) {
        throw new Exception("Query failed: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    echo "✓ Table contains {$row['count']} records\n\n";
    
    echo "DATABASE TEST COMPLETE - ALL CHECKS PASSED\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?>