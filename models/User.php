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
  public function findByUsername($key)
  {
    $sql="SELECT * FROM mysell_users WHERE username = '".$key."'";
    return $this->getSelfObject($sql);
  }
  public function findByEmail($key)
  {
    $sql="SELECT * FROM mysell_users WHERE email = '".$key."'";
    return $this->getSelfObject($sql);
  }
}


