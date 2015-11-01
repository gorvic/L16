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
	  
	  if ( (int)$row['organization_form_id'] == 0 ) {
		$object = new Individual($row); //add by id of record
	  } elseif ( (int)$row['organization_form_id'] == 1 ) {
		$object = new Organization($row); //add by id of record
	  } else {
		$object = new Ad($row); //add by id of record
	  }
	  
	  
	  $object_array[$row['id']] = $object;
	}
	return $object_array;
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
