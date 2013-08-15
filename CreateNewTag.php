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
	$tagCreated = 'none';
	$tagExists = 'none';	
	
	$sessionId = $_SESSION['sessionId'];
	if($sessionId != "" && session_id() == $sessionId){		
		$welcomeDisplay = 'inline';
	}else{	
		header('Location:  Login.php');
	}
	
	$dbErrorDisplay = 'none';
	$tagCreated = 'none';
	$tagExists = 'none';
	$sessionId = $_SESSION['sessionId'];
	if($sessionId != "" && session_id() == $sessionId){		
		showPage();
	}else{	
		header('Location:  Login.php');
	}	
	
	function showPage(){	
		global $dbErrorDisplay, $tagCreated, $tagExists;
		if(isset($_POST['submitted'])){		
			//Connect to the database
			$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
			//Connection Problem
			if(!$db){
				$dbErrorDisplay = 'block';
				oci_close($db);
			}else{	//Connection established		
				$tagName = $_POST['tagName'];
				//Creating the statement
				$query = "SELECT TAGNAME FROM tag WHERE tagname = '".$tagName."'";
				$statement = oci_parse($db,$query);
				//Executing the statement
				oci_execute($statement);
				$tagPresent = false;
				while($row = oci_fetch_array($statement, OCI_BOTH)){
					$tagPresent = true;
					break;
				}
				//Tag name not present
				if(!$tagPresent){
					$query = "INSERT INTO tag VALUES ('".$tagName."', (SELECT sysdate FROM dual), '".$_SESSION['userName']."')";
					$statement = oci_parse($db,$query);
					$result = oci_execute($statement);
					if(!$result){
						$dbErrorDisplay = 'block';
						oci_free_statement($statement);
						oci_close($db);
					}else{
						oci_commit($db);
						$tagCreated = 'block';
						oci_free_statement($statement);
						oci_close($db);
					}
				}				
				else{	//Tag Exists		
					$tagExists = 'block';
					oci_free_statement($statement);
					oci_close($db);
				}
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
									<td style="text-align:right;">Enter Tag Name</td>
									<td><input name="tagName" type="text"/></td>
								</tr>
								<tr>
									<td style="text-align:center;">
										<input name="submitted" type="Submit" value="Create Tag" />
									</td>			
								</tr>
							</table>
						</form>
						<div id="dbconnectionerror" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;color:red;display:<?php echo $dbErrorDisplay; ?>">
							<h4 style="text-align:center;">
								There is a problem with the system. Please try again later.
							</h4>
						</div>

						<div id="tagcreated" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $tagCreated; ?>">
							<h4 style="text-align:center;">
								Tag Created Succesfully
							</h4>
						</div>
						
						<div id="tagexists" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $tagExists; ?>">
							<h4 style="text-align:center;">
								Tag Already Exists
							</h4>
						</div>
					</div>				
				</td>
			</tr>
		</table>
	</div>
</body>