<?php
header('Content-Type: text/html; charset=utf-8');
require_once ('./includes/initialize.php');

function __autoload($class_name) {

  if ($class_name != 'DbSimple_Mysqli' && $class_name != 'Smarty') {
	require_once CLASS_PATH . '/' . $class_name . '.php';
  }
}





//AJAX. With ajax queries there is no display with smarty

//controller role - isPost isGet
if (request_is_post()) {
  
 //submitting unchecked checkboxes
  if (!isset($_POST['allow_mails'])) {
	$_POST['allow_mails'] = "";
  } else {
	$_POST['allow_mails'] = 1;
  }

  $ajax_result = Ad::handlePostQuery(AdsStorage::sanitizeHTTPQueriesData($_POST));
  echo json_encode($ajax_result, JSON_NUMERIC_CHECK);
  
} elseif (isset($_GET['id']) && isset($_GET['mode'])) {

  $ajax_result = Ad::handleGetQuery(AdsStorage::sanitizeHTTPQueriesData($_GET));
  echo json_encode($ajax_result, JSON_NUMERIC_CHECK);

  
} else {

  /*@var $storage AdsStorage*/
  
  $storage = AdsStorage::getInstance($smarty);
  $storage->fillStorage()->display();
}