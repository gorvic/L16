<?php

class Individual extends Ad {

  public function __construct(array $values) {
	parent::__construct($values);
	$this->organization_form_id = 0;
  }

}