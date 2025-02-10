<?php

require __DIR__ . '/inc/all.inc.php';

session_destroy();
header('Location: index.php');
die();
