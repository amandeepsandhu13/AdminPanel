<?php
$msg="";
include("include/settings.php");
if(isset($_POST["btnSubmit"]))
{
	$state=$_POST["rbtnUser"];
	$uname=trim($_POST["txtUserName"]);
	if($uname!=null)
	{		
		if($state=="Admin")
		{
			//echo "b";
			$sql=$mysqli->prepare("select userdetails.Email_Id,usermaster.Password from userdetails inner join usermaster on usermaster.User_Id=userdetails.User_Id where User_Name=?");
			echo $sql->error;
		}
		if($state=="Employee")
		{
			//echo "a";
			$sql=$mysqli->prepare("select userdetails.Email_Id,usermastermaster.Password from userdetails inner join usermastermaster on usermastermaster.user_id=userdetails.user_id where user_name=?");
		}
		$sql->bind_param("s",$uname);
		$sql->execute();
		$sql->bind_result($email,$password);
		
		if($sql->fetch()>0)
		{
			$_SESSION["email"]=$email;
			$_SESSION["password"]=$password;
			header("location:".baseurl()."smtpgmail.php");
			//echo $_SESSION["email"].$_SESSION["password"];
		}
		else
		{
			$msg="User Don't exits with this name";
		}
	}
	else
	{
		$msg="Enter the username";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forgot Password</title>
</head>
<body>
	<div align="center">
		<form action="" method="post">
		<table align="center">
			
            <tr>
				<td>
					<fieldset>
						<legend align="center" style="font-size:30px;color:red">Forgot Password</legend>
						<table>
                      	 	 <tr>
                                <td colspan="2" align="center">
                                    <?php 
                                        echo $msg;
                                    ?>
                                </td>
                            </tr>
							<tr>
								<td colspan="2">
                                    <p align="justify">If you have forgotten your password, you can have it recover.<br/>
                                        Please enter your Username below to do so. <br/>
                                    </p>
								</td>
							</tr>
                         </table>
                         <table align="center" cellpadding="5" cellspacing="0">
                         	<tr>
                            	<td>User Type</td>
                                <td>
                                	<input type="radio" name="rbtnUser" value="Admin"/>Admin &nbsp; &nbsp; 
                                    <input type="radio" name="rbtnUser" value="Employee" checked="checked"/>employee
                                </td>
                            </tr>
							<tr>
                            	<td>User Name:</td>
								<td><input type="text" name="txtUserName" required="required" title="Enter the User Name"/><br /><br /></td>
							</tr>
							<tr>
                                <td colspan="2" align="center">
                                    <input type="submit" value="Submit Request" class="btn" name="btnSubmit"/>
                                </td>
							</tr>
						</table>
					</fieldset>
				</td>
			</tr>
		</table>
		</form>
       </div>
	</body>
</html>