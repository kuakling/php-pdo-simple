<?php
return [
  'pageName' => 'index',
  'pageTitle' => 'Hello and Welcome',
  'cssFiles' => [],
  'cssScripts' => [],
  'jsFiles' => [],
  'jsScripts' => [],
  'db' => include(__DIR__ . '/db.php'),
  'flashMessages' => [],
  'layout' => __DIR__ . '/../layouts/ecommerce.php',
  'uploadDir' => realpath(__DIR__ . '/../../uploads'),
];
?>
