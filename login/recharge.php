<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
    header("Location: index.php");
    exit;
}
// select loggedin users detail
$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />

<script src="https://sdk.amazonaws.com/js/aws-sdk-2.224.1.min.js"></script>

<script
src="https://code.jquery.com/jquery-2.2.4.min.js"
integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
crossorigin="anonymous"></script>

</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Your Meter No. xxxxxx</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="home.php">Home</a></li>
        <li><a href="analysis.php">Consumption Analysis</a></li>
        <li class="active"><a href="home.php">Recharge</a></li>
        <!-- <li><a href="#">Report</a></li> -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="glyphicon glyphicon-user"></span>&nbsp;Hi <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav> 

<div id="wrapper">

<div class="container">

    <div class="page-header">
    <h3 id="r1"> Prepaid Electric Meter</h3>

    </div>
    
    <div class="row">
    <div class="col-lg-12">
    
    <form action="">
  <div class="form-group">
    <label for="recharge">Recharge Your Meter :</label>
    <input type="number" class="form-control" id="recharge" placeholder="Enter No. of Units" required>
  </div>

  <button onClick=putData() "window.location.href='home.php'" type="button" class="btn btn-primary">Recharge!</button>
</form>
    </div>
    </div>

</div>

</div>

   
</body>

<script>

var awsConfig = {
    "region": "us-east-1",
    "endpoint": "http://dynamodb.us-east-1.amazonaws.com",
    "accessKeyId": "AKIAIDQA6MHYZW6A67CQ", "secretAccessKey": "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",
};
AWS.config.update(awsConfig);

var docClient = new AWS.DynamoDB.DocumentClient();


function putData() {

    var recharge = document.getElementById('recharge').value;
    
    console.log(recharge);
    
  var params = {
        
        Item:{
            id : "0" ,
            message : recharge.toString() ,
        },
        
        TableName : 'rechargeMMM'
        
    };


    
    docClient.put(params, function(err,data){
        if (err) {
           
            console.log('Error saving Data!',err.stack);
            console.log(document.getElementById("r1").innerHTML = "Network Error !" );
        } else {
        
            console.log('Data Saved!', data);

            console.log(document.getElementById("r1").innerHTML = "Recharge is Successfull !" );

            setTimeout('window.location.href="home.php"', 1000);

            // return data.Item.message;
        }
        
    });
  
}


</script>
</html>

<?php ob_end_flush(); ?>