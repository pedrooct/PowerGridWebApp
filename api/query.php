<?php

function connectToMysql()
{
  $conn = mysqli_connect("localhost","root","root","powergrid");
  if(!$conn)
  {
    return false;
  }
  return $conn;
}
function closeConnectionMysql()
{
  mysqli_close($conn);
}
function verifyUser($email,$password)
{
  if(!$conn=connectToMysql())
  {
    return false;
  }
  $res = mysqli_query($conn,"SELECT email,password FROM utilizador where email="."'".$email."'");
  if(!$res)
  {
    return false;
  }
  if(password_verify($password,$res['password']))
  {
    return true;
  }
  return false;
}









?>
