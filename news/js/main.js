 window.onload=function(){
      var wrap=document.getElementById('wrap');
      var pic=document.getElementById('pic');
      var Li=document.getElementById('list').getElementsByTagName('li');
      var prev=document.getElementById('Prev');
      var next=document.getElementById('Next');
      var animated=false;
      var index=0;
      var timer=null;
      next.onclick=function(){
        if(animated){
          return;
        }
        else{
          index++;
          if(index>=Li.length){
            index=0;
          }
        }
 
        showlist();
        if(animated == false){//if(!animated)
          animate(-500);
        }
      }
      prev.onclick=function(){
        if(animated){
          return;
        }
        else{
          index--;
          if(index<=0){
            index=Li.length-1;
          }
        }
 
        showlist();
        if(!animated){
          animate(500);
        }
      }
      for(var i=0;i<Li.length;i++){
        Li[i].num=i;
        Li[i].onclick=function(){
          if(this.className=="on"){
            return;
          }
          var offset = -500*(this.num-index);
          if(!animated){
            animate(offset);
          }
          index=this.num;
          showlist();
        }
      }
      function animate(offset){
        animated=true;
        var newLeft=parseInt(pic.style.left) + offset;
        var time=300;
        var interval=10;
        var speed=offset/(time/interval);
 
        function go(){
          if((speed < 0 && parseInt(pic.style.left) > newLeft )|| (speed > 0 && parseInt(pic.style.left) < newLeft)){
            pic.style.left = parseInt(pic.style.left) + speed + 'px';
            setTimeout(go,interval);
          }else{
            animated=false;
            pic.style.left= newLeft + 'px';
            if(newLeft > -0){
              pic.style.left = -0 + 'px';
            }
            if(newLeft <-1500){
              pic.style.left = -0 + 'px';
            }
          }
        }
        go();
      }
      function showlist(){
        for(var i=0;i<Li.length;i++){
          Li[i].className="";
        }
        Li[index].className="on";
      }
      function play(){
        timer=setInterval(function(){
          next.onclick();
        },2000);
      }
      function stop(){
        clearInterval(timer);
      }
      wrap.onmouseover=stop;
      wrap.onmouseout=play;
      play();
    }