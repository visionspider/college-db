<?php
 require 'connect.php'; //host / user / pass / db credentials
 $link = mysqli_connect(HOST, USER, PASS, DB) or die(mysqli_connect_error()); // connect to mysql with host user pass and select this db
 $result = mysqli_query($link, "SELECT name FROM course"); // run a query so select column name from table course

// Generate the form

 echo "<form method=\"post\" action=\"main.php\">\n"; 
 echo "<label for=\"courses\"> Select your Course:</label> <select id=\"courses\" name=\"somecourse\" title=\"Please select a course\" required autofocus>\n";

 while ($record = mysqli_fetch_assoc($result)) { // while record is going line by line
    $coursename = $record['name']; 
    $field = htmlentities (trim ($coursename)); // sanitize output
    echo "   <option value=\"$field\">$field</option>\n"; // echo array
 }
 mysqli_close($link); // close database
 echo " </select>\n"; //
 // echo "<input type=\"text\" name=\"somecourse\" value=\"\" placeholder=\"non-existent course test\">"; 
 //for non-existent course testing
 echo "<label for=\"sname\">Student name:</label>";
 echo " <input type=\"text\" id=\"sname\" name=\"somename\" value=\"\" placeholder=\"Alice Mcguee\" title=\"First name SPACE Last name\" required>\n\n";
 echo "<label for=\"snumber\">Student number:</label>";
 echo " <input type=\"text\" id=\"snumber\" name=\"somenum\" value=\"\" maxlength=\"6\" size=\"6\" placeholder=\"123456\" patern=\"[0-9]{6}\" title=\"6 digit student number\" required>\n\n" ;
 echo " <input type=\"submit\">\n";
 echo "</form>\n";
 echo "<p>Already enrolled or limit reached.</p>";
?>

