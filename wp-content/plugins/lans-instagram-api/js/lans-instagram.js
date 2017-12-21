var lans_js_exists = (typeof lans_js_exists !== 'undefined') ? true : false;
if(!lans_js_exists){

	(function(){var e,t;e=function(){function e(e,t){var n,r;this.options={target:"instafeed",get:"popular",resolution:"thumbnail",sortBy:"none",links:!0,mock:!1,useHttp:!1};if(typeof e=="object")for(n in e)r=e[n],this.options[n]=r;this.context=t!=null?t:this,this.unique=this._genKey()}return e.prototype.hasNext=function(){return typeof this.context.nextUrl=="string"&&this.context.nextUrl.length>0},e.prototype.next=function(){return this.hasNext()?this.run(this.context.nextUrl):!1},e.prototype.run=function(t){var n,r,i;if(typeof this.options.clientId!="string"&&typeof this.options.accessToken!="string")throw new Error("Missing clientId or accessToken.");if(typeof this.options.accessToken!="string"&&typeof this.options.clientId!="string")throw new Error("Missing clientId or accessToken.");return this.options.before!=null&&typeof this.options.before=="function"&&this.options.before.call(this),typeof document!="undefined"&&document!==null&&(i=document.createElement("script"),i.id="instafeed-fetcher",i.src=t||this._buildUrl(),n=document.getElementsByTagName("head"),n[0].appendChild(i),r="instafeedCache"+this.unique,window[r]=new e(this.options,this),window[r].unique=this.unique),!0},e.prototype.parse=function(e){var t,n,r,i,s,o,u,a,f,l,c,h,p,d,v,m,g,y,b,w,E,S;if(typeof e!="object"){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,"Invalid JSON data"),!1;throw new Error("Invalid JSON response")}if(e.meta.code!==200){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,e.meta.error_message),!1;throw new Error("Error from Instagram: "+e.meta.error_message)}if(e.data.length===0){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,"No images were returned from Instagram"),!1;throw new Error("No images were returned from Instagram")}this.options.success!=null&&typeof this.options.success=="function"&&this.options.success.call(this,e),this.context.nextUrl="",e.pagination!=null&&(this.context.nextUrl=e.pagination.next_url);if(this.options.sortBy!=="none"){this.options.sortBy==="random"?d=["","random"]:d=this.options.sortBy.split("-"),p=d[0]==="least"?!0:!1;switch(d[1]){case"random":e.data.sort(function(){return.5-Math.random()});break;case"recent":e.data=this._sortBy(e.data,"created_time",p);break;case"liked":e.data=this._sortBy(e.data,"likes.count",p);break;case"commented":e.data=this._sortBy(e.data,"comments.count",p);break;default:throw new Error("Invalid option for sortBy: '"+this.options.sortBy+"'.")}}if(typeof document!="undefined"&&document!==null&&this.options.mock===!1){a=e.data,this.options.limit!=null&&a.length>this.options.limit&&(a=a.slice(0,this.options.limit+1||9e9)),n=document.createDocumentFragment(),this.options.filter!=null&&typeof this.options.filter=="function"&&(a=this._filter(a,this.options.filter));if(this.options.template!=null&&typeof this.options.template=="string"){i="",o="",l="",v=document.createElement("div");for(m=0,b=a.length;m<b;m++)s=a[m],u=s.images[this.options.resolution].url,this.options.useHttp||(u=u.replace("http://","//")),o=this._makeTemplate(this.options.template,{model:s,id:s.id,link:s.link,image:u,caption:this._getObjectProperty(s,"caption.text"),likes:s.likes.count,comments:s.comments.count,location:this._getObjectProperty(s,"location.name")}),i+=o;v.innerHTML=i,S=[].slice.call(v.childNodes);for(g=0,w=S.length;g<w;g++)h=S[g],n.appendChild(h)}else for(y=0,E=a.length;y<E;y++)s=a[y],f=document.createElement("img"),u=s.images[this.options.resolution].url,this.options.useHttp||(u=u.replace("http://","//")),f.src=u,this.options.links===!0?(t=document.createElement("a"),t.href=s.link,t.appendChild(f),n.appendChild(t)):n.appendChild(f);this.options.target.append(n),r=document.getElementsByTagName("head")[0],r.removeChild(document.getElementById("instafeed-fetcher")),c="instafeedCache"+this.unique,window[c]=void 0;try{delete window[c]}catch(x){}}return this.options.after!=null&&typeof this.options.after=="function"&&this.options.after.call(this),!0},e.prototype._buildUrl=function(){var e,t,n;e="https://api.instagram.com/v1";switch(this.options.get){case"popular":t="media/popular";break;case"tagged":if(typeof this.options.tagName!="string")throw new Error("No tag name specified. Use the 'tagName' option.");t="tags/"+this.options.tagName+"/media/recent";break;case"location":if(typeof this.options.locationId!="number")throw new Error("No location specified. Use the 'locationId' option.");t="locations/"+this.options.locationId+"/media/recent";break;case"user":if(typeof this.options.userId!="number")throw new Error("No user specified. Use the 'userId' option.");if(typeof this.options.accessToken!="string")throw new Error("No access token. Use the 'accessToken' option.");t="users/"+this.options.userId+"/media/recent";break;default:throw new Error("Invalid option for get: '"+this.options.get+"'.")}return n=""+e+"/"+t,this.options.accessToken!=null?n+="?access_token="+this.options.accessToken:n+="?client_id="+this.options.clientId,this.options.limit!=null&&(n+="&count="+this.options.limit),n+="&callback=instafeedCache"+this.unique+".parse",n},e.prototype._genKey=function(){var e;return e=function(){return((1+Math.random())*65536|0).toString(16).substring(1)},""+e()+e()+e()+e()},e.prototype._makeTemplate=function(e,t){var n,r,i,s,o;r=/(?:\{{2})([\w\[\]\.]+)(?:\}{2})/,n=e;while(r.test(n))i=n.match(r)[1],s=(o=this._getObjectProperty(t,i))!=null?o:"",n=n.replace(r,""+s);return n},e.prototype._getObjectProperty=function(e,t){var n,r;t=t.replace(/\[(\w+)\]/g,".$1"),r=t.split(".");while(r.length){n=r.shift();if(!(e!=null&&n in e))return null;e=e[n]}return e},e.prototype._sortBy=function(e,t,n){var r;return r=function(e,r){var i,s;return i=this._getObjectProperty(e,t),s=this._getObjectProperty(r,t),n?i>s?1:-1:i<s?1:-1},e.sort(r.bind(this)),e},e.prototype._filter=function(e,t){var n,r,i,s,o;n=[],i=function(e){if(t(e))return n.push(e)};for(s=0,o=e.length;s<o;s++)r=e[s],i(r);return n},e}(),t=typeof exports!="undefined"&&exports!==null?exports:window,t.instagramfeed=e}).call(this);

    function lans_init(){

        jQuery('#lans_instagram').each(function(){

            var $self = jQuery(this),
                $target = $self.find('#lans_images'),
                imgRes = 'standard_resolution',
                num = this.getAttribute('data-num'),
                //Convert styles JSON string to an object
                feedOptions = JSON.parse( this.getAttribute('data-options') ),
                getType = 'user',
                sortby = 'none',
                user_id = this.getAttribute('data-id'),
                num = this.getAttribute('data-num'),
                posts_arr = [],
                $header = '',
                morePosts = []; //Used to determine whether to show the Load More button when displaying posts from more than one id/hashtag. If one of the ids/hashtags has more posts then still show button.

            //Split comma separated hashtags into array
            var ids_arr = user_id.replace(/ /g,'').split(",");
            var looparray = ids_arr;

            //Get page info for first User ID
            var lans_page_url = 'https://api.instagram.com/v1/users/' + ids_arr[0] + '?access_token=' + lans_instagram_js_options.lans_instagram_at;

            jQuery.ajax({
                method: "GET",
                url: lans_page_url,
                dataType: "jsonp",
                success: function(data) {
                    $header = '<figure>';
                    $header += '<div>';
                    $header += '<img src="'+data.data.profile_picture+'" alt="'+data.data.full_name+'" width="50" height="50">';
                    $header += '</div>';
                    $header += '<figcaption>';
                    $header += '<p>';
                    $header += '<a href="http://instagram.com/'+data.data.username+'" target="_blank" title="@'+data.data.username+'">';
                    $header += data.data.username;
                    $header += '</a></p></figcaption>';
                    $header += '</figure>';
                    $header += '</a>';
                    //Add the header
//                    $self.find('.lans_instagram_header').prepend( $header );
                }
            });

            //Loop through User IDs
            jQuery.each( looparray, function( index, entry ) {

                var userFeed = new instagramfeed({
                    target: $target,
                    get: getType,
                    sortBy: sortby,
                    resolution: imgRes,
                    limit: parseInt( num, 10 ),
                    template: '<li data-background class="columns relative column-block lans_type_{{model.type}} lans_new" id="lans_{{id}}" data-date="{{model.created_time_raw}}"><figure class="lans_photo_wrap row collapse"><a class="th lans_photo column small-12" href="{{link}}" target="_blank"><img src="{{image}}" alt="" width="200" height="200"></a><figcaption><p>{{caption}}</p></figcaption></figure></li>',
                    filter: function(image) {
                        //Create time for sorting
                        var date = new Date(image.created_time*1000),
                            time = date.getTime();
                        image.created_time_raw = time;

                        //Remove all special chars in caption so doesn't cause issue in alt tag
                        //Always check to make sure it exists
//                        if(image.caption != null) image.caption.text = image.caption.text.replace(/[^a-zA-Z ]/g, "");

                        //Remove caching key from image sources to prevent duplicate content issue
                        image.images.thumbnail.url = image.images.thumbnail.url.split("?ig_cache_key")[0];
                        image.images.standard_resolution.url = image.images.standard_resolution.url.split("?ig_cache_key")[0];
                        image.images.low_resolution.url = image.images.low_resolution.url.split("?ig_cache_key")[0];

                        return true;
                    },
                    userId: parseInt( entry, 10 ),
                    accessToken: lans_instagram_js_options.lans_instagram_at,
                    after: function() {

                        // Call Custom JS if it exists
                        if (typeof lans_custom_js == 'function') setTimeout(function(){ lans_custom_js(); }, 100);
                        //Only check the width once the resize event is over
                        var lans_delay = (function(){
                            var lans_timer = 0;
                                return function(lans_callback, lans_ms){
                                clearTimeout (lans_timer);
                                lans_timer = setTimeout(lans_callback, lans_ms);
                            };
                        })();
	
												$self.find('[data-background]').each(function(args){
														var img = jQuery(this).find('img');
														if(img.length > 0) jQuery(this).css('background-image', 'url('+jQuery(img).attr('src')+')');
												});
												
                        //Sort posts by date
                        //only sort the new posts that are loaded in, not the whole feed, otherwise some photos will switch positions due to dates
                        $self.find('#lans_images .lans_item.lans_new').sort(function (a, b) {
                            var aComp = jQuery(a).data('date'),
                                bComp = jQuery(b).data('date');

                            if(sortby == 'none'){
                                //Order by date
                                return bComp - aComp;
                            } else {
                                //Randomize
                                return (Math.round(Math.random())-0.5);
                            }

                        }).appendTo( $self.find("#lans_images") );

                        //Remove the new class after 500ms, once the sorting is done
                        setTimeout(function(){
                            jQuery('#lans_images .lans_item.lans_new').removeClass('lans_new');
                            //Reset the morePosts variable so we can check whether there are more posts every time the Load More button is clicked
                            morePosts = [];
                        }, 500);

                    }, // End 'after' function
                    error: function(data) {
                        var sbiErrorMsg = '',
                            sbiErrorDir = '';

                        if( data.indexOf('access_token') > -1 ){
                            sbiErrorMsg += '<p><b>Error: Access Token is not valid</b><br /><span>This error message is only visible to WordPress admins</span>';
                            sbiErrorDir = "<p>There's an issue with the Instagram Access Token that you are using. Please obtain a new Access Token on the plugin's Settings page.<br />If you continue to have an issue with your Access Token then please see <a href='https://smashballoon.com/my-instagram-access-token-keep-expiring/' target='_blank'>this FAQ</a> for more information.";
                        } else if( data.indexOf('user does not exist') > -1 ){
                            sbiErrorMsg += '<p><b>Error: The User ID does not exist</b><br /><span>This error is only visible to WordPress admins</span>';
                            sbiErrorDir = "<p>Please double check the Instagram User ID that you are using. To find your User ID simply enter your Instagram user name into this <a href='http://www.otzberg.net/iguserid/' target='_blank'>tool</a>.</p>";
                        }

                        //Add the error message to the page unless the user is displaying multiple ids or hashtags
                        if(looparray.length < 2) jQuery('#lans_instagram').empty().append( '<p style="text-align: center;">Unable to show Instagram photos</p><div id="lans_mod_error">' + sbiErrorMsg + sbiErrorDir + '</div>');
                    }
                });

                userFeed.run();

            }); //End User ID array loop

        
        });

    }

    jQuery( document ).ready(function() {
        lans_init();
        var delayit = setTimeout(function(){
	        jQuery.each(jQuery('.lans_photo_wrap'), function(){
		        jQuery.each(jQuery(this).find('p'), function(){
			        var full = jQuery(this).text();
			        var text = full.substr(0, full.search('#'));
			        var hashes = full.split('#');
			        var htext = '<span class="hash">#';
					    var hspan = '</span>' + htext;
			        if(hashes.length > 0){
						      hashes.shift();
						      hashes.join(hspan);
						      htext += hashes + '</span>';
									htext = htext.replace(/ ,/g, hspan);
					    }else{
						    htext = full;
						  }
					    jQuery(this).html(text).after().append(htext);
			      });
					});
				}, 300);
    });

} // end lans_js_exists check