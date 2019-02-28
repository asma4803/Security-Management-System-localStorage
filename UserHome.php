<html>
    <head>
        <title> User </title>
        
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="animate.css">
        <!-- Custom Stylesheet -->
        <link rel="stylesheet" href="style1.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

        
        <script src="SecurityManager.js"></script>
        
        <script>
            
            function Main(){
                var username= localStorage.getItem("username");
                var p= document.getElementById("p1");
                
                p1.innerHTML="<b style='color:white; text-align:right'> |"+username+"|</b>";
                var userRoleArray= SecurityManager.GetAllUserRoles();
                var role= null;
                for (var k in userRoleArray)
                {
                    if  ( userRoleArray[k].username == username){
                        document.getElementById("role").innerHTML= "<b style='font-size:20px;'>"+userRoleArray[k].role+"</b>";
                        role= userRoleArray[k].role;
                    }
                }
                var rolePermissionArray= SecurityManager.GetAllRolePermissions();
                var permission=[];
                var j=0;
                for (var i in rolePermissionArray){
                    if (rolePermissionArray[i].role == role){
                        permission[j] = rolePermissionArray[i].permission;
                        j++;
                    }
                }
                var permissionDiv= document.getElementById("permission");
                debugger;
                for (var k=0; k<permission.length;k++){
                    var p= document.createElement("p");
                    p.innerHTML="<b style='font-size:20px;'>"+permission[k]+"</b>";
                    permissionDiv.appendChild(p);
                }
                
            }
            
        </script>
        
        
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
        
        .topnav p{
            float:right;
            padding-right: 10px;
            text-align: center;
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
        <a class="active" href="Home.php" style="float: left">Home</a>
        <a href="Login.php" >Logout</a>
        <p id="p1"></p>
    </div>
    <br><br><br>
    <p style="color:White; font-size:300%; text-align:center; padding-top:20px; color:black; text-shadow: 0px 0px 10px saddlebrown;font-family: Comic Sans Ms">Welcome User</p>

    <div class="container" id="div1" >
        <div id="div2" class="login-box animated fadeInUp">
            <div class="box-header">
                <h2>Details</h2>
            </div>
            <label for="role"><u>Role </u></label>
            <div id="role"></div>
            <br/>
            <label for="permission"><u>Permission</u></label>
            <br/>
            <div id="permission"></div>
            <br/>
           
        </div>
    </div>


</body>
</html>