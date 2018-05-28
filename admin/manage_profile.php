<?php
	$msg="";
	include("../include/settings.php");
	include("check_session.php");
	if(isset($_POST["btnUpdate"]))
	{
		if(($_POST["txtUsername"]!=null)&& ($_POST["txtPassword"]!=null)&& ($_POST["txtConfirmPassword"]!=null)&& ($_POST["txtName"]!=null)&& ($_POST["txtAddress"]!=null)&& ($_POST["txtCity"]!=null)&& ($_POST["txtState"]!=null)&& ($_POST["txtCountry"]!=null)&& ($_POST["txtPhone"]!=null)&& ($_POST["txtEmailId"]!=null))
		{
			if($_POST["txtPassword"]==$_POST["txtConfirmPassword"])
			{
				//$user_id=$_SESSION["userId"];
				$sql1=$mysqli->prepare("update usermaster set Password=?  where user_id=?");
				$sql1->bind_param("si",$_POST["txtPassword"],$_SESSION["userId"]);
				$sql1->execute();
				$sql1->close();
								
				$sql2=$mysqli->prepare("update userdetails set Name=? , Address=? , City=? , State=? , Country=? , Phone=? , Email_id=?  where user_id=?");
				$sql2->bind_param("sssssssi",$_POST["txtName"],$_POST["txtAddress"],$_POST["txtCity"],$_POST["txtState"],$_POST["txtCountry"],$_POST["txtPhone"],$_POST["txtEmailId"],$_SESSION["userId"]);
				$sql2->execute();
				$sql2->close();
				
				$msg="Records Updated";
			}
			else
			{
				$msg= "Passwords don't match";
			}
		}
		else
		{
			$msg= "Please fill all the fields";
		}
	}
	$sql="select * from usermaster inner join userdetails on usermaster.user_id=userdetails.user_id where usermaster.User_Id=".'"'.$_SESSION["userId"].'"';
	$result=mysqli_query($mysqli,$sql);
	while($row=mysqli_fetch_object($result))
	{
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Profile</title>
</head>
<body>
<form action="" method="post">
	<table cellpadding="10" cellspacing="0" border="1" align="center">
    	<tr>
        	<td align="center" style="font-size:30px;color:red">
            	My Profile
            </td>
        </tr>
        <tr>
        	<td align="center">
            <table cellpadding="0" cellspacing="10">
            	<tr>
                	<td>
                    	<a href="manage_users.php" name="lnkManageUsers" >Manage Users</a>
                    </td>
                    <td>
                    	<a href="change_password.php" name="lnkChangePassword" >Change Password</a>
                    </td>
                    <td>
                    	 <a href="logout.php" name="lnkLogout">Logout</a>
                    </td>
                </tr>
                <tr>
                      <td colspan="2" align="center">
                      	<font size="+2" color="#FF0000">
							<?php 
								echo $msg; 
							?>
                        </font>
                      </td>
                </tr>
             </table>             
            </td>
        </tr>
        <tr>
        	<td>
            	<fieldset>
                	<legend align="center"> Account Information</legend>
                 <table cellspacing="0">
                 	<tr>
                    	<td width="120">
                        	Username:
                        </td>
                        <td>
                        	<input type="text" name="txtUsername" required title="Enter Name" readonly  value="<?php echo $row->User_Name ?>"/> 
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Password:
                        </td>
                        <td>
                        	<input type="password" name="txtPassword" required title="Enter Password" value="<?php echo $row->Password ?>"/>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Confirm Password:
                        </td>
                        <td>
                        	<input type="password" name="txtConfirmPassword" required title="Enter Password" value="<?php echo $row->Password ?>"/>
                        </td>
                    </tr>
                 </table>   
                </fieldset>
                
                <fieldset>
                	<legend align="center"> Personal Information </legend>
                 <table cellspacing="0">
                 	<tr>
                    	<td width="120">
                        	Name:
                        </td>
                        <td>
                        	<input type="text" required name="txtName" title="Enter the Name" value="<?php echo $row->Name ?>" />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Address:
                        </td>
                        <td>
                       		<textarea rows="4" cols="16" name="txtAddress" required title="Enter the Address"><?php echo $row->Address ?></textarea> 	
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	City:
                        </td>
                        <td>
                        	<input type="text" name="txtCity" required title="Enter the City" value="<?php echo $row->City ?>"/>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	State:
                        </td>
                        <td>
                        	<input type="text" name="txtState" required title="Enter the State" value="<?php echo $row->State ?>"/>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Country:
                        </td>
                        <td>
                        	<input type="text" name="txtCountry" required title="Enter the Country" value="<?php echo $row->Country ?>"/>
                        </td>
                    </tr>
                     <tr>
                    	<td>
                        	Phone:
                        </td>
                        <td>
                        	<input type="text" name="txtPhone" required title="Enter the Phone Number" value="<?php echo $row->Phone ?>"/>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Email Id:
                        </td>
                        <td>
                        	<input type="text" name="txtEmailId" required title="Enter the Email Id" value="<?php echo $row->Email_Id ?>"/>
                        </td>
                    </tr>
                     <tr>
                    	<td  align="center" colspan="2">
                        	<input type="submit" value="Update" name="btnUpdate"/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="reset" value="Reset" name="btnReset"/>
                        </td>
                    </tr>
                </table>   
                </fieldset>
            </td> 
        </tr>
    </table>
    <?php
	}
    ?>
    </form>
</body>
</html>