<?php
	//Stop showing warnings on the page!
	error_reporting(0);	
	
	$display = 'block';
	$linkDisplay = 'none';
	$dbErrorDisplay = 'none';
	$uNameExists = 'none';
	
	//If form is submitted
	if(isset($_POST['submitted'])){
		//Connect to the database
		$db = oci_connect("pdhar", "PunyabrataDhar", "oracle.cise.ufl.edu/orcl");
		//Connection Problem
		if(!$db){
			$dbErrorDisplay = 'block';
			oci_close($db);
		}else{	//Connection established
			$ufId = $_POST['ufId'];
			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$address = $_POST['address'];
			$phoneNumber = $_POST['phoneNumber'];
			$userName = $_POST['userName'];
			$password = $_POST['passWord'];
			//Check for duplicate username
			$query = "SELECT userName FROM userTable WHERE userName = '".$userName."'";
			$statement = oci_parse($db,$query);
			//Executing the statement
			oci_execute($statement);
			//Checking for already existing user
			$count = 0;
			while($row = oci_fetch_array($statement, OCI_BOTH)){				
				$count++;
			}
			if($count > 0){	//User already exists
				$uNameExists = 'block';
				oci_free_statement($statement);
				oci_close($db);
			}else{
				//Creating the statement and inserting into the database
				$query = "INSERT INTO userTable VALUES ('".$ufId."','".$firstName."','".$lastName."','".$userName."','".$password."','".$address."','".$phoneNumber."',(SELECT sysdate FROM dual),0)";
				$statement = oci_parse($db,$query);
				$result = oci_execute($statement);
				if(!$result){
					$dbErrorDisplay = 'block';
					oci_free_statement($statement);
					oci_close($db);
				}else{
					oci_commit($db);
					//Finalizing
					$display = 'none';
					$linkDisplay = 'block';
					oci_free_statement($statement);
					oci_close($db);
				}
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
	
	<div style="border:2px solid #456789;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $display ?>">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">	
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
					<td style="text-align:right;">UF ID</td>
					<td><input name="ufId" type="text"/></td>
				</tr>			
				<tr>
					<td style="text-align:right;">First name</td>
					<td><input name="firstName" type="text"/></td>
				</tr>
				<tr>
					<td style="text-align:right;">Last name</td>
					<td><input name="lastName" type="text"/></td>
				</tr>
				<tr>
					<td style="text-align:right;">Address</td>
					<td><input name="address" type="text"/></td>
				</tr>
				<tr>
					<td style="text-align:right;">Phone number</td>
					<td><input name="phoneNumber" type="text"/></td>
				</tr>				
				<tr>
					<td style="text-align:right;">Username</td>
					<td><input name="userName" type="text"/></td>
				</tr>
				<tr>
					<td style="text-align:right;">Password</td>
					<td><input name="passWord" type="password"/></td>
				</tr>
				<tr>
					<td style="text-align:right;">Confirm Password</td>
					<td><input type="password"/></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center;">
						<input name="submitted" type="Submit" value="Submit Registration" />
					</td>
				</tr>
			</table>
		</form>
		<h4 style="text-align:center;"><a href="Login.php" style="text-decoration:none;color:inherit;">Already a user? Click here to login!</a></h4>
	</div>

	<div style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $linkDisplay ?>">
		<h4 style="text-align:center;">
			You have successfully registered to our system! <a href="Login.php" style="text-decoration:none;color:inherit;">Click here to login.</a>
		</h4>
	</div>

	<div style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;color:red;display:<?php echo $dbErrorDisplay ?>">
		<h4 style="text-align:center;">
			There is a problem with the system. Please try again later.
		</h4>
	</div>

	<div style="border:2px solid #456789;border-top-color:#ABCDEF;width:80%;margin-left:auto;margin-right:auto;display:<?php echo $uNameExists ?>">
		<h4 style="text-align:center;">
			Username already exists. Use some other username.
		</h4>
	</div>
</body>