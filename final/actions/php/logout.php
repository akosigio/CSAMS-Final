<?php
    if (!isset($_SESSION)){
        session_start();
        session_destroy();
        header("Location: ../../");
    }else{
        session_start();
        session_destroy();
        header("Location: ../../");
    }
?>