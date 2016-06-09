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

  public function findByParent($par) {
  	$sql="SELECT * FROM mysell_cat WHERE id2 LIKE '".$par.".___' ORDER BY id2 ASC";
    return $this->getSelfObjects($sql);
  }

  public function findByPost($postID) {
  	$sql="SELECT * FROM mysell_cat INNER JOIN mysell_posts ON mysell_posts.catID = mysell_cat.id WHERE mysell_posts.id=".$postID;
    return $this->getSelfObject($sql);
  }
  public function findById2($key) {
  	$sql="SELECT * FROM mysell_cat WHERE id2=".$key;
    return $this->getSelfObject($sql);
  }
}


