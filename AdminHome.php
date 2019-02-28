<html>
    <head>
        <title> Admin </title>
        <script src="SecurityManager.js"></script>
    </head>

    <style>
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
<body >

    <div class="topnav">
        <a class="active" href="Home.php">Home</a>
        <a href="userManagement.php">User Management</a>
        <a href="roleManagement.php">Role Management</a>
        <a href="permissionManagement.php">Permission Management</a>
        <a href="rolePermissionManagement.php">Role Permission Management</a>
        <a href="userRoleManagement.php">User Role Management</a>
        <a href="Login.php" >Logout</a>
    </div>
    <br><br><br><br><br><br><br><br>
    <p style="color:White; font-size:400%; text-align:center; padding-top:20px; color:black; text-shadow: 3px 3px 5px saddlebrown;">Welcome Admin</p>
</body>
</html>