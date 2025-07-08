<?php
$servername = "localhost:3306";
$dbname = "hakc2743_monitoring_kebugaran_dan_nutrisi";
$username = "hakc2743_localhost";
$password = "md615GPkAtJ798";

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
        $sql_temp = "INSERT INTO temp_berat_tinggi_badan (berat_badan, tinggi_badan) VALUES ('$berat_badan', '$tinggi_badan')";
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
