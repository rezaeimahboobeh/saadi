<?php

function CreatStudentNumber($id,$coo){

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
						return 1;
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
		
	}

		return 0;
}




?>