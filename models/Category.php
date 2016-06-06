<?php

require_once 'DAO/Category.dao.php';

/**
/* Class Category
 */
class Category extends CategoryDAO
{
  public function findAllCategory() {
  	$sql="SELECT * FROM mysell_cat ORDER BY id2 ASC";
    return $this->getSelfObjects($sql);
  }
}


