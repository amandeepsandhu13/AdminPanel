<?php
	$msg="";
	include("../include/settings.php");
	include("check_session.php");
	if(isset($_POST["btnSearch"]))
	{
		$text=$_POST["txtSearch"];
		$sql=$mysqli->prepare("select usermaster.User_Id,userdetails.Name,usermaster.User_Type,userdetails.Email_Id,userdetails.Phone from usermaster inner join userdetails on usermaster.user_id=userdetails.user_id where Name like ?");
		$text='%'.$text.'%';
		$sql->bind_param("s",$text);
	}
	else
	{	
		$sql=$mysqli->prepare("select usermaster.User_Id,userdetails.Name,usermaster.User_Type,userdetails.Email_Id,userdetails.Phone from usermaster inner join userdetails on usermaster.user_id=userdetails.user_id");
		$sql->execute();
		$result=$sql->get_result();
	}
	$sql->execute();
	$result=$sql->get_result();
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
</head>
<body>
<br><br><br><br>
    	<table border="1" cellspacing="0" cellpadding="10" align="center">
        	<tr>
            	<td align="center" style="font-size:40px;color:red">
                	Manage Users
                </td>
            </tr>
            <tr>
            	<td align="right">
                	<table cellspacing="0" cellpadding="0">
                    	<tr>
                        	
                            <td>
                            	 <a href="logout.php" name="lnkLogout">Logout</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            	<td>
                	<form method="post" action="">
                	<table cellpadding="10" cellspacing="0">
                    	<tr>
                        	<td width="300">
                            	<input type="button" onClick="window.location.replace('add_new_user.php')"  value="Add New User"/>
                            </td>
                            <td>
                            	Search: <input type="text" name="txtSearch" placeholder="Search Here"/> <input type="submit" value="Search"  name="btnSearch"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                </td>
            </tr>
            <td>
            	<table border="1" align="center" cellpadding="15" cellspacing="0">
                    <tr>
                        <td>
                            User Id
                        </td>
                        <td>
                            Name
                        </td>
                        <td>
                            Type
                        </td>
                        <td>
                            Email
                        </td>
                        <td>
                            Phone
                        </td>
                        <td>
                            Option
                        </td>
                    </tr>
     		 <?php
	                while($row=$result->fetch_object())
					{
				?>
                    <tr>
                    	<td align="center">
                        	<?php echo $row->User_Id ?> 
                        </td>
                        <td>
                        	<?php echo $row->Name ?>
                        </td>
                        <td>
                        	<?php echo $row->User_Type ?>
                        </td>
                        <td>
                        	<?php echo $row->Email_Id ?>
                        </td>
                        <td>
                        	<?php echo $row->Phone ?> 
                        </td>
                        <td>
                        	<a href="edit_user.php?id=<?php echo $row->User_Id ?>"  title="Edits the user" name="lnkEditProfile">Edit</a>		<!--query string-->
                        </td>
                    <?php
							}
    					?>
                    </tr>
                </table>
            </td>
        </table>     
    </form>	
</body>
</html>