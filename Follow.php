<?php
	session_start();
	$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
	//Connection Problem
	if(!$db){
		header('Location:  Home.php');
	}else{	
		echo "Connection Established!";
	}
	/* Common Variables */
	$userId = "";
	$followNum = "";
	$type = "";

	if(array_key_exists('user', $_GET)){
		$userId = $_GET["user"];
	}
	if(array_key_exists('follow', $_GET)){
		$followNum = $_GET["follow"];
	}	
	
	/* Tag Follow */
	$tagId = "";
	if(array_key_exists('tag', $_GET)){
		$tagId = $_GET["tag"];
		$type = "Tag Follow";
	}
	
	/* User Follow */
	$userToFollow = "";	
	if(array_key_exists('userToFollow', $_GET)){
		$userToFollow = $_GET["userToFollow"];
		$type = "User Follow";
	}	
	
	/* Question Follow */
	$questionId = "";
	if(array_key_exists('questionId', $_GET)){
		$questionId = $_GET["questionId"];
		$type = "Question Follow";
	}
	
	switch ($type) {
		case "Tag Follow":
			//Tag and user already there : $tagId and $userId
			$query = "SELECT
						TF.TAGTOFOLLOW,
						TF.FOLLOWINGUSER,
						TF.FOLLOWED
					FROM
						TAGFOLLOW TF
					WHERE
						TF.TAGTOFOLLOW = '".$tagId."' AND TF.FOLLOWINGUSER = '".$userId."'";
			$statement = oci_parse($db,$query);
			oci_execute($statement);
			$count = 0;
			while($row = oci_fetch_array($statement, OCI_BOTH+OCI_RETURN_NULLS)){				
				$count = $count + 1;
			}
			
			if($count > 0){
				//Already There				
				$query = "UPDATE TAGFOLLOW SET FOLLOWED = ".$followNum." WHERE TAGTOFOLLOW = '".$tagId."' AND FOLLOWINGUSER = '".$userId."'";
				$statement = oci_parse($db,$query);
				oci_execute($statement);
				oci_commit($db);

			} else {
				//New Entry				
				$query = "INSERT INTO TAGFOLLOW VALUES ('".$tagId."','".$userId."',".$followNum.",(SELECT SYSDATE FROM DUAL))";
				$statement = oci_parse($db,$query);
				oci_execute($statement);
				oci_commit($db);				

			}
			header("Location:  Tag.php?id=".$tagId);
			break;
		case "User Follow":
			//User to Follow and user already there : $userToFollow and $userId
			$query = "SELECT
						UF.USERTOFOLLOW,
						UF.FOLLOWINGUSER,
						UF.FOLLOWED
					FROM
						USERFOLLOW UF
					WHERE
						UF.USERTOFOLLOW = '".$userToFollow."' AND UF.FOLLOWINGUSER = '".$userId."'";
			$statement = oci_parse($db,$query);
			oci_execute($statement);
			$count = 0;
			while($row = oci_fetch_array($statement, OCI_BOTH+OCI_RETURN_NULLS)){				
				$count = $count + 1;
			}
			
			if($count > 0){
				//Already There				
				$query = "UPDATE USERFOLLOW SET FOLLOWED = ".$followNum." WHERE USERTOFOLLOW = '".$userToFollow."' AND FOLLOWINGUSER = '".$userId."'";
				$statement = oci_parse($db,$query);
				oci_execute($statement);
				oci_commit($db);

			} else {
				//New Entry				
				$query = "INSERT INTO USERFOLLOW VALUES ('".$userToFollow."','".$userId."',".$followNum.",(SELECT SYSDATE FROM DUAL))";
				$statement = oci_parse($db,$query);
				oci_execute($statement);
				oci_commit($db);				

			}
			header("Location:  User.php?id=".$userToFollow);			
			break;
		case "Question Follow":
			//Question and user already there : $questionId and $userId
			echo $questionId;
			$query = "SELECT
						QF.QUESTIONTOFOLLOW,
						QF.FOLLOWINGUSER,
						QF.FOLLOWED
					FROM
						QUESTIONFOLLOW QF
					WHERE
						QF.QUESTIONTOFOLLOW = '".$questionId."' AND QF.FOLLOWINGUSER = '".$userId."'";
			$statement = oci_parse($db,$query);
			oci_execute($statement);
			$count = 0;
			while($row = oci_fetch_array($statement, OCI_BOTH+OCI_RETURN_NULLS)){				
				$count = $count + 1;
			}
			
			if($count > 0){
				//Already There	
				echo "already!";
				$query = "UPDATE QUESTIONFOLLOW SET FOLLOWED = ".$followNum." WHERE QUESTIONTOFOLLOW = '".$questionId."' AND FOLLOWINGUSER = '".$userId."'";
				$statement = oci_parse($db,$query);
				oci_execute($statement);
				oci_commit($db);
				echo "updated";

			} else {
				//New Entry	
				echo "new entry!";
				$query = "INSERT INTO QUESTIONFOLLOW VALUES ('".$questionId."','".$userId."',".$followNum.",(SELECT SYSDATE FROM DUAL))";
				$statement = oci_parse($db,$query);
				oci_execute($statement);
				oci_commit($db);				
				echo "inserted";
			}
			header("Location:  Question.php?id=".$questionId);				
			break;
	}
?>