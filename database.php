<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm_yield";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("<h3 style='color:red;text-align:center;'>Connection failed: " . $conn->connect_error . "</h3>");
}


$sql = "CREATE TABLE IF NOT EXISTS yields (
    sno INT PRIMARY KEY,
    product VARCHAR(30) NOT NULL,
    land VARCHAR(30) NOT NULL,
    ton INT NOT NULL,
    money_spend INT NOT NULL,
    money_earned_from_the_yield INT NOT NULL
)";
$conn->query($sql);

$action = $_POST['action'];

if ($action == "insert") {
    $sno = $_POST['sno'];
    $product = $_POST['product'];
    $land = $_POST['land'];
    $ton = $_POST['ton'];
    $money_spend = $_POST['money_spend'];
    $money_earned_from_the_yield = $_POST['money_earned_from_the_yield'];

    $sql = "INSERT INTO yields (sno, product, land, ton, money_spend, money_earned_from_the_yield) 
            VALUES ('$sno', '$product', '$land', '$ton', '$money_spend', '$money_earned_from_the_yield')";

    if ($conn->query($sql) === TRUE) {
        echo "<h3 style='color:green;text-align:center;'>✅ Record inserted successfully!</h3>";
    } else {
        echo "<h3 style='color:red;text-align:center;'>Error inserting record: " . $conn->error . "</h3>";
    }

} elseif ($action == "delete") {
    $sno = $_POST['sno'];
    $sql = "DELETE FROM yields WHERE sno='$sno'";

    if ($conn->query($sql) === TRUE) {
        echo "<h3 style='color:green;text-align:center;'>🗑️ Record deleted successfully!</h3>";
    } else {
        echo "<h3 style='color:red;text-align:center;'>Error deleting record: " . $conn->error . "</h3>";
    }

} elseif ($action == "update") {
    $sno = $_POST['sno'];
    $product = $_POST['product'];
    $land = $_POST['land'];
    $ton = $_POST['ton'];
    $money_spend = $_POST['money_spend'];
    $money_earned_from_the_yield = $_POST['money_earned_from_the_yield'];

    $sql = "UPDATE yields 
            SET product='$product', land='$land', ton='$ton', money_spend='$money_spend', 
                money_earned_from_the_yield='$money_earned_from_the_yield' 
            WHERE sno='$sno'";

    if ($conn->query($sql) === TRUE) {
        echo "<h3 style='color:green;text-align:center;'>🔄 Record updated successfully!</h3>";
    } else {
        echo "<h3 style='color:red;text-align:center;'>Error updating record: " . $conn->error . "</h3>";
    }

} elseif ($action == "show_db") {
    $sql = "SELECT * FROM yields";
    $result = $conn->query($sql);

    echo "<h2 style='text-align:center;'>🌾 Farm Yield Database Records</h2>";
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0' style='margin:auto; border-collapse: collapse;'>
                <tr style='background:#4CAF50;color:white;'>
                    <th>S.No</th>
                    <th>Product</th>
                    <th>Land</th>
                    <th>Ton</th>
                    <th>Money Spend</th>
                    <th>Money Earned</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['sno']}</td>
                    <td>{$row['product']}</td>
                    <td>{$row['land']}</td>
                    <td>{$row['ton']}</td>
                    <td>{$row['money_spend']}</td>
                    <td>{$row['money_earned_from_the_yield']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No records found.</p>";
    }

} elseif ($action == "select") {
    $sno = $_POST['sno'];
    $sql = "SELECT * FROM yields WHERE sno='$sno'";
    $result = $conn->query($sql);

    echo "<h2 style='text-align:center;'>🔍 Selected Record</h2>";
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0' style='margin:auto; border-collapse: collapse;'>
                <tr style='background:#4CAF50;color:white;'>
                    <th>S.No</th>
                    <th>Product</th>
                    <th>Land</th>
                    <th>Ton</th>
                    <th>Money Spend</th>
                    <th>Money Earned</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['sno']}</td>
                    <td>{$row['product']}</td>
                    <td>{$row['land']}</td>
                    <td>{$row['ton']}</td>
                    <td>{$row['money_spend']}</td>
                    <td>{$row['money_earned_from_the_yield']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No record found for S.No: $sno</p>";
    }
}

echo "<div style='text-align:center;margin-top:20px;'><a href='index.html' style='text-decoration:none;color:#4CAF50;font-weight:bold;'>⬅️ Go Back</a></div>";

$conn->close();
?>
