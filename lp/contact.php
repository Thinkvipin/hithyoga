<?php
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d H:i:s");
if(isset($_POST['name'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sub = $_POST['landingPage'];
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
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
       <h4 class="headline-support">Demystifying Meditation with<br> Gourav & Hitanshi </h4>
        <button class="btn btn-primary">Continue</button>
   </div>
     
</div>
  


</body>
</html>

