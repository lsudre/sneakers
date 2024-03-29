/*
 * Curry currency conversion jQuery Plugin v0.8.3
 * https://bitbucket.org/netyou/curry-currency-ddm
 *
 * Copyright 2017, NetYou (http://curry.netyou.co.il)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function(d){d.fn.curry=function(m){window.jQCurryPluginCache||(window.jQCurryPluginCache=[{},!1]);var e="",g={},u=window.jQCurryPluginCache[1],n=d(document),h,q,l,r,k=d.extend({target:".price",change:!0,base:"USD",symbols:{}},m);this.each(function(){var a=d(this),b=a.attr("id"),f=a.attr("class");b=""+(b?' id="'+b+'"':"");f?(b+=' class="curry-ddm',b=f?b+(" "+f+'"'):b+'"'):b+="";e="<select"+b+"></select>";f=d(e).insertAfter(a);a.detach();h=h?h.add(f):f});var p=function(a){e="";h.each(function(){for(l in a)r=
a[l],e+='<option value="'+l+'" data-rate="'+r+'">'+l+"</option>";d(e).appendTo(this)})};if(k.customCurrency)p(k.customCurrency);else if(u)n.on("jQCurryPlugin.gotRates",function(){p(window.jQCurryPluginCache[0])});else m=d.ajax({url:"https://api.fixer.io/latest",dataType:"jsonp",data:{symbols:"INR,EUR,CAD,GBP,ILS",base:k.base}}),window.jQCurryPluginCache[1]=!0,m.done(function(a){a=a.rates;g[k.base]=1;for(var b in a)q=a[b],g[b]=q;p(g);window.jQCurryPluginCache[0]=g;n.trigger("jQCurryPlugin.gotRates")}).fail(function(a){console.log(a)});
if(k.change){var v=d.extend({USD:"&#36;",GBP:"&pound;",EUR:"&euro;",JPY:"&yen;"},k.symbols),t;n.on("change",this.selector,function(){for(var a=d(k.target),b=d(this).find(":selected"),f=b.data("rate"),e=!1,c,h=a.length,g=0;g<h;g++)$price=d(a[g]),c=$price.text(),-1!==c.indexOf(",")&&(e=!0,c=c.replace(",",".")),c=Number(c.replace(/[^0-9\.]+/g,"")),$price.data("base-figure")?c=f*$price.data("base-figure"):($price.data("base-figure",c),c*=f),c=Number(c.toString().match(/^\d+(?:\.\d{0,2})?/)),e&&(c=c.toString().replace(".",
","),e=!1),t=v[b.val()]||b.val(),$price.html('<span class="symbol">'+t+"</span>"+c)})}return h}})(jQuery);
