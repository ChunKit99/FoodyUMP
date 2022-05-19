//restaurant_profile.html
function res_edit(){
if (confirm("Are you sure to edit?")==true) {
    alert('Saved!');
  } else {
    // Do nothing!
    alert('No item edited.');
  }
}

/*function res_delete(){
    if (confirm('Are you sure to delete?')) {
        var res_profile = document.getElementsByClassName('check_respro');
        var text = document.getElementsByClassName('txt');
        for(var i=0; i< res_profile.length; i++){
              box = res_profile[i];
          if(box.checked) {
           rowTag = box.parentNode.parentNode;
           tableTag = box.parentNode.parentNode.parentNode;
           tableTag.removeChild(rowTag);
             }
            }
            document.getElementById("btn_delete".addEventListener("btn_delete",res_delete));
        alert('Deleted!');
      } else {
        // Do nothing!
        alert('No item deleted.');
      }
}*/

//restaurant_profile.html
function res_delete(){
    if (confirm('Are you sure to delete?')) {
        var res_profile = document.getElementsByClassName('check_respro');
        var text = document.getElementsByClassName('res_input');
        for(var i=0; i< res_profile.length; i++){
              box = res_profile[i];
              t=text[i];
          if(box.checked==true) {
              switch(i){
                  case 0:
                      i = 0;
                      document.getElementById('res_name').value='';
                      box.checked=false;
                      break;
                  case 1:
                      i = 1;
                      document.getElementById('res_location').value='';
                      box.checked=false;
                      break;
                  case 2:
                        i = 2;
                        document.getElementById('res_operation').value='';
                        box.checked=false;
                        break;
                  case 3:
                        i = 3;
                        document.getElementById('res_contact').value='';
                        box.checked=false;
                        break;
                  case 4:
                        i = 4;
                        document.getElementById('res_insta').value='';
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

//addFood.html
function foodAdd(){
  if (confirm("Are you sure to add?")==true) {
    alert('Saved!');
    window.location.href = "restaurant_food.html";
  } else {
    alert('No item added.');
  }
}

function foodEdit(){
  if (confirm("Are you sure to edit?")==true) {
    alert('Edited!');
    window.location.href = "restaurant_food.html";
  } else {
    alert('No item edited.');
  }
}

function foodDelete(){
  if (confirm("Are you sure to delete?")==true) {
    alert('Deleted!');
    window.location.href = "restaurant_food.html";
  } else {
    alert('No item deleted.');
  }
}

function foodPublish(){
  if (confirm("Are you sure to publish?")==true) {
    alert('Published!');
    window.location.href = "restaurant_food.html";
  } else {
    alert('No item published.');
  }
}

//orderDetail.html
function orderUpdate(){
  if (confirm("Are you sure to update?")==true) {
    alert('Updated!');
    window.location.href = "restaurant_order.html";
  } else {
    alert('No changed done.');
  }
}

function orderDelete(){
  if (confirm("Are you sure to delete?")==true) {
    alert('Deleted!');
    window.location.href = "restaurant_order.html";
  } else {
    alert('No changed done.');
  }
}

function graph(chart1){
  var xValues = [50,60,70,80,90,100,110,120,130,140,150];
                var yValues = [7,8,8,9,9,9,10,11,14,14,15];

                new Chart("chart1", {
                type: "line",
                data: {
                    labels: xValues,
                    datasets: [{
                    fill: false,
                    lineTension: 0,
                    backgroundColor: "rgba(0,0,255,1.0)",
                    borderColor: "rgba(0,0,255,0.1)",
                    data: yValues
                    }]
                },
                options: {
                    legend: {display: false},
                    scales: {
                    yAxes: [{ticks: {min: 6, max:16}}],
                    }
                }
                });
}
