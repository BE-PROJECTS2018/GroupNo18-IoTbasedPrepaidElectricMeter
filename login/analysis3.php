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

<script src="assets/js/bootstrap.min.js"></script>

<script src="https://sdk.amazonaws.com/js/aws-sdk-2.224.1.min.js"></script>

<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>

  <script src="https://cdn.anychart.com/releases/8.2.0/js/anychart-base.min.js" type="text/javascript"></script>
    <script>
      anychart.onDocumentLoad(function () {
        // create an instance of a pie chart
       
            // chart settings
            var chart = anychart.fromJson(
                // set chart type
                {chart: {type: "line",              // var chart = anychart.line();
            
                  // set series type
                  series:[{seriesType: "spline",    // chart.spline(
            // set series data 
            data: [                         
              {x: "Domestic", value: 24.9}, 
              {x: "Commercial", value: 9.1},
              {x: "Industry", value: 37.5},   
              {x: "Traction", value: 2.2},  
              {x: "Agriculture", value: 20.6},
              {x:"Others",value: 6.5}     
            ],
            }],                            
            
                  // set chart container
                  container: "container"}}          //   chart.container("container"); 
              ).draw();  
           
            
         // var chart = anychart.fromJson(json);

          chart.title("Electric Consumption Details Of India (%)");
            
          // draw chart
          chart.draw();
          
      });
    </script>
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
            <li class="active"><a href="home.php">Home</a></li>
            <li><a href="analysis.php">Consumtion Analysis</a></li>
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
        
        <ul class="nav nav-tabs">
        <li><a href="analysis.php">2005-06</a></li>
        <li><a href="analysis2.php">2006-07</a></li>
        <li class="active"><a href="analysis3.php">2007-08</a></li>
        <li><a href="analysis4.php">2008-09</a></li>
        <li><a href="analysis5.php">2009-10</a></li>
        <li><a href="analysis6.php">1999-90</a></li>
        
      </ul>
        
        <div id="container" style="width: 100%; height: 400px;"></div>

        
        <div class="page-footer">
        <h3><a href="https://data.gov.in/ministrydepartment/central-electricity-authority
        " target="_blank"> <b>Source: Ministry of power/Central Electricity Authority </b> </a></h3>
        </div>

    
    </div>
    </div>

    
    </body>
</html>
<?php ob_end_flush(); ?>