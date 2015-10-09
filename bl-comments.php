<?php

/**
 * Plugin Name: Brand Lovers Plugin
 * Plugin URI: http://brandlovers.com/
 * Description: Display comments of Brandlovers platform in your site
 * Version: 1.0
 * Author: Brandloves
 * Author URI: http://brandlovers.com/
 */

require_once('BLComments.php');
require_once('BLCommentsAdmin.php');

$blCommentsAdmin = new BLCommentsAdmin();
$blComments = new BLComments();
