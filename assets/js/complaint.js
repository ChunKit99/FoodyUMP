function getDate(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

today = yyyy + '-'+ mm + '-' + dd;
//alert(today);
return today;
}

function getTime(){
    var today = new Date();
    var h = (today.getHours()<10?'0':'') + today.getHours();
    var m = (today.getMinutes()<10?'0':'') + today.getMinutes();
    var s = (today.getSeconds()<10?'0':'') + today.getSeconds();
    var time = h + ":" + m + ":" + s;
//alert(time);
return time;
}

