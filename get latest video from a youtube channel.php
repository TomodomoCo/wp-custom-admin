						<div class="box">
							<h3 class="rule">
								SMOOTH FM
								<span>
									TV
								</span>
							</h3>
                            
    <script type="text/javascript">
    function showMyVideos(data) {
    	var feed = data.feed;
    	var entries = feed.entry || [];
    	var html = [];
    	for (var i = 0; i < entries.length; i++) {
    		// Parse out YouTube entry data
    		var entry = entries[i];
    		var title = entry.title.$t;
    		var playerUrl = entries[i].media$group.media$content[0].url;
    		html.push( /*"<h4>", title, "</h4>\n",*/
    		           "<object width='339' height='203'><param name='movie' value='" , playerUrl , "&hl=en&fx=1&'></param><param name='allowFullScreen' value='true'></param><param name='allowscriptaccess' value='always'></param><embed src='" , playerUrl , "&hl=en&fs=1&' type='application/x-shockwave-flash' allowscriptaccess='always' allowfullscreen='true' width='339' height='203'></embed></object>" );
    		}
    	document.getElementById('videos').innerHTML = html.join('');
    	} 
    </script>
    <div id="videos" style="text-align: center;"> <!-- The showMyVideos() JavaScript function places the YouTube video code here -->
    </div>
    
    <script 
        type="text/javascript" 
        src="http://gdata.youtube.com/feeds/users/Smooth981fm/uploads?alt=json-in-script&max-results=1&callback=showMyVideos">
    </script>
						<!--	<img src="<?php echo get_template_directory_uri(); ?>/images/smoothvideo.png" />-->
							<a href="http://www.youtube.com/user/Smooth981fm" class="more videoa">VIEW MORE</a>
						</div>