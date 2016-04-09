<?php
	session_start();
	require "DBAccessorClass.php";
	
	$errMsg = "";
	
	if(isset($_POST["hdnTrans"])){
		if($_POST["hdnTrans"] === "regist"){
			// 登録ボタンが押された場合。
			// 登録処理を行う。			
			$mail = $_SESSION["mail"]; // メールアドレス
			$year = $_SESSION["year"]; // 年
			$month = $_SESSION["month"]; // 月
			$day = $_SESSION["day"]; // 日
			$addr = $_SESSION["addr"]; // 都道府県
			
			//$dbAccessor = new DBAccessor();
			//$stmt = $dbAccessor->insertRegist($mail, $year, $month, $day, $addr);
			
			header("Location: ../contents/complete.php");
		}else if($_POST["hdnTrans"] === "return"){
			// 戻るボタンが押された場合、入力画面へ遷移する。
			header("Location: ../contents/regist.php");
		}
	}
	
	// 入力画面から送られてきた情報を取得する。	
	$mail = $_SESSION["mail"]; // メールアドレス
	$year = $_SESSION["year"]; // 年
	$month = $_SESSION["month"]; // 月
	$day = $_SESSION["day"]; // 日
	$addr = $_SESSION["addr"]; // 都道府県
	
	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>メルマガ登録確認</title>
<link rel="stylesheet" type="text/css" href="../css/reset.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/contentsRegist.css" media="all">
</head>
<body>
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../js/commonRegist.js"></script>
<script type="text/javascript">
// 戻るボタン押下
function fncReturn(){

	$("#hdnTrans").val("return");
	$("#frmRgstConfirm").submit();
	
}
// 登録ボタン押下
function fncRegist(){
	
	$("#hdnTrans").val("regist");
	$("#frmRgstConfirm").submit();
	
}
</script>
<form id="frmRgstConfirm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="post">
    <input type="hidden" id="hdnTrans" name="hdnTrans"/>
    <div id="divRgst">
    	<div id="divRgstHead">
        	<img src="../images/imgMailMagHeader.png" alt="fravum shop MailMagagine" width="686" height="26">
        </div>
        <div id="divRgstNav">
            <ol type="1">
                <li id="liImgInAddr"><img src="../images/imgInAddrOff.gif" alt="アドレス入力" width="175" height="45"></li>
                <li id="liImgConfirm"><img src="../images/imgConfirmOn.gif" alt="登録確認" width="175" height="45"></li>
                <li id="liImgComplete"><img src="../images/imgCompleteOff.gif" alt="登録完了" width="175" height="45"></li>
            </ol>
        </div>
        <div id="divMailMagTitle">
        	<img src="../images/imgMailMagConf.png" alt="登録確認" width="686" height="24">
        </div>
        <div id="divConfMain">
            <div id="divRgstInput">
				<hr id='hr1'>
				<div id='divImgMailHead'><img src='../images/imgMailHeadConf.png' alt='メールアドレス' width='160' height='29'></div><div id='divTxtMail'><p><span class='clsFontGothic clsSize13'><?php echo $mail ?></span></p></div>
				<hr id='hr2'>
				<div id='divImgBirthHead'><img src='../images/imgBirthHeadConf.png' alt='生年月日' width='160' height='29'></div><div id='divBirth'><p><span class='clsFontGothic clsSize13'><?php echo $year." 年 ".$month." 月 ".$day." 日" ?></span></p></div>
				<hr id='hr3'>
				<div id='divImgAddrHead'><img src='../images/imgAddrHead.png' alt='お住まい' width='160' height='29'></div><div id='divAddr'><p><span class='clsFontGothic clsSize13'><?php echo $addr ?></span></p></div>
				<hr id='hr4'>
            </div>
            <div id="divConfMsg">
            	<p class="clsFontGothic clsSize13">上記の内容でよろしければ「登録する」ボタンを押してください</p>
            </div>
            
            <div id="divBtnCommit">
                <div id="divBtnBack">
                    <a href="#" class="rollover"><img src='../images/imgBtnBackOff.png' width="147" height="40" alt='戻る' onclick='fncReturn();'/></a>
                </div>
                <div id="divBtnRegist">
                    <a href="#" class="rollover"><img src='../images/imgBtnRegistOff.png' width="147" height="40"  alt='登録' onclick='fncRegist();return false;'/></a>
                </div>
            </div>
        </div>
    </div>
</form>
</body>

</html>