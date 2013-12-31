<?php
$conn = mysql_connect('localhost', 'asg4_me', 'gadspherloc');
if($conn) {
  echo 'Finally connected!!!';
} else {
  die('Still cannot connect' . mysql_error());
}
?>