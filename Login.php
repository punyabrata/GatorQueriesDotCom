<?php
	//Stop showing warnings on the page!
	//error_reporting(0);	

	$uNamePwdWrong = 'none';
	$dbErrorDisplay = 'none';
	//If form is submitted
	if(isset($_POST['submitted'])){		
		//Connect to the database
		$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
		//Connection Problem
		if(!$db){
			$dbErrorDisplay = 'block';
			oci_close($db);
		}else{	//Connection established		
			$userName = $_POST['userName'];
			$passWd = $_POST['passWord'];
			$firstName = "";
			$lastName = "";
			$address = "";			
			$userPhoto = "";
			//Creating the statement
			$query = "SELECT FIRSTNAME,LASTNAME,ADDRESS,USERNAME,PHOTO FROM userTable WHERE USERNAME = '".$userName."' AND PASSWORD = '".$passWd."'";
			$statement = oci_parse($db,$query);
			//Executing the statement
			oci_execute($statement);
			//Checking for incorrect username/password
			$count = 0;
			while($row = oci_fetch_array($statement, OCI_BOTH)){
				$firstName = $row[0];
				$lastName = $row[1];
				$address = $row[2];
				$userName = $row[3];
				$userPhoto = $row[4];
				$count++;
			}
			//Incorrect username/password
			if($count < 1){
				$uNamePwdWrong = 'block';
			}else{	//Valid user
				session_start();
				$_SESSION['firstName'] = $firstName;
				$_SESSION['lastName'] = $lastName;
				$_SESSION['userName'] = $userName;
				$_SESSION['userPhoto'] = $userPhoto;
				$_SESSION['address'] = $address;
				$_SESSION['sessionId'] = session_id();		
				header('Location:  Home.php');
				//Closing the connection
				oci_free_statement($statement);
				oci_close($db);
			}
		}
	}
?>

<body style="background-color: #ABCDEF;font-family:Tahoma;color:#3B5998;">
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

	<div style="border:2px solid #456789;width:80%;margin-left:auto;margin-right:auto;">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">	
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
					<td style="text-align:right;">Username</td>
					<td><input name="userName" type="text"/></td>
				</tr>
				<tr>
					<td style="text-align:right;">Password</td>
					<td><input name="passWord" type="password"/></td>
				</tr>
				<tr>
					<td style="text-align:center;">
						<input name="submitted" type="Submit" value="Login" />
					</td>
					<td style="text-align:center;">
						<a href="Registration.php" style="text-decoration:none;color:inherit;">Forgot Password?</a>
					</td>				
				</tr>
			</table>
		</form>
		<h4 style="text-align:center;"><a href="Registration.php" style="text-decoration:none;color:inherit;">New User? Sign up for GatorQueries!</a></h4>
	</div>

	<div id="dbconnectionerror" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;color:red;display:<?php echo $dbErrorDisplay ?>">
		<h4 style="text-align:center;">
			There is a problem with the system. Please try again later.
		</h4>
	</div>

	<div id="unamepwdwrong" style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $uNamePwdWrong ?>">
		<h4 style="text-align:center;">
			Incorrect Username and/or Password. Please try again.
		</h4>
	</div>
</body>