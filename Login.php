<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Login</title>

        <!-- Google Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="animate.css">
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

        <script src="SecurityManager.js"></script>
        <style>
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
        </style>

        <script>
            function Main()
            {
                var adminbtn = document.getElementById("adminBtn");
                adminbtn.onclick = function () {
                    var name = document.getElementById("adminBox").value;
                    var passwd = document.getElementById("adminPass").value;
                    if (name.length == 0 || passwd.legnth == 0) {
                        alert("username required");
                    }
                    var result = SecurityManager.ValidateAdmin(name, passwd);
                    if (result == true)
                    {
                        window.location.href = "AdminHome.php";
                    } else {
                        //alert("wrong username or password");
                        var modal = document.getElementById('myModal');
                        var span = document.getElementsByClassName("close")[0];
                        // When the user clicks the button, open the modal 
                        modal.style.display = "block";

// When the user clicks on <span> (x), close the modal
                        span.onclick = function () {
                            modal.style.display = "none";
                        }

// When the user clicks anywhere outside of the modal, close it
                        window.onclick = function (event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    }
                    //  return false;
                };

                var userBtn = document.getElementById("userBtn");
                userBtn.onclick = function () {
                    debugger;
                    var userName = document.getElementById("userBox").value;
                    var userPass = document.getElementById("userPass").value;
                    var userArray = SecurityManager.GetAllUsers();
                    var flag = true;
                    for (var k in userArray) {
                        if (userArray[k].username == userName && userArray[k].password == userPass) {
                            flag = true;
                            break;
                        } else if (userArray[k].username != userName || userArray[k].password != userPass) {
                            flag = false;
                        }
                    }
                    if (flag == false) {
                        var modal = document.getElementById('myModal');
                        var span = document.getElementsByClassName("close")[0];
                        // When the user clicks the button, open the modal 
                        modal.style.display = "block";

// When the user clicks on <span> (x), close the modal
                        span.onclick = function () {
                            modal.style.display = "none";
                        }

// When the user clicks anywhere outside of the modal, close it
                        window.onclick = function (event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    } else {
                        localStorage.setItem("username", userName);
                        window.location.href = "UserHome.php";
                    }
                };

            }

        </script>

    </head>

    <body onload="Main();">
        <div class="container">
            <div class="top">
                <h1 id="title" class="hidden"><span id="logo">Security <span>Management</span></span></h1>
            </div>

            <table align="center" >
                <tr>
                    <td style="width:400px"><div class="login-box animated fadeInUp">
                            <div class="box-header">
                                <h2>Login Admin</h2>
                            </div>
                            <label for="username">Username</label>
                            <br/>
                            <input type="text" id="adminBox">
                            <br/>
                            <label for="password">Password</label>
                            <br/>
                            <input type="password" id="adminPass">
                            <br/>
                            <button type="submit" id="adminBtn">Sign In</button>
                            <br/>
                        </div></td>

                    <td style="width:400px"><div class="login-box animated fadeInUp">
                            <div class="box-header">
                                <h2>Login User</h2>
                            </div>
                            <label for="username">Username</label>
                            <br/>
                            <input type="text" id="userBox">
                            <br/>
                            <label for="password">Password</label>
                            <br/>
                            <input type="password" id="userPass">
                            <br/>
                            <button type="submit" id="userBtn">Sign In</button>
                            <br/>
                        </div></td>
                </tr>
            </table>
        </div>

        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p align="center" style="font-family: Comic Sans MS">Wrong username or password..</p>
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