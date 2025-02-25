<?php
$servername = "localhost:3306";
$dbname = "monitork_1";
$username = "monitork_user";
$password = "B9ek2t6!7";

$api_key_value = "12345";
$api_key = $berat_badan = $tinggi_badan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    $berat_badan = test_input($_POST["berat"]);
    $tinggi_badan = test_input($_POST["tinggi"]);

    if ($api_key == $api_key_value) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error;
            exit();
        }

        // Insert Temperature and Humidity data
        $sql_temp = "INSERT INTO temp_berat_tinggi (berat, tinggi) VALUES ('$berat_badan', '$tinggi_badan')";
        if ($conn->query($sql_temp) === TRUE) {
            echo "Data temp berat dan tinggi berhasil ditambahkan. ";
        } else {
            echo "Error berat dan tinggi: " . $sql_temp . "<br>" . $conn->error . " ";
        }

        $conn->close();
    } else {
        echo "Wrong API Key";
    }
} else {
    echo "No data posted HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
