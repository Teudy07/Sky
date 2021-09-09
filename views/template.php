<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400'); 

        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');
            }
    
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        }
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<?php include "partials/header.php" ?>

    <body class="has-detached-right  pace-done">
        <div class="pace  pace-inactive">
            <div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%"
                data-progress="99">
                <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity">
            </div>
        </div>

        <!-- Page content -->
        <!-- Main content para los Boxes-->
            <!-- Content area -->
            <?php
                if(isset($_GET['route'])) {
                    
                    if(file_exists(dirname(__FILE__) . "/pages/" . $_GET['route'] . '.php')) {
                        include "partials/navbar.php";
                        echo "<div class='page-container' style='min-height:876.3000030517578px'>";
        
                        echo "<div class='page-content'>";

                        include "partials/sidebar.php";
                        echo "<div class='content-wrapper'>";
                        echo "<div class='content'>";

                        include "pages/".$_GET['route'].".php";

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        include "pages/404.php";
                    }
                } else {
                    include "partials/navbar.php";
                        echo "<div class='page-container' style='min-height:876.3000030517578px'>";
        
                        echo "<div class='page-content'>";

                        include "partials/sidebar.php";
                        echo "<div class='content-wrapper'>";
                        echo "<div class='content'>";

                        include "pages/home.php";

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                }
            ?>
                
    </body>
</html>