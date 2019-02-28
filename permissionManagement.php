<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>permission_m</title>

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

                //var UpdatedUserArray = SecurityManager.GetAllPermissions();
                var table = document.getElementById("data");

                var headingRow = document.createElement("tr");

                headingRow.innerHTML = "<tr>  <th>ID</th> <th>Permission</th>  <th>Description</th><th>Edit</th><th>Delete</th></tr>";
                table.appendChild(headingRow);
                var dataArray = SecurityManager.GetAllPermissions();

                for (var i = 0; i < dataArray.length; i++)
                {
                    var row = document.createElement("tr");
                    row.innerHTML = "<td >" + dataArray[i].ID + "</td><td>" + dataArray[i].permission + "</td><td>" + dataArray[i].description + "</td><td><input type='submit' value='edit' onclick='edit(this);'></td><td><input type='submit' value='delete' onclick='remove(this);'></td> ";
                    table.appendChild(row);
                }


                var saveBtn = document.getElementById("save");
                saveBtn.onclick = function () {
                    var flag1 = true;
                    var flag3 = true;
                    var permission = document.getElementById("permission").value;
                    var description = document.getElementById("description").value;

                    if (permission == "" || description == "") {
                        flag3 = false;
                    }
                    var permissionArray = SecurityManager.GetAllPermissions();


                    for (var k in permissionArray)
                    {
                        if (permissionArray[k].permission === permission) {
                            flag1 = false;
                        }

                    }
                    //console.log(userArray);
                    if (flag1 == true && flag3 == true) {
                        var permissionObj = {"permission": permission, "description": description};
                        //console.log(user);
                        SecurityManager.SavePermission(permissionObj, function () {
                            alert("Permission added successfully");
                            document.getElementById("permission").value = "";
                            document.getElementById("description").value = "";

                        }, function () {
                            alert("some problem occured");
                        });
                        var row1 = document.createElement("tr");
                        row1.innerHTML = "<td>" + permissionObj.ID + "</td><td>" + permissionObj.permission + "</td><td>" + permissionObj.description + "</td><td><input type='submit' value='edit' onclick='edit(this);'> </td><td><input type='submit' value='delete' onclick='remove(this);'> </td>";
                        table.appendChild(row1);

                    }
                    if (flag1 == false) {
                        var div = document.getElementById("pdiv");
                        div.innerText = "permission already exists";
                        //alert("user already exists");
                    }

                    if (flag3 == false) {
                        alert("some fields are empty");
                    }

                };
            }

            function edit(element) {
                var rowInd = element.parentNode.parentNode.rowIndex;
                var colInd = element.parentNode.cellIndex;
                var table = document.getElementById("data");
                var id = table.rows.item(rowInd).cells.item(0).innerHTML;
                //console.log(id);
                var permissionArray = SecurityManager.GetAllPermissions();
                for (var k in permissionArray)
                {
                    //console.log(roleArray[k]);
                    if (id == permissionArray[k].ID) {
                        var permission = permissionArray[k];
                        //console.log("hello");
                        document.getElementById("permission").value = permission.permission;
                        document.getElementById("description").value = permission.description;

                        var flag1 = true;
                        var flag3 = true;
                        //document.getElementById("cities").value = user.city;
                        var save = document.getElementById("save");
                        save.onclick = function () {
                            permission.permission = document.getElementById("permission").value;
                            permission.description = document.getElementById("description").value;

                            debugger;
                            if (permission.permission == "" || permission.description == "") {
                                flag3 = false;

                            }
                            for (var h in permissionArray) {
                                if (permissionArray[h].permission == permission.permission && permissionArray[h].ID != id)
                                {
                                    flag1 = false;
                                }

                            }
                            if (flag1 == true && flag3 == true) {
                                SecurityManager.SavePermission(permission, function () {
                                    alert("permission updated");
                                }, function () {
                                    alert("some problem occured");
                                });
                                window.location.href = "permissionManagement.php";
                            }
                            if (flag3 == false) {
                                alert("some fields are empty");
                                flag3 = true;

                            }
                            if (flag1 == false) {
                                var div = document.getElementById("rdiv");
                                div.innerText = "permission already exists";
                                flag1 = true;

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

                var result = confirm("Do you want to delete the permission?");
                var permissionArray = SecurityManager.GetAllPermissions();
                if (result) {
                    table.removeChild(element.parentNode.parentNode);
                    debugger;
                    for (var l in permissionArray)
                    {
                        //console.log(userArray[k]);
                        if (permissionArray[l].ID == id) {

                            SecurityManager.DeletePermission(id, function () {
                                alert("permission successfully deleted");
                            }, function () {
                                alert("some problem occured");
                            });
                        }
                    }
                }
            }



            function pempty() {
                if (document.getElementById("permission").value.length == 0)
                {
                    document.getElementById("pdiv").innerText = "enter permission";
                } else
                {
                    document.getElementById("pdiv").innerText = "";
                }
            }
            function dempty() {
                if (document.getElementById("description").value.length == 0)
                {
                    document.getElementById("ddiv").innerText = "enter description";
                } else
                {
                    document.getElementById("ddiv").innerText = "";
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
                                <h2>Permission Management</h2>
                            </div>
                            <label for="permission">Permission</label>
                            <br/>
                            <input type="text" id="permission" onblur="pempty();"><div id="pdiv" style="color:saddlebrown"> </div>
                            <br/>
                            <label for="description">Description</label>
                            <br/>
                            <input type="textarea" id="description" onblur="dempty();"><div id="ddiv" style="color:saddlebrown"> </div>
                            <br/>
                            <button type="submit" id="save" >Save</button>
                            <br/>
                        </div>
                    </td>

                    <td style="width:auto">
                        <div id="div2" class="login-box animated fadeInUp">
                            <div class="box-header">
                                <h2>Permissions</h2>
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