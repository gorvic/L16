<?php

class AdsStorage {

  private $ads = array();
  private static $instance;
  private $view;

  /**
   * Constructor
   */
  private function __construct($view) {
	$this->view = $view;
  }

  /**
   * Instatiating of singletone
   * 
   * @return type
   */
  public static function getInstance($view) {
	if (empty(self::$instance)) {
	  self::$instance = new AdsStorage($view);
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
  public function prepareFieldsOfAd() {
	
	$view = $this->view; 
	
	$view->assign('lesson_number', 16);
	$view->assign('organization_form', array('0' => 'Частное лицо', '1' => 'Организация'));
	$view->assign('cities', City::get_column_values('name'));
	$view->assign('labels', Category::find_all_categories());
	$view->assign('subcategories', Category::get_array_of_subcategories());
	$view->assign('ad_person', 'Ваше имя');
	
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
  private function prepareTableOfAds() {

	$view = $this->view;	
	
	$row = '';
	foreach ($this->ads as $ad) {
	  $view->assign('ad_in_table', $ad);
	  $row.=$view->fetch('table_row_'.strtolower(get_class($ad)).'.tpl.html');		

	}

	$view->assign('ads_rows', $row);
	return self::$instance;
  }

  public function display() {

	$view = $this->view;

	$this->prepareFieldsOfAd();
	$this->prepareTableOfAds();
	$view->display('lesson12.tpl');
  }

}
