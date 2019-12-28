<!DOCTYPE html>
<html>
<head>
<title>Population Analyzer</title>
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
<script type="text/javascript" src="js/firstpage.js"></script>
<link rel="stylesheet" type="text/css" href="css/search.css">
<style>
.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 15px;
    border-radius: 5px;   
    background: #000000;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    border-radius: 50%; 
    background: #428BCA;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}
</style>
</head>
<body>


<!-- Search bar -->
  <div class="container-fluid">
    <div class="row" style='background: linear-gradient(#171819,#393c42)'>
        <div class="col-md-9" style="height: 50px">
          <button type="button" class="btn btn-primary" style="margin-top:8px" data-toggle="modal" data-target="#myModal">Predict Population</button>

          
        </div>
        <div class="col-md-3">
          <form name="f1" class="navbar-form" role="search">
            <div class="input-group add-on" style="width: 100%">
              <input type="text" name="search" id="search" class="form-control" placeholder="Search By Country">
                <div class="input-group-btn">
                  <button type="button" name="srchbtn" class="btn btn-primary" onclick="search_country()"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
          </form>       
        </div>
    </div>
  </div>
  
  <!-- World Map -->
  <div class="jumbotron" style="height: 100%">
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Predict Population</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="http://localhost:5000/prediction">
            <input type="text" placeholder="Enter country Name" name="predict_country" class="form-control"><br>
            <input type="number" placeholder="Enter from Year to be predicted" name="predict_year1" class="form-control"><br>
            <input type="number" placeholder="Enter end year to be predicted" name="predict_year2" class="form-control"><br>
            <input type="submit" class="btn btn-primary"> 
          </form>
      </div>
    </div>

  </div>
</div>
    <div class="container">
    <div id="container" style="width:100% ; border-radius: 12px"></div>
    <div class="row">
      <div class="col-xs-2">
      </div>
      <div class="col-xs-8">
        <div id="slidebar">
          <input type="range" id="YearSlider" min="1960" max="2017" value="2000" class="slider" style="border-radius: 20px">
        </div> 
      </div>
      <div class="col-xs-2">
      </div>
    </div>
    </div>
  </div>

  <!-- Selected Countries Table -->
  <div class="container" id="tablediv" style="visibility: hidden">
    <div class="row">
      <div class="col-xs-12">
      	<table class="table table-hover table-responsive" id="poptable" method='POST' style="width:100%;">
          <caption><center><h4>Selected Countries</h4></center></caption>
          <tr class="info">
            <th>Country</th>
            <th>1961 (in millions)</th>
            <th>2016 (in millions)</th>
          </tr>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
      </div>
    </div>
  </div>

  <script>
    // Controliing the Slider
    var population='p2000';
    var slider = document.getElementById('YearSlider');
    var yearselected = slider.value;


    slider.oninput = function() {
    yearselected=(this.value);
    population='p' + yearselected;
    document.getElementById('slider_output').innerHTML=yearselected;
    }

    // Plotting World Map
    var map = new Datamap({
      element: document.getElementById('container'),
      scope: 'world',
      responsive: true,
      // plotting data on World Map
      dataUrl: 'data/TotalPopulation.csv',
      dataType: 'csv',
      data:{},

      fills: {
          defaultFill: 'black'
      },

      geographyConfig: {
        hideAntarctica: true,
        hideHawaiiAndAlaska : false,
        borderWidth: 1,
        borderOpacity: 1,

        // data to be displayed when hovered over a country on world map
        popupTemplate: function(geo, dataUrl) { 

          return '<div class="hoverinfo"><i class="fa fa-flag-checkered" aria-hidden="true" style ="color:#FC8D59"></i><strong> ' + geo.properties.name + '</strong></div>' + 
            '<div class="hoverinfo"><i class="fa fa-users" aria-hidden="true" style ="color:#FC8D59"></i><strong> ' + (dataUrl[population]/1000000).toFixed(2) + ' (millions)</strong></div> '
      },

      popupOnHover: true,
      highlightOnHover: true,
      highlightFillColor: ' #428bca',
      highlightBorderColor: 'rgba(250, 15, 160, 0.2)',
      highlightBorderWidth: 2,
      highlightBorderOpacity: 1,
        
    }
    });

  </script>
</body>
</html>
