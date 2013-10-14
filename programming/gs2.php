<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=gb2312">

		<title>公式2</title>
	</head>

	<body>
	公式2<br /><br />
	请输入以下数据以便计算结果：
	<?php


	if(isset($_GET["submit"])){
		//定义一些常量
		$PI=3.1415926;
		$D=$_GET["D"];
		$t=$_GET["t"];;
		$o=$_GET["o"];
		$miu=$_GET["miu"];
		
		$b=0.465*$o*pow( (1-2*$miu*$miu),0.25)/( sqrt(($D-$t)*$t) );
		$K1 = 3+0.807*$b+0.360*$b*$b+0.073*$b*$b*$b+0.71*$b*$b*$b*$b;
		$K2 = 3+1.17*$b+5.15*$b*$b-3.33*$b*$b*$b+0.71*$b*$b*$b*$b;

		
	}
		
	?>
	<form action="gs2.php" method="get">
	套管外径：<input type="text" name="D"> <br />
	套管壁厚：<input type="text" name="t"> <br />
	射孔孔口直径：<input type="text" name="o"><br />
	泊松比：<input type="text" name="miu" value="0.25"><br />
													<br />
	<input type="submit" name="submit" value="获得数据">
	</form>

	<?php
	if(isset($K1)){
		echo 'K alpha：',$K1;
		echo '<br />';
		echo 'K yita: ', $K2;
	}
	?>
	</body>
</html>