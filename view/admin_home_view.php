<?php
require('../controller/admin_controller.php');
$admin = new admin_controller;

$admin->displayUser('system_admin');
$admin->displayUser('customer');
?>