<?php
$servername = "localhost";
$username = "eflozdo_qwickha";
$password = "t&P8JUbwiO43";
$database = "reflozdo_qwickhand";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT JobID, FirstName, LastName FROM job";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "job_id: " . $row["JobID"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>