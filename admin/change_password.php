<?php
	$msg="";
	include("../include/settings.php");
	include("../admin/check_session.php");
	$User_Id=$_SESSION["userId"];
	if(isset($_POST["btnUpdate"]))
	{

		if(($_POST["txtUserName"]!=null) && ($_POST["txtPassword"]!=null) && ($_POST["txtNewPassword"]!=null) && ($_POST["txtConfirmPassword"]!=null))
		{
			$sql=$mysqli->prepare("select Password from usermaster where User_Name=?");
			$sql->bind_param("s",$_SESSION["userName"]);
			$sql->execute();
			$sql->bind_result($Password);
			if($sql->fetch()>0 && $_POST["txtPassword"]== $Password)
			{
				if($_POST["txtNewPassword"]== $_POST["txtConfirmPassword"])
					{					
						$sql->close();
						$sql=$mysqli->prepare("update usermaster set Password=?  where User_Id=?");
						$sql->bind_param("si",$_POST["txtNewPassword"],$User_Id);
						$sql->execute();
						$sql->close();
						
						$msg= "Updation done";
					}
					else
					{
						$msg= "Passwords don't match";
					}
				}
			else
			{
				$msg= "Invalid username and password";
			}
		}
		else
		{
			$msg= "Fields kept empty";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
</head>
<body>
<table align="center">
	<tr>
    	<td>
            <fieldset>
           		 <legend align="center">Change Password</legend>
                	<form action="" method="post">
                        <table align="center">
                        <tr>
                              <td colspan="2" align="center">
                                    <font size="+2" color="#FF0000">
											<?php 
                                                echo $msg; 
                                            ?>
                                    </font>
                              </td>
               			 </tr>
                         <tr>
                                <td>
                                    User Name:
                                </td>
                                <td>
                                    <input type="text" name="txtUserName" readonly value="<?php echo $_SESSION["userName"]?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Password:
                                </td>
                                <td>
                                    <input type="password" name="txtPassword" required title="Enter the Password"/>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    New Password:
                                </td>
                                <td>
                                    <input type="password" name="txtNewPassword" required title="Enter the New Password"/>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    Confirm Password:
                                </td>
                                <td>
                                    <input type="password" name="txtConfirmPassword" required title="Enter the Password to be confirmed"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" value="Update" name="btnUpdate" /> &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; 
                                    <input type="button" value="Cancel" name="btnCancel" onClick="window.location.replace('manage_profile.php')" />		
                                    <!--for onclick , input type must be button-->
                          
                                </td>
                            </tr>        
                        </table>
                   </form>
            </fieldset>
		</td>
	</tr>
</table>	
</body>
</html>
