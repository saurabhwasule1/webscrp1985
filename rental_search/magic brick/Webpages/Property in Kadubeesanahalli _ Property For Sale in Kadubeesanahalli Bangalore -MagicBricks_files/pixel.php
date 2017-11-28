var pixel=pixel||{pixelConfig:null,segmentConfig:null,extraParams:null,cookieDomain:null,clickTrackers:null,initialize:null,finalize:null,paramArray:[],segParams:[],pageLoadStatusFlag:false,checkReadyStateOnIntervals:null,pixelFireStatus:false,parse:function(){try{if(!(pixel.pixelFireStatus||pixel.checkReadyStateOnIntervals)){pixel.checkReadyStateOnIntervals=setInterval(function(){if(!pixel.pixelFireStatus){pixel.checkIfPageLoadComplete();if(pixel.pageLoadStatusFlag){try{var b=pixel.detectCampaign();pixel.initialize(b);if(typeof pixel.getExtraParams!="undefined"){pixel.getExtraParams();}pixel.getParams();pixel.finalize(b);pixel.removeDuplicatePids();pixel.fireAnalyze(pixel.getQueryString(pixel.paramArray));}catch(c){pixel.paramArray.param="999";pixel.paramArray.err=c;pixel.fireAnalyze(pixel.getQueryString(pixel.paramArray));}}}},500,"Javascript");}}catch(a){pixel.paramArray.param="999";pixel.paramArray.err=a;pixel.fireAnalyze(pixel.getQueryString(pixel.paramArray));}},removeDuplicatePids:function(){var e="",d="",c="";var b=pixel.paramArray.param.split("_")[0];try{if(b&&(b=="e400")){e=pixel.paramArray.pid1;d=pixel.paramArray.pid2;c=pixel.paramArray.pid3;if(e&&d&&(e==d)){pixel.deleteParam("2");}if(d&&c&&(d==c)){pixel.deleteParam("3");}if(e&&c&&(e==c)){pixel.deleteParam("3");}}}catch(a){}},deleteParam:function(b){try{delete pixel.paramArray["pid"+b];delete pixel.paramArray["catid"+b];delete pixel.paramArray["price"+b];delete pixel.paramArray["quantity"+b];}catch(a){}},checkIfPageLoadComplete:function(){if(document.readyState==="interactive"||document.readyState==="complete"){pixel.pageLoadStatusFlag=true;clearInterval(pixel.checkReadyStateOnIntervals);}else{pixel.pageLoadStatusFlag=false;}},getParams:function(){var f="",d="",i="",e="";var h="",j="",c="",b="",g="";for(var a in pixel.pixelConfig){g=a.split("_Z")[0];if(pixel.paramArray[g]){continue;}if(pixel.pixelConfig.hasOwnProperty(a)&&pixel.pixelConfig[a]){f=pixel.pixelConfig[a][1];d=pixel.pixelConfig[a][0];i=pixel.pixelConfig[a][2];e=pixel.pixelConfig[a][3];if(f){if(f==="xpath"&&d&&typeof pixel.getDataFromXPath!="undefined"){pixel.paramArray[g]=pixel.getDataFromXPath(d,i);}else{if(f==="url"&&d&&e){if(e=="regex"&&typeof pixel.getDataFromUrl!="undefined"){pixel.paramArray[g]=pixel.getDataFromUrl(d,i);}else{if(e=="qstring"&&typeof pixel.getParamFromUrl!="undefined"){pixel.paramArray[g]=pixel.getParamFromUrl(document.URL,d);}}}else{if(f=="jsvariable"&&d&&typeof pixel.getDataFromJSVar!="undefined"){pixel.paramArray[g]=pixel.getDataFromJSVar(d);}else{if(f=="udf"&&d&&typeof pixel.getDataFromUDF!="undefined"){pixel.paramArray[g]=pixel.getDataFromUDF(d,i);}else{if(f=="csspath"&&d&&typeof pixel.getDataFromCSSPath!="undefined"){pixel.paramArray[g]=pixel.getDataFromCSSPath(d,i);}else{if(f=="classname"&&d&&typeof pixel.getElementsByClass!="undefined"){pixel.paramArray[g]=pixel.getElementsByClass(d.split(",")[0],d.split(",")[1],d.split(",")[2]);}}}}}}h=pixel.pixelConfig[a][4];j=pixel.pixelConfig[a][5];c=pixel.pixelConfig[a][6];if(c&&typeof pixel.getNumericField!="undefined"){pixel.paramArray[g]=pixel.getNumericField(pixel.paramArray[g],c);}b=pixel.pixelConfig[a][7];if(h&&pixel.paramArray[g]){pixel.paramArray[g]=pixel.getSubstring(pixel.paramArray[g],h,j);}if(b&&b.toLowerCase()=="md5"&&typeof pixel.getMd5!="undefined"){pixel.paramArray[g]=pixel.getMd5(pixel.paramArray[g]);}if(b&&b.toLowerCase()=="sha256"&&typeof pixel.getSHA256!="undefined"){pixel.paramArray[g]=pixel.getSHA256(pixel.paramArray[g]);}}}}},getSubstring:function(h,b,a){var f=null;var e="";var d=1;var g;try{if(a){g=new RegExp(b,a);}else{g=new RegExp(b);}f=h.toString().match(g);if(f&&f[d]){return f[d];}}catch(c){e="";}return e;},getSegParams:function(){var g="",e="",l="",f="",a=document.URL;var j="",m="",d="",c="",i="",h="";for(var k in pixel.segmentConfig){if(pixel.segmentConfig.hasOwnProperty(k)){pixel.segParams[k]=[];for(var b in pixel.segmentConfig[k]){h=b.split("_Z")[0];if(pixel.segParams[k][h]){continue;}if(pixel.segmentConfig[k].hasOwnProperty(b)&&pixel.segmentConfig[k][b]){g=pixel.segmentConfig[k][b][1];e=pixel.segmentConfig[k][b][0];l=pixel.segmentConfig[k][b][2];f=pixel.segmentConfig[k][b][3];if(g){if(g==="xpath"&&e&&typeof pixel.getDataFromXPath!="undefined"){pixel.segParams[k][h]=pixel.getDataFromXPath(e,l);}else{if(g==="url"&&e&&f){if(f=="regex"&&typeof pixel.getDataFromUrl!="undefined"){pixel.segParams[k][h]=pixel.getDataFromUrl(e,l);}else{if(f=="qstring"&&typeof pixel.getParamFromUrl!="undefined"){pixel.segParams[k][h]=pixel.getParamFromUrl(a,e);}}}else{if(g=="jsvariable"&&e&&typeof pixel.getDataFromJSVar!="undefined"){pixel.segParams[k][h]=pixel.getDataFromJSVar(e);}else{if(g=="csspath"&&e&&typeof pixel.getDataFromCSSPath!="undefined"){pixel.segParams[k][h]=pixel.getDataFromCSSPath(e,l);}else{if(g=="udf"&&e&&typeof pixel.getDataFromUDF!="undefined"){pixel.segParams[k][h]=pixel.getDataFromUDF(e,l);}else{if(g=="classname"&&e&&typeof pixel.getElementsByClass!="undefined"){pixel.segParams[k][h]=pixel.getElementsByClass(e.split(",")[0],e.split(",")[1],e.split(",")[2]);}}}}}}j=pixel.segmentConfig[k][b][4];m=pixel.segmentConfig[k][b][5];d=pixel.segmentConfig[k][b][6];if(d&&typeof pixel.getNumericField!="undefined"){pixel.segParams[k][h]=pixel.getNumericField(pixel.segParams[k][h],d);}c=pixel.segmentConfig[k][b][7];i=(c&&c.toLowerCase()=="md5");if(j&&pixel.segParams[k][h]){pixel.segParams[k][h]=pixel.getSubstring(pixel.segParams[k][h],j,m);}}}}pixel.segParams[k]["URL"]=a;}}},getCookie:function(b){var d=document.cookie;if(!b){return"";}var a=d.split(";");for(var c in a){if(a.hasOwnProperty(c)){var e=a[c].match(/\s*(.*)=(.*)/);if(e){if(e[1]===b&&e[2]){return e[2];}}}}return"";},getMd5:function(D){if(D&&D!==""){var E;var y=function(b,a){return(b<<a)|(b>>>(32-a));};var I=function(k,b){var W,a,d,x,c;d=(k&2147483648);x=(b&2147483648);W=(k&1073741824);a=(b&1073741824);c=(k&1073741823)+(b&1073741823);if(W&a){return(c^2147483648^d^x);}if(W|a){if(c&1073741824){return(c^3221225472^d^x);}else{return(c^1073741824^d^x);}}else{return(c^d^x);}};var r=function(a,c,b){return(a&c)|((~a)&b);};var q=function(a,c,b){return(a&b)|(c&(~b));};var p=function(a,c,b){return(a^c^b);};var n=function(a,c,b){return(c^(a|(~b)));};var v=function(X,W,ab,aa,k,Y,Z){X=I(X,I(I(r(W,ab,aa),k),Z));return I(y(X,Y),W);};var f=function(X,W,ab,aa,k,Y,Z){X=I(X,I(I(q(W,ab,aa),k),Z));return I(y(X,Y),W);};var G=function(X,W,ab,aa,k,Y,Z){X=I(X,I(I(p(W,ab,aa),k),Z));return I(y(X,Y),W);};var u=function(X,W,ab,aa,k,Y,Z){X=I(X,I(I(n(W,ab,aa),k),Z));return I(y(X,Y),W);};var e=function(W){var X;var d=W.length;var c=d+8;var b=(c-(c%64))/64;var x=(b+1)*16;var Y=new Array(x-1);var a=0;var k=0;while(k<d){X=(k-(k%4))/4;a=(k%4)*8;Y[X]=(Y[X]|(W.charCodeAt(k)<<a));k++;}X=(k-(k%4))/4;a=(k%4)*8;Y[X]=Y[X]|(128<<a);Y[x-2]=d<<3;Y[x-1]=d>>>29;return Y;};var s=function(d){var a="",b="",k,c;for(c=0;c<=3;c++){k=(d>>>(c*8))&255;b="0"+k.toString(16);a=a+b.substr(b.length-2,2);}return a;};var t=function(a){if(a===null||typeof a==="undefined"){return"";}var Y=(a+"");var Z="",k,b;b=k=0;var c=Y.length;for(var d=0;d<c;d++){var X=Y.charCodeAt(d);var W=null;if(X<128){k++;}else{if(X>127&&X<2048){W=String.fromCharCode((X>>6)|192,(X&63)|128);}else{if((X&63488)!=55296){W=String.fromCharCode((X>>12)|224,((X>>6)&63)|128,(X&63)|128);}else{if((X&64512)!=55296){throw new RangeError("Unmatched trail surrogate at "+d);}var x=Y.charCodeAt(++d);if((x&64512)!=56320){throw new RangeError("Unmatched lead surrogate at "+(d-1));}X=((X&1023)<<10)+(x&1023)+65536;W=String.fromCharCode((X>>18)|240,((X>>12)&63)|128,((X>>6)&63)|128,(X&63)|128);}}}if(W!==null){if(k>b){Z+=Y.slice(b,k);}Z+=W;b=k=d+1;}}if(k>b){Z+=Y.slice(b,c);}return Z;};var F=[],M,h,H,w,g,V,U,T,S,P=7,N=12,K=17,J=22,C=5,B=9,A=14,z=20,o=4,m=11,l=16,j=23,R=6,Q=10,O=15,L=21;D=t(D);F=e(D);V=1732584193;U=4023233417;T=2562383102;S=271733878;E=F.length;for(M=0;M<E;M+=16){h=V;H=U;w=T;g=S;V=v(V,U,T,S,F[M+0],P,3614090360);S=v(S,V,U,T,F[M+1],N,3905402710);T=v(T,S,V,U,F[M+2],K,606105819);U=v(U,T,S,V,F[M+3],J,3250441966);V=v(V,U,T,S,F[M+4],P,4118548399);S=v(S,V,U,T,F[M+5],N,1200080426);T=v(T,S,V,U,F[M+6],K,2821735955);U=v(U,T,S,V,F[M+7],J,4249261313);V=v(V,U,T,S,F[M+8],P,1770035416);S=v(S,V,U,T,F[M+9],N,2336552879);T=v(T,S,V,U,F[M+10],K,4294925233);U=v(U,T,S,V,F[M+11],J,2304563134);V=v(V,U,T,S,F[M+12],P,1804603682);S=v(S,V,U,T,F[M+13],N,4254626195);T=v(T,S,V,U,F[M+14],K,2792965006);U=v(U,T,S,V,F[M+15],J,1236535329);V=f(V,U,T,S,F[M+1],C,4129170786);S=f(S,V,U,T,F[M+6],B,3225465664);T=f(T,S,V,U,F[M+11],A,643717713);U=f(U,T,S,V,F[M+0],z,3921069994);V=f(V,U,T,S,F[M+5],C,3593408605);S=f(S,V,U,T,F[M+10],B,38016083);T=f(T,S,V,U,F[M+15],A,3634488961);U=f(U,T,S,V,F[M+4],z,3889429448);V=f(V,U,T,S,F[M+9],C,568446438);S=f(S,V,U,T,F[M+14],B,3275163606);T=f(T,S,V,U,F[M+3],A,4107603335);U=f(U,T,S,V,F[M+8],z,1163531501);V=f(V,U,T,S,F[M+13],C,2850285829);S=f(S,V,U,T,F[M+2],B,4243563512);T=f(T,S,V,U,F[M+7],A,1735328473);U=f(U,T,S,V,F[M+12],z,2368359562);V=G(V,U,T,S,F[M+5],o,4294588738);S=G(S,V,U,T,F[M+8],m,2272392833);T=G(T,S,V,U,F[M+11],l,1839030562);U=G(U,T,S,V,F[M+14],j,4259657740);V=G(V,U,T,S,F[M+1],o,2763975236);S=G(S,V,U,T,F[M+4],m,1272893353);T=G(T,S,V,U,F[M+7],l,4139469664);U=G(U,T,S,V,F[M+10],j,3200236656);V=G(V,U,T,S,F[M+13],o,681279174);S=G(S,V,U,T,F[M+0],m,3936430074);T=G(T,S,V,U,F[M+3],l,3572445317);U=G(U,T,S,V,F[M+6],j,76029189);V=G(V,U,T,S,F[M+9],o,3654602809);S=G(S,V,U,T,F[M+12],m,3873151461);T=G(T,S,V,U,F[M+15],l,530742520);U=G(U,T,S,V,F[M+2],j,3299628645);V=u(V,U,T,S,F[M+0],R,4096336452);S=u(S,V,U,T,F[M+7],Q,1126891415);T=u(T,S,V,U,F[M+14],O,2878612391);U=u(U,T,S,V,F[M+5],L,4237533241);V=u(V,U,T,S,F[M+12],R,1700485571);S=u(S,V,U,T,F[M+3],Q,2399980690);T=u(T,S,V,U,F[M+10],O,4293915773);U=u(U,T,S,V,F[M+1],L,2240044497);V=u(V,U,T,S,F[M+8],R,1873313359);S=u(S,V,U,T,F[M+15],Q,4264355552);T=u(T,S,V,U,F[M+6],O,2734768916);U=u(U,T,S,V,F[M+13],L,1309151649);V=u(V,U,T,S,F[M+4],R,4149444226);S=u(S,V,U,T,F[M+11],Q,3174756917);T=u(T,S,V,U,F[M+2],O,718787259);U=u(U,T,S,V,F[M+9],L,3951481745);V=I(V,h);U=I(U,H);T=I(T,w);S=I(S,g);}var i=s(V)+s(U)+s(T)+s(S);return i.toLowerCase();}return"";},removeJunk:function(a){if(a){a=a.toString();a=a.replace(/\&lt\;/g,"<").replace(/\&gt\;/g,">").replace(/\&quot\;/g,'"').replace(/\&amp\;/g,"&").replace(/\&nbsp\;/g," ");a=a.replace(/(<([^>]+)>)/ig,"").replace(/[ \t\r\n]+/g," ").replace(/^\s+|\s+$/g,"");return a;}return"";},getQueryString:function(a){var c=a.account_id;var e="?account_id="+c;delete a.account_id;var d="";for(var b in a){if(a.hasOwnProperty(b)){d=a[b];if(b=="param"){d=a[b].split("_")[0];}e+="&"+b+"="+this.encodeParam(d);}}return e;},matches:function(g,a,f){var d=null;var b=false;var e;try{if(a){e=new RegExp(f,a);}else{e=new RegExp(f);}d=g.match(e);if(d&&d.length>0){b=true;}}catch(c){b=false;}return b;},equalsTo:function(a,b){return(Number(a)==Number(b));},getDataFromJSVar:function(d){var e=d.split(".");var c=e.length;var b=null;var l=null;var f=/[\['"]?((\w|-|\s)+)['"\]]?/;var g,o,a;try{g=e[0];if(g.indexOf("[")>0){b=g.split("[");a=window[b[0]];for(var k=1;k<b.length;k++){l=b[k].match(f);a=a[l[1]];}}else{a=window[g];}}catch(n){return"";}var m=a;try{for(var k=1;k<c;k++){g=e[k];if(g.indexOf("[")>0){b=g.split("[");a=a[b[0]];for(var h=1;h<b.length;h++){l=b[h].match(f);a=a[l[1]];}}else{a=a[g];}}m=a;}catch(n){return"";}return(typeof m=="undefined"?"":m);},getDataFromUDF:function(e,c){var b="";try{var d=window.pixel[e];if(c){b=d(c);}else{b=d();}}catch(a){}return b;},getExtraParams:function(){var a,c;for(var b in pixel.extraParams){if(pixel.extraParams.hasOwnProperty(b)){a=pixel.extraParams[b]["param"];c=pixel.extraParams[b]["days"];pixel.paramArray[a]=pixel.getCookieForNDays(a,c);}}},getCookieForNDays:function(c,f){var e=c;var d=pixel.getCookie(e);var a=0;var b=pixel.paramArray.param.split("_")[0];if(d){a=parseInt(d.split("|")[0]);}if((e=="Nprd"&&b!="e300")||(e=="Nsc"&&b!="e400")||(e=="Nty"&&b!="e500")){return a;}if(a>0){a++;d=a+"|"+d.split("|")[1];pixel.setCookieForNDays(e,d,f,true);}else{pixel.setCookieForNDays(e,1,f,false);}d=pixel.getCookie(e);if(d){a=parseInt(d.split("|")[0]);}else{a=0;}return a;},setCookieForNDays:function(j,b,n,k){var c="";var l="";var e=false;if(typeof pixel.cookieDomain!="undefined"&&pixel.cookieDomain!=""){c=pixel.cookieDomain;l=";domain="+c;}if(j=="Nclk"){var d=pixel.clickTrackers;if(typeof d!="undefined"){var f=d.split(",");var a=document.URL;if(f!=null){for(var o in f){var h=f[o];if(typeof h!="undefined"&&h!=""&&a.indexOf(h)>-1){e=true;}}}if(!e){return;}}}if(n!==-1){var m=new Date();var i;if(k){var g=new Date(parseInt(b.split("|")[1]));i=b+(!(g)?"":";expires="+g.toUTCString())+l+";path=/";document.cookie=j+"="+i;}else{m.setDate(m.getDate()+parseInt(n));b=b+"|"+m.getTime();i=b+(!(m)?"":";expires="+m.toUTCString())+l+";path=/";document.cookie=j+"="+i;}}else{document.cookie=j+"="+b;}},exists:function(a){return((typeof a!="undefined")&&(a!=""));}};pixel.encodeParam=function(a){if(a){a=pixel.removeJunk(a);a=encodeURIComponent(a);return a;}return"";};pixel.dataLayerCheck=function(){return pixel.fnGetDataLayer("priExtRmtAd")!=""?"VIZVRM4248":"VIZVRM400";};pixel.fnGetDataLayer=function(b){var a=0;if(typeof(dataLayer)!=="undefined"&&dataLayer!==null){for(a=0;a<dataLayer.length;a++){if(dataLayer[a][b]){return dataLayer[a][b];}}}return"";};pixel.fnGet300Data=function(){pixel.paramArray.std_catid=pixel.paramArray.catid=pixel.paramArray.subcat1id=pixel.paramArray.std_subcat1id=pixel.paramArray.std_subcat2id=pixel.paramArray.subcat2id="";var b={service_type:"",listing_city:"",listing_propertytype:"",listing_locality:""};var a="";Object.keys(b).forEach(function(c){a=pixel.fnGetDataLayer(c);b[c]=a+"_";});pixel.paramArray.serviceType=b.service_type;pixel.paramArray.catid=pixel.paramArray.std_catid=(b.service_type+b.listing_city).replace(/_$|^_/,"");pixel.paramArray.subcat1id=pixel.paramArray.std_subcat1id=(b.service_type+b.listing_propertytype+b.listing_city).replace(/_$|^_/,"");pixel.paramArray.subcat2id=pixel.paramArray.std_subcat2id=(b.service_type+b.listing_propertytype+b.listing_locality+b.listing_city).replace(/_$|^_/,"");};pixel.fnGet500Data=function(){pixel.paramArray.catid="";var b={service_type:"",city:""};var a="";Object.keys(b).forEach(function(c){a=pixel.fnGetDataLayer(c);b[c]=a+"_";});pixel.paramArray.catid=(b.service_type+b.city).replace(/_$|^_/,"");};pixel.fnGetPageType=function(b){var a=0;var c="";if(typeof(dataLayer)!=="undefined"&&dataLayer!==null){for(a=0;a<dataLayer.length;a++){if(dataLayer[a][b]){c+=dataLayer[a][b];}}}return c;};pixel.fireAnalyze=function(g){var b=("https:"==document.location.protocol?"https://sg-pl":"http://sg-pl")+".vizury.com/analyze/analyze.php";var d=".magicbricks.com";var f=("https:"==document.location.protocol?"https://sg-pl":"http://sg-pl")+".vizury.com/analyze/cookieCallback.php?cb=.magicbricks.com";clearInterval(pixel.checkReadyStateOnIntervals);if(!(pixel.pixelFireStatus)){var e=document.createElement("iframe");var c=pixel.vizidCookie("_vz",d);e.src=b+g+"&cb="+c+((pixel.isSafari())?"&csm=2":"");e.scrolling="no";e.width=1;e.height=1;e.marginheight=0;e.marginwidth=0;e.frameborder=0;e.style.display="none";pixel.pixelFireStatus=true;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(e,a);if(e.attachEvent){e.attachEvent("onload",pixel.callBackViz(f));}else{e.onload=pixel.callBackViz(f);}}};pixel.detectCampaign=function(){var a="VIZVRM400";var b=document.URL;if(("VIZVRM400"==pixel.dataLayerCheck())){a="VIZVRM400";}else{if((true)){a="VIZVRM4248";}}return a;};pixel.initialize=function(b){var c=document.URL;var d=document.referrer;pixel.paramArray.URL=c;pixel.paramArray.referrer=d?d:"";pixel.paramArray.fp34=pixel.getMd5(pixel.getCookie("_ga"));if(b=="VIZVRM400"){pixel.paramArray.account_id=b;pixel.paramArray.param="e000";pixel.paramArray.section=1;pixel.paramArray.level=1;pixel.segmentConfig={e500:{pageType:["dataLayer[36].type","jsvariable","","","(.*)","","",""],pageType_Z1:["dataLayer[8].type","jsvariable","","","(.*)","","",""],pageType_Z2:["fnGetPageType","udf",["type"],"","(.*)","","",""]},e300:{pageType:["dataLayer[9].type","jsvariable","","","(.*)","","",""],pageType_Z1:["fnGetPageType","udf",["type"],"","(.*)","","",""]},e205:{pageType:["dataLayer[9].type","jsvariable","type","","(.*)","","",""],pageType_Z1:["fnGetPageType","udf",["type"],"","(.*)","","",""]},e100:{pageType:["dataLayer[0].type","jsvariable","","","(.*)","","",""],pageType_Z1:["fnGetDataLayer","udf",["type"],"","(.*)","","",""]}};pixel.getSegParams();pixel.extraParams=[{param:"Nvis",days:"30"},{param:"Nprd",days:"1"},{param:"Nty",days:"30"}];pixel.cookieDomain=".magicbricks.com";pixel.clickTrackers="";var a={pid1:["dataLayer[11].pid","jsvariable","","","(.*)","","",""],pid1_Z1:["fnGetDataLayer","udf",["pid"],"","(.*)","","",""],orderid:["dataLayer[9].oid","jsvariable","","","(.*)","","",""],orderid_Z1:["fnGetDataLayer","udf",["oid"],"","(.*)","","",""],orderprice:["dataLayer[10].op","jsvariable","","","(.*)","","",""],orderprice_Z1:["fnGetDataLayer","udf",["op"],"","(.*)","","",""],pageType:["dataLayer[36].type","jsvariable","","","(.*)","","",""],pageType_Z1:["dataLayer[8].type","jsvariable","","","(.*)","","",""],pageType_Z2:["fnGetPageType","udf",["type"],"","(.*)","","",""],serviceType:["dataLayer[12].service_type","jsvariable","","","(.*)","","",""],serviceType_Z1:["fnGetDataLayer","udf",["service_type"],"","(.*)","","",""]};var g={pid:["dataLayer[10].pid","jsvariable","","","(.*)","","",""],pid_Z1:["dataLayer[0].listing_id[0]","jsvariable","","","_(.*)","","",""],pageType:["dataLayer[9].type","jsvariable","","","(.*)","","",""],pageType_Z1:["fnGetPageType","udf",["type"],"","(.*)","","",""],Level:["dataLayer[15].city_type","jsvariable","","","(.*)","","",""],Level_Z1:["fnGetDataLayer","udf",["city_type"],"","(.*)","","",""],IgnoreSec:["dataLayer[4].listing_propertytype","jsvariable","","","(.*)","","",""],IgnoreSec_Z1:["fnGetDataLayer","udf",["listing_propertytype"],"","(.*)","","",""],serviceType:["dataLayer[11].service_type","jsvariable","","","(.*)","","",""],serviceType_Z1:["fnGetDataLayer","udf",["service_type"],"","(.*)","","",""]};var f={pid1:["dataLayer[0].listing_id[0]","jsvariable","","","_(.*)","","",""],pid2:["dataLayer[0].listing_id[1]","jsvariable","","","_(.*)","","",""],pid3:["dataLayer[0].listing_id[2]","jsvariable","","","_(.*)","","",""],pageType:["dataLayer[9].type","jsvariable","type","","(.*)","","",""],pageType_Z1:["fnGetPageType","udf",["type"],"","(.*)","","",""],Level:["dataLayer[23].city_type","jsvariable","","","(.*)","","",""],Level_Z1:["fnGetDataLayer","udf",["city_type"],"","(.*)","","",""],serviceType:["dataLayer[10].service_type","jsvariable","","","(.*)","","",""],serviceType_Z1:["fnGetDataLayer","udf",["service_type"],"","(.*)","","",""],IgnoreSec:["dataLayer[4].listing_propertytype","jsvariable","","","(.*)","","",""],IgnoreSec_Z1:["fnGetDataLayer","udf",["listing_propertytype"],"","(.*)","","",""]};var e={pageType:["dataLayer[0].type","jsvariable","","","(.*)","","",""],pageType_Z1:["fnGetDataLayer","udf",["type"],"","(.*)","","",""]};if(((pixel.matches(pixel.segParams.e500["pageType"],"i","thank_you")))){pixel.pixelConfig=a;pixel.paramArray.param="e500";}else{if(((pixel.matches(pixel.segParams.e300["pageType"],"i","product_page")))){pixel.pixelConfig=g;pixel.paramArray.param="e300";}else{if(((pixel.matches(pixel.segParams.e205["pageType"],"i","search_page")))){pixel.pixelConfig=f;pixel.paramArray.param="e205";}else{if(((pixel.matches(pixel.segParams.e100["pageType"],"i","home_page")))){pixel.pixelConfig=e;pixel.paramArray.param="e100";}}}}}else{if(b=="VIZVRM4248"){pixel.paramArray.account_id=b;pixel.paramArray.param="e000";pixel.paramArray.section=1;pixel.paramArray.level=1;pixel.segmentConfig={e300:{pid:["fnGetDataLayer","udf",["priExtRmtAd"],"","(.*)","","",""]}};pixel.getSegParams();pixel.extraParams=[];pixel.cookieDomain="";pixel.clickTrackers="";var g={pid:["fnGetDataLayer","udf",["priExtRmtAd"],"","(.*)","","",""],misc:["fnGetDataLayer","udf",["reccomExtRmtAd"],"","(.*)","","",""]};if(pixel.segParams.e300["subcat1id"]!=undefined&&pixel.segParams.e300["subcat1id"]!=""&&pixel.segParams.e300["catid"]!=undefined&&pixel.segParams.e300["catid"]!=""){pixel.segParams.e300["subcat1id"]=pixel.segParams.e300["catid"]+"_"+pixel.segParams.e300["subcat1id"];}if(pixel.segParams.e300["subcat2id"]!=undefined&&pixel.segParams.e300["subcat2id"]!=""&&pixel.segParams.e300["catid"]!=undefined&&pixel.segParams.e300["catid"]!=""&&pixel.segParams.e300["subcat1id"]!=undefined&&pixel.segParams.e300["subcat1id"]!=""){pixel.segParams.e300["subcat2id"]=pixel.segParams.e300["subcat1id"]+"_"+pixel.segParams.e300["subcat2id"];}if(((pixel.exists(pixel.segParams.e300["pid"],"")))){pixel.pixelConfig=g;pixel.paramArray.param="e300";}}}};pixel.callBackViz=function(c){c=(pixel.isSafari())?(c+"&sf=y"):c;var a=document.getElementsByTagName("script")[0];var b=document.createElement("script");b.type="text/javascript";b.src=c;b.async=true;a.parentNode.insertBefore(b,a);};pixel.vizidCookie=function(b,c){var a=pixel.getCookie(b);if(!a){a=pixel.generateVizCookie();pixel.setCookie(b,a,365,c);}return a;};pixel.generateVizCookie=function(){var d=pixel.isSafari()?"vizSF_":"viz_";var a=7418186;var e=parseInt(new Date().getTime()/1000,10).toString(16);var c=(Math.floor(Math.random()*a)).toString(16);while(c.length<5){c=c+(Math.floor(Math.random()*a)).toString(16);}c=c.slice(c.length-5);var b=d+e+c;return b;};pixel.setCookie=function(b,f,c,e){var a=e?("; domain="+e):"";if(c>0){var g=new Date();g.setDate(g.getDate()+c);var d=encodeURIComponent(f)+((c==null)?"":"; expires="+g.toUTCString())+"; path=/"+a;document.cookie=b+"="+d;}else{document.cookie=b+"="+encodeURIComponent(f);}};pixel.isSafari=function(){return Object.prototype.toString.call(window.HTMLElement).indexOf("Constructor")>0;};pixel.finalize=function(a){if(a=="VIZVRM400"){if(pixel.paramArray.param=="e300"){pixel.fnGet300Data();}else{if(pixel.paramArray.param=="e500"){pixel.fnGet500Data();}}if(/rent/i.test(pixel.paramArray.serviceType)){pixel.paramArray.account_id="VIZVRM3184";}if(pixel.paramArray.param=="e500"){pixel.paramArray.section=1;pixel.paramArray.level=1;}else{if(pixel.paramArray.param=="e300"){pixel.paramArray.section=1;pixel.paramArray.level=1;if((pixel.matches(pixel.paramArray.serviceType,"i","rent"))){pixel.paramArray.section=1;pixel.paramArray.level=3;}else{if((pixel.equalsTo(pixel.paramArray.Level,"0"))){pixel.paramArray.section=1;pixel.paramArray.level=2;}}}else{if(pixel.paramArray.param=="e205"){pixel.paramArray.section=1;pixel.paramArray.level=1;if((pixel.matches(pixel.paramArray.serviceType,"i","rent"))){pixel.paramArray.section=1;pixel.paramArray.level=3;}else{if((pixel.equalsTo(pixel.paramArray.Level,"0"))){pixel.paramArray.section=1;pixel.paramArray.level=2;}}}else{if(pixel.paramArray.param=="e100"){pixel.paramArray.section=1;pixel.paramArray.level=1;}}}}if(pixel.getCookie("Nty").split("|")[0]>1){pixel.paramArray.param="e100";pixel.paramArray.level="2";}delete pixel.paramArray.Level;if(pixel.paramArray.IgnoreSec&&/office\s*space|Shop\s*\/\s*Showroom|Commercial\s*Land|Warehouse\s*\/\s*Godown|Industrial\s*Building|Industrial\s*Shed/i.test(pixel.paramArray.IgnoreSec)){pixel.paramArray.param="e100";}}else{if(a=="VIZVRM4248"){if(pixel.paramArray.subcat1id!=undefined&&pixel.paramArray.subcat1id!=""&&pixel.paramArray.catid!=undefined&&pixel.paramArray.catid!=""){pixel.paramArray.subcat1id=pixel.paramArray.catid+"_"+pixel.paramArray.subcat1id;}if(pixel.paramArray.subcat2id!=undefined&&pixel.paramArray.subcat2id!=""&&pixel.paramArray.catid!=undefined&&pixel.paramArray.catid!=""&&pixel.paramArray.subcat1id!=undefined&&pixel.paramArray.subcat1id!=""){pixel.paramArray.subcat2id=pixel.paramArray.subcat1id+"_"+pixel.paramArray.subcat2id;}if(pixel.paramArray.param=="e300"){pixel.paramArray.section=1;pixel.paramArray.level=1;if((pixel.exists(pixel.paramArray.misc,""))){pixel.paramArray.section=1;pixel.paramArray.level=2;}}}}};if(typeof pixel!=="undefined"&&pixel&&typeof pixel.parse!=="undefined"){pixel.pixelFireStatus=false;pixel.checkReadyStateOnIntervals=null;pixel.paramArray=[];pixel.segParams=[];pixel.parse();}