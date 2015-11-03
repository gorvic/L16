<?php

class Ad extends DatabaseObject {

//  const ORGANIZATION_FORM_INDIVIDIAL = 0;
//  const ORGANIZATION_FORM_ORGANIZATION = 1;

  protected static $table_name = "ads";
  protected static $db_fields = array('id',
	  'seller_name',
	  'phone',
	  'allow_mails',
	  'category_id',
	  'location_id',
	  'title',
	  'description',
	  'price',
	  'email',
	  'organization_form_id',
  ); //SHOW COLUMNS FROM sometable
  protected $seller_name;
  protected $phone;
  protected $allow_mails;
  protected $category_id;
  protected $location_id;
  protected $title;
  protected $description;
  protected $price;
  protected $email;
  protected $organization_form_id;

  public static function find_by_sql($sql = "") {

	global $database;

	$result_set = $database->select($sql);

	$object_array = array();
	foreach ($result_set as $row) {

	  if ((int) $row['organization_form_id'] == 0) {
		$object = new Individual($row); //add by id of record
	  } elseif ((int) $row['organization_form_id'] == 1) {
		$object = new Organization($row); //add by id of record
	  } else {
		$object = new Ad($row); //add by id of record
	  }


	  $object_array[$row['id']] = $object;
	}
	return $object_array;
  }

  public static function handlePostQuery(array $sanitized_post_array) {

	// The result of the request
	$ajax_result = array(
		'status' => '',
		'message' => '',
		'data' => '',
	);
	$is_edit_mode = isset($sanitized_post_array['id']);

	$ad = new Ad($sanitized_post_array);
	$result = $ad->save();

	$sanitized_title = htmlentities($ad->getTitle());
	
	if ($result) {
	  $ajax_result['status'] = 'success';
	  $ajax_result['message'] = 'Ad "' . $sanitized_title . '" has been ' . ($is_edit_mode ? '" updated' : '"added') . ' successfully .';
	  $ajax_result['data'] = ['id' => $ad->getId()];
	} else {
	  $ajax_result['status'] = 'error';
	  $ajax_result['message'] = 'Error while ad "' . $sanitized_title . ($is_edit_mode ? '" updating ' : '" adding') . '.';
	}
	
	return $ajax_result;
  }
  
  public static function handleGetQuery(array $sanitized_get_array) {

	// The result of the request
	$ajax_result = array(
		'status' => '',
		'message' => '',
		'data' => '',
	);
	
	$id = (int) $sanitized_get_array['id'];
	$mode = $sanitized_get_array['mode'];

	if ($mode == 'show') {


	  $ad_fields = Ad::find_by_id($id)->getFieldsForTemplate();
	  unset($ad_fields['db_fields']);
	  $ajax_result['status'] = 'success';
	  $ajax_result['data'] = $ad_fields;
	  
	} elseif ($mode == 'delete') {

	  $ad_title = Ad::find_by_id($id)->getTitle();
	  $sanitized_ad_title = htmlentities($ad_title);
	  Ad::delete($id);

	  $ajax_result['status'] = 'success';
	  if (Ad::count_all()) {
		$ajax_result['message'] = 'Ad "' . $sanitized_ad_title . '" has been deleted successfully';
	  } else {
		$ajax_result['message'] = 'There is no more ads in database';
	  }
	} else {
	  $ajax_result['status'] = 'error';
	  $ajax_result['message'] = 'Undefined mode';
	}
	return $ajax_result;
	
  }

  /**
   * Getters
   */
  public function getId() {
	return $this->id;
  }

  public function getSellerName() {
	return $this->seller_name;
  }

  public function getPhone() {
	return $this->phone;
  }

  public function getAllowMails() {
	return $this->allow_mails;
  }

  public function getCategoryId() {
	return $this->category_id;
  }

  public function getLocationId() {
	return $this->location_id;
  }

  public function getTitle() {
	return $this->title;
  }

  public function getDescription() {
	return $this->description;
  }

  public function getPrice() {
	return $this->price;
  }

  public function getEmail() {
	return $this->email;
  }

  public function getOrganizationFormId() {
	return $this->organization_form_id;
  }

  /**
   * Setters
   */
  public function setId($id) {
	$this->id = $id;
  }

  public function setSellerName($seller_name) {
	$this->seller_name = $seller_name;
  }

  public function setPhone($phone) {
	$this->phone = $phone;
  }

  public function setAllowMails($allow_mails) {
	$this->allow_mails = $allow_mails;
  }

  public function setCategoryId($category_id) {
	$this->category_id = $category_id;
  }

  public function setLocationId($location_id) {
	$this->location_id = $location_id;
  }

  public function setTitle($title) {
	$this->title = $title;
  }

  public function setDescription($description) {
	$this->description = $description;
  }

  public function setPrice($price) {
	$this->price = $price;
  }

  public function setEmail($email) {
	$this->email = $email;
  }

  public function setOrganizationFormId($organization_form_id) {
	$this->organization_form_id = $organization_form_id;
  }

  /**
   * Get properties from object
   * @return type
   */
  public function getFieldsForTemplate() {
	return get_object_vars($this);
  }

  public function __construct(array $values) {

	foreach ($values as $property_name => $property_value) {
	  $this->$property_name = $property_value;
	}
  }

}
