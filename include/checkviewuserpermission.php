<?php
function check_view_user_permission()
{
if($_SESSION['viewusers'] == 0 && $_SESSION['admin'] == 0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="../Dashboard/";		
		header("Location: http://$host$uri/$extra");
	}
}

function check_edit_user_permission()
{
if($_SESSION['editusers'] == 0 && $_SESSION['admin'] == 0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="../Dashboard/";		
		header("Location: http://$host$uri/$extra");
	}
}

function check_edit_diseases_permission()
{
if($_SESSION['editdiseases'] == 0 && $_SESSION['admin'] == 0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="../Dashboard/";		
		header("Location: http://$host$uri/$extra");
	}
}

function check_edit_roles_permission()
{
if($_SESSION['editroles'] == 0 && $_SESSION['admin'] == 0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="../Dashboard/";		
		header("Location: http://$host$uri/$extra");
	}
}
function check_edit_conditions_permission()
{
if($_SESSION['editconditions'] == 0 && $_SESSION['admin'] == 0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="../Dashboard/";		
		header("Location: http://$host$uri/$extra");
	}
}

function check_admin_permission()
{
if($_SESSION['admin'] == 0)
	{	
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra="../Dashboard/";		
		header("Location: http://$host$uri/$extra");
	}
}
?>