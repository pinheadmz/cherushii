<?
	$dom = simplexml_load_file("http://www.milothemadscientist.blogspot.com/feeds/posts/default?alt=rss");
?>

<!DOCTYPE html>

<html>
<head>
<title>Blogger RSS Reader</title>
</head>
<body>
	<h1><?= $dom->channel->title ?></h1>
	<ul>
	<? $i = 0; foreach ($dom->channel->item as $item): ?>
		<li><a href="<?= $item->link ?>"><?= htmlspecialchars($item->title) ?></a>
			<br>
			<?= $item->description;?>
		</li>
	<? if(++$i > 2) break; endforeach ?>
	</ul>
</body>
</html>
