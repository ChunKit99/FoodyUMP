function logout() {
    window.location.href = '/login.php';
}

function validateUserType() {
    var ddl = document.getElementById("userType");
    var selectedValue = ddl.options[ddl.selectedIndex].value;
    if (selectedValue == "administrator") {
        window.location.href = '/adminstrator/admin_home.php';
    } else if (selectedValue == "restaurantOwner") {
        location.replace('/restaurent/restaurant_profile.php');
    } else if (selectedValue == "generalUser") {
        location.replace('/general_user/views/user_home.php');
    } else if (selectedValue == "rider") {
        location.replace('/rider/rider_home.php');
    } else {
        alert("Error");
    }
}