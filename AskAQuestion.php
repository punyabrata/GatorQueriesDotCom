<style type="text/css">
::-webkit-scrollbar {
    width: 12px;
}
 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
    border-radius: 10px;
}
 
::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); 
}
</style>

<?php	
	//Stop showing warnings on the page!
	//error_reporting(0);	
	
	session_start();
	$welcomeDisplay = 'none';
	$dbErrorDisplay = 'none';
	$numNotif = 22;
	
	$sessionId = $_SESSION['sessionId'];
	if($sessionId != "" && session_id() == $sessionId){		
		$welcomeDisplay = 'inline';
	}else{	
		header('Location:  Login.php');
	}
	$tags = '';
	$dbErrorDisplay = 'none';
	$questionCreated = 'none';
	$sessionId = $_SESSION['sessionId'];
	if($sessionId != "" && session_id() == $sessionId){		
		showPage();
	}else{	
		header('Location:  Login.php');
	}	
	
	function showPage(){		
		global $tags, $questionCreated;
		$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
		
		if(isset($_POST['submitted'])){		
			//Connect to the database			
			//Connection Problem
			if(!$db){
				$dbErrorDisplay = 'block';
				oci_close($db);
			}else{	//Connection established		
				$questionSubject = $_POST['questionSubject'];
				$questionDescription = $_POST['questionDescription'];
				$tags = $_POST['tag'];
				$query1 = "INSERT INTO Question VALUES (((select floor(dbms_random.value*1000000000) from dual)),'".$questionSubject."', '".$questionDescription."','".$_SESSION['userName']."',(SELECT sysdate FROM dual))";
				$statement = oci_parse($db,$query1);
				oci_execute($statement);
				oci_commit($db);
				$questionCreated = 'block';
				oci_free_statement($statement);
				$query2 = "SELECT question# from question where questionsubject ='".$questionSubject."'";
				$statement = oci_parse($db,$query2);
				oci_execute($statement);
				$row = oci_fetch_array($statement, OCI_BOTH);
                foreach ($tags as $t){
				$query3 = "INSERT INTO Questiontag VALUES ('".$t."', '".$row[0]."',(SELECT sysdate FROM dual),'".$_SESSION['userName']."')";
				$statement = oci_parse($db,$query3);
				oci_execute($statement);
				}
				
				oci_close($db);
				$questionCreated = 'block';
				/**

				we shud add tags here
				
				*/		
				
			}
		}
	}	
?>
<body style="background-color: #ABCDEF;font-family:Tahoma;color:#3B5998 !important;">
	
	<!--Header-->
	<div style="height:20%;width:80%;margin-left:auto;margin-right:auto;display:table;">
		<div style="postion:relative;display:table-cell;margin-left:auto;margin-right:auto;vertical-align:middle;">
			<table border="0" cellpadding="0" cellspacing="0" style="border-color:white;width:100%;margin-left:auto;margin-right:auto;color:white;">
				<tr>
					<td valign="top" style="width:25%;">
						<img src="../Images/index.jpg" height="140" width="80%"></img>
					</td>
					<td valign="top" style="background-color:#3B5998;padding:10;">
						<p style="border-bottom:1px solid;padding-bottom:4;font-size:20;font-height:20;font-weight:bold;">Ask Questions! Get Answered!</p>						
						<p style="font-size:32;font-height:20;font-weight:bold;">Go Gators!</p>
					</td>
					<td valign="top" align="right" style="width:25%;">
						<img src="../Images/gator.png" height="140" width="80%"></img>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<p/>
	<p/>
	
	<!--Body-->
	<div style="border:2px solid #456789;width:80%;margin-left:auto;margin-right:auto;">
		<table border="0" id="headerInformation" width="100%" style="border:1px solid #456789;">
			<tr>
				<td width="160">
					<?php 
						$photoPath = "";
						$displayVar = "";
						$displayInner = "";
						if($_SESSION['userPhoto'] == "1"){
							//Profile Photo
							$photoPath = "DP/".$_SESSION['userName'];
							$displayVar = "none";
							$displayInner = "none";
						} else {
							//Default Profile Photo
							$photoPath = "default_dp";
							$displayVar = "table";
							$displayInner = "table-cell";
						}
					?>				
					<div style="z-index:1000;height:160;width:150;position:absolute;text-align:center;display:<?php echo $displayVar; ?>;">
						<div style="postion:relative;display:<?php echo $displayInner; ?>;vertical-align:middle;">
							Upload Photo
						</div>
					</div>
					<img src="../Images/<?php echo $photoPath; ?>.jpg" height="160" width="150"></img>
				</td>
				<td valign="top">
					<h2 style="display:<?php echo $welcomeDisplay ?>;"><?php echo $_SESSION['firstName']." ".$_SESSION['lastName'] ?></h2>
					<br/>
					<h4 style="display:<?php echo $welcomeDisplay ?>;font-weight:normal;"><?php echo $_SESSION['address'] ?></h4>
					<br/>
					<br/>
					<a href="Notification.php" style="text-decoration:none;color:inherit;">Edit Profile</a>	
					<p/>
					<p/>
					<input type="text" 
						onFocus="if (value == 'Search someone...') {value=''}" 
						onBlur="if (value== '') {value='Search someone...'}" 
						value="Search someone..." 
						style="width:80%;height:30;font-family:Tahoma;font-size:16;"
					/>
				</td>				
				<td valign="top" width="300" style="text-align:right;">
					<table border="0" style="float:right;">
						<tr>
							<td style="width:60;">
								<a href="Home.php">
									<img src="../Images/Home_Used.jpg" height="40" width="40" style="float:right;"></img>
								</a>
							</td>
							<td style="width:60;">
								<div style="z-index:1000;height:50;width:50;position:absolute;text-align:right;display:table;">
									<div style="postion:relative;display:table-cell;vertical-align:middle;">
										<a href="Notification.php" style="text-decoration:none;<?php if($numNotif > 0) echo "color:red;font-weight:bold;"; ?>;">
											<?php if($numNotif > 0) echo $numNotif; ?>
										</a>
									</div>
								</div>							
								<img src="../Images/Notification_Used.jpg" height="40" width="40" style="float:right;"></img>								
							</td>
							<td style="width:60;">
								<img src="../Images/Settings_Used.jpg" height="40" width="40" style="float:right;"></img>
							</td>
						</tr>
					</table>
					<a href="Preferences.php" style="text-decoration:none;color:inherit;">Preferences</a><br/>
					<a href="Logout.php" style="text-decoration:none;color:inherit;">Logout</a><br/>
				</td>
			</tr>			
		</table>
		
		<table id="bodyInformation" width="100%" border="0" style="border-color:white;table-layout:fixed;">
			<tr>
				<td id="leftPane" width="250" style="max-height:500px;padding-left:10;border-right-style:solid;border-right:1px solid inherit;" valign="top">
					<div style="max-height:850px;">
						<h3> ACTIVITIES </h3>
						<a href="CreateNewTag.php" style="text-decoration:none;color:inherit;">Create a New Tag</a>
						<p/>
						<a href="AskAQuestion.php" style="text-decoration:none;color:inherit;">Ask a Question</a>
						<p/>
						<a href="SearchQuestions.php" style="text-decoration:none;color:inherit;">Search Questions</a>
						<p/>
						<br/>									
						<h3> INTERESTS </h3>
						<a href="MyQuestions.php" style="text-decoration:none;color:inherit;">Questions I asked</a>
						<p/>
						<a href="QuestionsIAnswered.php" style="text-decoration:none;color:inherit;">Questions I answered</a>
						<p/>
						<a href="MyTags.php" style="text-decoration:none;color:inherit;">Tags created by me</a>
						<p/>
						<a href="QuestionsITagged.php" style="text-decoration:none;color:inherit;">Questions I Tagged</a>
						<p/>
						<a href="QuestionsIVoted.php" style="text-decoration:none;color:inherit;">My voted Questions</a>
						<p/>
						<a href="AnswersIVoted.php" style="text-decoration:none;color:inherit;">My voted Answers</a>
						<p/>					
						<br/>	
						<h3> FOLLOWS </h3>
						<a href="MyFollowers.php" style="text-decoration:none;color:inherit;">My Followers</a>
						<p/>
						<a href="PersonsIFollow.php" style="text-decoration:none;color:inherit;">Persons I Follow</a>
						<p/>
						<a href="QuestionsIFollow.php" style="text-decoration:none;color:inherit;">Questions I Follow</a>
						<p/>	
						<a href="TagsIFollow.php" style="text-decoration:none;color:inherit;">Tags I Follow</a>
						<p/>
						<br/>	
						<h3> STATISTICS </h3>
						<a href="Statistics.php" style="text-decoration:none;color:inherit;">GatorQueries Statistics</a>
						<p/>
						<br/>						
						<hr style="background-color:#3B5998; border-width:0; color:#3B5998; height:1px; lineheight:0; display: inline-block; text-align: left; width:50%;"/>
					</div>
				</td>
				<td id="rightContent" valign="top">
					<div style="border:2px solid #456789;width:80%;margin-left:auto;margin-right:auto;">
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">	
							<table style="margin-left:auto;margin-right:auto;">
								<tr>
									<td style="text-align:right;">Question Subject</td>
									<td><input name="questionSubject" type="text"/></td>
								</tr>
								<tr>
									<td style="text-align:right;">Question Description</td>
									<td><textarea name="questionDescription" rows="4" cols="50"></textarea></td>
								</tr>
								<tr>
									<td style="text-align:right;">Select Tags</td>
									<td>
									<select multiple name="tag[]">
									<?php 
									$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
									$query = "select distinct tagname from tag";
									$statement = oci_parse($db,$query);
									oci_execute($statement);						
									while($row = oci_fetch_array($statement, OCI_BOTH)){
										echo '<option value="'. $row[0] .'">'. $row[0] .'</option>';
									}	
									?>	
									</select>
									</td>
								</tr>
								<tr>
									<td style="text-align:center;">
										<input name="submitted" type="Submit" value="Ask Question" />
									</td>			
								</tr>
							</table>
						</form>
						<div id="dbconnectionerror" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;color:red;display:<?php echo $dbErrorDisplay ?>">
							<h4 style="text-align:center;">
								There is a problem with the system. Please try again later.
							</h4>
						</div>

						<div id="tagcreated" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $questionCreated ?>">
							<h4 style="text-align:center;">
								Question Posted Succesfully !
							</h4>
						</div>						
					</div>					
				</td>
			</tr>
		</table>
	</div>
</body>