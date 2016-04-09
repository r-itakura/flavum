<?php
	session_start();
	require "DBAccessorClass.php";
	
	$errMsg = "";
	
	if(isset($_POST["hdnTrans"])){
		if($_POST["hdnTrans"] === "confirm"){
			// 画面情報をセッションに格納する。
			$_SESSION["mail"] = $_POST["hdnTxtMail"]; // メールアドレス
			$_SESSION["year"] = $_POST["hdnSelYear"]; // 年
			$_SESSION["month"] = $_POST["hdnSelMonth"]; // 月
			$_SESSION["day"] = $_POST["hdnSelDay"]; // 日
			$_SESSION["addr"] = $_POST["hdnSelAddr"]; // 住所

			// 登録確認画面へ遷移する。
			header("Location: ../contents/confirm.php");
		}
	}	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>メルマガ登録</title>
<link rel="stylesheet" type="text/css" href="../css/reset.css" media="all">
<link rel="stylesheet" type="text/css" href="../css/contentsRegist.css" media="all">
</head>
<body>
<script type="text/javascript" src="../js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="../js/commonRegist.js"></script>
<script type="text/javascript">
// 初期表示時処理
$(document).ready(function(){
	// 画面項目初期化
	$("#txtMail").val(<?php echo "'".$_SESSION["mail"]."'" ?>);
	$("select[id='selYear']").val(<?php echo $_SESSION["year"] ?>);
	$("select[id='selMonth']").val(<?php echo $_SESSION["month"] ?>);
	$("select[id='selDay']").val(<?php echo $_SESSION["day"] ?>);
	$("select[id='selAddr']").val(<?php echo "'".$_SESSION["addr"]."'" ?>);
	$("#txtMail").focus();
	
});
// 確認ボタン押下
function fncConfirm(){
	// 入力チェック
	// 必須入力チェック
	var flg = true;
	if(jQuery.trim($("#txtMail").val()) == ''){
		$("#errMsg").text("メールアドレスを入力してください");
		flg = false;
	}else{
		$("#errMsg").text("");
	}
	
	// 形式チェック
	if(jQuery.trim($("#txtMail").val()) != '' && !$("#txtMail").val().match(/^[A-Za-z0-9]+[\w-]+@[\w\.-]+\.\w{2,}$/)){
		$("#errMsg").text("メールアドレスの形式が正しくありません");
		flg = false;
	}
	
	// byte数チェック
	if(jQuery.trim($("#txtMail").val()) != '' && getByte($("#txtMail").val()) > 100){
		$("#errMsg").text("メールアドレスは100文字以内で入力してください");
		flg = false;
	}
	
	if(!flg){
		// 入力チェックエラーの場合、画面に戻る。
		return;
	}
	
	// 画面入力値をhiddenに詰める。
	$("#hdnTxtMail").val($("#txtMail").val());
	$("#hdnSelYear").val($("#selYear").val());
	$("#hdnSelMonth").val($("#selMonth").val());
	$("#hdnSelDay").val($("#selDay").val());
	$("#hdnSelAddr").val($("#selAddr").val());
	
	$("#hdnTrans").val("confirm");
	$("#frmRgstInput").submit();
	
}
</script>
<form id="frmRgstInput" action="<?php print($_SERVER['PHP_SELF']) ?>" method="post">
    <input type="hidden" id="hdnTrans" name="hdnTrans"/>
    <div id="divRgst">
    	<div id="divRgstHead">
        	<img src="../images/imgMailMagHeader.png" alt="fravum shop MailMagagine" width="686" height="26">
        </div>
        <div id="divRgstNav">
            <ol type="1">
                <li id="liImgInAddr"><img src="../images/imgInAddrOn.gif" alt="アドレス入力" width="175" height="45"></li>
                <li id="liImgConfirm"><img src="../images/imgConfirmOff.gif" alt="登録確認" width="175" height="45"></li>
                <li id="liImgComplete"><img src="../images/imgCompleteOff.gif" alt="登録完了" width="175" height="45"></li>
            </ol>
        </div>
        <div id="divMailMagTitle">
        	<img src="../images/imgMailMag.png" alt="メールマガジン登録" width="686" height="24">
        </div>
        <div id="divRgstMain">
            <div id="divErrMsg">
                <p id="errMsg" class="clsFontGothic clsErrMsg"></p>
            </div>
            <div id="divRgstInput">
                <input type="hidden" id="hdnTxtMail" name="hdnTxtMail">
                <input type="hidden" id="hdnSelYear" name="hdnSelYear">
                <input type="hidden" id="hdnSelMonth" name="hdnSelMonth">
                <input type="hidden" id="hdnSelDay" name="hdnSelDay">
                <input type="hidden" id="hdnSelAddr" name="hdnSelAddr">
<?php
				echo "<hr id='hr1'>";
				echo "<div id='divImgMailHead'><img src='../images/imgMailHead.png' alt='メールアドレス' width='160' height='29'></div><div id='divTxtMail'><input type='text' value='' tabindex=1 id='txtMail' size='50' maxlength='100' name='txtMail'/></div>";
				echo "<hr id='hr2'>";
				echo "<div id='divImgBirthHead'><img src='../images/imgBirthHead.png' alt='生年月日' width='160' height='29'></div>";
				
				$today = getdate();
				$year = $today['year'];
				$month = 1;
				$day = 1;
	
				// 年セレクトボックス
				$i = 0;
				$selected = "";
				echo "<div id='divSelBirth'><select id='selYear' tabindex=2 name='selYear'>";
				for($i = 0; $i < 50; $i++){
					if($year == 1984){
						$selected = "selected";
					}else{
						$selected = "";
					}
					echo "<option value=".$year." ".$selected.">".$year."</option>";
					$year--;
				}
				echo "</select><span class='clsMargin10 clsFontGothic clsSize11'>年</span>";
	
				// 月セレクトボックス
				$j = 0;
				echo "<select id='selMonth' tabindex=3 name='selMonth'>";
				for($j = 0; $j < 12; $j++){
					if($month == 1){
						$selected = "selected";
					}else{
						$selected = "";
					}
					echo "	<option value=".$month." ".$selected.">".$month."</option>";
					$month++;
				}
				echo "</select><span class='clsMargin10 clsFontGothic clsSize11'>月</span>";
				
				// 日セレクトボックス
				$k = 0;
				echo "<select id='selDay' tabindex=4 name='selDay'>";
				for($k = 0; $k < 31; $k++){
					if($day == 1){
						$selected = "selected";
					}else{
						$selected = "";
					}
					echo "	<option value=".$day." ".$selected.">".$day."</option>";
					$day++;
				}
				echo "</select><span class='clsMargin10 clsFontGothic clsSize11'>日</span></div>";
				echo "<hr id='hr3'>";
				echo "<div id='divImgAddrHead'><img src='../images/imgAddrHead.png' alt='お住まい' width='160' height='29'></div>";
	
				// 都道府県セレクトボックス
				$prefs = array('北海道','青森県','岩手県','宮城県','秋田県','山形県','福島県','茨城県','栃木県','群馬県','埼玉県','千葉県','東京都','神奈川県','新潟県','山梨県','長野県','富山県','石川県','福井県','岐阜県','静岡県','愛知県','三重県','滋賀県','京都府','大阪府','兵庫県','奈良県','和歌山県','鳥取県','島根県','岡山県','広島県','山口県','徳島県','香川県','愛媛県','高知県','福岡県','佐賀県','長崎県','熊本県','大分県','宮崎県','鹿児島県','沖縄県');
				echo "<div id='divSelAddr'><select id='selAddr' tabindex=5 name='selAddr'>";
				foreach($prefs as $pref){
					if($pref == "東京都"){
						$selected = "selected";
					}else{
						$selected = "";
					}
					echo "<option value=" . $pref ." ".$selected. ">" . $pref ."</option>";
				}
				echo "</select></div>";
				echo "<hr id='hr4'>";
?>
            </div>
            <div id="divRgstMsg">
            	<p class="clsFontGothic clsSize13">上記の内容でよろしければ「確認する」ボタンを押してください</p>
            </div>
            <div id="divBtnConf">
            	<a href="#" class="rollover"><img src='../images/imgBtnConfirmOff.png' alt='確認' width="147" height="40" onclick='fncConfirm();return false;'/></a>
        	</div>
        </div>
    </div>
</form>
</body>

</html>