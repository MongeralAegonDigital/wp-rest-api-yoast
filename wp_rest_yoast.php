<?php
/**
 * Plugin Name: JSON REST API Yoast routes
 * Description: Adds Yoast fields to page and post metadata
 * Author: Alan Gomes<alanhr2@gmail.com>
 * Author URI: *
 * Version: 1.0.0
 * Plugin URI:https://github.com/MongeralAegonDigital/wp-rest-api-yoast.
 */
 define('WRPY', __DIR__);

 require_once WRPY.'/vendor/autoload.php';

 $controllers = [
   MAD\Controller\YoastMetaController::class,
   MAD\Controller\YoastSiteMapController::class,
 ];

 foreach ($controllers as $controller) {
     $rf = new \ReflectionClass($controller);
     $rf->newInstanceArgs();
 }
