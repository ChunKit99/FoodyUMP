$(document).ready(function(){
  $.ajax({
    url: "http://localhost/restaurant/graph.php",
    type:"GET",
    success:function(data){
        console.log(data);
    },
    error: function(data){

    }
  });
});