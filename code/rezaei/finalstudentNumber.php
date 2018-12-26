<?php
//include 'includes/config.php';
//include_once 'includes/persian_date.class.php';
global $HOSTDB; // Host name
global $USERDB; // Mysql username
global $PASSDB; // Mysql password
global $NAMEDB;
$arr = NULL;
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
		$sql='SELECT * FROM user' ;
		$result1=mysqli_query($coo,$sql);
		$count=0;
		while ( $mrow = mysqli_fetch_assoc ( $result1 ) )
		{
			$student [$count] = $mrow;
			$count ++;
		}
		$id="";
		for($i=0; $i<$count; $i++){
			$id = $student[$i]['id'];
			$mrow1 = mysqli_fetch_assoc (mysqli_query($coo,"SELECT * FROM user
			JOIN inforoot on inforoot.userID=user.id
			WHERE user.id = '$id'
			order by inforoot.timeof desc limit 1"));
			if ($mrow1 !== NULL) {
			if ($mrow1['studentNumber'] == '') {
				if ($mrow1['liveCountryID'] > 0 && $mrow1['liveCountryID'] < 10) {
					$countryID_sn = "00".$mrow1['liveCountryID'];
				}
				elseif ($mrow1['liveCountryID'] <100 && $mrow1['liveCountryID'] >= 10) {
					$countryID_sn = "0".$mrow1['liveCountryID'];
				}
				elseif ($mrow1['liveCountryID']>=100) {
					$countryID_sn =$mrow1['liveCountryID'];
				}
		    $random_number=rand(100,990)+rand(1,9);
		    $studentNumber = '97'.$countryID_sn.$random_number.'01';
				//=== check duplicate ==
				while (true) {
					$is_duplicate = mysqli_fetch_assoc (mysqli_query ($coo,
					"select studentNumber from user where studentNumber='$studentNumber' AND NOT id='$id'"));
					if ($is_duplicate == NULL) {
						//This is not a duplicate value.
						mysqli_query ($coo, "UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'");
						echo "<p style='color: green'> ID is $id and studentNumber is $studentNumber and is not duplicate.</p>";
						break;
					}
					else {
						//This is a duplicate value.
						echo "<p style='color: blue'> ID is $id and studentNumber is $studentNumber and is duplicate.</p>";
						$random_number = rand(100,990)+rand(1,9);
						$studentNumber = '97'.$countryID_sn.$random_number.'01';
						echo "<p style='color: yellow'> ID is $id and New studentNumber is $studentNumber and is duplicate.</p>";
						mysqli_query ($coo, "UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'");
					}
				}
				//=== #END# check duplicate ==
			} else {
				//$mrow1['studentNumber'] != ''
				$studentNumber = $mrow1['studentNumber'];
				echo "<p style='color:green'>StudentNumber of $id is $studentNumber</p>";
			}
		} else {
			echo "<p style='color:red'>ATTENTION!! $id is not valid</p>";
		}
	}





?>
