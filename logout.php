<?php 
    session_start();
    setcookie(session_name() , '' , [
        'expires'=>-1
    ]);
    session_destroy();
?>