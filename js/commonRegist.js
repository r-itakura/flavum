// ロールオーバー
$(function(){	
	$('.rollover').each(function(){
		var navBtn = $(this).find("img");
		
		var srcOff = navBtn.attr("src");
		var srcOn = srcOff.replace("Off", "On");

		$(this).hover(function(){
			navBtn.attr("src", srcOn);
		}, function(){
			navBtn.attr("src", srcOff);
		});
		
	});
});
// バイト数を取得する
function getByte(aStr){
 if(aStr.length == 0){return 0;}
 var count = 0;
 var Str = "";
 for(var i=0;i <aStr.length;i++){
   Str = aStr.charAt(i);
   Str = escape(Str);
   if( Str.length  < 4 ){
     count = count + 1;
   }else{
     count = count + 2;
   }
 }
 return count;
}