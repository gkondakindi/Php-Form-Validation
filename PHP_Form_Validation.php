<html>
<body>
<?php
$name = $email = $website = $comment = $gender = '';
$nameErr = $emailErr = $websiteErr = $commentErr = $genderErr = '';
if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(empty($_POST['name']))
		$nameErr = 'Name should not be empty';
	else
	{
		$name = modifyinput($_POST['name']);
		if(!preg_match("/^\w*$/",$name))
			$nameErr = 'Name should contain only alphanumerals';
	}
	if(empty($_POST['email']))
		$emailErr = 'Email should not be empty';
	else
	{
		$email = modifyinput($_POST['email']);
		if(!preg_match("/[\w\-]+@[\w\-]+\.[\w\-]+/",$email))
			$emailErr = 'Email should be in proper format';
	}
	if(empty($_POST['website']))
		$website = '';
	else
	{
		$website = modifyinput($_POST['website']);
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
			$websiteErr = 'Invalid URL';
	}
	if(empty($_POST['comment']))
		$comment = '';
	else
		$comment = modifyinput($_POST['comment']);
	if(empty($_POST['gender']))
		$genderErr = 'Please select a gender';
	else
		$gender = modifyinput($_POST['gender']);
	
}
function modifyinput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<table>
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name" value="<?php echo $name;?>"> *<?php echo $nameErr;?></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" value="<?php echo $email;?>">*<?php echo $emailErr;?></td>
		</tr>
		<tr>
			<td>Website:</td>
			<td><input type="text" name="website" value="<?php echo $website;?>"><?php echo $websiteErr;?></td>
		</tr>
		<tr>
			<td>Comment:</td>
			<td><textarea name="comment" rows="5" columns="50" value="<?php echo $comment;?>"></textarea><?php echo $commentErr;?></td>
		</tr>
		<tr>
			<td>Gender:</td>
			<td><input type="radio" name="gender" <?php if(isset($gender) && $gender=="female") echo "checked";?> value="female"> Female
				<input type="radio" name="gender" <?php if(isset($gender) && $gender=="male") echo "checked";?> value="male"> Male *<?php echo $genderErr;?></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center"><input type="submit" value="submit"></td>
		</tr>
	</table>
</form>
</body>
</html>