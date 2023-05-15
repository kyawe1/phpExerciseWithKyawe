<?php 
        session_start();
        $_SESSION['is_start']=true;
        $page=$_GET['page'];
        header("Location: /".$page);
    ?>