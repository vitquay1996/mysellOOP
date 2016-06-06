<?php

require_once 'DAO/User.dao.php';

/**
/* Class User
 */
class User extends UserDAO
{
  public function findEveryUser()
  {
    $sql="SELECT * FROM mysell_users ORDER BY id DESC";
    return $this->getSelfObjects($sql);
  }
}


