<?php
	// LOGIN.PHP
	// errori muutujad peavad enne if'i olemas olema :)
	
	$email_error = "";
	$password_error = "";
	$username_error = "";
	$reg_email_error = "";
	$reg_password_error = "";
	$reg_username_error = "";
	
	//muutujad andmebaasi väärtuste jaoks
	$username = ""; $email = ""; $password = "";
	
	//echo $_POST["email"];
	
	// kontrollime et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		//************************************************************
		//echo "keegi vajutas login nuppu";
		
		//vajutas login nuppu
		//************************************************************
		if(isset($_POST["login"])){
				
			if (empty($_POST["email"]) ) {
				$email_error = "This field is required";
			}else{
				// kõik korras
				// test_input eemaldab pahataltikud osad
				$email = test_input($_POST["email"]);
				
				}
				
			if (empty($_POST["username"]) ) {
				$username_error = "This field is required";
				
			}else{
				
				$username = test_input($_POST["username"]);
				
				}
				
			if (empty($_POST["password"]) ) {
				$password_error = "This field is required";
			}else{
			
				$password = test_input($_POST["password"]);
				
			}
			// kontrollin et ei oleks ühtegi errorit
			if($email_error == "" && $password_error ==""){
				
			echo "kontrollin sisselogimist ".$email." ja parool ";
		
			}

		
		//*************************************************************
		// Keegi vajutas create nuppu
		//*************************************************************
		}elseif(isset($_POST["create"])){
			
			if (empty($_POST["reg_username"]) ) {
				$reg_username_error = "This field is required";
			}
			if (empty($_POST["reg_password"]) ) {
				$reg_password_error = "This field is required";
			}else {
				
				// kui oleme siia jõudnud, siis parool ei ole tühi enam
				// kontrollin, et oleks vähemalt 8 sümbolit pikk
				if(strlen($_POST["reg_password"]) < 8) {
					
					$reg_password_error = "Password must be at least 8 characters";
					
				}
			}
			if (empty($_POST["reg_email"]) ) {
				$reg_email_error = "This field is required";
			}
		
		}
	}
	
	
	function test_input($data) {
		// võtab ära tühikud, enterid, tabid
		$data = trim($data);
		// tagurpidi kaldkriipsud
		$data = stripslashes($data);
		// teeb htm'li tekstiks 
		$data = htmlspecialchars($data);
		return $data;
}
	
	$page_title = "Sisselogimine";
	$page_file_name = "login.php";
	require_once("../header.php");
?>

	<h2>Log in</h2>
		
		<form action="login.php" method="post" >
			<input name="username" type="text" placeholder="username"> <?php echo $username_error; ?><br> <br>
			<input name="email" type="email" placeholder="email"> <?php echo $email_error; ?><br> <br>
			<input name="password" type="password" placeholder="Password"> <?php echo $password_error; ?> <br> <br>
			<input name="login" type="submit" value="Log in"> <br> <br>
		</form>
	
	<h2>Create user</h2>
	
		<form action="login.php" method="post" >
			<input name="reg_username" type="text" placeholder="username"> * <?php echo $reg_username_error; ?><br> <br>
			<input name="reg_email" type="email" placeholder="email"> * <?php echo $reg_email_error; ?><br> <br>
			<input name="reg_password" type="password" placeholder="Password"> * <?php echo $reg_password_error; ?> <br> <br>
			<input name="reg_password" type="password" placeholder="Insert password again"> * <?php echo $reg_password_error; ?> <br> <br>
			<input name="create" type="submit" value="Register"> <br> <br>
		</form>
	
	<?php require_once("../footer.php"); ?>