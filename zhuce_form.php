<?php echo output_message($_SESSION['message']); $_SESSION['message']=''; ?>

<script type="text/javascript">
       //
	   $(function(){
				
	       $("#regForm").validate(
		   {
			 
	            rules: {    //自定义验证规则
				        user_id1: {required:true,minlength: 3},
						user_nickname1: {required:true,minlength: 3},
						user_password1:  {required:true,minlength: 6},
						user_password2 : { equalTo: "#user_password1" },
						user_email : {required:true,email: true}
				 }
			
			 		   
	       });
		
	   });
      
	      

</script>
<style type="text/css">

label.error { float: none; color: red; padding-left: .5em; vertical-align: top;  width:auto;}

</style>
<table width="613" height="435" background="bar_image/image/2222.jpg" vspace="100" hspace="100" >
  <tr><td>
	<form action="zhuce_tijiao.php" method="post" id="regForm" >

	记录你的每一天<br /><br />
	<label for="user_id1">登录名</label>
	<input name="user_id1" type="text" id="user_id1" />
	<br /> <br />
	<label for="user_nickname1">昵称</label>
	<input name="user_nickname1" type="text" id="user_nickname1"/>
	<br /> <br />
    <label for="user_password1">密码</label>
	<input name="user_password1" type="password" id="user_password1" />
    <br /> <br />
    <label for="user_password2">确认密码</label>
	<input name="user_password2" type="password" id="user_password2" />
    <br /> <br />
    <label for="user_email">电子邮件</label>
	<input name="user_email" type="text" id="user_email"/>
    <br /> <br />
	<label for="verify">验证码</label>
	<input name="verify" type="text" id="verify" size="6"  />
	

	<img name="img1" src="captcha.php" alt="Verification pass-phrase" style="cursor : pointer;" onclick="this.src='captcha.php?t='+(new Date()).getTime();''">
	<br /> <br />
	<input id="submit_tijiao" name="submit_tijiao" type="submit" value="注册">
	<input name="reset" type="reset" value="重置">
     
</form>




</td></tr>
</table>
