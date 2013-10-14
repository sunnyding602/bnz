<?php
require_once('../includes/initialize.php');
if( !empty($_SESSION['message']) )
echo output_message($_SESSION['message']);
unset($_SESSION['message']);
?>
<div style="width:80%;margin:0 0 0 26px;" id="subMsg">
<form id="post" name="post" action="fabiao2.php" method="post">

 <table width="100%" border="0" cellspacing="1" cellpadding="3" align=center  >

<tr>
      <td valign="top" width=85 nowrap >标　题:</td>
      <td >
        <input type="text" id="ti" name="biaoti" style="width:425px;" value="回复" readonly="readonly" >
		<input type="hidden" name="topic_id" value="<?php if( isset($topic_id) ) echo $topic_id;?>" />

</td>
<td rowspan="4" width=180 valign="top">


</td>
</tr>
<tr >
<td valign="top" >内　容:</td>
<td>
<div >
	<textarea id="co" name="neirong" style="width:425px;height:150px;" ></textarea>
</div>

</td>
</tr>
<tr>
<td valign="top" >图片链接:</td>
<td >
<input name="tupianlianjie" type="text" id="str1"  style="width:310px" value="http://" >
</td>
</tr>
<tr>
      <td >用户名:</td>
      <td>

<div style="margin-top:-3px">
<input name="yonghuming" type="text" readonly="ture" value="<?php if( isset($_SESSION['user_nickname']) ) 
echo $_SESSION['user_nickname']; else echo '非会员';?>">
</div>


</td>
</tr>
<tr>
<td valign=middle align="left" colspan=2>
<div ><label for="textfield">验证码</label>
	<input name="verify" type="text" id="textfield" size="6" />
		  <img name="img1" src="../captcha.php" alt="Verification pass-phrase" style="cursor : pointer;" onclick="this.src='../captcha.php?t='+(new Date()).getTime();''"></div>
</td>
</tr>
<tr>
<td valign="top" >&nbsp;</td>
<td>
<input type="submit" id="Submit3" name="submit_fabiao2" value="发表贴子">&nbsp;&nbsp; <a name="sub"></a></td>
<td>&nbsp;</td>
</tr>
<tr align="left">
<td valign="top" colspan="3">
</td>
</tr>
</table>

</form>
</div>

