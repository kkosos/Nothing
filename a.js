var max_bound
var pos= {x:0,y:0};
var mov_dir={left:false,right:false,up:false,down:false};
var pause=false;
var t=setInterval(updateMove,10);

function border_bound(up,down,left,right){
	this.up=up;
	this.down=down;
	this.left=left;
	this.right=right;	
}

function init(){
	max_bound = new border_bound(-35,450,-13,475);
	var c = document.getElementById("can_1");	
	var ctx = c.getContext("2d");
	ctx.font = "30px Arial";
	ctx.fillText("o",10,50);
	
	window.addEventListener("keydown",moveit);
	window.addEventListener("keyup",stopit);

}

function moveit(event){	
	//for different browser
	if(window.event){
		keynum = event.keyCode	
	}//a 65 d 68  w87 s83  space 32
	else if(event.which){
		keynum = event.which		
	}
	if(keynum==65)
		mov_dir.left=true;		
	else if(keynum==68)
		mov_dir.right=true;
	else if(keynum==87)	
			mov_dir.up=true;			
	else if(keynum==83)
		mov_dir.down=true;
	else if(keynum==32)
		return;

}
function stopit(event){
	//for different browser
	if(window.event){
		keynum = event.keyCode	
	}//a 65 d 68  w87 s83  p80
	else if(event.which){
		keynum = event.which		
	}
	if(keynum==65)
		mov_dir.left=false;	
	else if(keynum==68)
		mov_dir.right=false;
	else if(keynum==87)
		mov_dir.up=false;
	else if(keynum==83)
		mov_dir.down=false;
	//pause
	else if(keynum==80){
		if(!pause)
		{
			clearInterval(t);			
		}
		else{
			t=setInterval(updateMove,10);
		}
		pause=!pause;		
		}

}

function updateMove(){
	
	var elem = document.getElementById("can_1");
	var mul_move=2;
	
	if(mov_dir.down){
		pos.y+=(mul_move);
		if(pos.y>max_bound.down)
			pos.y=max_bound.down;
		elem.style.top = pos.y + "px";
		console.log(pos.y);
	}
	if(mov_dir.up){
		pos.y-=(mul_move);
		if(pos.y<max_bound.up)
				pos.y=max_bound.up;
		elem.style.top = pos.y + "px";
		console.log(pos.y);
	}
	if(mov_dir.left){
		pos.x-=(mul_move);
		if(pos.x<max_bound.left)
				pos.x=max_bound.left;
		elem.style.left = pos.x + "px";
		console.log(pos.x);
	}
	if(mov_dir.right){
		pos.x+=(mul_move);
		if(pos.x>max_bound.right)
				pos.x=max_bound.right;
		elem.style.left = pos.x + "px";
		console.log(pos.x);
	}
	
	/*
	
	
		//for y
		if(direct){
			pos.y+=(next_pos*mul_move);
			if(pos.y<-9||pos.y>409)
				pos.y=pos.y>0?409:-9;
			elem.style.top = pos.y + "px";
			console.log(pos.y);
			
		}
		//for x
		else{
			pos.x+=(next_pos*mul_move);
			if(pos.x<-54||pos.x>364)
			pos.x=pos.x>0?364:-54;
			elem.style.left = pos.x + "px";
			console.log(pos.x);
		}*/
}
init();