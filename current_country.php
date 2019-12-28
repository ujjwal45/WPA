<!DOCTYPE html>
<html>
<head>
	<title>Population Analyser</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="js/currency-autocomplete.js"></script>
	<script type="text/javascript" src="js/jquery.autocomplete.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://d3js.org/d3.v3.min.js"></script>
	<script src="http://d3js.org/topojson.v1.min.js"></script>
	<script src="http://datamaps.github.io/scripts/datamaps.world.min.js"></script>
	<script src="https://use.fontawesome.com/c97c3faabd.js"></script>
 <style>
  path {
    stroke: steelblue;
    stroke-width: 1;
    fill: none;
  }
  .axis {
    shape-rendering: crispEdges;
  }
 
  .x.axis line {
    stroke: lightgrey;
  }
 
  .x.axis .minor {
    stroke-opacity: .5;
  }
 
  .x.axis path {
    display: none;
  }
 
  .y.axis line, .y.axis path {
    fill: none;
    stroke: #000;
  }
 
  </style>
</head>
<body style="margin:0;">
	<div style="height: 160px; width:100%; top:0; left:0; position: fixed;">
		<div style="height: 100%;">
		<div class="col-md-12" id="country_details" style="background: linear-gradient(#171819,#393c42); padding-left: 0px; padding-right: 0px; height: 150px; color: #ffffff">
			<table class="table table-responsive">
				<tr>
					<td colspan='4' id="country_Name"></td>
				</tr>
				<tr>
					<td id="population"><center>Population(2016)</center></td>
					<td id="GDP"><center>GDP</center></td>
					<td id="land"><center>Area</center></td>
				</tr>
			</table>
		</div>
		</div>
	</div>

	<div class="jumbotron" style="margin-top:155px;">
		<svg id="linechart" style="width: 100%; height: 500px"></svg>
		<div id="piechart"></div>
 	</div>

<script type="text/javascript">
	var population='p2000';
    var slider = document.getElementById('YearSlider');
    var malepopulation="";
    var femalepopulation="";




	d3.csv("data/fulldata.csv",function(data){
		var Country_Name=localStorage.selected_country;
		var domain_array=[];
		for(var i=0;i<data.length;i++){
			if(Country_Name==data[i].Name){
				document.getElementById('country_Name').innerHTML="<center><h3>" + data[i].Name + "</h3></center>"
				document.getElementById('land').innerHTML+="<center>" + data[i].Land + " sq.km" + "</center>"
				document.getElementById('GDP').innerHTML+="<center>" + data[i].GDP + " (million US $)" + "</center>"
				document.getElementById('population').innerHTML+="<center>" + data[i].p2016 + "</center>"
				localStorage.setItem("current_country_data",JSON.stringify(data[i]));
				var linedata=[{
					"year":"1960",
					"population": (data[i].p1960/1000000),
				},
				{
					"year":"1961",
					"population": (data[i].p1961/1000000),
				},
				{
					"year":"1962",
					"population": (data[i].p1962/1000000),
				},
				{
					"year":"1963",
					"population": (data[i].p1963/1000000)
				},
				{
					"year":"1964",
					"population": (data[i].p1964/1000000)
				},
				{
					"year":"1965",
					"population": (data[i].p1965/1000000)
				},
				{
					"year":"1966",
					"population": (data[i].p1966/1000000)
				},
				{
					"year":"1967",
					"population": (data[i].p1967/1000000)
				},
				{
					"year":"1968",
					"population": (data[i].p1968/1000000)
				},
				{
					"year":"1969",
					"population": (data[i].p1969/1000000)
				},
				{
					"year":"1970",
					"population": (data[i].p1970/1000000)
				},
				{
					"year":"1971",
					"population": (data[i].p1971/1000000)
				},
				{
					"year":"1972",
					"population": (data[i].p1972/1000000)
				},
				{
					"year":"1973",
					"population": (data[i].p1973/1000000)
				},
				{
					"year":"1974",
					"population": (data[i].p1974/1000000)
				},
				{
					"year":"1975",
					"population": (data[i].p1975/1000000)
				},
				{
					"year":"1976",
					"population": (data[i].p1976/1000000)
				},
				{
					"year":"1977",
					"population": (data[i].p1977/1000000)
				},
				{
					"year":"1978",
					"population": (data[i].p1978/1000000)
				},
				{
					"year":"1979",
					"population": (data[i].p1979/1000000)
				},
				{
					"year":"1980",
					"population": (data[i].p1980/1000000)
				},
				{
					"year":"1981",
					"population": (data[i].p1981/1000000)
				},
				{
					"year":"1982",
					"population": (data[i].p1982/1000000)
				},
				{
					"year":"1983",
					"population": (data[i].p1983/1000000)
				},
				{
					"year":"1984",
					"population": (data[i].p1984/1000000)
				},
				{
					"year":"1985",
					"population": (data[i].p1985/1000000)
				},
				{
					"year":"1986",
					"population": (data[i].p1986/1000000)
				},
				{
					"year":"1987",
					"population": (data[i].p1987/1000000)
				},
				{
					"year":"1988",
					"population": (data[i].p1988/1000000)
				},
				{
					"year":"1989",
					"population": (data[i].p1989/1000000)
				},
				{
					"year":"1990",
					"population": (data[i].p1990/1000000)
				},
				{
					"year":"1991",
					"population": (data[i].p1991/1000000)
				},
				{
					"year":"1992",
					"population": (data[i].p1992/1000000)
				},
				{
					"year":"1993",
					"population": (data[i].p1993/1000000)
				},
				{
					"year":"1994",
					"population": (data[i].p1994/1000000)
				},
				{
					"year":"1995",
					"population": (data[i].p1995/1000000)
				},
				{
					"year":"1996",
					"population": (data[i].p1996/1000000)
				},
				{
					"year":"1997",
					"population": (data[i].p1997/1000000)
				},
				{
					"year":"1998",
					"population": (data[i].p1998/1000000)
				},
				{
					"year":"1999",
					"population": (data[i].p1999/1000000)
				},
				{
					"year":"2000",
					"population": (data[i].p2000/1000000)
				},
				{
					"year":"2001",
					"population": (data[i].p2001/1000000)
				},
				{
					"year":"2002",
					"population": (data[i].p2002/1000000)
				},
				{
					"year":"2003",
					"population": (data[i].p2003/1000000)
				},
				{
					"year":"2004",
					"population": (data[i].p2004/1000000)
				},
				{
					"year":"2005",
					"population": (data[i].p2005/1000000)
				},
				{
					"year":"2006",
					"population": (data[i].p2006/1000000)
				},
				{
					"year":"2007",
					"population": (data[i].p2007/1000000)
				},
				{
					"year":"2008",
					"population": (data[i].p2008/1000000)
				},
				{
					"year":"2009",
					"population": (data[i].p2009/1000000)
				},
				{
					"year":"2010",
					"population": (data[i].p2010/1000000)
				},
				{
					"year":"2011",
					"population": (data[i].p2011/1000000)
				},
				{
					"year":"2012",
					"population": (data[i].p2012/1000000)
				},
				{
					"year":"2013",
					"population": (data[i].p2013/1000000)
				},
				{
					"year":"2014",
					"population": (data[i].p2014/1000000)
				},
				{
					"year":"2015",
					"population": (data[i].p2015/1000000)
				},
				{
					"year":"2016",
					"population": (data[i].p2016/1000000)
				}
				];

				for(var j=0; j<linedata.length; j++){
					domain_array[j]=(linedata[j].population);
				}

				var max_domain=Math.max(...domain_array);

				var line_vis=d3.select("#linechart"),
								WIDTH=1000,
								HEIGHT=500,
								MARGINS={
									top:20,
									right:20,
									left:50,
									bottom:50},
								xscale=d3.scale.linear().range([MARGINS.left,WIDTH-MARGINS.right]).domain([1960,2016]),
								yscale=d3.scale.linear().range([HEIGHT-MARGINS.top,MARGINS.bottom]).domain([0,max_domain]),

								xAxis=d3.svg.axis().scale(xscale),
								yAxis=d3.svg.axis().scale(yscale).orient("left");

				line_vis.append("svg:g").attr("transform","translate(0," + (HEIGHT-26) + ")").call(xAxis);
				line_vis.append("svg:g").call(yAxis).attr("transform","translate(" + (MARGINS.left) + ",0)").call(yAxis);									

				var lineGen = d3.svg.line()
		  					.x(function(d) {
		    					return xscale(d.year);
		  					})
		  					.y(function(d) {
		    					return yscale(d.population);
		  					});

		  		line_vis.append('svg:path')
		  		.attr('d', lineGen(linedata))
		  		.attr('stroke', 'green')
		  		.attr('stroke-width', 2)
		  		.attr('fill', 'none');	


		  		

    				
			}
		}

	});

</script>
</body>
</html>,