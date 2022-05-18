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
        // Do nothing!
        alert('No item deleted.');
      }
}
