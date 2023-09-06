<?php 
//sitemap.php

$base_url = base_url();

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'industries/automotive' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'industries/capital-markets' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'why' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'industries/ecommerce' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'industries/healthcare' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'industries/travel' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'profiles' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'industries/banking' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'admin' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'industries' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'join' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'discover' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'hire' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'our-story' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'contact-us' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'about-us' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'remote-ios-jobs' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'careers' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'terms-and-conditions' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'verified' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'home/resources' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'privacy-policy' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'blog-post.html' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'corporate-information' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'discover/pingglesmsg' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'discover/glovo' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'discover/ourstory' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'careers/key-accounts-manager' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'careers/back-end-developer' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'careers/senior-it-recruiter' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'careers/front-end-developer' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'careers/hr-associate' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'terms-of-use' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'skills' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'index.php' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'home' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'profiles/' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'discover/contact-us' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '<url>' . PHP_EOL;
echo '<loc>' . $base_url . 'discover/hire' .'</loc>' . PHP_EOL;
echo '<priority>1.0</priority>' . PHP_EOL;
echo '</url>' . PHP_EOL;

echo '</urlset>' . PHP_EOL;

?>
