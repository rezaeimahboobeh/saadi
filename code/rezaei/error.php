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
    $result=mysqli_query($coo,$sql);
    $count=0;

        while ( $mrow = mysqli_fetch_assoc ( $result ) )
        {
                  $student [$count] = $mrow;
                  $count ++;
        
        }
$id="";
        for($i=0;$i<$count;$i++){
            $id = $student[$i]['id'];
            $sql2="SELECT * FROM user JOIN inforoot on inforoot.userID=user.id WHERE user.id = '$id' order by inforoot.timeof desc limit 1";
            $result=mysqli_query($coo,$sql2);
            $mrow = mysqli_fetch_assoc ( $result ) ;

            if ($mrow != NULL) {
            if ($mrow['studentNumber'] == '') {
                    if ($mrow['liveCountryID'] > 0 && $mrow['liveCountryID'] < 10)
                        $countryID_sn = "00".$mrow['liveCountryID'];
                    elseif ($mrow['liveCountryID'] <100 && $mrow['liveCountryID'] >= 10)
                        $countryID_sn = "0".$mrow['liveCountryID']; 
                    elseif ($mrow['liveCountryID']>=100)
                        $countryID_sn =$mrow['liveCountryID'];   
                    $random_number=rand(100,990)+rand(1,9);
                    $studentNumber = '97'.strval($countryID_sn).$random_number.'01';
                 $checkDuplicate = mysqli_fetch_assoc (mysqli_query ($coo, "select studentNumber from user where studentNumber='$studentNumber'"));
                 print_r($checkDuplicate);
                 //while (true) {
                   /* if ($checkDuplicate == NULL) {
                    $sql3="UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'";
                    $update=mysqli_query ($coo, $sql3);
                    //break;
                      }
                    else{
                    $sql3="UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'";
                    $update=mysqli_query ($coo, $sql3);
                    //else print_r($checkDuplicate) ;
                    //  echo $studentNumber."<br>";
                  //  break;
                    }
                    //} 
                print_r($checkDuplicate) ;
                echo $studentNumber."<br>";*/
            }
                 
            /*while () {
                    if ($checkDuplicate == NULL) {
                    $sql3="UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'";
                    $update=mysqli_query ($coo, $sql3);
                    break;
                      }
                    else{
                    $sql3="UPDATE user SET studentNumber = '$studentNumber' WHERE id='$id'";
                    $update=mysqli_query ($coo, $sql3);
                    //else print_r($checkDuplicate) ;
                    //  echo $studentNumber."<br>";
                    break;
                    }
                    }   
                 echo $studentNumber."<br>";
                }*/
            
        }
        }
        
?>