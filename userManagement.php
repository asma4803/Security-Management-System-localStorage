<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>user_m</title>

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

                var UpdatedUserArray = SecurityManager.GetAllUsers();
                var table = document.getElementById("data");

                var headingRow = document.createElement("tr");

                headingRow.innerHTML = "<tr>  <th>ID</th> <th>Name</th>  <th>Email</th><th>Edit</th><th>Delete</th></tr>";
                table.appendChild(headingRow);
                var dataArray = SecurityManager.GetAllUsers();

                for (var i = 0; i < dataArray.length; i++)
                {
                    var row = document.createElement("tr");
                    row.innerHTML = "<td >" + dataArray[i].ID + "</td><td>" + dataArray[i].name + "</td><td>" + dataArray[i].email + "</td><td><input type='submit' value='edit' onclick='edit(this);'></td><td><input type='submit' value='delete' onclick='remove(this);'></td> ";
                    table.appendChild(row);
                }

                var coun = document.getElementById("country");
                var counArray = SecurityManager.GetCountries();
                var opt = document.createElement("option");
                opt.setAttribute('value', '');
                opt.setAttribute('label', '--Select--');
                coun.appendChild(opt);
                for (var k in counArray)
                {
                    opt = document.createElement("option");
                    opt.setAttribute('value', counArray[k].Name);
                    opt.setAttribute('label', counArray[k].Name);
                    coun.appendChild(opt);
                    //console.log(counArray[k]);

                }

                var saveBtn = document.getElementById("save");
                saveBtn.onclick = function () {
                    var flag1 = true;
                    var flag2 = true;
                    var flag3 = true;
                    var username = document.getElementById("username").value;
                    var passwd = document.getElementById("password").value;
                    var name = document.getElementById("name").value;
                    var email = document.getElementById("email").value;
                    var country = document.getElementById("country").value;
                    var city = document.getElementById("cities").value;
                    if (username == "" || passwd == "" || name == "" || email == "" || country == "" || city == "") {
                        flag3 = false;
                    }
                    var userArray = SecurityManager.GetAllUsers();


                    for (var k in userArray)
                    {
                        if (userArray[k].username === username) {
                            flag1 = false;
                        }
                        if (userArray[k].email === email) {
                            flag2 = false;
                        }
                    }
                    //console.log(userArray);
                    if (flag1 == true && flag2 == true && flag3 == true) {
                        var user = {"username": username, "password": passwd, "name": name, "email": email, "country": country, "city": city};
                        //console.log(user);
                        SecurityManager.SaveUser(user, function () {
                            alert("user added successfully");
                            document.getElementById("username").value = "";
                            passwd = document.getElementById("password").value = "";
                            name = document.getElementById("name").value = "";
                            email = document.getElementById("email").value = "";

                        }, function () {
                            alert("some problem occured");
                        });
                        var row1 = document.createElement("tr");
                        row1.innerHTML = "<td>" + user.ID + "</td><td>" + user.name + "</td><td>" + user.email + "</td><td><input type='submit' value='edit' onclick='edit(this);'> </td><td><input type='submit' value='delete' onclick='remove(this);'> </td>";
                        table.appendChild(row1);

                    }
                    if (flag1 == false) {
                        var div = document.getElementById("udiv");
                        div.innerText = "username already exists";
                        //alert("user already exists");
                    }
                    if (flag2 == false)
                    {
                        var div = document.getElementById("ediv");
                        div.innerText = "email already exists";
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
                console.log(id);
                var userArray = SecurityManager.GetAllUsers();
                for (var k in userArray)
                {
                    console.log(userArray[k]);
                    if (id == userArray[k].ID) {
                        var user = userArray[k];
                        console.log("hello");
                        document.getElementById("username").value = user.username;
                        document.getElementById("password").value = user.password;
                        document.getElementById("name").value = user.name;
                        document.getElementById("email").value = user.email;
                        document.getElementById("country").value = user.country;
                        var counArray = SecurityManager.GetCountries();
                        var cid1 = null;
                        for (var l in counArray) {
                            if (counArray[l].Name == user.country) {
                                cid1 = counArray[l].CountryID;
                                break;
                            }
                        }
                        var city = document.getElementById("cities");
                        var cityArray = SecurityManager.GetCitiesByCountryId(cid1);
                        city.innerHTML = '';
                        //debugger;
                        for (var i = 0; i < cityArray.length; i++) {
                            if (cityArray[i] == user.city) {
                                var opt = document.createElement("option");
                                opt.innerText = user.city;
                                opt.setAttribute('value', user.city);
                                city.appendChild(opt);
                                break;
                            }
                        }
                        for (var i = 0; i < cityArray.length; i++) {
                            if (cityArray[i] != user.city) {
                                var opt = document.createElement("option");
                                opt.innerText = user.city;
                                opt.setAttribute("value", user.city);
                                city.appendChild(opt);
                                break;
                            }
                        }
                        var flag1 = true;
                        var flag2 = true;
                        var flag3 = true;
                        //document.getElementById("cities").value = user.city;
                        var save = document.getElementById("save");
                        save.onclick = function () {
                            user.username = document.getElementById("username").value;
                            user.password = document.getElementById("password").value;
                            user.name = document.getElementById("name").value;
                            user.email = document.getElementById("email").value;
                            user.country = document.getElementById("country").value;
                            user.city = document.getElementById("cities").value;
                            debugger;
                            if (user.email == "" || user.name == "" || user.password == "" || user.username == "" || user.country == "" || user.city == "") {
                                flag3 = false;

                            }
                            for (var h in userArray) {
                                if (userArray[h].username == user.username && userArray[h].ID != id)
                                {
                                    flag1 = false;
                                }
                                if (userArray[h].email == user.email && userArray[h].ID != id) {
                                    flag2 = false;
                                }
                            }
                            if (flag1 == true && flag2 == true && flag3 == true) {
                                SecurityManager.SaveUser(user, function () {
                                    alert("user updated");
                                }, function () {
                                    alert("some problem occured");
                                });
                                window.location.href = "userManagement.php";
                            }
                            if (flag3 == false) {
                                alert("some fields are empty");
                                flag3=true;
                                //window.location.href="userManagement.php";
                            }
                            if (flag1 == false) {
                                var div = document.getElementById("udiv");
                                div.innerText = "username already exists";
                                flag1=true;
                                //alert("try a new one");
                                //window.location.href="userManagement.php";
                                //alert("user already exists");
                            }
                            if (flag2 == false)
                            {
                                var div = document.getElementById("ediv");
                                div.innerText = "email already exists";
                                flag2=true;
                                //alert("try a new one");
                                //window.location.href="userManagement.php";
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
                
                var result = confirm("Do you want to delete the usre?");
                var userArray = SecurityManager.GetAllUsers();
                if (result) {
                    table.removeChild(element.parentNode.parentNode);
                    for (var k in userArray)
                    {
                        //console.log(userArray[k]);
                        if (userArray[k].ID == id) {
                            SecurityManager.DeleteUser(id, function () {
                                alert("user successfully deleted");
                            }, function () {
                                alert("some problem occured");
                            })
                        }
                    }
                }
            }

            function uempty() {
                if (document.getElementById("username").value.length == 0)
                {
                    document.getElementById("udiv").innerText = "enter username";
                } else
                {
                    document.getElementById("udiv").innerText = "";
                }
            }
            function pempty() {
                if (document.getElementById("password").value.length == 0)
                {
                    document.getElementById("pdiv").innerText = "enter password";
                } else
                {
                    document.getElementById("pdiv").innerText = "";
                }
            }

            function nempty() {
                if (document.getElementById("name").value.length == 0)
                {
                    document.getElementById("ndiv").innerText = "enter name";
                } else
                {
                    document.getElementById("ndiv").innerText = "";
                }
            }

            function eempty() {
                if (document.getElementById("email").value.length == 0)
                {
                    document.getElementById("ediv").innerText = "enter email";
                } else
                {
                    document.getElementById("ediv").innerText = "";
                }
            }

            function fillCities()
            {

                //console.log("Hello");
                var city = document.getElementById("cities");

                if (city.options.length > 0)
                {
                    city.options.length = 0;
                }

                var counArray = SecurityManager.GetCountries();
                var country = document.getElementById("country").value;
                var cid = 0;
                for (var k in counArray) {
                    if (counArray[k].Name == country)
                    {
                        cid = counArray[k].CountryID;
                        //  console.log(cid);
                    }
                }

                var opt = document.createElement("option");
                opt.setAttribute('value', '');
                opt.setAttribute('label', '--Select--');
                city.appendChild(opt);
                var cityArray = SecurityManager.GetCitiesByCountryId(cid);
                for (var j in cityArray)
                {
                    opt = document.createElement("option");
                    opt.innerHTML = cityArray[j].Name;
                    opt.value = cityArray[j].Name;
                    //opt.setAttribute('value', cityArray[j].Name);
                    //opt.setAttribute('label', cityArray[j].Name);
                    city.appendChild(opt);
                    //console.log(cityArray[j]);
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
                                <h2>User Management</h2>
                            </div>
                            <label for="username">Username</label>
                            <br/>
                            <input type="text" id="username" onblur="uempty();"><div id="udiv" style="color:saddlebrown"> </div>
                            <br/>
                            <label for="password">Password</label>
                            <br/>
                            <input type="password" id="password" onblur="pempty();"><div id="pdiv" style="color:saddlebrown"> </div>
                            <br/>
                            <label for="name">Name</label>
                            <br/>
                            <input type="text" id="name" onblur="nempty();"><div id="ndiv" style="color:saddlebrown"> </div>
                            <br/>
                            <label for="Email">Email</label>
                            <br/>
                            <input type="email" id="email" onblur="eempty();"><div id="ediv" style="color:saddlebrown; border-color: black"> </div>
                            <br/>
                            <label for="country"> Country </label>
                            <br />
                            <select id="country" class="optStyle" onchange="fillCities();">

                            </select>
                            <br/>
                            <label for="cities"> City </label>
                            <br/>
                            <select id="cities" class="optStyle" >

                            </select>
                            <br/>
                            <button type="submit" id="save" >Save</button>
                            <br/>
                        </div>
                    </td>

                    <td style="width:auto">
                        <div id="div2" class="login-box animated fadeInUp">
                            <div class="box-header">
                                <h2>Users</h2>
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