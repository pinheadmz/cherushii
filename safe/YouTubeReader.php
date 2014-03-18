<?
    $dom = simplexml_load_file("http://www.youtube.com/rss/user/spreadtheillness/videos.rss");
?>

	<div id="videotarget"></div>

		<? $i = 0; foreach ($dom->channel->item as $item): ?>
		<?
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


		<? if(++$i > 2) break; endforeach ?>
	



<script type="text/javascript">
// **** loads a video into the player
function loadVideo(video)
{
	var videoHtml = "<iframe width='640' height='360' src='http://www.youtube.com/embed/"+ video +"?rel=0' frameborder='0' allowfullscreen></iframe>"

	$('#videotarget').html(videoHtml);
	$("#videotarget").slideDown();
}

</script>