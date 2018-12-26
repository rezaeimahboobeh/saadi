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
    $sql='SELECT * FROM `user`' ;
	$result1=mysqli_query($coo,$sql);
	$count=0;

		while ( $mrow = mysqli_fetch_assoc ( $result1 ) )
        {
                  $student [$count] = $mrow;
                  $count ++;
        
        }
$id="";
		for($i=0;$i<$count;$i++){
			$id = $student[$i]['id'];
			$sql2="SELECT * FROM user JOIN inforoot on inforoot.userID=user.id WHERE user.id = '$id' order by inforoot.timeof desc limit 1";
			$result=mysqli_query($coo,$sql2);
			$mrow1 = mysqli_fetch_assoc ( $result ) ;

			if ($mrow1 != NULL) {
			if ($mrow1['studentNumber'] == '') {
					if ($mrow1['liveCountryID'] > 0 && $mrow1['liveCountryID'] < 10)
						$countryID_sn = "00".$mrow1['liveCountryID'];
					elseif ($mrow1['liveCountryID'] <100 && $mrow1['liveCountryID'] >= 10)
						$countryID_sn = "0".$mrow1['liveCountryID'];	
					elseif ($mrow1['liveCountryID']>=100)
				    	$countryID_sn =$mrow1['liveCountryID'];   
				    $random_number=rand(100,990)+rand(1,9);
				    $studentNumber = '97'.strval($countryID_sn).$random_number.'01';
					$checkDuplicate = mysqli_fetch_assoc (mysqli_query ($coo, "select studentNumber from user where studentNumber='$studentNumber'"));
					
				 	if ($checkDuplicate==NULL) {
					
						$sql3="UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'";
						$update=mysqli_query ($coo, $sql3);
						echo "if";
					}
					else{
						$studentNumber = '97'.strval($countryID_sn).$random_number.'01';
						$sql3="UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'";
						$update=mysqli_query ($coo, $sql3);
						echo"else";
					}
					//$sql3="UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'";
					//$update=mysqli_query ($coo, $sql3);
					/*else{
					$sql3="UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'";
					$update=mysqli_query ($coo, $sql3);
					//else print_r($checkDuplicate) ;
				    //  echo $studentNumber."<br>";
				 
					}*/
					
				print_r($checkDuplicate) ;
				echo $studentNumber."<br>";
				//echo $dup;
			}
				 
			
			
		}
		}
		

?>