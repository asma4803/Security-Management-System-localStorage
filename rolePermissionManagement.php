<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>role_permission</title>

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="animate.css">
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="style1.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

        <script src="SecurityManager.js"></script>

        <script>
            function Main()
            {
                var table = document.getElementById("data");
                var headingRow = document.createElement("tr");

                headingRow.innerHTML = "<tr>  <th>ID</th> <th>Role</th>  <th>Permission</th><th>Edit</th><th>Delete</th></tr>";
                table.appendChild(headingRow);
                var dataArray = SecurityManager.GetAllRolePermissions();

                for (var i = 0; i < dataArray.length; i++)
                {
                    var row = document.createElement("tr");
                    row.innerHTML = "<td >" + dataArray[i].ID + "</td><td>" + dataArray[i].role + "</td><td>" + dataArray[i].permission + "</td><td><input type='submit' value='edit' onclick='edit(this);'></td><td><input type='submit' value='delete' onclick='remove(this);'></td> ";
                    table.appendChild(row);
                }

                var role = document.getElementById("role");
                var roleArray = SecurityManager.GetAllRoles();
                var opt = document.createElement("option");
                opt.setAttribute('value', '');
                opt.setAttribute('label', '--Select--');
                role.appendChild(opt);

                for (var k in roleArray)
                {
                    opt = document.createElement("option");
                    opt.setAttribute('value', roleArray[k].role);
                    opt.setAttribute('label', roleArray[k].role);
                    role.appendChild(opt);
                    //console.log(counArray[k]);

                }

                var permissionArray = SecurityManager.GetAllPermissions();
                var permission = document.getElementById("permission");
                var opt = document.createElement("option");
                opt.setAttribute('value', '');
                opt.setAttribute('label', '--Select--');
                permission.appendChild(opt);
                debugger;
                for (var j in permissionArray)
                {
                    opt = document.createElement("option");
                    opt.setAttribute('value', permissionArray[j].permission);
                    opt.setAttribute('label', permissionArray[j].permission);
                    permission.appendChild(opt);
                    //console.log(counArray[k]);

                }


                var saveBtn = document.getElementById("save");
                saveBtn.onclick = function () {
                    var flag1 = true;
                    var flag2 = true;
                    var flag3 = true;

                    var role1 = document.getElementById("role").value;
                    var permission1 = document.getElementById("permission").value;
                    if (role.options[role.selectedIndex].value == "" || permission.options[permission.selectedIndex].value == "") {
                        flag3 = false;
                    }
                    var rolePermissionArray = SecurityManager.GetAllRolePermissions();
                    for (var k in rolePermissionArray)
                    {
                        if (rolePermissionArray[k].role === role1 && rolePermissionArray[k].permission === permission1) {
                            flag1 = false;
                        }

                    }
                    //console.log(userArray);
                    if (flag1 == true && flag3 == true) {
                        var rolePermission = {"role": role1, "permission": permission1};
                        //console.log(user);
                        SecurityManager.SaveRolePermission(rolePermission, function () {
                            alert(" added successfully");
                            role.options[role.selectedIndex].value = "";
                            permission.options[permission.selectedIndex].value = "";
                            window.location.href = "rolePermissionManagement.php";

                        }, function () {
                            alert("some problem occured");
                        });

                        var row1 = document.createElement("tr");
                        row1.innerHTML = "<td>" + rolePermission.ID + "</td><td>" + rolePermission.role + "</td><td>" + rolePermission.permission + "</td><td><input type='submit' value='edit' onclick='edit(this);'> </td><td><input type='submit' value='delete' onclick='remove(this);'> </td>";
                        table.appendChild(row1);

                    }
                    if (flag1 == false) {

                        alert("this role permission is already exists");
                    }
                    if (flag3== false){
                        alert("fields are empty");
                    }

                };
            }

            function edit(element) {
                var rowInd = element.parentNode.parentNode.rowIndex;
                var colInd = element.parentNode.cellIndex;
                var table = document.getElementById("data");
                var id = table.rows.item(rowInd).cells.item(0).innerHTML;

                var role = document.getElementById("role");
                var permission = document.getElementById("permission");

                var rolePermissionArray = SecurityManager.GetAllRolePermissions();
                for (var k in rolePermissionArray)
                {
                    console.log(rolePermissionArray[k]);
                    if (id == rolePermissionArray[k].ID) {
                        var rolePermission = rolePermissionArray[k];
                        //console.log("hello");
                        role.value = rolePermission.role;
                        permission.value = rolePermission.permission;

                        var flag1 = true;
                        var flag2 = true;
                        var flag3 = true;
                        //document.getElementById("cities").value = user.city;
                        var save = document.getElementById("save");
                        save.onclick = function () {
                            rolePermission.role = document.getElementById("role").value;
                            rolePermission.permission = document.getElementById("permission").value;

                            debugger;
                            if (role.options[role.selectedIndex].value == "" || permission.options[permission.selectedIndex].value == "") {
                                flag3 = false;
                            }
                            for (var k in rolePermissionArray)
                            {
                                if ((rolePermissionArray[k].permission === permission.value && rolePermissionArray[k].role === role.value) && rolePermissionArray[k].ID != id) {
                                    flag1 = false;
                                }

                            }
                            if (flag1 == true && flag3 == true) {
                                SecurityManager.SaveRolePermission(rolePermission, function () {
                                    alert("updated");
                                }, function () {
                                    alert("some problem occured");
                                });
                                window.location.href = "rolePermissionManagement.php";
                            }
                            if (flag3 == false) {
                                alert("some fields are empty");
                                flag3 = true;
                                //window.location.href="userManagement.php";
                            }
                            if (flag1 == false) {
                                alert("role permission already exists");
                                flag1 = true;
                                //alert("try a new one");
                                //window.location.href="userManagement.php";
                                //alert("user already exists");
                            }

                        };
                    }

                }
            }
            function remove(element) {

                var rowInd = element.parentNode.parentNode.rowIndex;
                var colInd = element.parentNode.cellIndex;
                var table = document.getElementById("data");
                var id = table.rows.item(rowInd).cells.item(0).innerHTML;

                var result = confirm("Do you want to delete this?");
                var rolePermissionArray = SecurityManager.GetAllRolePermissions();
                if (result) {
                    table.removeChild(element.parentNode.parentNode);
                    for (var k in rolePermissionArray)
                    {
                        //console.log(userArray[k]);
                        if (rolePermissionArray[k].ID == id) {
                            SecurityManager.DeleteRolePermission(id, function () {
                                alert("successfully deleted");
                                window.location.href = "rolePermissionManagement.php";
                            }, function () {
                                alert("some problem occured");
                            })
                        }
                    }
                }
            }


        </script>

        <style>

            .optStyle{
                width:190px ;
                margin-bottom: 20px;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 2px;
                font-size: .9em;
                color: #888;
            }

            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 100px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */

            }

            /* Modal Content */
            .modal-content {
                position: relative;
                background-color: #fefefe;
                margin: auto;
                padding: 10px;
                border: 1px solid #888;
                width: 80%;
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
                -webkit-animation-name: animatetop;
                -webkit-animation-duration: 0.4s;
                animation-name: animatetop;
                animation-duration: 0.4s
            }
            @-webkit-keyframes animatetop {
                from {top:-300px; opacity:0} 
                to {top:0; opacity:1}
            }

            @keyframes animatetop {
                from {top:-300px; opacity:0}
                to {top:0; opacity:1}
            }

            /* The Close Button */
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }

            body{
                margin: 0px;
                background-image: url("photo_bg.jpg");
                height: auto;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
            .topnav {
                overflow: hidden;
                background-color: #333;

            }

            .topnav a {
                float: left;
                color: #f2f2f2;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                font-size: 16px;
                font-family: Comic Sans MS;
            }

            .topnav a:hover {
                background-color: #F0B27A;
                color: black;
                text-shadow: 0px 0px 5px white;
            }

            .topnav a.active {
                background-color: #935116;
                color: white;

            }


        </style>



    </head>

    <body onload="Main();">

        <div class="topnav">
            <a class="active" href="Home.php">Home</a>
            <a href="userManagement.php">User Management</a>
            <a href="roleManagement.php">Role Management</a>
            <a href="permissionManagement.php">Permission Management</a>
            <a href="rolePermissionManagement.php">Role Permission Management</a>
            <a href="userRoleManagement.php">User Role Management</a>
            <a href="Login.php" >Logout</a>
        </div>

        <div class="container" id="div1" >
            <table cellspacing="4" cellpadding="60px" >
                <tr>
                    <td style="width:400px">
                        <div id="div2" class="login-box animated fadeInUp">
                            <div class="box-header">
                                <h2>Role-Permission Management</h2>
                            </div>
                            <label for="role"> Role </label>
                            <br />
                            <select id="role" class="optStyle">

                            </select>
                            <br/>
                            <label for="permission"> Permission </label>
                            <br/>
                            <select id="permission" class="optStyle" >

                            </select>
                            <br/>
                            <button type="submit" id="save" >Save</button>
                            <br/>
                        </div>
                    </td>

                    <td style="width:auto">
                        <div id="div2" class="login-box animated fadeInUp">
                            <div class="box-header">
                                <h2>Role-Permission</h2>
                            </div>

                            <table id="data" style="border:1px; text-align: left;" cellspacing="4" cellpadding="4" >

                            </table>
                        </div>
                    </td>

                </tr>
            </table>
        </div>

        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p align="center" style="font-family: Comic Sans MS">User Entered</p>
            </div>
        </div>

    </body>

    <script>
        $(document).ready(function () {
            $('#logo').addClass('animated fadeInDown');
            $("input:text:visible:first").focus();
        });
        $('#username').focus(function () {
            $('label[for="username"]').addClass('selected');
        });
        $('#username').blur(function () {
            $('label[for="username"]').removeClass('selected');
        });
        $('#password').focus(function () {
            $('label[for="password"]').addClass('selected');
        });
        $('#password').blur(function () {
            $('label[for="password"]').removeClass('selected');
        });
    </script>

</html>