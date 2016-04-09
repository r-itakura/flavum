<?php
	session_start();
	
	if(isset($_POST["hdnTrans"])){
		if($_POST["hdnTrans"] === "close"){
			// 閉じるボタンが押された場合
			// セッション情報クリア
			$_SESSION = array(); 
			session_destroy();
			
			echo "<script type='text/javascript'>";
			echo "window.close();";
			echo "</script>";
			return;
		}
	}	
	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>メルマガ登録完了</title>
<link rel="stylesheet" type="text/css" href="../css/reset.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/contentsRegist.css" media="all">
</head>
<body>
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../js/commonRegist.js"></script>
<script type="text/javascript">
// flavumトップへボタン押下
function fncClose(){

	$("#hdnTrans").val("close");
	$("#frmRgstComplete").submit();
	
}
</script>
<form id="frmRgstComplete" action="<?php print($_SERVER['PHP_SELF']) ?>" method="post">
    <input type="hidden" id="hdnTrans" name="hdnTrans"/>
    <div id="divRgst">
    	<div id="divRgstHead">
        	<img src="../images/imgMailMagHeader.png" alt="fravum shop MailMagagine" width="686" height="26">
        </div>
        <div id="divRgstNav">
            <ol type="1">
                <li id="liImgInAddr"><img src="../images/imgInAddrOff.gif" alt="アドレス入力" width="175" height="45"></li>
                <li id="liImgConfirm"><img src="../images/imgConfirmOff.gif" alt="登録確認" width="175" height="45"></li>
                <li id="liImgComplete"><img src="../images/imgCompleteOn.gif" alt="登録完了" width="175" height="45"></li>
            </ol>
        </div>
        <div id="divCompMain">
            <div id="divCompMsg">
            	<p class="clsFontGothic clsSize13">ご登録ありがとうございました。</p>
            </div>
            <div id="divBtnTop">
                <a href="#" class="rollover"><img src='../images/imgBtnCloseOff.png' width="147" height="40" alt='閉じる' onclick='fncClose();'/></a>
            </div>
        </div>
    </div>
</form>
</body>

</html>