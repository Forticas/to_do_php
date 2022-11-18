<?php

require_once 'partials/_start_session.php';


unset($_SESSION['user']['is_logged']);


header('Location: login.php');
exit;