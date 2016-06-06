<?php

require_once 'DAO/Comment.dao.php';

/**
/* Class Comment
 */
class Comment extends CommentDAO
{
    public function findByPostID($id)
  {
    $sql="SELECT * FROM mysell_comments WHERE postID='$id' ORDER BY id DESC";
    return $this->getSelfObjects($sql);
  }
}


