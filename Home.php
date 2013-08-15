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
							}else{	//Connection established							
								$query = "SELECT
											QAU.Q#,
											QAU.TAGNAME,
											QAU.ASKUNAME,      
											QAU.ASKFNAME,
											QAU.ASKLNAME,
											QAU.ASKPHOTO,
											QAU.QS,
											QAU.QD,
											QAU.QC,
											QAU.QV,        
											QAU.QUV,        
											QAU.F,        
											QAU.UF,                
											QAU.A#,
											QAU.ANSUNAME,
											QAU.ANSFNAME,
											QAU.ANSLNAME,
											QAU.ANSPHOTO,
											QAU.AD,
											QAU.AC,
											QAU.AV,
											QAU.UV        
										FROM    
										
										(SELECT *
										
											FROM
											
											(SELECT
												QWITHTAG.Q# \"Q#\",
												QWITHTAG.TAGNAME \"TAGNAME\",
												U.USERNAME \"ASKUNAME\",
												U.FIRSTNAME \"ASKFNAME\",
												U.LASTNAME \"ASKLNAME\",
												U.PHOTO \"ASKPHOTO\",
												QWITHTAG.QS \"QS\",
												QWITHTAG.QD \"QD\",
												QWITHTAG.QC \"QC\",
												QWITHTAG.QCACT \"QCACT\",
												QWITHTAG.UF \"UF\",
												QWITHTAG.F \"F\",            
												QWITHTAG.QV \"QV\",
												QWITHTAG.QUV \"QUV\"
											FROM
												(
													SELECT
														QWITHVOTE.Q# \"Q#\",
														QWITHVOTE.POSTEDBY \"POSTEDBY\",
														QT.TAGNAME \"TAGNAME\",
														QWITHVOTE.QS \"QS\",
														QWITHVOTE.QD \"QD\",
														QWITHVOTE.QC \"QC\",
														QWITHVOTE.QCACT \"QCACT\",
														QWITHVOTE.UF \"UF\",
														QWITHVOTE.F \"F\",
														QWITHVOTE.QV \"QV\",
														QWITHVOTE.QUV \"QUV\"                    
													FROM
														(
															SELECT
																QWITHFOLLOW.Q# \"Q#\",
																QWITHFOLLOW.POSTEDBY \"POSTEDBY\",
																QWITHFOLLOW.QS \"QS\",
																QWITHFOLLOW.QD \"QD\",
																QWITHFOLLOW.QC \"QC\",
																QWITHFOLLOW.QCACT \"QCACT\",
																QWITHFOLLOW.UF \"UF\",
																QWITHFOLLOW.F \"F\",
																QV.VOTE \"QV\",
																QV.USERVOTED \"QUV\"    
															FROM
																(
																	SELECT
																		Q.QUESTION# \"Q#\",
																		Q.POSTEDBY \"POSTEDBY\",
																		Q.QUESTIONSUBJECT \"QS\",
																		Q.QUESTIONDESCRIPTION \"QD\",
																		TO_CHAR(Q.CREATEDDATETIME,'Month DD, YYYY HH24:MI:SS') \"QC\",
																		Q.CREATEDDATETIME \"QCACT\",
																		QF.FOLLOWINGUSER \"UF\",
																		QF.FOLLOWED \"F\"
																	FROM
																		QUESTION \"Q\"
																		LEFT OUTER JOIN QUESTIONFOLLOW \"QF\"
																		ON (Q.QUESTION# = QF.QUESTIONTOFOLLOW)                            
																) \"QWITHFOLLOW\"
																LEFT OUTER JOIN QUESTIONVOTE \"QV\"
																ON (QWITHFOLLOW.Q# = QV.QUESTION#)                    
														) \"QWITHVOTE\"
														LEFT OUTER JOIN QUESTIONTAG \"QT\"
														ON (QWITHVOTE.Q# = QT.QUESTION#)
												) \"QWITHTAG\"
												JOIN USERTABLE U
												ON (U.USERNAME = QWITHTAG.POSTEDBY)
											
											) \"QU\"
											
											LEFT OUTER JOIN
											
											(SELECT
												AWITHVOTE.QANS \"QANS\",
												AWITHVOTE.A# \"A#\",
												U.USERNAME \"ANSUNAME\",
												U.FIRSTNAME \"ANSFNAME\",
												U.LASTNAME \"ANSLNAME\",
												U.PHOTO \"ANSPHOTO\",
												AWITHVOTE.AD \"AD\",
												AWITHVOTE.AC \"AC\",
												AWITHVOTE.ACACT \"ACACT\",
												AWITHVOTE.AV \"AV\",
												AWITHVOTE.UV \"UV\"
											FROM
												(
													SELECT
														A.QUESTIONANSWERED \"QANS\",
														A.ANSWER# \"A#\",
														A.ANSWERDESCRIPTION \"AD\",
														TO_CHAR(A.CREATEDDATETIME,'Month DD, YYYY HH24:MI:SS') \"AC\",
														A.CREATEDDATETIME \"ACACT\",
														A.ANSWEREDBY \"ABY\",
														AV.VOTE \"AV\",
														AV.USERVOTED \"UV\"
													FROM
														ANSWER \"A\"
														LEFT OUTER JOIN ANSWERVOTE \"AV\"
														ON (A.ANSWER# = AV.ANSWER#)                        
												) \"AWITHVOTE\"
												JOIN USERTABLE U
												ON(U.USERNAME = AWITHVOTE.ABY)
													
											) \"AU\"
											 
											ON (QU.Q# = AU.QANS)
										) \"QAU\"
										
										ORDER BY QAU.QCACT DESC, QAU.Q#, QAU.UF, QAU.QUV, QAU.ACACT, QAU.A#, QAU.UV";
								$statement = oci_parse($db,$query);
								//Executing the statement
								oci_execute($statement);
								/*****************************/							
								$quesAnsArray = array();			//The main array of size = num questions in the database							
								$quesAnsArrayEntry = array();		//Each entry in the main array of size = 2, left = question, right = answer
								/*****************************/							
								$quesSpcArray = array();			//Question Specific Array of size = 5
								$ansSpcArray = array();				//Answer Specific Array of size = num answers for that question in the database
								/*****************************/
								$quesSpcDetails = array();			//Question Specific Details of size = 8
								$tagSpcDetails = array();			//Tag Specific Details of size = num tags for that question in the database
								$followSpcDetails = array();		//Follow Specific Details of size = num follows for that question in the database
								$quesUpVoteSpcDetails = array();	//Question Upvote Specific Details of size = num upvotes for that question
								$quesDownVoteSpcDetails = array();	//Question Downvote Specific Details of size = num downvotes for that question
								/*****************************/
								$ansSpcArrayEntry = array();		//Each entry in the Answer Specific Array of size = 3
								$ansSpcDetails = array();			//Answer Specific Details of size = 7
								$ansUpVoteSpcDetails = array();		//Answer Upvote Specific Details of size = num upvotes for that answer
								$ansDownVoteSpcDetails = array();	//Answer Downvote Specific Details of size = num downvotes for that answer
								/*****************************/							
								$previousQN = "";
								$currentQN = "";
								$previousTag = "";
								$currentTag = "";
								$previousAV = "";
								$currentAV = "";
								$previousAN = "";
								$currentAN = "";
								$previousQV = "";
								$currentQV = "";
								$previousQF = "";
								$currentQF = "";
								/*****************************/
								$quesCount = 0;
								$newQuestion = false;
								$newQuesFollow = false;
								$newQuesVote = false;
								$newAnswer = false;
								$newAnswerVote = false;							
								
								/*****************************/
								//Traversing every row
								while($row = oci_fetch_array($statement, OCI_BOTH+OCI_RETURN_NULLS)){
									$previousQN = $currentQN;
									$currentQN = $row[0];
									$previousQF = $currentQF;
									$currentQF = $row[0].$row[12];								
									$previousQV = $currentQV;
									$currentQV = $row[0].$row[10];
									$previousAN = $currentAN;
									$currentAN = $row[13];
									$previousAV = $currentAV;
									$currentAV = $row[13].$row[21];
									$previousTag = $currentTag;
									$currentTag = $row[0].$row[1];								
									if(strcmp($previousQN,$currentQN) == 0) {
										$newQuestion = false;
										//Old Question
										if(strcmp($previousQF,$currentQF) == 0){
											//Old Question Follow
											if(strcmp($previousQV,$currentQV) == 0){
												//Old Question Vote
												//At least one question vote already done, meaning all the answers of a question are traversed
												if($newQuesVote == false) {
													if(strcmp($previousAN,$currentAN) == 0){
														//Old Answer
														if(strcmp($previousAV,$currentAV) == 0){
															//Old Answer Vote
															if($newAnswerVote == true || $newAnswer == true || $newQuesFollow == true || $newQuestion == true) {
																//We are done
																//echo "We are done for question number : ".$row[0]."!<br/>";
																$quesSpcArray[1] = $tagSpcDetails;
																$quesAnsArrayEntry[0] = $quesSpcArray;
																//Pushing Question-Answer Array Entry to the Question-Answer Main Array
																array_pop($quesAnsArray);
																array_push($quesAnsArray,$quesAnsArrayEntry);																
															} else {
																//echo "pushing tag for question : ".$row[0]."<br/>";
																array_push($tagSpcDetails,$row[1]);
															}
														} else {
															//New Answer Vote
															//Question UpVote Specific Details
															//$ansUpVoteSpcDetails = array();
															//echo "New Answer Vote: ".$row[18]."	".$row[19]."<br/>";
															$newAnswerVote = true;
															if($row[20] != NULL && $row[20] == "1"){										
																array_push($ansUpVoteSpcDetails,$row[21]);
																//Pushing Answer UpVote Specific Details to the Answer Specific Array Entry
																$ansSpcArrayEntry[1] = $ansUpVoteSpcDetails;
																//Pushing Answer Specific Array Entry to the Answer Specific Array
																array_pop($ansSpcArray);
																array_push($ansSpcArray,$ansSpcArrayEntry);
																//Pushing the Answer Specific Array to the Question-Answer Array Entry
																$quesAnsArrayEntry[1] = $ansSpcArray;
																//Pushing Question-Answer Array Entry to the Question-Answer Main Array
																array_pop($quesAnsArray);
																array_push($quesAnsArray,$quesAnsArrayEntry);															
															}
															//Question DownVote Specific Details
															//$ansDownVoteSpcDetails = array();
															if($row[20] != NULL && $row[20] == "-1"){										
																array_push($ansDownVoteSpcDetails,$row[21]);
																//Pushing Answer UpVote Specific Details to the Answer Specific Array Entry
																$ansSpcArrayEntry[2] = $ansDownVoteSpcDetails;
																//Pushing Answer Specific Array Entry to the Answer Specific Array
																array_pop($ansSpcArray);
																array_push($ansSpcArray,$ansSpcArrayEntry);
																//Pushing the Answer Specific Array to the Question-Answer Array Entry
																$quesAnsArrayEntry[1] = $ansSpcArray;
																//Pushing Question-Answer Array Entry to the Question-Answer Main Array
																array_pop($quesAnsArray);
																array_push($quesAnsArray,$quesAnsArrayEntry);															
															}													
														}
													} else {
														//New Answer
														$newAnswer = true;
														if($row[13] != NULL){
															//For each new answer
															//echo "New answer: ".$row[16]." : which means new ansSpcDetails, ansUpVoteSpcDetails and ansDownVoteSpcDetails<br/>";
															$ansSpcDetails = array();
															$ansUpVoteSpcDetails = array();
															$ansDownVoteSpcDetails = array();
															array_push($ansSpcDetails,$row[13],$row[14],$row[17],$row[15],$row[16],$row[18],$row[19]);
															if($row[20] != NULL && $row[20] == "1"){
																array_push($ansUpVoteSpcDetails,$row[21]);
															}
															if($row[20] != NULL && $row[20] == "-1"){
																array_push($ansDownVoteSpcDetails,$row[21]);
															}
															//Pushing Answer Specific Details to the Answer Specific Array Entry
															$ansSpcArrayEntry = array();
															array_push($ansSpcArrayEntry,$ansSpcDetails,$ansUpVoteSpcDetails,$ansDownVoteSpcDetails);
															//Pushing Answer Specific Array Entry to the Answer Specific Array
															array_push($ansSpcArray,$ansSpcArrayEntry);
															//Pushing the Answer Specific Array to the Question-Answer Array Entry
															$quesAnsArrayEntry[1] = $ansSpcArray;
															//Pushing Question-Answer Array Entry to the Question-Answer Main Array
															array_pop($quesAnsArray);
															array_push($quesAnsArray,$quesAnsArrayEntry);														
														}																										
													}
												}
											} else {
												//New Question Vote
												$newQuesVote = true;
												//echo $currentQN."	".$currentQF."	".$newQuesFollow."	"."new question vote!<br/>";
												if($newQuesFollow == false){
													//UpVote
													//echo $currentQN."	change!"."<br/>";
													if($row[9] != NULL && $row[9] == "1"){
														array_push($quesUpVoteSpcDetails,$row[10]);
														//Pushing UpVote Specific Details to the Question Specific Array
														$quesSpcArray[3] = $quesUpVoteSpcDetails;
														//Pushing Question Specific Array to the Question-Answer Array Entry
														$quesAnsArrayEntry[0] = $quesSpcArray;
														//Pushing Question-Answer Array Entry to the Question-Answer Main Array
														array_pop($quesAnsArray);
														array_push($quesAnsArray,$quesAnsArrayEntry);													
													}
													//DownVote
													if($row[9] != NULL && $row[9] == "-1"){
														array_push($quesDownVoteSpcDetails,$row[10]);
														//Pushing DownVote Specific Details to the Question Specific Array
														$quesSpcArray[4] = $quesDownVoteSpcDetails;
														//Pushing Question Specific Array to the Question-Answer Array Entry
														$quesAnsArrayEntry[0] = $quesSpcArray;
														//Pushing Question-Answer Array Entry to the Question-Answer Main Array
														array_pop($quesAnsArray);
														array_push($quesAnsArray,$quesAnsArrayEntry);													
													}
												}
											}
										} else {
											//New Question Follow
											$newQuesFollow = true;
											if($row[11] != NULL && $row[11] == "1"){
												//echo $row[0]."	".$row[10]."<br/>";										
												array_push($followSpcDetails,$row[12]);
												//Pushing Follow Specific Details to the Question Specific Array
												$quesSpcArray[2] = $followSpcDetails;
												//Pushing Question Specific Array to the Question-Answer Array Entry
												$quesAnsArrayEntry[0] = $quesSpcArray;
												//Pushing Question-Answer Array Entry to the Question-Answer Main Array
												array_pop($quesAnsArray);
												array_push($quesAnsArray,$quesAnsArrayEntry);											
											}										
										}
										
									} else {
											
										//New Question
										$newQuestion = ($quesCount > 0) ? true : false;
										$newQuesFollow = false;
										$newQuesVote = false;
										$newAnswer = false;
										$newAnswerVote = false;
										//Question Specific Details
										$quesSpcDetails = array();
										array_push($quesSpcDetails,$row[0],$row[2],$row[5],$row[3],$row[4],$row[6],$row[7],$row[8]);
										//Tag Specific Details
										$tagSpcDetails = array();
										array_push($tagSpcDetails,$row[1]);
										//Follow Specific Details
										$followSpcDetails = array();
										if($row[11] != NULL && $row[11] == "1"){
											//echo $row[0]."	".$row[10]."<br/>";										
											array_push($followSpcDetails,$row[12]);
										}
										//Question UpVote Specific Details
										$quesUpVoteSpcDetails = array();
										if($row[9] != NULL && $row[9] == "1"){
											//echo $row[0]."	".$row[8]."<br/>";										
											array_push($quesUpVoteSpcDetails,$row[10]);
										}
										//Question DownVote Specific Details
										$quesDownVoteSpcDetails = array();
										if($row[9] != NULL && $row[9] == "-1"){
											//echo $row[0]."	".$row[8]."<br/>";										
											array_push($quesDownVoteSpcDetails,$row[10]);
										}
										//Question Specific Array
										$quesSpcArray = array();
										array_push($quesSpcArray,$quesSpcDetails,$tagSpcDetails,$followSpcDetails,$quesUpVoteSpcDetails,$quesDownVoteSpcDetails);
										
										/*****************************/
										//Answer Specific Details
										$ansSpcDetails = array();
										if($row[13] != NULL){										
											array_push($ansSpcDetails,$row[13],$row[14],$row[17],$row[15],$row[16],$row[18],$row[19]);
										}
										//Question UpVote Specific Details
										$ansUpVoteSpcDetails = array();
										if($row[20] != NULL && $row[20] == "1"){										
											array_push($ansUpVoteSpcDetails,$row[21]);
										}
										//Question DownVote Specific Details
										$ansDownVoteSpcDetails = array();
										if($row[20] != NULL && $row[20] == "-1"){										
											array_push($ansDownVoteSpcDetails,$row[21]);
										}
										if($row[13] != NULL){
											//Answer Specific Array Entry
											$ansSpcArrayEntry = array();
											array_push($ansSpcArrayEntry,$ansSpcDetails,$ansUpVoteSpcDetails,$ansDownVoteSpcDetails);
											//Answer Specific Array
											$ansSpcArray = array();
											array_push($ansSpcArray,$ansSpcArrayEntry);
										}
										/*****************************/
										//Question Answer Array Entry
										$quesAnsArrayEntry = array();
										array_push($quesAnsArrayEntry,$quesSpcArray,$ansSpcArray);
										//Question Answer Main Array
										array_push($quesAnsArray,$quesAnsArrayEntry);
										$quesCount++;
									}
								}
								//echo "<pre>";
									//print_r($quesAnsArray);
								//echo "</pre>";	
								oci_free_statement($statement);
								oci_close($db);								
							}						
						?>
						<div id="dbconnectionerror" style="width:100%;color:red;display:<?php echo $dbErrorDisplay ?>">
							<h4> There is a problem with the system. Please try again later. </h4>
						</div>
						<table border="0" cellspacing="0" width="100%" id="questionAnswerTable">
							<?php foreach ($quesAnsArray as $eachQA) {
							?>
							<tr style="background-color: #89ABCD;">
								<td id="AskerPicCol" valign="top" width="110">
									<?php 
										$askerPhotoPath = "";
										if($eachQA[0][0][2] == "1"){
											//Profile Photo
											$askerPhotoPath = "DP/".$eachQA[0][0][1];
										} else {
											//Default Profile Photo
											$askerPhotoPath = "default_dp";
										}
									?>								
									<img src="../Images/<?php echo $askerPhotoPath; ?>.jpg" height="110" width="100"></img>
								</td>
								<td id="QuesAnsCol" valign="top">
									<h3>
										<a href="User.php?id=<?php echo $eachQA[0][0][1]; ?>" style="text-decoration:none;color:inherit;">
											<?php echo $eachQA[0][0][3]." ".$eachQA[0][0][4]; ?>
										</a>
									</h3>
									<p style="font-weight:bold;color:#555555;"><?php echo $eachQA[0][0][5]; ?></p>
									<p style="color:#555555;"><?php echo $eachQA[0][0][6]; ?></p>
									<hr/>
									<p>
										<img src="../Images/Tag.jpg" height="40" width="40"></img>
										<?php foreach ($eachQA[0][1] as $eachTag) { ?>
											<a href="Tag.php?id=<?php echo $eachTag; ?>" style="text-decoration:none;color:inherit;"><?php echo $eachTag; ?></a>
											&nbsp;&nbsp;
										<?php } ?>
									</p>
									<p>
										<img src="../Images/Follow.jpg" height="30" width="30"></img>
										<label style="color:#555555;"><?php echo count($eachQA[0][2]); ?></label>
										<img src="../Images/Upvote.jpg" height="30" width="30"></img>
										<label style="color:#555555;"><?php echo count($eachQA[0][3]); ?></label>
										<img src="../Images/Downvote.jpg" height="30" width="30"></img>
										<label style="color:#555555;"><?php echo count($eachQA[0][4]); ?></label>
									</p>
									<label style="color:#777777;font-size:14;">
										<?php echo $eachQA[0][0][7]; ?>
									</label>
									<a href="Question.php?id=<?php echo $eachQA[0][0][0]; ?>" style="text-decoration:none;color:inherit;font-weight:bold;">
										<p style="width:33%;float:right;text-align:right;padding:10 20 5 0;border:1px solid #3B5998;margin-right:5;background-color:#ABCDEF;">
											Respond to this question									
										</p>
									</a>								
								</td>							
							</tr>
							<tr style="background-color: #789ABC;">
								<td>
								</td>
								<td>
									<table id="answersToQuestions" border="0" width="100%">
										<?php foreach ($eachQA[1] as $answerArrayEntry) { ?>
										<tr>
											<td colspan="2"> <hr/> </td>
										</tr>									
										<tr>
											<td id="AnswererPicCol" valign="top" width="70">
												<?php 
													$answererPhotoPath = "";
													if($answerArrayEntry[0][2] == "1"){
														//Profile Photo
														$answererPhotoPath = "DP/".$answerArrayEntry[0][1];
													} else {
														//Default Profile Photo
														$answererPhotoPath = "default_dp";
													}
												?>										
												<img src="../Images/<?php echo $answererPhotoPath; ?>.jpg" height="70" width="65"></img>
											</td>
											<td valign="top">
												<h4>
													<a href="User.php?id=<?php echo $answerArrayEntry[0][1]; ?>" style="text-decoration:none;color:inherit;">
														<?php echo $answerArrayEntry[0][3]." ".$answerArrayEntry[0][4]; ?>
													</a>
												</h4>
												<p style="color:#555555;"><?php echo $answerArrayEntry[0][5]; ?></p>
												<hr/>
												<p>
													<img src="../Images/Upvote_Ans.jpg" height="30" width="30"></img>
													<label style="color:#555555;"><?php echo count($answerArrayEntry[1]); ?></label>
													<img src="../Images/Downvote_Ans.jpg" height="30" width="30"></img>
													<label style="color:#555555;"><?php echo count($answerArrayEntry[2]); ?></label>
												</p>
												<label style="color:#777777;font-size:14;"><?php echo $answerArrayEntry[0][6]; ?></label>
												<a href="Answer.php?id=<?php echo $answerArrayEntry[0][0]; ?>" style="text-decoration:none;color:inherit;font-weight:bold;">
													<p style="width:31%;float:right;text-align:right;padding:10 20 5 0;border:1px solid #3B5998;margin-right:5;background-color:#ABCDEF;">											
														Vote for this answer												
													</p>
												</a>											
											</td>										
										</tr>
										<?php } ?>								
									</table>								
								</td>							
							</tr>
							<tr>
								<td colspan="2">
									<hr style="background-color:#3B5998; border-width:0; color:#3B5998; height:1px; lineheight:0; display: inline-block; text-align: left; width:100%;"/>
								</td>
							</tr>
							<?php } ?>
						</table>
					</div>
				</td>
			</tr>
		</table>
	</div>
</body>