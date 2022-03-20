<?php
 require 'connect.php';
 $link = mysqli_connect(HOST, USER, PASS, DB) or die(mysqli_connect_error());
 // echo "Connected to server!<br/> Course #: <br/>";
//  $set = mysqli_query($link,'SELECT code FROM enrolment;');
// $dbs = array();
// while($db = mysqli_fetch_row($set))
//    $dbs[] = $db[0];
// echo implode('<br/>', $dbs);

// echo "<br/> Student #: <br/>";
//  $set1 = mysqli_query($link,'SELECT uid FROM enrolment;');
// $db1s = array();
// while($db1 = mysqli_fetch_row($set1))
//    $db1s[] = $db1[0];
// echo implode('<br/>', $db1s);
// echo "<br/> Student count: <br/>";
//  $set2 = mysqli_query($link,'SELECT count FROM course;');
// $db2s = array();
// while($db2 = mysqli_fetch_row($set2))
//    $db2s[] = $db2[0];
// echo implode('<br/>', $db2s);
 $result = mysqli_query($link, "SELECT * FROM course AND enrolment;");
 $count = mysqli_num_rows($result);
 echo "$count<br>\n";

 mysqli_close($link);
?>