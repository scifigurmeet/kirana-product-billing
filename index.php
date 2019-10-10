<!DOCTYPE html>
<html>
<head>
<title>Kirana ML Model Software For TCS Competition</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300" />
</head>
<style>
div{
	font-family: 'Roboto', sans-serif !important;
}
.loader{
	display: none;
	position: fixed; /* Sit on top of the page content */
	width: 100%; /* Full width (cover the whole page) */
	height: 100%; /* Full height (cover the whole page) */
	top: 0; 
	left: 0;
	right: 0;
	bottom: 0;
	background-color: rgba(0,0,0,0.9); /* White background with opacity */
	background-image: url('https://loading.io/spinners/harmony/index.harmony-taiji-spinner.svg');
	background-repeat: no-repeat;
	background-position: center;
	background-size: 25%;
	z-index: 1051; /* Specify a stack order in case you're using a different order for other elements */
	cursor: pointer; /* Add a pointer on hover */
}
</style>
<body style="background: #e5554e;">
<header>
<div class="pos-f-t" style="color:white;">
<div class="collapse" id="navbarToggleExternalContent" style="background: black;">
<div class="p-4">
<h4 class="text-white">Kirana Product Billing (Software Developed For <b>TCS Inframind</b> Competition)</h4>
</div>
</div>
<nav class="navbar navbar-dark bg-dark">
<button onclick="topFunction();" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
<span style="display: inline-block;" class="navbar-toggler-icon"></span>
</button>
<h4 style="display: inline-block; color: white; margin: 5px;">Kirana Product Billing (Developed By Team <b>ScifiDevs</b>)</h4>
</nav>
</div>
</header>
<div id="loader" class="loader"></div>
<div class="container-fluid">
	<div class="row">
		<div class="col col-md-12" style="color: white;">
		<h3 style="text-align: center; margin: 10px;"><i class="fas fa-laptop-code"></i>&nbsp;&nbsp;ML Product Detection &&nbsp;&nbsp;<i class="fa fa-file-invoice"></i>&nbsp;&nbsp;Bill Generation</h3>
		</div>
	</div>
	<div class="row" style="background: whitesmoke;">
		<div class="col col-md-6"><br>
		<h4 style="text-align: center;">Bill Details</h4>
		<table id="bill" class="table table-hover">
			<thead>
				<tr>
					<th>
					S.No.
					</th>
					<th>
					Product Description
					</th>
					<th>
					Quantity
					</th>
					<th>
					Price Per Quantity
					</th>
					<th>
					Total Price
					</th>
					<th>
					Remove
					</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		</div>
		<div class="col col-md-6" style="background: black;">
			<button class="btn btn-info" style="margin: 15px;" onclick="fetchProductDetails($('#quanity').val());">Fetch Product <i class="fas fa-camera"></i></button>
			<span class="label" style="color:white;">Quantity&nbsp;&nbsp;</span>
			<input type="number" id="quanity" class="form-control" min="1" value="1" style="width: 80px; display: inline-block;">
			<button class="btn btn-danger float-right" style="margin: 15px;">
			<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
			Shop Desk <i>(Live Stream)</i>
			</button>
			<div style="text-align: right; padding: 0px; 10px;">
				<img src="http://192.168.137.176:8080/video">
			</div>
		</div>
	</div>
</div>
<script>
function fetchProductDetails(quantity = 1){
	var saveData = $.ajax({
		type: 'POST',
		url: "api.php",
		success: function(response){
			console.log(response.name);
			name = response.name;
			price = response.price;
			addItem(name,quantity,price);
		},
		error: function(response){
			alert('Sorry, but the current placed product could not be identified!');
		}
	});
}
function addItem(name,quanity,price){
	row = '<tr>'
	+ '<td class="sno">#</td>'
	+ '<td>' + name + '</td>'
	+ '<td>' + quanity + '</td>'
	+ '<td>' + price + '</td>'
	+ '<td class="price">' + (quanity * price) + '</td>'
	+ '<td><button class="btn btn-danger" onclick="$(this).parent().parent().remove();serialize();">Remove</button></td>'
	+ '</tr>';
	$('#bill tbody').append(row);
	serialize();
}

function serialize(){
	$('#quanity').val(1);
	$('#total').remove();
	count = 1;
	$('.sno').each(function(elm) {
		$(this).text(count++);
	});
	price = 0
	$('.price').each(function(elm) {
		price += parseInt($(this).text());
	});
	row = '<tr id="total" style="background: #e5554e;">'
	+ '<td colspan="4" style="text-align: center; color: white; font-size: 150%;"><b>Total Payable Amount</b></td>'
	+ '<td colspan="2"><b style="color: white; font-size: 150%;">₹ ' + price +'</b></td>'
	+ '</tr>';
	$('#bill tbody').append(row);
}

$(document).ajaxStart(function(){
  $("#loader").show();
});

$(document).ajaxComplete(function(){
  $("#loader").hide();
});

</script>
</body>
</html>