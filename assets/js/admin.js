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
    }else{
        alert("Error");
    }
}

function adminUserListEdit() {
    if (confirm('Are you sure to edit?')) {
        var editUserlist = document.getElementsByClassName('select');
        var text = document.getElementsByClassName('select');
        window.location.href = "admin_add_user.html";
        for (var i = 0; i < editUserlist.length; i++) {
            box = editUserlist[i];
            t = text[i];
            if (box.checked == true) {
                switch (i) {
                    case 0:
                        i = 0;
                        document.getElementById('select').value = '';
                        box.checked = false;
                        break;
                }
            }

        }
        alert('Edit User Information!');
    } else {
        alert('No item Edited.');
    }
}

function adminUserListDelete() {
    if (confirm('Are you sure to edit?')) {
        var deleteUserlist = document.getElementsByClassName('select');
        var text = document.getElementsByClassName('select');
        window.location.href = "admin_user_list.html";
        for (var i = 0; i < deleteUserlist.length; i++) {
            box = deleteUserlist[i];
            t = text[i];
            if (box.checked == true) {
                switch (i) {
                    case 0:
                        i = 0;
                        document.getElementById('select').value = '';
                        box.checked = false;
                        break;
                }
            }

        }
        alert('Deleted!');
    } else {
        alert('No item Edited.');
    }
}

function adminAddUserAdd() {
    if (confirm("Are you sure to add?") == true) {
        alert('Saved!');
        window.location.href = "admin_add_user.php";
    } else {
        alert('No item added.');
    }
}

function adminAddUserEdit() {
    if (confirm("Are you sure to edit?") == true) {
        alert('Saved!');
        window.location.href = "admin_add_user.php";
    } else {
        alert('No item edited.');
    }
}