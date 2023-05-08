<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "payroll";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $pay_period = $_POST["pay_period"];
    $hours_worked = $_POST["hours_worked"];
    $hourly_rate = $_POST["hourly_rate"];
    $overtime_hours = $_POST["overtime_hours"];
    $overtime_rate = $_POST["overtime_rate"];
    $total_pay = $_POST["total_pay"];

    // Insert data into database
    $sql = "INSERT INTO employee (first_name, last_name, email) VALUES ('$first_name', '$last_name', '$email')";
    if ($conn->query($sql) === TRUE) {
        $employee_id = $conn->insert_id;
        $sql = "INSERT INTO salary (employee_id, pay_period, hours_worked, hourly_rate, overtime_hours, overtime_rate, total_pay) VALUES ('$employee_id', '$pay_period', '$hours_worked', '$hourly_rate', '$overtime_hours', '$overtime_rate', '$total_pay')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        First name: <input type="text" name="first_name"><br>
        Last name: <input type="text" name="last_name"><br>
        Email: <input type="text" name="email"><br>
        Pay period: <input type="text" name="pay_period"><br>
        Hours worked: <input type="text" name="hours_worked"><br>
        Hourly rate: <input type="text" name="hourly_rate"><br>
        Overtime hours: <input type="text" name="overtime_hours"><br>
        Overtime rate: <input type="text" name="overtime_rate"><br>
        Total pay: <input type="text" name="total_pay"><br>
        <input type="submit" value="Submit">
      </form>