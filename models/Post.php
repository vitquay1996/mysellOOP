<?php

require_once 'DAO/Post.dao.php';

/**
/* Class Post
 */
class Post extends PostDAO
{
  public function findEveryRecentPost()
  {
    $sql="SELECT * FROM mysell_posts ORDER BY id DESC";
    return $this->getSelfObjects($sql);
  }

  public function findByCat($catID)
  {
    $sql="SELECT mysell_posts.* FROM mysell_posts INNER JOIN mysell_cat ON mysell_posts.catID = mysell_cat.id WHERE id2 LIKE '%".$catID."%' ORDER BY id DESC";
    return $this->getSelfObjects($sql);
  }

  public function findByUsername($username)
  {
    $sql="SELECT * FROM mysell_posts WHERE username ='".$username."' ORDER BY id DESC";
    return $this->getSelfObjects($sql);
  }


  public function search($key)
  {
    $sql="SELECT * FROM mysell_posts WHERE MATCH(`title`) AGAINST('%".$key."%' IN BOOLEAN MODE)";
    return $this->getSelfObjects($sql);
  }

  public function searchPriceDown($key)
  {
    $sql="SELECT * FROM mysell_posts WHERE MATCH(`title`) AGAINST('%".$key."%' IN BOOLEAN MODE) ORDER BY price DESC";
    return $this->getSelfObjects($sql); 
  }

  public function searchPriceUp($key)
  {
    $sql="SELECT * FROM mysell_posts WHERE MATCH(`title`) AGAINST('%".$key."%' IN BOOLEAN MODE) ORDER BY price ASC";
    return $this->getSelfObjects($sql); 
  }

  public function postWithCategory()
  {
    $sql="SELECT mysell_posts.*, mysell_cat.`name` AS catID FROM mysell_posts INNER JOIN mysell_cat ON mysell_posts.`catID` = mysell_cat.`id`";
    return $this->getSelfObjects($sql); 
  }

  public function findByCatName($key)
  {
    $sql="SELECT mysell_posts.* FROM mysell_posts INNER JOIN mysell_cat ON mysell_posts.`catID`=mysell_cat.`id` WHERE mysell_cat.`name`='".$key."' ORDER BY `id` DESC";
    return $this->getSelfObjects($sql); 
  }

  public function findPrice($order)
  {
    if ($order == 'increase') {
      $sql="SELECT mysell_posts.* FROM mysell_posts ORDER BY price ASC";
    }
    else {
      $sql="SELECT mysell_posts.* FROM mysell_posts ORDER BY price DESC";
    }
    return $this->getSelfObjects($sql); 
  }


  public function findByCatPrice($cat, $order)
  {
    if ($order == 'increase') {
      $sql="SELECT mysell_posts.* FROM mysell_posts INNER JOIN mysell_cat ON mysell_posts.`catID`=mysell_cat.`id` WHERE id2 LIKE '%".$cat."%' ORDER BY price ASC";
    }
    else {
      $sql="SELECT mysell_posts.* FROM mysell_posts INNER JOIN mysell_cat ON mysell_posts.`catID`=mysell_cat.`id` WHERE id2 LIKE '%".$cat."%' ORDER BY price DESC";
    }
    return $this->getSelfObjects($sql);
  }

}



