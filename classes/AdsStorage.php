<?php

class AdsStorage {

  private $ads = array();
  private static $instance;

  /**
   * Constructor
   */
  private function __construct() {}

  /**
   * Instatiating of singletone
   * 
   * @return type
   */
  public static function getInstance() {
	if (empty(self::$instance)) {
	  self::$instance = new AdsStorage();
	}
	return self::$instance;
  }

  /**
   * Add ad to storage
   * @param Ad $ad
   */
  public function addAd(Ad $ad) {
	
	$this->ads[$ad->getId()] = $ad;
  }
  
  /**
   * Remove ad from storage
   * 
   * @param type $id
   */
  public function removeAd($id) {
	unset($this->ads[$id]);
  }

  /**
   * Get all records of ad from database
   * 
   * @global type $database
   * @return type
   */
  public function fillStorage() {
	global $database;
	
	$this->ads = Ad::find_all();
	
	return self::$instance;
  }
  
  /**
   * Get ad by id from storage
   * @param type $id
   * @return type
   */
  public function getAd($id) {
	
	if (array_key_exists($id, $this->ads)) {
	  return $this->ads[$id] ;
	}
	return null;
	
  }
  
  /**
   * 
   * @global type $smarty
   * @param type $edit_id
   */
  public function prepareFieldsOfAd($edit_id = '') {
	global $smarty;
	
	$smarty->assign('lesson_number', 16);
	$smarty->assign('organization_form', array('0' => 'Частное лицо', '1' => 'Организация'));
	$smarty->assign('cities', City::get_column_values('name'));
	$smarty->assign('labels', Category::find_all_categories());
	$smarty->assign('subcategories', Category::get_array_of_subcategories());
	$smarty->assign('ad_person', 'Ваше имя');
	
//	if ($edit_id) {
//
//	  $ad = $this->getAd($edit_id);
//	  if (empty($ad)) {
//	    die('Неверный id объявления');
//	  }
//	  
//	  $smarty->assign('button_name', 'edit');
//	  $smarty->assign('button_value', 'Записать изменения');
//	  $smarty->assign('default_edit_id', $edit_id);
//	  
//	  $smarty->assign('is_allow_mail', $ad->getAllowMails() == 1 ? 'checked' : '');
//	  $smarty->assign('ad_person', $ad->getOrganizationFormId() == 0 ? 'Ваше имя' : 'Название организации');
//	  
//	  $arr_fields = $ad->getFieldsForTemplate();
//	  foreach ($arr_fields as $field => $value) {
//		$smarty->assign($field, $value);
//	  }
//	  
//	} else {
//
//	  $smarty->assign('button_name', 'submit');
//	  $smarty->assign('button_value', 'Добавить');
//	  $smarty->assign('default_edit_id', '');
//	  
//	}
  }
  
  public static function sanitizeHTTPQueriesData(array $form_array) {

	$tmp_form_array = $form_array;
	
	//escape POST array; can be more complex
	foreach ($tmp_form_array as $key => $value) {
	  $tmp_form_array[$key] = strip_tags($value);
	}
	
	

	return $tmp_form_array;
  }

  /**
   * Prepare table of ads
   * 
   * @global type $smarty
   * @return type AdsStorage
   */
  public function prepareTableOfAds() {
	global $smarty;

	$row = '';
	foreach ($this->ads as $ad) {
	  $smarty->assign('ad_in_table', $ad);
	  $row.=$smarty->fetch('table_row_'.strtolower(get_class($ad)).'.tpl.html');		

	}

	$smarty->assign('ads_rows', $row);
	return self::$instance;
  }

  public function display() {
	global $smarty;

	$smarty->display('lesson12.tpl');
//	$output = $smarty->fetch('lesson12.tpl');
//	echo $output;
  }

}
