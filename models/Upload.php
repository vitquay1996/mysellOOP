<?php

require_once 'DAO/Upload.dao.php';

/**
/* Class Upload
 */
class Upload extends UploadDAO
{
  public function findByPostID($id)
  {
    $sql="SELECT * FROM mysell_upload WHERE postID='$id' LIMIT 1";
    //echo $sql;
    return $this->getSelfObject($sql);
  }
}


