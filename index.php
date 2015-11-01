<?php
header('Content-Type: text/html; charset=utf-8');
require_once ('./includes/initialize.php');

function __autoload($class_name) {

  if ($class_name != 'DbSimple_Mysqli' && $class_name != 'Smarty') {
	require_once CLASS_PATH . '/class.' . $class_name . '.php';
  }
}

////for AJAX queries
//$is_partial = empty($_POST['partial']) ? false : true;
//
//// A preset set of messages
//$messages = array(
//	'required' => 'The field %s is required',
//	'invalid' => 'The field %s is invalid',
//	'errors' => 'Please fix the errors in the form to continue',
//	'generic' => 'An error has occurred and your message has not been delivered. Try later %s',
//	'short' => 'The value of the field %s is too short. It must have at least %d characters',
//	'success' => 'Thank you for your message %s. It has been successfully sent'
//);

// The result of the request
$ajax_result = array(
	'status' => '',
	'message' => '',
	'data' => '',
//	'info' => array()
);


//AJAX. With ajax queries there is no display with smarty
if (request_is_post()) {

  $is_edit_mode = isset($_POST['id']);
  
//submitting unchecked checkboxes
  if (!isset($_POST['allow_mails'])) {
	$_POST['allow_mails'] = "";
  } else {
	$_POST['allow_mails'] = 1;
  }
  
  $ad = new Ad(AdsStorage::sanitizeFormData($_POST));
  $result = $ad->save();
  
  if ($result) {
	$ajax_result['status'] = 'success';
	$ajax_result['message'] = 'Ad "'.$ad->getTitle().'" has been '.($is_edit_mode ? '" updated' : '"added').' successfully .';
	$ajax_result['data'] = ['id' => $ad->getId()];
  } else {
	$ajax_result['status'] = 'error';
	$ajax_result['message'] = 'Error while ad "'.$ad->getTitle() .($is_edit_mode ? '" updating ' : '" adding').'.';
  } 
  
  echo json_encode($ajax_result, JSON_NUMERIC_CHECK);
  
} elseif (isset($_GET['id']) && isset($_GET['mode'])) {


  $id = (int) $_GET['id'];
  $mode = strip_tags($_GET['mode']);

  if ($mode == 'show') {


	$ad_fields = Ad::find_by_id($id)->getFieldsForTemplate();
	unset($ad_fields['db_fields']);
	$ajax_result['data'] = $ad_fields;
	

  } elseif ($mode == 'delete') {

	$ad_title = Ad::find_by_id($id)->getTitle();
	Ad::delete($id);

	$ajax_result['status'] = 'success';
	if (Ad::count_all()) {
	  $ajax_result['message'] = 'Ad "' . $ad_title . '" has been deleted successfully';
	} else {
	  $ajax_result['message'] = 'There is no more ads in database';
	}
	
  } else {
	$ajax_result['status'] = 'error';
	$ajax_result['message'] = 'Undefined mode';
	
  }
  echo json_encode($ajax_result, JSON_NUMERIC_CHECK);
  
} else {

//could be chained methods -> -> ->
  $storage = AdsStorage::getInstance();
  $storage->fillStorage();
  $storage->prepareFieldsOfAd();
  $storage->prepareTableOfAds();
  $storage->display();
}