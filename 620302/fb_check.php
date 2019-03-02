<?php
session_start();
//echo $_POST["hdnFbID"]."<br>";
//echo $_POST["hdnName"]."<br>";
//echo $_POST["hdnEmail"]."<br>";
    $dbname="jaipunco_db"; 
    $servername = "localhost";
    $username = "jaipunco";
    $password = "P10oct2540M##";

    // Create connection
    $objConnect = mysql_connect($servername, $username, $password);
    $objDB = mysql_select_db($dbname);
	mysql_query("SET NAMES UTF8");

	// Check Exists ID
	$strSQL = "SELECT * FROM tblmember WHERE facebook_id = '".$_POST["hdnFbID"]."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if($objResult)
	{
		$_SESSION["member_id"] = $objResult["member_id"];
		$cookie_name = "member_id";
		$cookie_value = $objResult["member_id"];
		setcookie($cookie_name, $cookie_value, time() + (86400 * 15), "/"); // 86400 = 1 day
		header("location:/");
		exit();
	}
	else
	{
		// Create New ID
			$strPicture = "https://graph.facebook.com/".$_POST["hdnFbID"]."/picture?type=large";
			$strLink = "https://www.facebook.com/app_scoped_user_id/".$_POST["hdnFbID"]."/";

			$strSQL ="  INSERT INTO  tblmember (facebook_id,name,email,profile,link,create_date) 
				VALUES
				('".trim($_POST["hdnFbID"])."',
				'".trim($_POST["hdnName"])."',
				'".trim($_POST["hdnEmail"])."',
				'".trim($strPicture)."',
				'".trim($strLink)."',
				'".trim(time())."')";
			$objQuery  = mysql_query($strSQL);

			$strSQL = "SELECT * FROM tblmember WHERE facebook_id = '".$_POST["hdnFbID"]."' ";
			$objQuery = mysql_query($strSQL);
			$objResult = mysql_fetch_array($objQuery);
			if($objResult)
			{
				$_SESSION["member_id"] = $objResult["member_id"];
				$cookie_name = "member_id";
				$cookie_value = $objResult["member_id"];
				setcookie($cookie_name, $cookie_value, time() + (86400 * 15), "/"); // 86400 = 1 day
				header("location:/");
				exit();
			}
			exit();
	}

	mysql_close();
?>