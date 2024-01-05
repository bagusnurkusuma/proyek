<?php
	session_start();
	include "koneksi.php";
	
// $data = pg_query($koneksi, "SELECT * FROM user_role.user_role");
// while($row = pg_fetch_object($data))
	
	$login = pg_query($link,"select * from user_role.user_role where username ='$_POST[user]' and password ='$_POST[pass]'");
	$rowcount = pg_num_rows($login);
	if ($rowcount == 1)
	{
		$_SESSION['username'] = $_POST['user'];
		header("location: side_bar.php");
	}
	else
	{
		echo "<center>Username atau Password anda Salah";
		echo " <a href='login.html'>login</a></p>";
		}
?>