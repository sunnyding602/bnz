<?php
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
require_once(SITE_ROOT_PATH.'header.php'); 
?>
<?php $title = 'The Muscle Training Website'; ?>
<title><?php echo $title; ?></title>
</head>

<body>
<div class="content">
  <?php require_once('login.php'); ?>
  <tr>
    <td>
  <h1>Muscle training Website</h1>
  <h2>your level in the real world</h2>
  <hr size="1"/>
      you won't be the world's strongest man,this website will never change 
      your dream,but others. let them dream of being you.<br /><br />
      
  <?php require('approval1.php');?>
  <hr size="1"/>	
      </td>
    
    <?php //require_once('navigation.php'); ?>
    
    </tr>
  </table>
  <br /><br />
  <a href="index.php">返回</a><br /><br /><br />
  <?php require('footer.php'); ?>
</div>
</body>


</html>
