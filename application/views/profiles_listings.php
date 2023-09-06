<?php 
//sitemap.php

$base_url = base_url();

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

$base_url = base_url();

for($i=0; $i<count($result); $i++)
{
     echo '<url>' . PHP_EOL;
     echo '<loc>' . $base_url .'profile' . '/' . strtolower($result[$i]["profile_url"]) . '/' . strtolower($result[$i]["unique_id"])  .'</loc>' . PHP_EOL;
     echo '<priority>1.0</priority>' . PHP_EOL;
     echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>
