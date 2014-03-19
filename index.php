<?
	// youtube rss feed
	// $YouTubeDOM = 'http://www.youtube.com/rss/user/SexyEasystreet/videos.rss';

	// soundcloud website feed
	$soundcloudWWW = 'http://www.soundcloud.com/cherushii';

	// facebook page
	$facebookWWW = 'https://www.facebook.com/CherushiiMusic';

	// blogger rss feed
	$BlogDOM = 'http://www.cherushiimusic.blogspot.com/feeds/posts/default?alt=rss';

	// photo directories
	$picDir = 'Chelsea_Photos';
	$thumbDir = $picDir . '/thumbs'; // thumbnail directory must be called 'thumbs' and all thumbs must start with 't'

	// webloc directory
	$linksDir = 'Chelsea_Links';

	// bio text file
	$bioTxt = 'Chelsea_Bio.txt';

	// shows calendar text file
	$showsTxt = 'Chelsea_Shows.txt';
	
	// KALX calendar text file
	$kalxTxt = 'Chelsea_KALX.txt';


	// discography text file and artwork directory name
	$discographyTxt = 'Chelsea_Discography.txt';
	$discographyArtwork = 'Chelsea_Discography_Artwork';
	
	// don't print errors to page if something is wrong
	error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
<!-- 
***************************************
*  designed by MATTHEW ZIPKIN 2012    *
* matthew(dot)zipkin(at)gmail(dot)com *
***************************************
-->
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<meta name='viewport' content='width=1300'>
<link rel="icon" 
      type="image/gif" 
      href="i/C.gif">
<link rel="apple-touch-icon" 
      type="image/gif" 
      href="i/C.gif">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<title>Cherushii</title>
	
<link type='text/css' href='css/cherushii.css' rel='stylesheet' />
<link type='text/css' href='fonts/jerasans/stylesheet.css' rel='stylesheet' />
<link type='text/css' href='fonts/codepro_regulardemo_macroman/stylesheet.css' rel='stylesheet' />
<link type='text/css' href='fonts/questrial/stylesheet.css' rel='stylesheet' />

<!-- jQuery and jQuery UI for draggables, effects and cookies -->
<script type='text/javascript' src='include/jquery-1.7.2.min.js'></script>
<script type="text/javascript" src="include/jquery.transit.min.js"></script>

<!-- application code -->
<script type='text/javascript' src='js/cherushii.js'></script>

</head>
<body>
	<div id='BGc'>
		<div id='BG'></div>
		<div id='BG2'></div>
	</div>
<!-- *************************** header ****************************** -->
	<div id='headerc'>
		<div id='header'>
			<!-- <div id='headerpic'></div> -->
			<div id='headertxt'>cherushii<br><span>Producer : Composer : Live P.A.</span></div>
			<!-- <div class='blogShare'>
				<script type="text/javascript">document.write('<a href="https://www.facebook.com/sharer/sharer.php?u=' + location.href + '" target="_blank">');</script>
					<img src='i/fb50.png'></a>
				<script type="text/javascript">document.write('<a href="https://twitter.com/share?url=' + location.href + '" target="_blank">');</script>
					<img src='i/t50.png'></a>								
			</div> -->
		</div>
	</div>

	<div id='menuc'>
		<div id='menu'>
			<div id='news' class='menuButton'>News</div>
			<div id='audio' class='menuButton'>Sounds</div>
			<div id='live' class='menuButton'>Live</div>
			<div id='discography' class='menuButton'>Discography</div>
			<div id='bio' class='menuButton'>Bio</div>
			<!-- <div id='links' class='menuButton'>Links</div> -->
			<div id='contact' class='menuButton'>Contact</div>			
		</div>
	</div>

	<div id='mainc'>
		<div id='main'>
		<div id='grey'></div>
<!-- *************************** home  ****************************** -->
			<div id='newsC' class='content'>
				<div class='section'>Home</div>

<!-- *************************** blog  ****************************** -->
			<? $BlogDOM = @simplexml_load_file($BlogDOM); ?>
				<div id='blogc' class='front'>
					<div id='blog'>
						<? $i = 0; foreach ($BlogDOM->channel->item as $item): ?>
						<div>
						<h1><?= htmlspecialchars($item->title) ?></h1>
						
						<br><br>
						<span style="float:right;font-style:italic;font-size:12px"><?= substr(htmlspecialchars($item->pubDate), 0, -15) ?></span>
						<br>
						<?= $item->description;?>
						<br><hr><br></div>
						<? if(++$i > 10) break; endforeach ?>
					</div>
				</div>
<!--
				<div id='featuredV' class='featured front'>
					<h2>Featured Video:</h2>
					<div id='featuredVideo' class='youtubelinkF'></div>
				</div>
-->
				<div id='featuredA' class='featured front'>
					<h2>Latest Release:</h2>
					<div id='featuredAudio' class='soundcloudlinkF'></div>
				</div>

				<div id='featuredS' class='featured front'>
					<h2>Upcoming Events:</h2>
					<div id='featuredShow' class='showsItem'></div>
				</div>
				
				<!-- KALX ********************************** -->
				<? $kalxDOM = @simplexml_load_file($kalxTxt); ?>
				<div id='KALX' class='featured front'>
					<h2>Upcoming Radio <br>Shows On <a href="http://kalx.berkeley.edu" target="_blank">KALX</a>:</h2>
					
				<?
					foreach ($kalxDOM->show as $show){
						echo "<div class='kalxItem'>";
						if ($show->title) {
							echo $show->title;
							echo ":<br>";
						}
						if ($show->when) {
							echo $show->when;
						}
						echo "<br>&bull;</div>";
					}
				?>
						
							
				</div>
				
				
<!-- *************************** front page contact / booking ****************************** -->
<!--
				<div id='bookingC' class='front'>
					<div id='bookingText'>
						<br>
						<a href='mailto:chelcfaith@gmail.com'>chelcfaith@gmail.com</a><br>
						<a href='<?= $facebookWWW ?>' target='_blank'><img src='i/gotofb60.png'></a><br>
						Cherushii makes Detroit-influenced techno and house.
					</div>
				</div>
-->
			</div>

<!-- *************************** bio ****************************** -->
			<? $bioTxt = @file_get_contents($bioTxt); ?>
			<div id='bioC' class='content'>
				<div class='section'>Bio</div>
				<div class='bioText'>
					<div id='bioPic'></div>
					<?= $bioTxt ?>
				</div>

		<!-- ***************************** photos **************************** -->
				<div class='section'>Press Photos</div>
				<div class='bioText photosText'>Click to download high resolution images...</div>
				<div class='photoGallery'>
					<? 
						$picDirTitle = $picDir;
						$picDir = opendir($picDir);
						$thumbDirTitle = $thumbDir;
						$thumbDir = opendir($thumbDir);
					
						while (false !== ($entry = readdir($picDir))){
							if ($entry != '.' && $entry != '..'  && $entry != 'thumbs' ){
								echo '<a href="' . $picDirTitle . '/' . $entry . '" target="_blank">';
								echo '<img src="' . $picDirTitle . '/thumbs/t' . $entry . '">';
								echo '</a>';
							}		
						}
						closedir($picDir);
									
					?>
				</div>				

			</div>

<!-- *************************** live ****************************** -->
			<? $ShowsDOM = @simplexml_load_file($showsTxt); ?>
			<div id='liveC' class='content'>
				<div class='section'>Live</div>
				<div id='liveInfo'>
					<img src='i/live1.jpg'>
					<span>photo by: Amanda Kershaw</span>
				</div><br>
				<div id='showsInfo'>
					<?= $ShowsDOM->intro ?>
				</div><br>
				<div id='showsC'>
					<div class='section'>Upcoming Shows</div><br>
					<div id='shows'>
						<? foreach ($ShowsDOM->show as $show): ?>
						<div class='showsItem'>
							<? if ($show->link) { ?>
								<a href='<?= $show->link ?>' target='_blank'>
							<? } ?>						
							<h1><?= $show->title ?></h1>
							<? if ($show->link) { ?>
								</a>
							<? } ?>

						</div>
						<hr style='width:80%'>
						<? endforeach ?>
					</div>
				</div>
			</div>

<!-- *************************** discography ****************************** -->
			<? $DiscogDOM = @simplexml_load_file($discographyTxt); ?>
			<div id='discographyC' class='content'>
				<div class='section'>Selected Discography</div>

				<div id='discographyC'>
					<div id='discography'>
						<? foreach ($DiscogDOM->release as $release): ?>
						<div class='discographyItem'>
						<img src='<?= $discographyArtwork . '/' . $release->artwork ?>'>
						<h1><?= $release->title ?></h1>
						<?= $release->label ;?>
						<br>
						<? foreach ($release->links->link as $link): ?>
							<a href='<?= $link ?>' target='_blank'><?=$link->attributes()->type?></a>
						<? endforeach ?>
						</div>
						<hr>
						<? endforeach ?>
					</div>
				</div>
			</div>

<!-- *************************** videos ****************************** -->
<? /*
			<? $YouTubeDOM = simplexml_load_file($YouTubeDOM); ?>
			<div id='videoC' class='content'>
				<div class='section'>Videos</div>

				<? $i = 0; foreach ($YouTubeDOM->channel->item as $item):
				// DOMify the content in each XML "description" 
				$section = $item->description;
				$sectionDom = new DOMDocument();
				$sectionDom->loadHTML($section);
		
				// grab each video thumbnail
				$preview = $sectionDom->getElementsByTagName('img')->item(0)->getAttribute('src');
	
				// grab video title
				$title = $sectionDom->getElementsByTagName('a')->item(1)->textContent;
	
				// grab youtube id number
				$videourl = $sectionDom->getElementsByTagName('a')->item(0)->getAttribute('href'); 
				$video = explode("?v=", $videourl);
				$video = explode("&", $video[1]);
				$video = $video[0];
				?>
				<div class='youtubelink' onclick='loadVideo("<?= $video ?>")'>
					<img src=' <?= $preview ?> '>
					<span><?= $title ?></span>
				</div>
				<? if(++$i > 5) break; endforeach ?>

				<div id="videotarget"><span>select a video</span></div>
			</div>
*/ ?>

<!-- *************************** audio ****************************** -->
			<? $soundcloudFILE = @file_get_contents($soundcloudWWW); 
			$scDOM = new DOMDocument;
			@$scDOM->loadHTML($soundcloudFILE);
			$divs = $scDOM->getElementsByTagName('div'); ?>

			<div id='audioC' class='content'>
				<div class='section'>Sounds</div>

				<? $j=0; foreach ($divs as $div):
				if ( $div->hasAttribute('data-sc-track') && ($div->getAttribute('class') == 'medium mode player') ){
					// grab soundcloud id number for player widget
					$scID = $div->getAttribute('data-sc-track');
					// grab track title
					$scTitle = $div->getElementsByTagName('div')->item(0)->getElementsByTagName('h3')->item(0)->textContent;
					//get image url
					$scImg = $div->getElementsByTagName('div')->item(0)->getElementsByTagName('a')->item(0)->getAttribute('href');	
					
					// check for error and skip
					if (empty($scTitle) || empty($scImg))
						continue;
					
					// print HTML
					$scHTML = "<div class='soundcloudlink' onclick='loadAudio(" . $scID . ")'><img src='" . $scImg . "'><span>" . $scTitle . "</span></div>";
					echo $scHTML;

					if(++$j > 5) break;
				}
				endforeach ?>

				<div id="audiotarget"><span>select a track</span></div>
			</div>

<!-- ***************************** links **************************** -->
<? /*
			<? $linksDirObj = opendir($linksDir); ?>
			<div id='linksC' class='content'>
				<div class='section'>Links</div>
				<ul>
				<?

				while (false !== ($entry = readdir($linksDirObj))){
					if ($entry != '.' && $entry != '..'){
						$title = substr($entry, 0, -7);
						
						// open webloc file as XML DOM and grab URL from them
						$webloc = simplexml_load_file($linksDir . '/' . $entry);
						$link = $webloc->dict->string;
						echo "<li><a href='" . $link . "' target='_blank'>" . $title . "</a></li>";					

					}		
				}
				closedir($linksDirObj);
				?>
				</ul>
			</div>
*/ ?>
<!-- ***************************** contact **************************** -->
			<div id='contactC' class='content'>
				<div class='section'>Contact</div>
				<div id='contactText'>
					For booking, remix inquiries and general information, email:<br>
					<a href="mailto:info@cherushii.com">info@cherushii.com</a><br><br>

					<a href='<?= $facebookWWW ?>' target='_blank'>facebook</a>
					&nbsp;//&nbsp;
					<a href='<?= $soundcloudWWW ?>' target='_blank'>soundcloud</a>
				<? /*
					&nbsp;//&nbsp;
					<a href='/ChelseaFaith_Resume.pdf' target='_blank'>resume</a>
					<br>
				*/ ?>					
				</div>
			</div>
		</div>
	</div>







</body>
</html>
