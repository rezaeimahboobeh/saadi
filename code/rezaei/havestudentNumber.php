<?php
function HaveStudentNumber($id,$coo)
{
	$mrow1 = mysqli_fetch_assoc (mysqli_query($coo,"SELECT * FROM user
			JOIN inforoot on inforoot.userID=user.id
			WHERE user.id = '$id'
			order by inforoot.timeof desc limit 1"));
			
			if ($mrow1['studentNumber'] == '') 
				echo "no student number";
			

}


?>