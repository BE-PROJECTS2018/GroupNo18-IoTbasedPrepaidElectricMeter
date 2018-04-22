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
            <li class="active"><a href="#">Home</a></li>
            <li><a href="analysis.php">Consumption Analysis</a></li>
            <li><a href="recharge.php">Recharge</a></li>
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
    	<h3> Prepaid Electric Meter</h3>
    	</div>
        
        <div class="row">
        <div class="col-lg-12">
        
        <h3 class="data1" id="aaa">Number of units consumed : </h3>
        <br/><br/>
        <h3 class="data2" id="aaa1">Last Recharge : </h3>
        
        </div>
        </div>
    
    </div>
    
    </div>
  
    <script>
    var data1 = 0;
    var data2 = 0;
    var awsConfig = {
    "region": "us-east-1",
    "endpoint": "http://dynamodb.us-east-1.amazonaws.com",
    "accessKeyId": "AKIAIDQA6MHYZW6A67CQ", "secretAccessKey": "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",
};
AWS.config.update(awsConfig);

var docClient = new AWS.DynamoDB.DocumentClient();

function fetchOneByKey () {
    var params = {
        TableName: "consumption",
        Key: {
            "id": "0"
        }
    };

    docClient.get(params, function (err, data) {
        if (err) {
            console.log("users::fetchOneByKey::error - " + JSON.stringify(err, null, 2));
        }
        else {
            console.log("users::fetchOneByKey::success - " + JSON.stringify(data, null, 2));

            data1 = data.Item.message;

            console.log(data1);
            console.log(document.getElementById("aaa").innerHTML = "No. Of Units Consumed : " + data1+" Units" );
           
            return data.Item.message;
        }
    });
}




function fetch () {
  var params = {
    TableName : 'rechargeMMM',
    Key : {
      "id" : "0"
    }
  };

  docClient.get(params, function(err,data){
    if(err){
      console.log("error:" + JSON.stringify(err,null,2));
    }
    else {
      console.log("users:"+ JSON.stringify(data,null,2));

      data2 = data.Item.message;

      console.log(document.getElementById("aaa1").innerHTML = "Last Recharge : " + data2 + " Units" );

      return data.Item.message;
    }
  });
}
  if(fetchOneByKey()){
     
  }
   if(fetch()){
}
   

  


 // data1 = fetchOneByKey();
  //putData();
 // data2 = fetch();
    
    
    </script>

    
</body>
</html>
<?php ob_end_flush(); ?>