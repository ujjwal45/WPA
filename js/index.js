    localStorage.clear();

    var lstorage=[];
    // searching the country to select(js file)
    function search_country(){
      d3.csv("data/totalpopulation.csv", function(data) {
      var v=f1.search.value; 
        for(var i=0;i<data.length;i++){
          if(data[i].Name==v){
            document.getElementById('tablediv').style.visibility="visible";
            lstorage[i]=data[i].Name;
            document.getElementById('poptable').innerHTML+="<tr id='"+data[i].Name+"' class='ComparisonTable'  onclick='current_country(this.id)' style='cursor:pointer'><td>" + data[i].Name + "</td><td>" + (data[i].p1961/1000000).toFixed(2) + "</td><td>" + (data[i].p2016/1000000).toFixed(2) + "</td></tr>";
            console.log(lstorage[i]);
        }
      }
      
    });
    }

    // Getting the details of clicked country 
    function current_country(curr_id){
      console.log(curr_id);
      console.log(a);
    }

    // Comparing the Selected Countries
    function compare(){
    localStorage.setItem("list_data_key",  JSON.stringify(lstorage));
    window.location.href='/templates/country.html';
    console.log(a);
    }

	  
    