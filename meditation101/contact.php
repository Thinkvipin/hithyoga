<?php
$con = mysqli_connect("localhost","cjanroap_yoga","Airlines!234567890","cjanroap_yoga");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sub = $_POST['landingPage'];
    $message = $_POST['message'];
    $datetime = date('Y-m-d h:i:s');
    
    $sql = mysqli_query($con,"INSERT INTO `wp_landingpage_leads` ( `name`, `email`, `phone`, `comment`, `created_on`) VALUES ( '$name', '$email', '$phone', '$message', '$datetime')");


    
    $sub="Hithyoga - Landing Page Enquiry";
    $msgBody="<table cellspacing='0' style='width:100%' border='1'>
              <tbody>
              <tr>
                <th>From:</th><td>".$sub ."</td>
              </tr>
              <tr>
                <th>Name:</th><td>".$name."</td>
              </tr>
              <tr>
                <th>Email Id:</th><td><a href='mailto:".$email."' target='_blank'>".$email."</a></td>
              </tr>
              <tr>
                <th>Phone Number:</th><td>".$phone."</td>
              </tr>
              <tr>
                <th>Comment:</th><td>".$message."</td>
              </tr>
              
            </tbody></table>";
            
            
            $to = "hithyoga@gmail.com";
            
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            
            // More headers
            $headers .= 'From: <info@hithyoga.com>' . "\r\n";
            
            mail($to,$sub,$msgBody,$headers);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Best Yoga Classes, Yoga Teachers Training, Corporate sessions, Workshops and Retreats in Delhi Gurgaon Noida (NCR)</title>
      <link href="src/bootstrap.min.css" rel="stylesheet">
      <link href="src/css" rel="stylesheet" type="text/css">
      <link rel="icon" href="https://www.hithyoga.com/wp-content/uploads/2019/06/cropped-logo-192x192.png" sizes="192x192" />
      <link href="src/health.css" rel="stylesheet">
      <link href="src/mint.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;400;500&display=swap" rel="stylesheet">
  
</head>
<body>
<div class="container hero-area text-center">
      <div>
          <a href="https://www.hithyoga.com/"><img src="https://www.hithyoga.com/wp-content/uploads/2019/08/logo-1.jpg" alt="Yoga logo"> 
          </a>
      </div>
      
      

   </div>
<div class="jumbotron text-center" style="background:#fff;">
    
   <div class="container">
       <h3 class="headline-support">Meditation 101 - Meditation for Beginners<br>by Gourav & Hitanshi <br>
        Don't Refresh It will redirect to the payment page </h3>
   </div>
     
</div>
  <script>
       window.location.replace("https://pages.razorpay.com/pl_FHUp7d6F8pH516/view");
  </script>


</body>
</html>

