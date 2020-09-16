<?php
header('Access-Control-Allow-Origin: https://www.hithyoga.com/custom_url1.php');
// print file_get_contents('https://www.hithyoga.com/test.php');

$email= 'vipins851@gmail.com';
$url = 'https://hithyoga.com/custom_url1';
$request = 'Airlines_23456789000';
$data1 = "pass=".$request."&email=".$email."";
$postdata = $data1;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
$result = curl_exec($ch);
echo $result;
curl_close($ch);
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://hithyoga.com/wp-json/testone/loggedinuser",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_HTTPHEADER => array(
//     "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvd3d3LmhpdGh5b2dhLmNvbSIsImlhdCI6MTU5MTEzMDQwMCwibmJmIjoxNTkxMTMwNDAwLCJleHAiOjE1OTE3MzUyMDAsImRhdGEiOnsidXNlciI6eyJpZCI6IjYifX19.gqp2r9vuBRoU2xojqp53nOa0iDN6nqHyFIEN9x2eFkc",
//     "content-type: application/json",
//     "Access-Control-Allow-Origin: *"
    
//   ),
// ));

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);

// if ($err) {
//   echo "cURL Error #:" . $err;
// } else {
//   echo $response;
// }

?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
// $(document).ready(function(){
//   $("button").click(function(){
//     $.ajax({url: "https://www.hithyoga.com/custom_url", success: function(result){
//       console.log(result); 
//       $("#div1").html(result);
//       Cookies.set('wordpress_logged_in_373f35e60310085fe883b1f7756f1d26', 'admin|1591155536|fzniT7H7QT3i0VDgpW5pKpZXYzmKfdgkdrjH8B2rU5y|a3eb554d072b3dcde70bd6bdbada3602b9c152bab9b524c385eaa854f77dc22d');
//     }});
//   });
// });
</script>
</head>
<body>

<div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>

<button>Get External Content</button>

</body>
</html>
