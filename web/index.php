<?php
    include_once "../lib/helpers.php";
    include_once "../view/partials/header.php";

    echo "<body>";
        echo "<div class='container'>";
            include_once "../view/partials/navbar.php";

            //si llega algo por el metodo get
            if (isset($_GET['modulo'])) {
                resolve();
            }

        echo "</div>";
            include_once "../view/partials/footer.php";
    echo "<body>";
?> 