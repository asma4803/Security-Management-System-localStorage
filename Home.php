<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Home</title>

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
                var btn = document.getElementById("welcome");
                btn.onclick= function(){
                    window.location.href="Login.php";
                }
                
            }

        </script>

    </head>

    <body onload="Main();">
        <div class="container">
            <div class="top">
                <h1 id="title" class="hidden"><span id="logo">Security <span>Management System</span></span></h1>
            </div>

            <table align="center" >
                <tr>
                    <td style="width:400px"><div class="login-box animated fadeInUp" style="background-color: #665851">
                            <br/><br>
                            <button type="submit" id="welcome" style="font-family: Comic Sans Ms; height:60px; width:340px; font-size: 18px; text-shadow: 0px 0px 5px saddlebrown;">want to logged in? Click Me ;)</button>
                            <br/>
                        </div></td>

                    
                </tr>
            </table>
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