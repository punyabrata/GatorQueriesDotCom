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
	$alreadyFollowing = false;
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
					<div style="max-height:850px;overflow:auto;">
						<?php
							$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
							//Connection Problem
							if(!$db){
								$dbErrorDisplay = 'block';
								oci_close($db);
							}else{							
							}
						?>
						<table width="100%" style="border-bottom-style:solid;">
							<tr>
								<td id="ProfilePic" width="25%" valign="top">							
									<img src="../Images/Answer.jpg" height="145" width="140"></img>									
								</td>
								<td id="OtherDetails" valign="top">
								<?php
									$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
									//Connection Problem
									if(!$db){
										$dbErrorDisplay = 'block';
										oci_close($db);
									}else{
										$answerId = $_GET["id"];
										$answerDesctiption = "";
										$questionAnswered = "";
										$answeredBy = "";
										$quesSub = "";
										$quesDesc = "";
										$askedBy = "";
										
										$query = "SELECT
													A.ANSWERDESCRIPTION,
													A.QUESTIONANSWERED,
													A.ANSWEREDBY,
													Q.QUESTIONSUBJECT,
													Q.QUESTIONDESCRIPTION,
													Q.POSTEDBY
													
												FROM
													ANSWER A
													JOIN QUESTION Q
													ON (A.QUESTIONANSWERED = Q.QUESTION#)
												WHERE
													A.ANSWER# = '".$answerId."'";
										$statement = oci_parse($db,$query);
										oci_execute($statement);
										while($row = oci_fetch_array($statement, OCI_BOTH+OCI_RETURN_NULLS)){
											$answerDesctiption = $row[0];
											$questionAnswered = $row[1];
											$answeredBy = $row[2];
											$quesSub = $row[3];
											$quesDesc = $row[4];
											$askedBy = $row[5];											
										}
										
									}
								?>
									<table border="0" width="100%">
										<tr>
											<td valign="top" width="20%">
												<img src="../Images/DP/<?php echo $answeredBy; ?>.jpg" height="100" width="95"></img>
											</td>
											<td valign="top">
												<p style="font-size:20;"><?php echo $answerDesctiption ?></p>
											</td>
										</tr>
									</table>
									<hr/>
									<h4 style="text-decoration:underline;">
										<a href="Question.php?id=<?php echo $questionAnswered; ?>" style="color:inherit;">Original question</a>
									</h4>
									<table border="0" width="100%">
										<tr>
											<td valign="top" width="20%">
												<img src="../Images/DP/<?php echo $askedBy; ?>.jpg" height="100" width="95"></img>
											</td>
											<td valign="top">
												<p style="font-size:18;"><?php echo $quesSub ?></p>
												<p style="font-size:16;"><?php echo $quesDesc ?></p>
											</td>
										</tr>
									</table>									

								</td>
							</tr>
							<tr>
								<td id="FollowUser" valign="top" style="padding-top:20;">
									<!--a href="Follow.php?tag=<?php echo $theTagName; ?>&user=<?php echo $_SESSION['userName']; ?>&follow=1" style="float:right;display:<?php echo $displayFollow; ?>;"-->
									<img src="../Images/Upvote_Act.jpg" height="100" width="100" style="float:right;"></img>
									<!--/a-->
									<!--a href="Follow.php?tag=<?php echo $theTagName; ?>&user=<?php echo $_SESSION['userName']; ?>&follow=0" style="float:right;display:<?php echo $alreadyFollow; ?>;"-->
										<!--img src="../Images/Downvote_Act.jpg" width="80%" style="float:right;"></img-->	
									<!--/a-->									
								</td>
								<td id="FollowUser" valign="top" style="padding-top:20;">
									<img src="../Images/Downvote_Act.jpg" height="100" width="100" ></img>	
								</td>
							</tr>
							
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div>
</body>