<?php
global $dbhost, $dbusername, $dbpassword, $dbname, $mysqli, $conn;

// SERVER
// $dbhost = 'localhost';
// $dbusername = 'teemorco_school2';
// $dbpassword = 'TestSch00l2';
// $dbname = 'teemorco_school2';

// SERVER
$dbhost = 'localhost';
$dbusername = 'teemorco_ihnschl';
$dbpassword = '1nh15nam3';
$dbname = 'teemorco_ihnschool';

// LOCALHOST
// $dbhost = 'localhost';
// $dbusername = 'school2';
// $dbpassword = '1nh15nam3';
// $dbname = 'school2';


$users_tablename = 'users';
$answers_tablename = 'answers';
$courses_tablename = 'courses';
$enrollments_tablename = 'enrollments';
$exams_tablename = 'exams';
$lessons_tablename = 'lessons';
$notes_tablename = 'notes';
$prayers_tablename = 'prayers';
$programs_tablename = 'programs';
$progenroll_tablename = 'progenroll';
$prog_det_tablename = 'prog_det';
$progenroll_tablename = 'progenroll';
$registration_tablename = 'registration';
$ticker_tablename = 'ticker';
$volunteers_tablename = 'volunteers';
$volunteerpos_tablename = 'volunteerpos';
$system_tablename = 'system';
$branches_tablename = 'branches';
$progcourses_tablename = 'progcourses';
$courselessons_tablename = 'courselessons';
$quizzes_tablename = 'quizzes';
$quizdet_tablename = 'quizdet';
$answerquiz_tablename = 'answerquiz';
$messages_tablename = 'messages';
$studentmsg_tablename = 'studentmsg';

//*****************************************************************************
//****************************** DB_CONNECT() *********************************
//*****************************************************************************
function dbconnect() {
    global $dbhost, $dbusername, $dbpassword, $dbname, $mysqli;
	
	$mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

	// Check connection
	if ($mysqli -> connect_errno) {
		echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
		exit();
	}
}

