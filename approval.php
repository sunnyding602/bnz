<?php session_start(); ?>
<?php require_once('header.php'); ?>
<?php require_once('connectvars.php') ?>
<?php $title = 'The Muscle Training Website'; ?>
<title><?php echo $title; ?></title>
</head>

<body>
<?php require_once('login.php'); ?>
<tr>
	<td>
<h1>admin page,add users</h1>

<hr/>
you won't be the world's strongest man,this website will never change 
your dream,but others. let them dream of being you.<br /><br />
	
		
		</td>
		
		<?php //require_once('navigation.php'); ?>
		
	</tr>
</table>
<?php require_once('approval.php');?>
<?php require('footer.php'); ?>
</body>


</html>