<?php
    // Nobody should be able to directly view content/ 
    // So redirect them to the homepage if they load index.php
    header("Location: ../index.php");
?>