<?php
 require 'connect.php';
 $link = mysqli_connect(HOST, USER, PASS, DB) or die(mysqli_connect_error());
main($link);

function main($link){
	if (isset ($_POST['somecourse'], $_POST['somename'], $_POST['somenum'])) { 
//READ HTML INPUTS
  		$course = htmlentities($_POST['somecourse'],ENT_QUOTES,'UTF-8');
  		$student_name = htmlentities($_POST['somename'],ENT_QUOTES,'UTF-8');
  		$student_id = htmlentities($_POST['somenum'],ENT_QUOTES,'UTF-8');
      
  	}
  else{
    header("Location: redirect0.php"); 
    die();} //error1 (being extra safe)
      echo "im going in valid_student!\n";
  if(!valid_student($link, $student_name, $student_id)){
    return;
  }// use goto or exit/die maybe
    echo "im going in get_course!\n";
  $course_array = get_course($link, $course);

  if($course_array == NULL){
    return;
  } //just stop
 //RETURN ERROR1 IF INVALID INPUT
    echo "im going in enroll_student!\n";
  enroll_student($link, $student_id, $course, $studentcount); 
echo "I made it to the end!";
mysqli_close($link);
}


function valid_student($link, $name, $id){
    $namecheck = mysqli_query($link, "SELECT DISTINCT fullname FROM student WHERE BINARY fullname='$name' AND BINARY uid='$id'"); //checks specific fullname that has same binary values as user input and also checks that the same row matches with the user input uid
    $uidcheck = mysqli_query($link, "SELECT DISTINCT uid FROM student WHERE BINARY uid='$id' AND BINARY fullname='$name'"); // same as above but in reverse
    $row_uid = mysqli_fetch_assoc($uidcheck);
    $row_name = mysqli_fetch_assoc($namecheck);
      echo "im going in student check!!\n";
    if(equals_as_string($name, $row_name['fullname']) && equals_as_string($id, $row_uid['uid'])) {
      $is_valid = TRUE;
      echo "im in student check!!\n";
      //CHECKS NAME AND STUDENT #
}
    echo "I passed student check!!\n";
  // mysqli_close($link);
  if(!$is_valid){
    header("Location: redirect1.php"); 
    die();
  } //error2
  
  return($is_valid); //exit of function
  
}

function get_course($link, $course){
  $coursecheck = mysqli_query($link, "SELECT DISTINCT name FROM course WHERE BINARY name='$course'"); //checks specific course that has same binary values as user input
  $correct_course = NULL;
  $row_course = mysqli_fetch_assoc($coursecheck);
    if(equals_as_string(trim($course), $row_course['name'])) {	
      $correct_course = $course; 
      //CHECKS COURSE NAME
       //end the while loop
    }

    // mysqli_close($link);
  if($correct_course == NULL){
  	header("Location: redirect2.php"); // error3
    die();
  	
  }
  return $correct_course; //exit of function
    
 //check all the conditions related to course here.
}
//need to be able to read column row and give out the same row of a different column i.e. column name give out the relevant column code in course
function enroll_student($link, $id, $course, $max_number){ //need to check enrollment conditions here and then write to txt file
	$already_enrolled = FALSE;
	$current_number = 0;
   $nameto_code = mysqli_query($link, "SELECT DISTINCT code FROM course WHERE BINARY name='$course'"); //changing course name into course code
      $course = mysqli_fetch_assoc($nameto_code);
      $coursecode = $course['code']; 
	$enrolcheck1 = mysqli_query($link, "SELECT DISTINCT code FROM enrolment WHERE BINARY code='$coursecode'"); //comparing course code from enrolment to course code from user input
  $enrolled = mysqli_fetch_assoc($enrolcheck1);
  $enrolcode = $enrolled['code'];
  $enrolcheck2 = mysqli_query($link, "SELECT DISTINCT uid FROM enrolment WHERE BINARY uid='$id' AND code ='$coursecode'"); //checking if user input uid matches enrolment uid and code row
  $enrolled2 = mysqli_fetch_assoc($enrolcheck2);
  $enroluid = $enrolled2['uid'];
  $countcheck = mysqli_query($link, "SELECT DISTINCT count FROM course WHERE BINARY code='$coursecode'"); //
  $studentcount = mysqli_fetch_assoc($countcheck);
  $max_number = $studentcount['count'];
  echo " im going into already_enrolled! ";

    	if(equals_as_string($id, $enroluid) && equals_as_string($coursecode, $enrolcode)) {
    		$already_enrolled = TRUE; 
        //CHECKS STUDENT # AND COURSE ID
        echo "already_enrolled is true!";
    	}
        if(equals_as_string($coursecode, $enrolcode))	{
        	$current_number +=1; //$A = $A + 1
          echo "I am in current_number increase!";
        }
   echo "I am about to go in enrol student";
	if(!$already_enrolled && $current_number <= $max_number){ //CHECKS IF ALREADY ENROLLED AND IF THE CURRENT # IS LESSER THAN MAX NUMBER
    $new_num = $max_number - 1; //decreases the specific count column by 1
    $studentnum = mysqli_query($link, "UPDATE course SET count='$new_num' WHERE code='$coursecode'"); //updates count in db

    $update = mysqli_query($link, "INSERT INTO enrolment (code, uid, semester) VALUES ('$coursecode', '$id', '1209');"); // adds a new student into course enrolment

    if (!$already_enrolled) {
     header("Location: redirect4.php"); //success
     die;
   }
 }
  else{
		header("Location: redirect3.php"); 
    die(); // error 4
	}

  // mysqli_close($link); //closefile

	
}
//string input to data comparator
function equals_as_string($string, $array_string){
  if ($string == $array_string) {
    return(TRUE);
  }
}
 
?>