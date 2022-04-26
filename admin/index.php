<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="format-detection" content="telephone=no" />

    <title>Bond</title>

    <link rel="stylesheet" href="../js/plugins/revslider/public/assets/css/rs6.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../css/combined.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="../css/responsive-css.css" type="text/css" media="all" />
    <link rel="shortcut icon" type="image/png" href="../images/favicon 2.svg"/>
</head>
<body>
    <div class="container__wrapper">
        <div class="box__">
            <image src="../images/LOGO.svg" width="150" height="40" class="img_" />
            <!-- <h1>Login Admin</h1> -->
            
            <form method="post" action="./loginadmin.php">
                <div class="txt_field">
                    <input type="text" name="name" required >
                    <label>Username</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="pass" required >
                    <label>Password</label>
                </div>
                <input type="submit" name="submit" value="Login" class="btn__">
                <div class="btn__kembali">
                    <a href="../index.html">kembali</a>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>