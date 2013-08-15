<body>
<?php
	$count = 0;
	$dbErrorDisplay = 'none';
	$noQuestions = 'none';
	$str = '';
	session_start();	
	$sessionId = $_SESSION['sessionId'];
	if($sessionId != "" && session_id() == $sessionId){		
		showPage();
	}else{	
		header('Location:  Login.php');
	}
	
	
	function showPage(){
	global $count,$dbErrorDisplay ,$noQuestions,$str ;

		
		if(true){	
		
			//Connect to the database
			$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
			//Connection Problem
			if(!$db){
			
				$dbErrorDisplay = 'block';
				oci_close($db);
			}else{	//Connection established
			
				$query = "SELECT tagname FROM Tag WHERE createdby = '".$_SESSION['userName']."'";				
				$statement = oci_parse($db,$query);
				$result = oci_execute($statement);				
				if(!$result){
				
					$dbErrorDisplay = 'block';
					oci_free_statement($statement);
					oci_close($db);
				}
				else{
					while($row = oci_fetch_array($statement, OCI_BOTH)){
						$count = $count + 1;						
					}
					
					if($count == 0){
						global $noQuestions;
						$noQuestions = 'block';
						}
					else{
						$str = $str."<b>Your Tags :<b>";
						$str = $str."<table border='1' style = 'border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;'>";
						oci_execute($statement);
						while($row = oci_fetch_array($statement, OCI_BOTH))
						  {										  
						  $str = $str."<tr>";
						  $str = $str."<td>" . $row[0] . "</td>";
						  $str = $str."</tr>";
						  
						  
						  }
						$str = $str."</table>";
						
					}	
				}
			}
		}	
	}	
?>



	<div style="border:2px solid #456789;width:80%;margin-left:auto;margin-right:auto;">
     <?php echo $str; ?>		
	<div id="dbconnectionerror" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;color:red;display:<?php echo $dbErrorDisplay ?>">
		<h4 style="text-align:center;">
			There is a problem with the system. Please try again later.
		</h4>
	</div>

	<div id="tagcreated" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $noQuestions; ?>">
		<h4 style="text-align:center;">
			There are no Tags Created by you !
		</h4>
	</div>
	
	
</body>
