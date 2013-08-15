<?php
	
	session_start();	
	$sessionId = $_SESSION['sessionId'];
	if($sessionId != "" && session_id() == $sessionId){		
		showPage();
	}else{	
		header('Location:  Login.php');
	}
	$dbErrorDisplay = 'none';
	$noQuestions = 'none';
	
	function showPage(){		
		if(isset($_POST['submitted'])){		
			//Connect to the database
			$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
			//Connection Problem
			if(!$db){
				$dbErrorDisplay = 'block';
				oci_close($db);
			}else{	//Connection established
				$query = "SELECT question_subject, question_description FROM  Question, QuestionFollow WHERE Folllowinguser = '".$_SESSION['username']."' 
				and questionToFollow = question_id and followed = true";				
				$statement = oci_parse($db,$query);
				$result = oci_execute($statement);
				if(!$result){
					$dbErrorDisplay = 'block';
					oci_free_statement($statement);
					oci_close($db);
				}
				else{
					$count = 0;
					while($row = oci_fetch_array($statement, OCI_BOTH)){
						$count++
					}			
					if($count == 0)
						$noQuestions = 'block';
					else{
						echo "<b>Your Questions!<b>";
						echo "<table border='1'>
						<tr>
						<th>Question Subject</th>
						<th>Question Description</th>
						</tr>";

						while($row = oci_fetch_array($statement, OCI_BOTH))
						  {
						  echo "<tr>";
						  echo "<td>" . $row[0] . "</td>";
						  echo "<td>" . $row[1] . "</td>";
						  echo "</tr>";
						  }
						echo "</table>";
					}	
				}
			}
		}	
	}	
?>

<body>
	<div style="border:2px solid #456789;width:80%;margin-left:auto;margin-right:auto;">
		
	<div id="dbconnectionerror" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;color:red;display:<?php echo $dbErrorDisplay ?>">
		<h4 style="text-align:center;">
			There is a problem with the system. Please try again later.
		</h4>
	</div>

	<div id="tagcreated" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $noQuestions ?>">
		<h4 style="text-align:center;">
			There are no Questions Followed by you !
		</h4>
	</div>
	
	
</body>