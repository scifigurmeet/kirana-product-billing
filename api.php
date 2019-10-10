<?php
ini_set('max_execution_time', '0');
$error = False;
$ip = "http://192.168.137.176:8080";
try{
$content = file_get_contents($ip."/photo.jpg");
$fp = fopen("temp.jpg", "w");
fwrite($fp, $content);
fclose($fp);
}
catch(Exception $ex){
	$error = True;
}

//Send Image For Processing To Python Script API

//Reading Shortcode from the API Response
$shortcode = file_get_contents("http://127.0.0.1:85/?".uniqid());

//Connection Detaiils
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    $error = True;
}

//Query to Fetch Product Details Corresponding to Shortcode
$sql = "SELECT * from products WHERE shortcode = '$shortcode'";
$result = mysqli_query($conn, $sql);

//Saving the Fetched Data into Object
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$detailsObj = new stdClass();
		$detailsObj->name = $row['name'];
		$detailsObj->price = $row['price'];
    }
} else {
    $error = True;
}

mysqli_close($conn);


//Converting Object To JSON For API Output
$outputJSON = json_encode($detailsObj);

if(!$error){
	header('Content-Type: application/json');
	echo $outputJSON;
	}
else echo "An Error Occured while fetching the product details.";
?>