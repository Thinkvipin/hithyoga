<?php
$con = mysqli_connect("localhost","cjanroap_yoga","Airlines!234567890","cjanroap_yoga");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$sql = mysqli_query($con,"INSERT INTO `wp_landingpage_leads` (`sno`, `name`, `email`, `phone`, `comment`, `created_on`) VALUES (NULL, 'sumit', 'sumit@gmail.com', '0987654321', 'helo', '2020-09-19 10:03:06')");

echo "Done";
?>