//rider_home.html
function record_edit(){
  if (confirm('Are you sure to edit?')==true) {
      alert('Saved!');
    } else {
      // Do nothing!
      alert('No item edited.');
    }
  }
  
//rider_home.html
  function record_delete(){
      if (confirm('Are you sure to delete?')) {
          var res_profile = document.getElementsByClassName('record1');
          for(var i=0; i< xxx.length; i++){
                box = xxx[i];
                t=text[i];
            if(box.checked==true) {
                switch(i){
                    case 0:
                        i = 0;
                        document.getElementById('td').value='';
                        box.checked=false;
                        break;
                    case 1:
                        i = 1;
                        document.getElementById('td').value='';
                        box.checked=false;
                        break;
                    case 2:
                          i = 2;
                          document.getElementById('td').value='';
                          box.checked=false;
                          break;
                    case 3:
                          i = 3;
                          document.getElementById('td').value='';
                          box.checked=false;
                          break;
                  }
              }
      
          }
             alert('Deleted!');
        } else {
          alert('No item deleted.');
        }
  }

//rider_order.html
function qr(img){
    // Get the modal
    var modal = document.getElementById("myModal");
    
    // Get the button that opens the modal
    var btn = document.getElementById("qr");
    
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    
    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }
    
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
}

//rider_report.html
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

//rider_delivery_notes_details.html
function orderUpdate(){
  if (confirm("Are you sure to update?")==true) {
    alert('Updated!');
    window.location.href = "rider_order.html";
  } else {
    alert('No changed done.');
  }
}

//rider_delivery_notes_details.html
function orderDelete(){
  if (confirm("Are you sure to delete?")==true) {
    alert('Deleted!');
    window.location.href = "rider_order.html";
  } else {
    alert('No changed done.');
  }
}

//rider_delivery_records_details.html
function recordsUpdate(){
  if (confirm("Are you sure to update?")==true) {
    alert('Updated!');
    window.location.href = "rider_home.html";
  } else {
    alert('No changed done.');
  }
}

//rider_delivery_records_details.html
function recordsDelete(){
  if (confirm("Are you sure to delete?")==true) {
    alert('Deleted!');
    window.location.href = "rider_home.html";
  } else {
    alert('No changed done.');
  }
}