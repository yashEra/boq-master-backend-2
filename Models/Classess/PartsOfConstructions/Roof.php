<?php

class Roof{

    if($_POST["Roof Type"]=="Slab Roof"){
        header('Location:slab.php');
    }elseif($_POST["Roof Type"]=="Sheet Roof"){
        header('Location:');
    }
}
?>
