<?php

class ShareExtension extends DataExtension {
	
	public function ShareIcons() {
	
		// CSS
		Requirements::css('shareicons/css/shareicons.css');
	
		// Facebook recommend button
		$appID = $this->owner->SiteConfig->FacebookApp;
		Requirements::customScript(<<<JS
			(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=$appID";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk')); 
JS
		);
				
		// Twitter tweet this button
		Requirements::customScript(<<<JS
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
JS
		);
		
		// LinkedIn button
		Requirements::javascript('http://platform.linkedin.com/in.js');
		
		// Google+ button
		Requirements::customScript(<<<JS
			(function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
JS
		);
		
		
		// social tracking via google analytics
		Requirements::insertHeadTags('
			<script type="text/javascript" src="shareicons/javascript/ga_social_tracking.js"></script>
		');
		
		// Facebook tracking
		Requirements::customScript(<<<JS
			_ga.trackFacebook();
JS
		);
		
		// Twitter tracking
		Requirements::insertHeadTags("
			<script>
			(function(){
				var twitterWidgets = document.createElement('script');
				twitterWidgets.type = 'text/javascript';
				twitterWidgets.async = true;
				twitterWidgets.src = 'https://platform.twitter.com/widgets.js';
				// Setup a callback to track once the script loads.
				twitterWidgets.onload = _ga.trackTwitter;
				document.getElementsByTagName('head')[0].appendChild(twitterWidgets);
			})();
			</script>
		");
		
		// LinkedIn tracking
		Requirements::insertHeadTags("
			<script type=\"text/javascript\">
				function LinkedInShare() {
				_gaq.push(['_trackSocial', 'LinkedIn', 'Share']);
				}
			</script>
		");
		
		
		
		
		
		// generate share icons html, return to template
		$page_url = Director::absoluteBaseURL() . Controller::curr()->Link();
		
		//$page_url = $this->owner->getCurrentItem()->absoluteLink();
		
		$html = '<div class="shareicons clearfix">
			<ul>
				<li class="twitter">
					<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
				</li>';
				
				/*$html .= '
				<li class="linkedin">
					<script type="IN/Share" data-counter="right" data-showzero="true" onsuccess="LinkedInShare"></script>
				</li>';*/
				$html .= '<li class="googleplus">
					<div class="g-plusone" data-size="medium"></div>
				</li>
				<li class="facebook">
					<div class="fb-like" data-href="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-action="recommend"></div>
				</li>
			</ul>
		</div>';

		return $html;
		
	}
	
}