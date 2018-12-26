<?php
global $HOSTDB; // Host name
global $USERDB; // Mysql username
global $PASSDB; // Mysql password
global $NAMEDB;
$arr = NULL;
include 'createstudentNumber.php';
include 'havestudentNumber.php';
$coo = mysqli_connect ( "localhost", "root", "", "slfc");
if (! $coo)
{
	die ( 'Could not connect: ' . mysqli_error ( $coo ) );
}
else
{
    if (! mysqli_connect_error ())
    {
    	$coo->set_charset ( "utf8" );
        $result = mysqli_query ( $coo, "SET CHARACTER SET 'utf8';" );
        $result = mysqli_query ( $coo, "SET SESSION collation_connection = 'utf8_persian_ci';" );}
    }

	CreatStudentNumber(16,$coo);
?>