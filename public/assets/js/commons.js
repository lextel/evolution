	/*定时淡出淡入图片
	id				索引
	imgArr 			图片数组;
	imgIndex		默认图片索引
	fadeTime 		淡出淡入的时间
	intervalTime	多久执行一次更换图片的函数
	*/
	 function timingPicture(id,imgArr,imgIndex,fadeTime,intervalTime){
		setInterval(function(){
				 //淡出
				 $(id).fadeOut(fadeTime,function(){
					imgIndex++;
					if(imgIndex >= imgArr.length){
						  imgIndex = 0;
					}	
					//改变图片
					$(id).attr("src", imgArr[imgIndex]);		   
				 });
					  
				 //淡入
				   $(id).fadeIn(fadeTime);
		  },intervalTime); 
	 }
	
	
	/*倒计时函数
	nms :      秒数
	id :       索引
	*/
	 function djsCount(nms,id){
		//nms = parseInt(nms);
		var str = "";
		var time = setInterval(function (){ 
			str = "";
			var myD=Math.floor(nms/(1000 * 60 * 60 * 24));
			var myH=Math.floor(nms/(1000*60*60)) % 24; //小时 
			var myM=Math.floor(nms/(1000*60)) % 60; //分钟 
			var myS=Math.floor(nms/1000) % 60; 		//秒 
			var myMS=Math.floor(nms/10) % 100; //拆分秒
			
			if(nms>= 0){
				if(myD >0){
					str = myD+"天";
				}
				if(myH>0){
					str += myH+"小时";
				}
				str = myM+"分"+myS+"秒"+myMS+"毫秒";
			}else{
				str = "已到时！";
				clearTimeout(time);
			}
			nms -= 10;
			$("#"+id).html(str);
		}, 10);
	 }

	/*这是鼠标进出列表的效果
	id : 		html标签的JQ对象
	jcolorValue:进颜色的值
	ccolorValue:出颜色的值
	*/
	function mouseList(id,jcolorValue,ccolorValue){
		$(id).each(function(i){
			
			//鼠标移入事件
   			$(this).bind("mouseover" , function(){
				$(this).css("border-color",jcolorValue);		
			});
	
			//鼠标移出事件
			$(this).bind("mouseout" , function(){						
				$(this).css("border-color",ccolorValue);		
			});

		});
	}


	/*这是鼠标进出文字的效果
	id : 		html标签的JQ对象
	jcolorValue:	颜色的值
	ccolorValue:出颜色的值
	*/
	function mouseWrittenWords(id,jcolorValue,ccolorValue){
		$(id).each(function(i){
		
			//鼠标移入事件
   			$(this).bind("mouseover" , function(){
				
				$(this).css("color",jcolorValue);		
			});
	
			//鼠标移出事件
			$(this).bind("mouseout" , function(){
								
				$(this).css("color",ccolorValue);		
			});
		
		});
	}
	
	
	
	/*
	id : 索引
	value : 进度条值
	*/
	function progressBar(id,pbvalue){
	 	  $(id).progressbar({ 
				value: parseInt(pbvalue)
		  });
		    
	   $(id).attr({ title: "已完成"+num+"%" });
	}
	

//图片滚动 调用方法 imgscroll({speed: 30,amount: 1,dir: "up"});
$.fn.imgscroll = function(o){
	var defaults = {
		speed: 3000,	
		amount: 0,
		width: 1,
		dir: "left"

	};

	o = $.extend(defaults, o);

	return this.each(function(){

		var _li = $("li", this);
		_li.parent().parent().css({overflow: "hidden", position: "relative"}); //div
		_li.parent().css({margin: "0", padding: "0", overflow: "hidden", position: "relative", "list-style": "none"}); //ul
		_li.css({position: "relative", overflow: "hidden"}); //li
		if(o.dir == "left") _li.css({float: "left"});

		//初始大小

		var _li_size = 0;

		for(var i=0; i<_li.size(); i++)
			_li_size += o.dir == "left" ? _li.eq(i).outerWidth(true) : _li.eq(i).outerHeight(true);

		//循环所需要的元素
		if(o.dir == "left") _li.parent().css({width: (_li_size*3)+"px"});
		_li.parent().empty().append(_li.clone()).append(_li.clone()).append(_li.clone());
		_li = $("li", this);

		//滚动
		var _li_scroll = 0;

		function goto(){
			_li_scroll += o.width;
			if(_li_scroll > _li_size)
			{
				_li_scroll = 0;
				_li.parent().css(o.dir == "left" ? { left : -_li_scroll } : { top : -_li_scroll });
				_li_scroll += o.width;
			}
				_li.parent().animate(o.dir == "left" ? { left : -_li_scroll } : { top : -_li_scroll }, o.amount);
		}

		//开始
		var move = setInterval(function(){ goto(); }, o.speed);
		_li.parent().hover(function(){
			clearInterval(move);
		},function(){
			clearInterval(move);
			move = setInterval(function(){ goto(); }, o.speed);
		});
	});
};

