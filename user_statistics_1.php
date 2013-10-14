<?php
require_once('includes/config.php');
require_once(SITE_ROOT_PATH.'includes/initialize.php');
require_once(SITE_ROOT_PATH.'header.php'); 
require_once(SITE_ROOT_PATH.'quicksave/record.php') 
?>
<?php $title = 'Bar Team user statistics'; ?>
<title><?php echo $title; ?></title>

</head>

<body>
<div class="content">
  <?php require_once('login.php'); ?>
  <?php require_once('navigation.php'); ?>
  
  
  <h1>Official Statistics Of The Bar Team</h1>
  <?php 

if( isset($_POST['submit']) && isset($_SESSION['user_id']) ){ 

	$user_pass_phrase = sha1($_POST['verify']);	
	if ( $_SESSION['pass_phrase'] == $user_pass_phrase ) {
	//(be simple!)
	$category_circle = $_POST['category_circle'];
	$category_1 = $_POST['category_1'];
	$category_2 = $_POST['category_2'];
	$category_3 = $_POST['category_3'];
	$category_4 = $_POST['category_4'];
	$category_5 = $_POST['category_5'];
	$category_6 = $_POST['category_6'];
	$user_thoughts = $_POST['user_thoughts'];
	$user_info_id = $_SESSION['user_info_id'];
	$today = date('Y-m-d');
	//-放超人机制-------------------------------
	if($category_circle > 20 ) { $category_circle = 0; echo 'BOY! you are not a superman~'; }
	if($category_1 > 100 ) { $category_1 = 0; echo 'BOY! you are not a superman~'; }
	if($category_2 > 100 ) { $category_2 = 0; echo 'BOY! you are not a superman~'; }
	if($category_3 > 20 ) { $category_3 = 0; echo 'BOY! you are not a superman~'; }
	if($category_4 > 100 ) { $category_4 = 0; echo 'BOY! you are not a superman~'; }
	if($category_5 > 200 ) { $category_5 = 0; echo 'BOY! you are not a superman~'; }
	if($category_6 > 200 ) { $category_6 = 0; echo 'BOY! you are not a superman~'; }
	//--------------------------------------------
	
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$query1 = "INSERT INTO user_statistics".
	"(id, user_info_id, category_circle, category_1,category_2, category_3, category_4, category_5, category_6, user_thoughts, user_date)".
	"VALUES(NULL, '$user_info_id',".
	" '$category_circle', '$category_1', '$category_2', '$category_3', '$category_4', '$category_5', '$category_6', '$user_thoughts', '$today')";
	$queryif = "SELECT * FROM user_statistics WHERE user_info_id = '$user_info_id' AND user_date = '$today'";
	$query2 = "UPDATE  user_statistics SET ".
	"category_circle = '$category_circle', category_1 = '$category_1', category_2 = '$category_2', category_3 = '$category_3'".
	", category_4 = '$category_4', category_5 = '$category_5', category_6 = '$category_6' ,user_thoughts = '$user_thoughts ' ".
	" WHERE user_info_id = '$user_info_id' AND user_date = '$today'";
	mysqli_query($dbc,"SET NAMES 'utf8'");
	$resultsif = mysqli_query($dbc, $queryif);
	if(mysqli_num_rows($resultsif) == 1){
	$result2 = mysqli_query($dbc, $query2);
	echo '今日数据已更新.';
	}
	else{
	$result1 = mysqli_query($dbc, $query1);
	echo '已成功保存今日数据.';
	//echo $category_circle , $category_1, $category_2, $category_3, $category_4, $category_5 , $category_6, $user_info_id;
	
	}
	mysqli_close($dbc);
	
	}

	else{
	echo '验证码错误,其他自己找';
	}
  	
 
}
if( !isset($_SESSION['user_id'] ) )
echo '本功能只开放给注册用户,谢谢合作';

 ?>
  <hr size="1"/>
  
  <script type="text/javascript">
       //
	   $(function(){
				
	       $("#form1").validate(
		   {
			 
	            rules: {    //自定义验证规则
				        category_circle: { number: true},
						category_1: { number: true},
						category_2:  { number: true},
						category_3 : {  number: true },
						category_4 : { number: true},
						category_5 : { number: true},
						category_6 : { number: true}
				 }
			
			 		   
	       });
		
	   });
      
	      

</script>
<style type="text/css">

label.error { float: none; color: red; padding-left: .5em; vertical-align: top;  width:auto;}

</style>
 <span style="color: #F0F">
右边看上去很诡异的东西是使用说明(需要登录...):<br />
来源: 应社长要求要添加一个快速记录的功能.<br />
制作时间:3周吧..实际时间也就1天<br />
使用方法:<br />
1.在左边输入完数据后(保存)<br />
2.点击保存按钮进行保存(保存)<br />
3.点击使用方案按钮使用方案中的数据(使用已保存数据)
 </span>



  <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

  <table>
  <tr>
  <td>
    <h2>Circle</h2><br />
    <label for="textfield">跑圈</label>
    <input type="text" name="category_circle" id="category_circle" value="0"/>
    <h2>单杠</h2><br />
    <label for="textfield">正手</label>
    <input type="text" name="category_1" id="category_1" value="0"/>
    <br /><br />
    <label for="textfield">反手</label>
    <input type="text" name="category_2" id="category_2" value="0"/>
    <br /><br />
    <label for="textfield">前翻</label>
    <input type="text" name="category_3" id="category_3" value="0"/>
    <br />
    <h2>双杠</h2>
    <br />
    <label for="textfield">撑</label>
    <input type="text" name="category_4" id="category_4" value="0"/>
    <br />
    <h2>More</h2>
    <br />
    <label for="textfield">俯卧撑</label>
    <input type="text" name="category_5" id="category_5" value="0"/>
    <br /><br />
    <label for="textfield">仰卧起坐</label>
    <input type="text" name="category_6" id="category_6" value="0"/>
    <br /><br />
    </td>
    <?php if(isset($_SESSION['user_id'])){?>
    <td>
    <div>
    Note:<br />
    跑圈<br />
    正手<br />
    反手<br />
    前翻<br />
    撑<br />
    俯卧撑<br />
    仰卧起坐<br /><br /><br /><br />
    </div>
    </td>
   
    <td>
  <div id="solution0">
    快速记录 方案 1
    <?php
	$records = xmlUtil::readXml('quicksave/' . $_SESSION['user_id']);
	  echo '<br/>';
	  echo $records['solution'][0]['category_circle'].'<br/>'; 
	  echo $records['solution'][0]['category_1'].'<br/>' ;
	  echo $records['solution'][0]['category_2'].'<br/>' ;
	  echo $records['solution'][0]['category_3'].'<br/>' ;
	  echo $records['solution'][0]['category_4'].'<br/>' ;
	  echo $records['solution'][0]['category_5'].'<br/>' ;
	  echo $records['solution'][0]['category_6'].'<br/>' ;

	?>
    <input name="" type="button" onclick="saveToXml(0)" value="保存方案一" /><br/>
    <input name="" type="button" onclick="useSolution(0)" value="使用方案一" />
    </div>
    </td>
    
  
 	<td>
      <div id="solution1">
    快速记录 方案 2
    <?php
	
	  echo '<br/>';
	  echo $records['solution'][1]['category_circle'].'<br/>'; 
	  echo $records['solution'][1]['category_1'].'<br/>' ;
	  echo $records['solution'][1]['category_2'].'<br/>' ;
	  echo $records['solution'][1]['category_3'].'<br/>' ;
	  echo $records['solution'][1]['category_4'].'<br/>' ;
	  echo $records['solution'][1]['category_5'].'<br/>' ;
	  echo $records['solution'][1]['category_6'].'<br/>' ;



	?>
    <input name="" type="button" onclick="saveToXml(1)" value="保存方案貳" /><br/>
    <input name="" type="button" onclick="useSolution(1)" value="使用方案貳" />
    </div>
    </td>
    
    
    <td>
    <div id="solution2">
    快速记录 方案 3
    <?php
	
	  echo '<br/>';
	  echo $records['solution'][2]['category_circle'].'<br/>'; 
	  echo $records['solution'][2]['category_1'].'<br/>' ;
	  echo $records['solution'][2]['category_2'].'<br/>' ;
	  echo $records['solution'][2]['category_3'].'<br/>' ;
	  echo $records['solution'][2]['category_4'].'<br/>' ;
	  echo $records['solution'][2]['category_5'].'<br/>' ;
	  echo $records['solution'][2]['category_6'].'<br/>' ;



	?>
    <input name="" type="button" onclick="saveToXml(2)" value="保存方案叁" /><br/>
    <input name="" type="button" onclick="useSolution(2)" value="使用方案叁" />
    </div>
    </td>
    <?php }//endif(session)?>
    <tr>
 </table> 

 <script> $(document).ready(function(){
    
	
	
}); 

function saveToXml (where) {
		
        $.post( "<?php echo curPageURL();?>/quicksave/record_process.php?where="+where+"&filename=<?php echo $_SESSION['user_id']; ?>&category_circle="+$("#category_circle").val()+"&category_1="+$("#category_1").val()+"&category_2="+$("#category_2").val()+"&category_3="+$("#category_3").val()+"&category_4="+$("#category_4").val()+"&category_5="+$("#category_5").val()+"&category_6="+$("#category_6").val(), {where:where}, 
                function(data) {
					$("#solution"+where).html(data);

                }
        );
}

function useSolution(where){

$.post( "<?php echo curPageURL();?>/quicksave/record_read.php?where="+where+"&filename=<?php echo $_SESSION['user_id']; ?>&category_circle="+$("#category_circle").val()+"&category_1="+$("#category_1").val()+"&category_2="+$("#category_2").val()+"&category_3="+$("#category_3").val()+"&category_4="+$("#category_4").val()+"&category_5="+$("#category_5").val()+"&category_6="+$("#category_6").val(), {where:where}, 
                function(data) {
					var records = data.trim().split(",");
					$("#category_circle").val(records[0]);
					$("#category_1").val(records[1]);
					$("#category_2").val(records[2]);
					$("#category_3").val(records[3]);
					$("#category_4").val(records[4]);
					$("#category_5").val(records[5]);
					$("#category_6").val(records[6]);
                }
        );


}







</script>  
    <h2>Addition</h2>
    Thoughts:<br />
    <textarea name="user_thoughts" cols="60" rows="6">什么都没有想~</textarea>
    <br />
    <br />
    <label for="textfield">验证码</label>
    <input name="verify" type="text" id="textfield" size="6" />
    <img name="img1" src="captcha.php" alt="Verification pass-phrase" style="cursor : pointer;" onClick="this.src='captcha.php?t='+(new Date()).getTime();''">
    
    <br />
    
    <br />
    <input name="submit" type="submit" value="保存今日数据" />
    
  </form>
  <hr size="1"/>	
  
  
  
  
  
  <?php require('footer.php'); ?>
</div>
</body>


</html>
