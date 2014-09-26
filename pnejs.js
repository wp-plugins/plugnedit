function PNESetMobileCSS(){


 
 var viewportwidth;
 var viewportheight;
 var ClassSetting=1;
 var SpacerHeight;
 var SpacerWidth;
 var elem=document.getElementById('ICG1ADDONS-Spacer')


  

 if (typeof window.innerWidth != 'undefined')
 {
     
   
viewportwidth = parseInt(elem.parentNode.offsetWidth)
      
if (typeof PNEAheight === 'undefined')
{
PNEAheight=elem.style.height
};

if (typeof PNEAwidth === 'undefined')
{
PNEAwidth=elem.style.width
};


     
      if (viewportwidth < 240){return;};
      viewportheight = parseInt(window.innerHeight);
      ClassSetting=(viewportwidth/540);
 SpacerHeight= (ClassSetting)*parseInt(PNEAheight);
 SpacerWidth= (ClassSetting)*parseInt(PNEAwidth);

elem.style.height=SpacerHeight+'px';
elem.style.width=SpacerWidth+'px';
var pnecss = '#PNEmobilelayout {  -ms-transform: scale('+ClassSetting+'); -ms-transform-origin: 0 0;-moz-transform: scale('+ClassSetting+'); -moz-transform-origin: 0 0; -o-transform: scale('+ClassSetting+'); -o-transform-origin: 0 0; -webkit-transform: scale('+ClassSetting+'); -webkit-transform-origin: 0 0; transform: scale('+ClassSetting+');  transform-origin: 0 0;}';
var pnehead = document.head || document.getElementsByTagName('head')[0];
var pnestyle = document.createElement('style');

pnestyle.type = 'text/css';
if (pnestyle.styleSheet){
  pnestyle.styleSheet.cssText = css;
} else {
  pnestyle.appendChild(document.createTextNode(pnecss));
}

pnehead.appendChild(pnestyle);
  
      
}

}

if  (window.hasOwnProperty("orientation")){
window.addEventListener("orientationchange", PNESetMobileCSS, false);} else {
window.addEventListener("resize", PNESetMobileCSS, false);
}
