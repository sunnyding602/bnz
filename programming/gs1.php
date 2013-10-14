<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html;charset=gb2312">

		<title>公式1</title>
	</head>

	<body>
	公式1<br /><br />
	请输入以下数据以便计算结果：
	<?php
		$a=7.7;
		$c=10;
		$degree=0;
		//$degree2=0;
		$w=10;
		$t=7.7;

	if(isset($_GET["submit"])){
		//定义一些常量
		$PI=3.1415926;
		$a=$_GET["a"];
		$c=$_GET["c"];;
		$degree=$_GET["degree"];
		//$degree2=0;
		$w=$_GET["w"];
		$t=$_GET["t"];

		$Q=1.0+1.464*pow( ($a/$c),1.65 );
		$M1=1.13-0.09*($a/$c);
		$M2=-0.54+0.89/(0.2+$a/$c);
		$M3=0.5-1/(0.65+$a/$c)+14*pow( (1-$a/$c) ,24);
		$g1=1+( 0.1+0.35*pow($a/$c,2) )*pow( 1-sin(deg2rad($degree)) ,2 );
		$Fd=pow( ( pow(($a/$c),2)*pow(cos(deg2rad($degree)),2) + pow(sin(deg2rad($degree)),2) ) , 1/4);
		$Fw=pow(1/cos($PI*$c*sqrt($a/$t)/2*$w),0.5);
		
		$Fy=( $M1+$M2*pow($a/$c,2)+$M3*pow($a/$c,4) ) * $g1 * $Fd * $Fw;

		$K = sqrt($PI*$t/$Q) * $Fy;
	}
		
	?>
	<form action="gs1.php" method="get">
	裂纹深度：<input type="text" name="a"> <br />
	孔径：<input type="text" name="c"><br />
	孔密：<input type="text" name="w"><br />
	角度：<input type="text" name="degree"><br />
	套管壁厚：<input type="text" name="t"><br /><br />
	<input type="submit" name="submit" value="获得数据">
	</form>

	<?php
	if(isset($K))
		echo '结果：',$K;
	?>
	</body>
</html>