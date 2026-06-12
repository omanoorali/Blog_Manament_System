<?php

require_once "../models/auth.php";

$auth = new auth();

$logout = $auth->logout();

header("Location:../index.php");






?>