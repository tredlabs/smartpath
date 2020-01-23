<?php
//include 'reorder.php';

require 'db.php';
include 'lnav.php';

include 'blank.php';

session_start();

error_reporting(E_ALL & ~E_NOTICE);

$dir="";
require_once($dir."classes/Session_Manager.php");

$Session_Manager = new Session_Manager();
$logged = $Session_Manager->checkSession();



    $username = $_SESSION['username'];
	   $name = $_SESSION['name'];

            
					$Session_Manager = new Session_Manager();
					$sid = $Session_Manager->get_custom_SID();
				    $role = $_SESSION[$sid]['role'];
					 $name = $_SESSION[$sid]['name'];
				
					

if($logged)
{
	
	
}
else
{
	header("Location: index.php");
}



?>


<!DOCTYPE html>
<html>
    <head>
    	
    	
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
                    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
                    <meta name="author" content="Coderthemes">

                   

                    <title><?='Welcome '. $name?></title>
					
                    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet" />
                    <link href="../plugins/jquery-circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />

                    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/pages.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
                    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css">

                    <script src="assets/js/modernizr.min.js"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                     <link href="plugins/nvd3/build/nv.d3.min.css" rel="stylesheet" type="text/css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<script type="text/javascript">
function Rtest() //This is the function to remove the receivals for the Receival Tabel
	{

			var xhttp1 = new XMLHttpRequest();
		
	var sql="SELECT * FROM Warehouse1";
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
				
					}
					else{
						//alert(xhttp1.responseText);
						
						var alerted = localStorage.getItem('alerted')|| '';
						
						
		    if (alerted != 'yes') {
		//alert(xhttp1.responseText  + alerted);
		
		//swal("Paper!",xhttp1.responseText , "info");
	alert(xhttp1.responseText);
	localStorage.setItem('alerted','yes');
	
	}
	else{
	
		
	}
						
						
						
						}
					
					
					
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&sql="+sql);
	}
	
	
	function Rtest1() //This is the function to remove the receivals for the Receival Tabel
	{

			var xhttp1 = new XMLHttpRequest();
		
	var sql="SELECT * FROM Warehouse2";
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
				
					}
					else{
						//alert(xhttp1.responseText);
						
						var alerted = localStorage.getItem('alerted')|| '';
						
						
		var ware2 = localStorage.getItem('ware2')|| '';
		    if (ware2!='no') {
		    	
		    	alert(xhttp1.responseText);
		//swal("Printed Form!",xhttp1.responseText , "info");
	localStorage.setItem('ware2','no');
	
	//localStorage.setItem('status','yes');
	}
	else{
	
		
	}
						
						
						
						}
					
					
					
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&sql1="+sql);
	}
	
	
	function Rtest2() //This is the function to remove the receivals for the Receival Tabel
	{

			var xhttp1 = new XMLHttpRequest();
		
	var sql="SELECT * FROM Warehouse3";
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
				
					}
					else{
						//alert(xhttp1.responseText);
						
						var alerted = localStorage.getItem('alerted')|| '';
						
						
	var ware3 = localStorage.getItem('ware3')|| '';
		    if (ware3!='no') {
		    	
		    	alert(xhttp1.responseText);
		//swal("Printed Form!",xhttp1.responseText , "info");
	localStorage.setItem('ware3','no');
	
	//localStorage.setItem('status','yes');
	}
	else{
	
		
	}
						
						
						
						}
					
					
					
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorder.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&sql2="+sql);
	}
	
	
	function Rtestenv() //This is the function to remove the receivals for the Receival Tabel
	{

			var xhttp1 = new XMLHttpRequest();
		
	var sql="SELECT stocks.*,fields.name as type FROM stocks INNER JOIN fields ON stocks.field_id=fields.id";
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
						
					}
					else{
						//alert(xhttp1.responseText);
						
						var env = localStorage.getItem('env')||'';
		    if (env!='no') {
		    	alert(xhttp1.responseText);
		//swal("Envelope!",xhttp1.responseText , "info");
	localStorage.setItem('env','no');
	
	//localStorage.setItem('status','yes');
	}
	else{
		//alert('work');
	}
						
						
						
						}
					
					
					
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorderenv.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&sql="+sql);
	}
	
	function Rtestpf() //This is the function to remove the receivals for the Receival Tabel
	{

			var xhttp1 = new XMLHttpRequest();
		
	var sql="SELECT stocks.*,fields.name as type FROM stocks INNER JOIN fields ON stocks.field_id=fields.id";
	
		xhttp1.onreadystatechange = function()
		{
			if(xhttp1.readyState == 4)
			{
				if(xhttp1.status == 200)
				{
					if(xhttp1.responseText==""){
						
					}
					else{
						//alert(xhttp1.responseText);
						
						var pf = localStorage.getItem('pf')|| '';
		    if (pf!='no') {
		    	
		    	alert(xhttp1.responseText);
		//swal("Printed Form!",xhttp1.responseText , "info");
	localStorage.setItem('pf','no');
	
	//localStorage.setItem('status','yes');
	}
	else{
		//alert('work');
	}
						
						
						
						}
					
					
					
				}
				else
				{
					alert("An error occured while trying to remove the data you requested");
				}
			}
		};
		xhttp1.open("POST", "reorderpf.php", true);
		xhttp1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp1.send("&sql="+sql);
	}

 
 </script>      
    </head>


    <body onload="" class="fixed-left">
        
        <!-- Begin page -->
        <div id="wrapper">
        
            <!-- Top Bar Start -->
         
            <!-- Top Bar End -->


            
            <!-- Left Sidebar End --> 



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                	
                	<div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                   
                                    <h4 class="page-title">Smart Path Lunch Management System</h4>
                                </div>
                            </div>
                       </div> 

                	
                    <div class="container">

                        <!-- Page-Title -->
                  

                   
                        <div class="row" id="paper" style="visibility: visible">
                          		<p class="text-muted text-nowrap">Lunch Taken</p>
                           
                           <?
                       $limit=1;
						  for($count=0;$count<$limit;$count++){
						  	echo "    <div class='col-sm-6 col-lg-3'>
                            
                                <div class='widget-simple-chart text-right card-box'>
                                    <div class='circliful-chart' data-dimension='90' data-text='Lunch' data-width='5' data-fontsize='14' data-percent='100' data-fgcolor='#f76397' data-bgcolor='#ebeff2'></div>
                                    <h3 class='text-pink'><span class='counter'> $qty</span></h3>
                                  
                                </div>
                            </div>";
							
							
						  }
						  
                            
                           
                           ?>
                        
                     
                        </div>
                
	<div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<h4 class="m-t-0 m-b-20 header-title"><b>Lunch</b></h4>

									<div class="bar-chart">
                                        <svg style="height:400px;width:100%"></svg>
                                    </div>
								</div>
							</div>
						</div>
						


                        <!-- end row -->



                    
                        <!--end row/ WEATHER -->



                        <!-- end row -->


                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->

       
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
         
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->


    
        <script>
            var resizefunc = [];
        </script>

        <!-- Plugins  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>
        
        <!-- Counter Up  -->
        <script src="../plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="../plugins/counterup/jquery.counterup.min.js"></script>

        <!-- circliful Chart -->
        <script src="../plugins/jquery-circliful/js/jquery.circliful.min.js"></script>
        <script src="../plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

        <!-- skycons -->
        <script src="../plugins/skyicons/skycons.min.js" type="text/javascript"></script>
        
        <!-- Page js  -->
        <script src="assets/pages/jquery.dashboard.js"></script>

        <!-- Custom main Js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
        
        
        
  <!-- Nvd3 js -->
        <script src="plugins/d3/d3.min.js"></script>
        <script src="plugins/nvd3/build/nv.d3.min.js"></script>
        <script src="assets/pages/jquery.nvd3.init.js"></script>

        
        <script type="text/javascript">
        
         function email(mess,sub)  
      {  
           $.ajax({  
                url:"email.php",  
                method:"POST",  
                data:{mess:mess, sub:sub},  
                dataType:"text",  
                success:function(data){  
                  alert(data);  
                }  
           });  
      }
        
        
         function sendMail(mess,sub)
{
    var yourMessage =mess;
    var subject = sub;
    document.location.href = "mailto:imani_sterling@yahoo.com ?subject="
        + encodeURIComponent(subject)
        + "&body=" + encodeURIComponent(yourMessage);
        alert('email sent');
}

        
        
     


	

    
        
            jQuery(document).ready(function($) {
            	//Rtest();	
            	//Rtest1();
            	//Rtest2();
          //  Rtestenv();
           // Rtestpf();
            $(function(){

});
            	
            	
            	
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
                $('.circliful-chart').circliful();
            });
            
     
            // BEGIN SVG WEATHER ICON
            if (typeof Skycons !== 'undefined'){
            var icons = new Skycons(
                {"color": "#3bafda"},
                {"resizeClear": true}
                ),
                    list  = [
                        "clear-day", "clear-night", "partly-cloudy-day",
                        "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
                        "fog"
                    ],
                    i;

                for(i = list.length; i--; )
                icons.set(list[i], list[i]);
                icons.play();
            };

        </script>
        
         <script type="text/javascript">
   /**
* Theme: Minton Admin
* Author: Coderthemes
* Chart Nvd3 chart
*/


(function($) {
    'use strict';

    function sinAndCos() {
        var sin = [],
            sin2 = [],
            cos = [];
        for (var i = 0; i < 100; i++) {
            sin.push({
                x: i,
                y: Math.sin(i / 9)
            });
            sin2.push({
                x: i,
                y: Math.sin(i / 10) * 0.25 + 0.5
            });
            cos.push({
                x: i,
                y: 0.5 * Math.cos(i / 10)
            });
        }
        return [{
            values: sin,
            key: 'Sine Wave',
            color: "#00b19d"
        }, {
            values: cos,
            key: 'Cosine Wave',
            color: "#ef5350"
        }, {
            values: sin2,
            key: 'Custom sine',
            color: "#3DDCF7"
        }];
    }
    nv.addGraph(function() {
        var lineChart = nv.models.lineChart();
        var height = 300;
        lineChart.useInteractiveGuideline(true);
        lineChart.xAxis.tickFormat(d3.format(',r'));
        lineChart.yAxis.axisLabel('Voltage (v)').tickFormat(d3.format(',.2f'));
        d3.select('.line-chart svg').attr('perserveAspectRatio', 'xMinYMid').datum(sinAndCos()).transition().duration(500).call(lineChart);
        nv.utils.windowResize(lineChart.update);
        return lineChart;
    });
   
   var historicalBarChart = [{
        key: 'Cumulative Return',
        values: [{
            'label':'<?php
            
             echo " $item1[0]";?>',
            'value': <?php echo "$instock1[0]";?>,
            'color': '#00b19d'
        }, {
            'label':'<?php echo " $item1[1]";?>',
            'value': <?php echo "$instock1[1]";?>,
            'color': '#ef5350'
        }, {
            'label':'<?php echo " $item1[2]";?>',
            'value': <?php echo "$instock1[2]";?>,
            'color': '#3DDCF7'
        }, {
            'label':'<?php echo " $item1[3]";?>',
            'value': <?php echo "$instock1[3]";?>,
            'color': '#ffaa00'
        }, {
           'label':'<?php echo " $item1[4]";?>',
            'value': <?php echo "$instock1[4]";?>,
            'color': '#81c868'
        }, {
            'label':'<?php echo " $item[5]";?>',
            'value': <?php echo "$instock1[5]";?>,
            'color': 'red'
        }, {
            'label':'<?php echo " $item1[6]";?>',
            'value': <?php echo "$instock1[6]";?>,
            'color': '#333333'
            
        }, {
           'label':'<?php echo " $item1[7]";?>',
            'value': <?php echo "$instock1[7]";?>,
            'color': '#3bafda'
        }]
    }];

    nv.addGraph(function() {
        var barChart = nv.models.discreteBarChart().x(function(d) {
            return d.label;
        }).y(function(d) {
            return d.value;
        }).staggerLabels(true).tooltips(false).showValues(true).duration(250);
        barChart.yAxis.axisLabel('');
        d3.select('.bar-chart svg').datum(historicalBarChart).call(barChart);
        nv.utils.windowResize(barChart.update);
        return barChart;
    });
    var i, j;
    nv.utils.symbolMap.set('thin-x', function(size) {
        size = Math.sqrt(size);
        return 'M' + (-size / 2) + ',' + (-size / 2) + 'l' + size + ',' + size + 'm0,' + -(size) + 'l' + (-size) + ',' + size;
    });
    var scatterChart;
    var colors = ['#00b19d', '#ef5350','#3ddcf7', '#ffaa00','#81c868', '#dcdcdc','#555555	', '#fb6d9d','#98a6ad', '#3bafda'];
    //d3.scale.category10().range()
    nv.addGraph(function() {
        scatterChart = nv.models.scatterChart().useVoronoi(true).color(colors).duration(300);
        scatterChart.xAxis.tickFormat(d3.format('.02f'));
        scatterChart.yAxis.axisLabel('Population dynamics').tickFormat(d3.format('.02f'));
        scatterChart.tooltipContent(function(obj) {
            return '<p>' + obj.series[0].key + '</p>';
        });
        d3.select('.scatter-chart svg').datum(randomData(4, 40)).call(scatterChart);
        nv.utils.windowResize(scatterChart.update);
        scatterChart.dispatch.on('stateChange', function(e) {
            ('New State:', JSON.stringify(e));
        });
        return scatterChart;
    });

    function randomData(groups, points) {
        var data = [],
            shapes = ['thin-x', 'circle', 'cross', 'triangle-up', 'triangle-down', 'diamond', 'square'],
            random = d3.random.normal();
        for (i = 0; i < groups; i++) {
            data.push({
                key: 'Group ' + i,
                values: []
            });
            for (j = 0; j < points; j++) {
                data[i].values.push({
                    x: random(),
                    y: random(),
                    size: Math.round(Math.random() * 100) / 100,
                    shape: shapes[j % shapes.length]
                });
            }
        }
        return data;
    }
    var long_short_data = [{
        'key': 'Series 1',
        'color': "#dcdcdc",
        'values': [{
            'label': 'Group A',
            'value': -1.8746444827653
        }, {
            'label': 'Group B',
            'value': -8.0961543492239
        }, {
            'label': 'Group C',
            'value': -0.57072943117674
        }, {
            'label': 'Group D',
            'value': -2.4174010336624
        }, {
            'label': 'Group E',
            'value': -0.72009071426284
        }, {
            'label': 'Group F',
            'value': -0.77154485523777
        }, {
            'label': 'Group G',
            'value': -0.90152097798131
        }, {
            'label': 'Group H',
            'value': -0.91445417330854
        }, {
            'label': 'Group I',
            'value': -0.055746319141851
        }]
    }, {
        'key': 'Series 2',
        'color': "#3bafda",
        'values': [{
            'label': 'Group A',
            'value': 25.307646510375
        }, {
            'label': 'Group B',
            'value': 16.756779544553
        }, {
            'label': 'Group C',
            'value': 18.451534877007
        }, {
            'label': 'Group D',
            'value': 8.6142352811805
        }, {
            'label': 'Group E',
            'value': 7.8082472075876
        }, {
            'label': 'Group F',
            'value': 5.259101026956
        }, {
            'label': 'Group G',
            'value': 0.30947953487127
        }, {
            'label': 'Group H',
            'value': 0
        }, {
            'label': 'Group I',
            'value': 0
        }]
    }];
    var multiChart;
    nv.addGraph(function() {
        multiChart = nv.models.multiBarHorizontalChart().x(function(d) {
            return d.label;
        }).y(function(d) {
            return d.value;
        }).duration(250);
        multiChart.yAxis.tickFormat(d3.format(',.2f'));
        d3.select('.multi-chart svg').datum(long_short_data).call(multiChart);
        nv.utils.windowResize(multiChart.update);
        return multiChart;
    });
    
    
    //Regular pie chart example
	nv.addGraph(function() {
	  var chart = nv.models.pieChart()
	      .x(function(d) { return d.label })
	      .y(function(d) { return d.value })
	      .showLabels(true);
	
	    d3.select("#chart1 svg")
	        .datum(exampleData)
	      	.transition().duration(1200)
	        .call(chart);
	
	  return chart;
	});
	
	//Donut chart example
	nv.addGraph(function() {
	  var chart = nv.models.pieChart()
	      .x(function(d) { return d.label })
	      .y(function(d) { return d.value })
	      .showLabels(true)     //Display pie labels
	      .labelThreshold(.05)  //Configure the minimum slice size for labels to show up
	      .labelType("percent") //Configure what type of data to show in the label. Can be "key", "value" or "percent"
	      .donut(true)          //Turn on Donut mode. Makes pie chart look tasty!
	      .donutRatio(0.35)     //Configure how big you want the donut hole size to be.
	      ;
	   
	    d3.select("#chart2 svg")
	        .datum(exampleData())
	        .transition().duration(350)
	        .call(chart);
	
	  return chart;
	});
	
	//Pie chart example data. Note how there is only a single array of key-value pairs.
	
})(jQuery);
   
    </script>
   
    </body>
</html>