<?php
	$msg="";
	include("../include/settings.php");
	include("check_session.php");
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
           		View Profile
			
            </td>
		</tr>
        <tr>
        	<td align="center">
            <table cellpadding="0" cellspacing="10">
                <tr>
                    <td colspan="2" align="center">
                      	<font size="+2" color="#FF0000">
							<?php 
								echo $msg; 
							?>
                        </font>
					</td>
					<td>					
						<a href="change_password.php" name="lnkChangePassword" >Change Password</a>
					</td>
					<td>	
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../admin/logout.php" name="lnkLogout">Logout</a>
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
                        	<?php echo $row->User_Name ?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Password:
                        </td>
                        <td>
                        	<?php echo $row->Password ?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Confirm Password:
                        </td>
                        <td>
                        <?php echo $row->Password ?>
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
                        	<?php echo $row->Name ?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Address:
                        </td>
                        <td>
                       	<?php echo $row->Address ?> 	
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	City:
                        </td>
                        <td>
                        	<?php echo $row->City ?>
                       </td>
                    </tr>
                    <tr>
                    	<td>
                        	State:
                        </td>
                        <td>
                        	<?php echo $row->State ?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Country:
                        </td>
                        <td>
                        	<?php echo $row->Country ?>
                        </td>
                    </tr>
                     <tr>
                    	<td>
                        	Phone:
                        </td>
                        <td>
                        	<?php echo $row->Phone ?>
                       </td>
                    </tr>
                    <tr>
                    	<td>
                        	Email Id:
                        </td>
                        <td>
                      	  <?php echo $row->Email_Id ?>
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