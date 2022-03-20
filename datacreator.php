<?php
 require 'connect.php';
 $link = mysqli_connect(HOST, USER, PASS, DB) or die(mysqli_connect_error());
 echo "Connected to server!\n";
 $clean = "DROP TABLE enrolment;";
 $cleaner = mysqli_query($link, $clean) or die(mysqli_connect_error());
 $clean1 = "DROP TABLE course;";
 $cleaner1 = mysqli_query($link, $clean1) or die(mysqli_connect_error());
 echo "Tables deleted!";
// $query = "CREATE TABLE student (uid CHAR(6), fullname VARCHAR(40), INDEX(fullname(40)), PRIMARY KEY(uid));";
// $result = mysqli_query($link, $query) or die(mysqli_connect_error());
$query1 = "CREATE TABLE course (code CHAR(9), name VARCHAR(50), count CHAR(2), INDEX(name(50)), INDEX(count), PRIMARY KEY(code));";
$result1 = mysqli_query($link, $query1) or die(mysqli_connect_error());
$query2 = "CREATE TABLE enrolment (code CHAR(9), uid CHAR(6), semester CHAR(4), INDEX(code), INDEX(uid), INDEX(semester));";
 $result2 = mysqli_query($link, $query2) or die(mysqli_connect_error());
  echo "Tables created successfully\n";
// $query3 = "INSERT INTO student(uid,fullname) VALUES ('123456','test');";
//  $result3 = mysqli_query($link, $query3) or die(mysqli_connect_error());
// $query4 = "INSERT INTO student(uid,fullname) VALUES ('234567','test');";
// $result4 = mysqli_query($link, $query4) or die(mysqli_connect_error());
// $query5 = "INSERT INTO student(uid,fullname) VALUES ('655432','Michelle Browne');";
// $result5 = mysqli_query($link, $query5) or die(mysqli_connect_error());
$query6 = "INSERT INTO course(code,name,count) VALUES ('CN-CEA927','Dynamic AMP','4');";
$result6 = mysqli_query($link, $query6) or die(mysqli_connect_error());
$query7 = "INSERT INTO course(code,name,count) VALUES ('CN-ENG101','English','1');";
$result7 = mysqli_query($link, $query7) or die(mysqli_connect_error());
$query8 = "INSERT INTO course(code,name,count) VALUES ('CN-JAV101','Javascript','10');";
$result8 = mysqli_query($link, $query8) or die(mysqli_connect_error());
$query9 = "INSERT INTO course(code,name,count) VALUES ('CN-PHY101','Physics','3');";
$result9 = mysqli_query($link, $query9) or die(mysqli_connect_error());
$query10 = "INSERT INTO enrolment VALUES ('CN-CEA927','123456','1209');";
$result10 = mysqli_query($link, $query10) or die(mysqli_connect_error());
$query11 = "INSERT INTO enrolment VALUES ('CN-CEA927','234567','1209');";
$result11 = mysqli_query($link, $query11) or die(mysqli_connect_error());
$query12 = "INSERT INTO enrolment VALUES ('CN-ENG101','234567','1209');";
$result12 = mysqli_query($link, $query12) or die(mysqli_connect_error());
 echo "Rows created successfully";

 mysqli_close($link);
?>

