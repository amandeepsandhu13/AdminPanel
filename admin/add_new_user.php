<?php
$msg="";
include("../include/settings.php");
include("check_session.php");
if(isset($_POST['btnRegister']))
{	
	if(($_POST["txtUserName"]!=null)&& ($_POST["txtUserType"]!=null)&& ($_POST["txtName"]!=null)&& ($_POST["txtAddress"]!=null)&& ($_POST["txtCity"]!=null)&& ($_POST["txtState"]!=null)&& ($_POST["txtCountry"]!=null)&& ($_POST["txtPhone"]!=null)&& ($_POST["txtEmailId"]!=null))
	{
				$sql=$mysqli->prepare("select count(*) from usermaster where User_Name=?");
				$sql->bind_param("s",$_POST["txtUserName"]);
				$sql->execute();
				$sql->bind_result($check);
				$sql->fetch();
				$sql->close();
				if($check==0)
				{
					$pass=mt_rand(177,786);
					$sql=$mysqli->prepare("insert into usermaster(User_Name,Password,User_Type)values(?,?,?)");
					$sql->bind_param("sss",$_POST["txtUserName"],$pass,$_POST["txtUserType"]);
					$sql->execute();
					$sql->close();
					$sql=$mysqli->prepare("select max(User_Id) from usermaster");
					$sql->execute();
					$sql->bind_result($id);
					$sql->fetch();
					$sql->close();	
					$sql=$mysqli->prepare("insert into userdetails(User_Id,Name,Address,City,State,Country,Phone,Email_Id)values(?,?,?,?,?,?,?,?)");
					$sql->bind_param("isssssss",$id,$_POST["txtName"],$_POST["txtAddress"],$_POST["txtCity"],$_POST["txtState"],$_POST["txtCountry"],$_POST["txtPhone"],$_POST["txtEmailId"]);
					$sql->execute();
					$sql->close();
					if($msg="Record inserted Successfully")
					{
						header("Location:manage_users.php");
					}
				}
				else
				{
					$msg="User Already exist";
				}
	}
	else
	{
		$msg="Fields can't be left empty";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add New User</title>
</head>
<body>
<form action="" method="post">
	<table cellpadding="10" cellspacing="0" border="1" align="center">
    	<tr>
        	<td align="center" style="font-size:30px;color:red">
            	ADD NEW USER
            </td>
        </tr>
        <tr>
        	<td>
            	&nbsp;&nbsp;<a href="manage_users.php" name="lnkManageUsers" >Manage Users</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="logout.php" name="lnkLogout">Logout</a>
            </td>
        </tr>
        <tr>
        	<td>
            	<fieldset>
                	<legend align="center"> Account Information</legend>
                 <table cellspacing="0">
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
                    	<td width="120">
                        	Username:
                        </td>
                        <td>
                        	<input type="text" name="txtUserName" title="Enter Username" required />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	User Type:
                        </td>
                        <td>
                        	<select name="txtUserType">
                            	<option>Admin</option>
                                <option>Employee</option>
                            </select>
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
                        	<input type="text" name="txtName" title="Enter Name" required  />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Address:
                        </td>
                        <td>
                       		<textarea rows="4" cols="16" name="txtAddress" title="Enter Address" required ></textarea> 	
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	City:
                        </td>
                        <td>
                        	<input type="text" name="txtCity" title="Enter City" required />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	State:
                        </td>
                        <td>
                        	<input type="text" name="txtState" title="Enter State" required  />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Country:
                        </td>
                        <td>
                        	<input type="text" name="txtCountry" title="Enter Country" required />
                        </td>
                    </tr>
                     <tr>
                    	<td>
                        	Phone:
                        </td>
                        <td>
                        	<input type="text" name="txtPhone" title="Enter Phone Number" required  />
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	Email Id:
                        </td>
                        <td>
                        	<input type="email" name="txtEmailId" title="Enter Email id" required />
                        </td>
                    </tr>
                     <tr>
                    	<td  align="center" colspan="2">
                        	<input type="submit" value="Register" name="btnRegister"/>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="reset" value="Reset" name="btnReset"/>
                        </td>
                    </tr>
                </table>   
                </fieldset>
            </td> 
        </tr>
    </table>
    </form>
</body>
</html>