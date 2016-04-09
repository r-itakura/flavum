$(window).load(function() {
	// 画面表示時のウィンドウ幅から、高さを設定する。
	if($(window).width() < 774){
		$('#divContents').css('min-height', '1900px');
	}else if($(window).width() >= 774 && $(window).width() <= 1083){
		$('#divContents').css('min-height', '1650px');
	}else{
		$('#divContents').css('min-height', '1000px');
	}
	
	$("#divFooter").css("margin-left", $(window).width() - 100 + 'px');
	
});
$(function() {
	$('#ulNavBtn li').hover(function(){  
		//画像の位置を取得
		var left = $(this).position().left;
		var width = $(this).width();
		var diff = (76-width)/2;
		$('#navPointer').stop().animate({
			marginLeft : parseInt($(this).css('margin-left'))+ (left-(diff)) +'px'
		},'fast');
	});
});
$(function(){
	$("#grid-content").vgrid({
		easing: "easeOutQuint",
		time: 400,
		delay: 20,
		wait: 500
	});
});
var timer = false;
$(window).resize(function() {
	// ウィンドウリサイズ時に高さを設定する。
    if (timer !== false) {
        clearTimeout(timer);
    }
    timer = setTimeout(function() {
		if($(window).width() < 774){
			$('#divContents').css('min-height', '1900px');
		}else if($(window).width() >= 774 && $(window).width() <= 1083){
			$('#divContents').css('min-height', '1650px');
		}else{
			$('#divContents').css('min-height', '1000px');
		}
    	
    }, 200);
	
	$("#divFooter").css("margin-left", $(window).width() - 100 + 'px');
});

$(document).ready( function() {
	var weather = ""; // 天気
	var temp = ""; // 最高気温
	
	var page = location.href.substring(location.href.lastIndexOf('/') + 1);
	var imgPath = "";
	var weatherURL = "";

	if(page == "index.html" || ""){
		imgPath = "images";
		weatherURL = "contents";
	}else{
		imgPath = "../images";
		weatherURL = "../contents";
	}

	var weatherURL =  weatherURL + "/getWeather.php";
	$.getJSON(weatherURL, function(json){
		weather = json.forecasts[0].telop;

		if(json.forecasts[0].temperature.max != null){
			temp = json.forecasts[0].temperature.max.celsius;
		}

		if(weather == "晴" || weather == "晴れ"){
			$("#weather").attr("width", "28px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/sunny.png");
		}else if(weather == "曇り"){
			$("#weather").attr("width", "23px");
			$("#weather").attr("height", "17px");
			$("#weather").attr("src",imgPath + "/cloudy.png");
		}else if(weather == "雨"){
			$("#weather").attr("width", "46px");
			$("#weather").attr("height", "37px");
			$("#weather").attr("src",imgPath + "/rainy.png");
		}else if(weather == "晴のち曇"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr('src',imgPath + "/suntocloud.png");
		}else if(weather == "晴のち雨"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/suntorain.png");
		}else if(weather == "雨のち晴"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/raintosun.png");
		}else if(weather == "雨のち曇"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/raintocloud.png");
		}else if(weather == "曇のち晴"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/cloudtosun.png");
		}else if(weather == "曇のち雨"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/cloudtorain.png");
		}else if(weather == "晴時々曇"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/sunpartcloud.png");
		}else if(weather == "晴時々雨"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/sunpartrain.png");
		}else if(weather == "雨時々晴"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/rainpartsun.png");
		}else if(weather == "雨時々曇"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/rainpartcloud.png");
		}else if(weather == "曇時々晴"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/cloudpartsun.png");
		}else if(weather == "曇時々雨"){
			$("#weather").attr("width", "80px");
			$("#weather").attr("height", "28px");
			$("#weather").attr("src",imgPath + "/cloudpartrain.png");
		}else{
			$("#weatherErr").text("天気情報が取得できません");;
		}
		
		if(temp != ""){
			$("#temp").text(temp);
			$("#cel").attr("src",imgPath + "/imgCel.png");
			$("#cel").attr("width", "26px");
			$("#cel").attr("height", "18px");
		}
	});
	
	//ナビゲーションインタの初期位置を設定
	var navPointer = "";
	if(page == "index.html"){
		navPointer = "imgNavNewArrival";
	}else if(page == "newarrivals.html"){
		navPointer = "imgNavNewArrival";
	}else if(page == "access.html"){
		navPointer = "imgNavAccess";
	}else if(page == "mailmagagine.html"){
		navPointer = "imgNavMail";
	}else{
		navPointer = "imgNavNewArrival";
	}
	
	var left = $("#" + navPointer).position().left;
	var width = $("#" + navPointer).width();
	var diff = (76-width)/2;
	$('#navPointer').stop().animate({
		marginLeft : parseInt($("#" + navPointer).css('margin-left'))+ (left-(diff)) +'px'
	},'fast');
	
	
});