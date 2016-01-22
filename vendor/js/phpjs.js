// Vendor: http://phpjs.org/

//  discuss at: http://phpjs.org/functions/md5/
// original by: Webtoolkit.info (http://www.webtoolkit.info/)
// improved by: Michael White (http://getsprink.com)
// improved by: Jack
// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
//    input by: Brett Zamir (http://brett-zamir.me)
// bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
//  depends on: utf8_encode
//   example 1: md5('Kevin van Zonneveld');
//   returns 1: '6e658d4bfcb59cc13f96c14450ac40b9'
function md5(n){var r,t,u,e,o,f,c,i,a,h,v=function(n,r){return n<<r|n>>>32-r},g=function(n,r){var t,u,e,o,f;return e=2147483648&n,o=2147483648&r,t=1073741824&n,u=1073741824&r,f=(1073741823&n)+(1073741823&r),t&u?2147483648^f^e^o:t|u?1073741824&f?3221225472^f^e^o:1073741824^f^e^o:f^e^o},s=function(n,r,t){return n&r|~n&t},d=function(n,r,t){return n&t|r&~t},l=function(n,r,t){return n^r^t},w=function(n,r,t){return r^(n|~t)},A=function(n,r,t,u,e,o,f){return n=g(n,g(g(s(r,t,u),e),f)),g(v(n,o),r)},C=function(n,r,t,u,e,o,f){return n=g(n,g(g(d(r,t,u),e),f)),g(v(n,o),r)},b=function(n,r,t,u,e,o,f){return n=g(n,g(g(l(r,t,u),e),f)),g(v(n,o),r)},m=function(n,r,t,u,e,o,f){return n=g(n,g(g(w(r,t,u),e),f)),g(v(n,o),r)},y=function(n){for(var r,t=n.length,u=t+8,e=(u-u%64)/64,o=16*(e+1),f=new Array(o-1),c=0,i=0;t>i;)r=(i-i%4)/4,c=i%4*8,f[r]=f[r]|n.charCodeAt(i)<<c,i++;return r=(i-i%4)/4,c=i%4*8,f[r]=f[r]|128<<c,f[o-2]=t<<3,f[o-1]=t>>>29,f},L=function(n){var r,t,u="",e="";for(t=0;3>=t;t++)r=n>>>8*t&255,e="0"+r.toString(16),u+=e.substr(e.length-2,2);return u},S=[],_=7,j=12,k=17,p=22,q=5,x=9,z=14,B=20,D=4,E=11,F=16,G=23,H=6,I=10,J=15,K=21;for(n=this.utf8_encode(n),S=y(n),c=1732584193,i=4023233417,a=2562383102,h=271733878,r=S.length,t=0;r>t;t+=16)u=c,e=i,o=a,f=h,c=A(c,i,a,h,S[t+0],_,3614090360),h=A(h,c,i,a,S[t+1],j,3905402710),a=A(a,h,c,i,S[t+2],k,606105819),i=A(i,a,h,c,S[t+3],p,3250441966),c=A(c,i,a,h,S[t+4],_,4118548399),h=A(h,c,i,a,S[t+5],j,1200080426),a=A(a,h,c,i,S[t+6],k,2821735955),i=A(i,a,h,c,S[t+7],p,4249261313),c=A(c,i,a,h,S[t+8],_,1770035416),h=A(h,c,i,a,S[t+9],j,2336552879),a=A(a,h,c,i,S[t+10],k,4294925233),i=A(i,a,h,c,S[t+11],p,2304563134),c=A(c,i,a,h,S[t+12],_,1804603682),h=A(h,c,i,a,S[t+13],j,4254626195),a=A(a,h,c,i,S[t+14],k,2792965006),i=A(i,a,h,c,S[t+15],p,1236535329),c=C(c,i,a,h,S[t+1],q,4129170786),h=C(h,c,i,a,S[t+6],x,3225465664),a=C(a,h,c,i,S[t+11],z,643717713),i=C(i,a,h,c,S[t+0],B,3921069994),c=C(c,i,a,h,S[t+5],q,3593408605),h=C(h,c,i,a,S[t+10],x,38016083),a=C(a,h,c,i,S[t+15],z,3634488961),i=C(i,a,h,c,S[t+4],B,3889429448),c=C(c,i,a,h,S[t+9],q,568446438),h=C(h,c,i,a,S[t+14],x,3275163606),a=C(a,h,c,i,S[t+3],z,4107603335),i=C(i,a,h,c,S[t+8],B,1163531501),c=C(c,i,a,h,S[t+13],q,2850285829),h=C(h,c,i,a,S[t+2],x,4243563512),a=C(a,h,c,i,S[t+7],z,1735328473),i=C(i,a,h,c,S[t+12],B,2368359562),c=b(c,i,a,h,S[t+5],D,4294588738),h=b(h,c,i,a,S[t+8],E,2272392833),a=b(a,h,c,i,S[t+11],F,1839030562),i=b(i,a,h,c,S[t+14],G,4259657740),c=b(c,i,a,h,S[t+1],D,2763975236),h=b(h,c,i,a,S[t+4],E,1272893353),a=b(a,h,c,i,S[t+7],F,4139469664),i=b(i,a,h,c,S[t+10],G,3200236656),c=b(c,i,a,h,S[t+13],D,681279174),h=b(h,c,i,a,S[t+0],E,3936430074),a=b(a,h,c,i,S[t+3],F,3572445317),i=b(i,a,h,c,S[t+6],G,76029189),c=b(c,i,a,h,S[t+9],D,3654602809),h=b(h,c,i,a,S[t+12],E,3873151461),a=b(a,h,c,i,S[t+15],F,530742520),i=b(i,a,h,c,S[t+2],G,3299628645),c=m(c,i,a,h,S[t+0],H,4096336452),h=m(h,c,i,a,S[t+7],I,1126891415),a=m(a,h,c,i,S[t+14],J,2878612391),i=m(i,a,h,c,S[t+5],K,4237533241),c=m(c,i,a,h,S[t+12],H,1700485571),h=m(h,c,i,a,S[t+3],I,2399980690),a=m(a,h,c,i,S[t+10],J,4293915773),i=m(i,a,h,c,S[t+1],K,2240044497),c=m(c,i,a,h,S[t+8],H,1873313359),h=m(h,c,i,a,S[t+15],I,4264355552),a=m(a,h,c,i,S[t+6],J,2734768916),i=m(i,a,h,c,S[t+13],K,1309151649),c=m(c,i,a,h,S[t+4],H,4149444226),h=m(h,c,i,a,S[t+11],I,3174756917),a=m(a,h,c,i,S[t+2],J,718787259),i=m(i,a,h,c,S[t+9],K,3951481745),c=g(c,u),i=g(i,e),a=g(a,o),h=g(h,f);var M=L(c)+L(i)+L(a)+L(h);return M.toLowerCase()}
///////////////////////////////

//  discuss at: http://phpjs.org/functions/utf8_encode/
// original by: Webtoolkit.info (http://www.webtoolkit.info/)
// improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
// improved by: sowberry
// improved by: Jack
// improved by: Yves Sucaet
// improved by: kirilloid
// bugfixed by: Onno Marsman
// bugfixed by: Onno Marsman
// bugfixed by: Ulrich
// bugfixed by: Rafal Kukawski
// bugfixed by: kirilloid
//   example 1: utf8_encode('Kevin van Zonneveld');
//   returns 1: 'Kevin van Zonneveld'
function utf8_encode(r){if(null===r||"undefined"==typeof r)return"";var e,n,t=r+"",a="",o=0;e=n=0,o=t.length;for(var f=0;o>f;f++){var i=t.charCodeAt(f),l=null;if(128>i)n++;else if(i>127&&2048>i)l=String.fromCharCode(i>>6|192,63&i|128);else if(55296!=(63488&i))l=String.fromCharCode(i>>12|224,i>>6&63|128,63&i|128);else{if(55296!=(64512&i))throw new RangeError("Unmatched trail surrogate at "+f);var d=t.charCodeAt(++f);if(56320!=(64512&d))throw new RangeError("Unmatched lead surrogate at "+(f-1));i=((1023&i)<<10)+(1023&d)+65536,l=String.fromCharCode(i>>18|240,i>>12&63|128,i>>6&63|128,63&i|128)}null!==l&&(n>e&&(a+=t.slice(e,n)),a+=l,e=n=f+1)}return n>e&&(a+=t.slice(e,o)),a}
///////////////////////////////

//  discuss at: http://phpjs.org/functions/microtime/
// original by: Paulo Freitas
//   example 1: timeStamp = microtime(true);
//   example 1: timeStamp > 1000000000 && timeStamp < 2000000000
//   returns 1: true
function microtime(e){var t=(new Date).getTime()/1e3,n=parseInt(t,10);return e?t:Math.round(1e3*(t-n))/1e3+" "+n}
///////////////////////////////