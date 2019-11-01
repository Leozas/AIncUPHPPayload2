<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "contacts";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully" . PHP_EOL;


// transform html vars to php vars
$user_name_first = filter_input(INPUT_POST, 'name_first');
$user_name_last = filter_input(INPUT_POST, 'name_last');
$user_age = filter_input(INPUT_POST, 'age');
$user_phone_number = filter_input(INPUT_POST, 'phone_number');
$user_sponsor = filter_input(INPUT_POST, 'sponsor');
$user_food = filter_input(INPUT_POST, 'food');
$user_password= filter_input(INPUT_POST, 'password');

// write to table  new data
$data_create = "INSERT INTO localpeople (name_first, name_last, age, phone_number, sponsor, food)
VALUES ('$user_name_first', '$user_name_last', '$user_age', '$user_phone_number', '$user_sponsor', '$user_food')";

if ($conn->query($data_create) === TRUE) {
    echo "New record created successfully" . PHP_EOL;
} else {
    echo "Error: " . $data_create . "<br>" . $conn->error . PHP_EOL;
}

// return data from table

$data_return = "SELECT * FROM localpeople";
$result = $conn->query($data_return);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name_first"]. " " . $row["age"]. " " . "food:" . $row["food"] . PHP_EOL;
    }
} else {
    echo "0 results".PHP_EOL;
}
$conn->close();