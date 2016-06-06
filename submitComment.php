<?php
/*** begin our session ***/
session_start();
include_once 'include/checkUser.php';
include_once 'models/Comment.php';

/*** first check that both the username, password and form token have been sent ***/
if(!isset( $_POST['comment']))
{
    $message = 'Please enter a comment';
}

else
{ 
    try
    {
        $Comment = new Comment();
        $Comment->username = $User->username;
        $Comment->postID = $_POST['postID'];
        $Comment->content = $_POST['comment'];
        $Comment->date = date('Y-m-d');
        $Comment->create();
        header('Location: userview.php?id='.$_POST['postID']);
            exit;

        
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}
?>

<html>
<head>
    <title>Comment add</title>
</head>
<body>
    <p><?php echo $message; ?>
    </body>
    </html>