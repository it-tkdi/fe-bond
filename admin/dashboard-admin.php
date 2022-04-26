<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="format-detection" content="telephone=no" />

    <title>Bond</title>
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/responsive-css.css" type="text/css" media="all" />
    <link rel="shortcut icon" type="image/png" href="../images/favicon 2.svg"/>

</head>
<body>
    <input type="checkbox" id="check">
    <!-- Header area start -->
    <header>
        <label for="check">
            <i class="fas fa-bars" id="sidebar-btn"></i>
        </label>
        <div class="left-area">
            <img src="../images/LOGO.svg" width="141" height="30" />
        </div>
        <div class="right-area">
            <a href="dashboard-admin.php?halaman=logout" class="logout-btn">Logout</a>
        </div>
    </header>
    <!-- Header area end -->

    <!-- Sidebar start -->
    <div class="sidebar">
        <center>
            <img src="./img/user.png" class="profile-image" alt="">
            <h4>Admin</h4>
        </center>
        <a href="dashboard-admin.php?halaman=event"><i class="fas fa-tags"></i><span> Events</span></a>
        <a href="dashboard-admin.php?halaman=groups"><i class="fas fa-users"></i><span> Groups</span></a>
        <a href="dashboard-admin.php?halaman=email"><i class="fas fa-envelope"></i><span> Email</span></a>
        <a href="dashboard-admin.php?halaman=logout"><i class="fas fa-sign-out-alt"></i><span> Logout</span></a>
    </div>
    <!-- Sidebar end -->
    
    <div class="content">
        <div class="info">
            <?php
                if(isset($_GET['halaman'])){
                    if($_GET['halaman'] == "logout"){
                        include 'logout.php';
                    }
                    if($_GET['halaman'] == "event"){
                        include 'event.php';
                    }
                    if ($_GET['halaman'] == "tambahEvent") {
                        include 'tambahEvent.php';
                    }
                    if ($_GET['halaman'] == "ubahEvent") {
                        include 'ubahEvent.php';
                    }
                    if ($_GET['halaman'] == "hapusEvent") {
                        include 'hapusEvent.php';
                    }
                    if ($_GET['halaman'] == "activateEvent") {
                        include 'activateEvent.php';
                    }
                    if ($_GET['halaman'] == "groups") {
                        include 'groups.php';
                    }
                    if ($_GET['halaman'] == "tambahGroups") {
                        include 'tambahGroups.php';
                    }
                    if ($_GET['halaman'] == "ubahGroups") {
                        include 'ubahGroups.php';
                    }
                    if ($_GET['halaman'] == "email"){
                        include 'email.php';
                    }
                    if ($_GET['halaman'] == "tambahEmail") {
                        include 'tambahEmail.php';
                    }
                    if ($_GET['halaman'] == "ubahEmail") {
                        include 'ubahEmail.php';
                    }
                    if ($_GET['halaman'] == "hapusEmail") {
                        include 'hapusEmail.php';
                    }
                    if ($_GET['halaman'] == "blastEmail") {
                        include 'blastEmail.php';
                    }
                    if ($_GET['halaman'] == "blastByGroup") {
                        include 'blastByGroup.php';
                    }
                    if ($_GET['halaman'] == "tambahEmailExcel") {
                        include 'tambahEmailExcel.php';
                    }
                    if ($_GET['halaman'] == "listEmail") {
                        include 'listEmail.php';
                    }
                    if ($_GET['halaman'] == "download") {
                        include 'download.php';
                    }
                }
                else {
                    include 'event.php';
                }
            ?>
            
        </div>
    </div>

    <script>
    const accordion = document.getElementsByClassName('label__');

    for(i=0; i<accordion.length; i++) {
        accordion[i].addEventListener('click', function(){
        this.classList.toggle('active');
        })
    }
    </script>
    <script>
        function byEmail(){
            document.getElementById("byEmail").classList.toggle("visible_");
        }
        function byGroup(){
            document.getElementById("byGroup").classList.toggle("visible_");
        }
    </script>
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
        })
    </script>
</body>
</html>