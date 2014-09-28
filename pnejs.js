function isIE () {
  var myNav = navigator.userAgent.toLowerCase();
  return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}




function PNESetMobileCSS(full){


 
 var viewportwidth;
 var viewportheight;
 var ClassSetting=1;
 var SpacerHeight;
 var SpacerWidth;
 var elem=document.getElementById('ICG1ADDONS-Spacer')
 var elem2=document.getElementById('ICG1ADDON')
 var pnezoom=false;
 var pnezoomcss='';
 var pnecss
 var usezoom
 var PNEIE8=false
  
 
 if (typeof window.innerWidth != 'undefined')
 {      
 viewportwidth = parseInt(elem2.parentNode.offsetWidth)

} else {

  viewportwidth=parseInt(elem2.parentNode.offsetWidth);

if (isIE () == 8) {
return;
} 

if (isIE () < 8) {
 pnezoom=true; 
 usezoom='zoom:'
} 



}
if (document.getElementById('PNEbodystyle')){
document.getElementById('PNEbodystyle').parentNode.removeChild(document.getElementById('PNEbodystyle'));
}

if (typeof PNEAwidth==='undefined'){
PNEAwidth=elem.style.width
PNEAheight=elem.style.height
}



if (full=='fixed' || !document.getElementById('PNEmobilelayout')){
if (typeof pneElemwidth==='undefined'){
pneElemwidth=parseInt(elem.style.width);
}
} else {pneElemwidth=540;};


      if (viewportwidth < 240){return;};
      viewportheight = parseInt(window.innerHeight);
      ClassSetting=(viewportwidth/pneElemwidth);
SpacerHeight= (ClassSetting)*parseInt(PNEAheight);
SpacerWidth= (ClassSetting)*parseInt(PNEAwidth);
elem.style.height=SpacerHeight+'px';
elem.style.width=SpacerWidth+'px';


if (pnezoom==true){pnecss='#UpperMovableDrawing  { '+usezoom+' '+ClassSetting+';}'} else {
pnecss = '#UpperMovableDrawing { -ms-transform: scale('+ClassSetting+'); -ms-transform-origin: 0 0;-moz-transform: scale('+ClassSetting+'); -moz-transform-origin: 0 0; -o-transform: scale('+ClassSetting+'); -o-transform-origin: 0 0; -webkit-transform: scale('+ClassSetting+'); -webkit-transform-origin: 0 0; transform: scale('+ClassSetting+');  transform-origin: 0 0;}';
};



var pnehead = document.head || document.getElementsByTagName('head')[0];
var pnestyle = document.createElement('style');
pnestyle.type = 'text/css';
pnestyle.id = 'PNEStyleTrans2';

if (pnestyle.styleSheet) {   
    pnestyle.styleSheet.cssText = pnecss;

} else {
    pnestyle.appendChild(document.createTextNode(pnecss));
}

pnehead.appendChild(pnestyle);

if (document.getElementById('PNEStyleTrans')){
document.getElementById('PNEStyleTrans').parentNode.removeChild(document.getElementById('PNEStyleTrans'));
}
document.getElementById('PNEStyleTrans2').id='PNEStyleTrans';
 

};

if (window.addEventListener){window.addEventListener('load', PNESetMobileCSS, false);} 
else if (window.attachEvent) {window.attachEvent('onload', PNESetMobileCSS);}

window.hasOwnProperty = window.hasOwnProperty || Object.prototype.hasOwnProperty;
var addEvent =  window.attachEvent||window.addEventListener;
var event = window.attachEvent ? 'onresize' : 'resize';
if  (window.hasOwnProperty("orientation")){
addEvent("orientationchange", PNESetMobileCSS, false);} else {
addEvent(event, PNESetMobileCSS, false);
}
