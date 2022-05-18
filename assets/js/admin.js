function logout() {
    window.location.href = '/login.html';
}

function validateUserType() {
    var ddl = document.getElementById("userType");
    var selectedValue = ddl.options[ddl.selectedIndex].value;
    if (selectedValue == "administrator") {
        window.location.href = '/adminstrator/admin_home.html';
    } else if (selectedValue == "restaurantOwner") {
        location.replace('/restaurent/restaurant_profile.html');
    } else if (selectedValue == "generalUser") {
        location.replace('/general_user/views/user_home.html');
    } else if (selectedValue == "rider") {
        location.replace('/rider/views/rider_home.html');
    }else{
        alert("Error");
    }
}