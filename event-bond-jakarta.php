<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="format-detection" content="telephone=no" />

    <title>Bond</title>

    <link rel="stylesheet" href="js/plugins/revslider/public/assets/css/rs6.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/combined.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/custom-css.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/responsive-css.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/png" href="./images/favicon 2.svg"/>

</head>

<body data-rsssl="1" class="home page-template-default page page-id-3078 woocommerce-no-js" data-shop="three_cols">
    <input type="hidden" id="pp_enable_reflection" name="pp_enable_reflection" value="true" />
    <input type="hidden" id="pp_enable_right_click" name="pp_enable_right_click" value="" />
    <input type="hidden" id="pp_enable_dragging" name="pp_enable_dragging" value="" />
    <input type="hidden" id="pp_image_path" name="pp_image_path" value="images/" />
    <input type="hidden" id="pp_homepage_url" name="pp_homepage_url" value="index.html" />
    <input type="hidden" id="pp_ajax_search" name="pp_ajax_search" value="true" />
    <input type="hidden" id="pp_fixed_menu" name="pp_fixed_menu" value="true" />

    <input type="hidden" id="pp_footer_style" name="pp_footer_style" value="3" />

    <!-- Begin mobile menu -->
    <div class="mobile_menu_wrapper">
        <a id="close_mobile_menu" href="#"><i class="fa fa-times-circle"></i></a>
        <div class="menu-main-menu-container">
            <ul id="mobile_main_menu" class="mobile_main_nav">
                <li class="menu-item current-menu-item current_page_item menu-item-home menu-item-has-children">
                    <a href="index.html" aria-current="page">Home</a>
                </li>
                <li class="menu-item menu-item-has-children">
                    <a href="menu-bond-jakarta.html">Menu</a>
                </li>
                <li class="menu-item"><a href="gallery-bond-jakarta.html">Gallery</a></li>
                <li class="menu-item">
                    <a href="event-bond-jakarta.php">Event</a>
                </li>
                <li class="menu-item"><a href="contact-us.html">Contact Us</a></li>

            </ul>
        </div>
    </div>
    <!-- End mobile menu -->

    <!-- Begin template wrapper -->
    <div id="wrapper">
        <div class="header_style_wrapper">
            <div class="top_bar hasbg_">
                <div id="mobile_nav_icon"></div>

                <div id="menu_wrapper">
                    <!-- Begin logo -->

                    <a id="custom_logo" class="logo_wrapper hidden" href="index.html">
                        <img src="images/LOGO.svg" alt="" style="width: 160px; height: 40px;" />
                    </a>

                    <a id="custom_logo_transparent" class="logo_wrapper default" href="index.html">
                        <img src="images/LOGO.svg" alt="" style="width: 160px; height: 40px;" />
                    </a>
                    <!-- End logo -->


                    <!-- Begin main nav -->
                    <div id="nav_wrapper">
                        <div class="nav_wrapper_inner">
                            <div id="menu_border_wrapper">
                                <div class="menu-main-menu-container">
                                    <ul id="main_menu" class="nav">
                                        <li class="menu-item menu-item-home menu-item-has-children">
                                            <a href="index.html" aria-current="page">Home</a>
                                        </li>
                                        <li class="menu-item menu-item-has-children">
                                            <a href="menu-bond-jakarta.html">Menu</a>
                                        </li>
                                        <li class="menu-item"><a href="gallery-bond-jakarta.html">Gallery</a></li>
                                        <li class="menu-item"><a href="event-bond-jakarta.php">Event</a></li>
                                        <li class="menu-item"><a href="contact-us.html">Contact Us</a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- End main nav -->
                </div>
            </div>
        </div>
    </div>


    <br class="clear" />

    <div id="page_caption" class="hasbg parallax" data-image="upload/parallax-event.png" data-width="1732" data-height="1155">
        <div class="page_title_wrapper">
            <h1>Events</h1>
        </div>
        <div class="parallax_overlay_header"></div>
    </div>



    <!-- Begin content -->
    <div id="page_content_wrapper" class="hasbg">
        <!-- Begin content -->

        <div class="inner">
            <div class="inner_wrapper">
                <div id="page_main_content" class="sidebar_content full_width nopadding">
                    <?php 
                        if(isset($_GET['halaman'])) {
                            if($_GET['halaman'] == "single-event"){
                                include 'single-event.php';
                            }
                        } else {
                            include 'events.php';
                        }
                    ?>
                    
                </div>
            </div>
        </div>
        <br class="clear" />
    </div>




    <br />

    <a href="https://api.whatsapp.com/send?phone=6288989007007&text=Thank%20you%20for%20choosing%20to%20reserve%20table%20at%20our%20restaurant.%20Choose%20your%20date%20and%20time%20and%20enter%20your%20information%20below.%0A%0ARoom%3A%20VIP%2FPrivate%0APerson%3A%20%0ADate%3A%20%0ATime%3A%20%0AName%3A%20%0APhone%3A%20%0ASpecial%20Request%3A%20%0A%0AThank%20you%2C%20we%20will%20contact%20you%20ASAP%20for%20room%20availability." class="framewa__" target="_blank">
            <i class="fa fa-whatsapp"></i>
            <p>Reservation via Whatsapp</p>
    </a>

    <div class="footer_bar">
        <div id="footer" class="">
            <ul class="sidebar_widget three">
                <li id="text-7" class="widget widget_text">
                </li>
                <li id="text-8" class="widget widget_text">
                    <h2 class="widgettitle">Address</h2>
                    <div class="textwidget">
                        <p><i class="fa fa-map-marker marginright"></i>Jl. Suryo No.28, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12180</p>
                    </div>
                </li>
                <li id="text-9" class="widget widget_text">
                    <h2 class="widgettitle">Open Hours</h2>
                    <div class="textwidget">
                        <p>
                            <i class="fa fa-clock-o marginright"></i>Monday – Sunday<br />
                            10 AM – 1 AM<br />
                            <a class="tel__" href="tel:+6288989007007">
                                <i class="fa fa-phone marginright"></i>+62 889-8900-7007
                            </a>
                        </p>
                    </div>
                </li>
                <li id="text-10" class="widget widget_text">
                    <h2 class="widgettitle">Find Us On</h2>
                    <div class="textwidget">
                        <div class="social_wrapper shortcode light">
                            <ul>
                                <li class="facebook">
                                    <a target="_blank" title="Facebook" href="#" rel="noopener noreferrer"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li class="instagram">
                                    <a target="_blank" title="Instagram" href="https://instagram.com/bond.jkt?utm_medium=copy_link" rel="noopener noreferrer"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li class="twitter">
                                    <a target="_blank" title="Twitter" href="#" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>

            <br class="clear" />
        </div>

    </div>

    <div id="ajax_loading"><i class="fa fa-spinner fa-spin"></i></div>


    <script type="text/javascript" src="js/jquery.js" ></script>
    <script type="text/javascript" src="js/plugins/fancybox/jquery.fancybox.js" id="fancybox-js"></script>
    <script type="text/javascript" src="js/plugins/parallax.min.js" id="parallax-js"></script>
    <script type="text/javascript" src="js/plugins/combined.js" id="combined_js-js"></script>
</body>
</html>

