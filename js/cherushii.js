/*
***************************************
*  designed by MATTHEW ZIPKIN 2012    *
* matthew(dot)zipkin(at)gmail(dot)com *
***************************************
*/

// get browser gradient method http://jsfiddle.net/desandro/bxMgf/
gradientSyntax = (function() {
	var div = document.createElement('div');
	var prefixes = [ '', '-webkit-', '-moz-', '-o-' ];
	var syntax;
	for ( var i=0, len = prefixes.length; i < len; i++ ) {
		var prefix = prefixes[i];
		syntax = prefix + 'linear-gradient';
		div.style.cssText = 'background-image: ' + syntax + '(left top,#9f9, white);';
		if ( div.style.backgroundImage ) {
			return syntax;
		}
	}

	// test legacy WebKit syntax 
	syntax = '-webkit-gradient';
	div.style.cssText = 'background-image: ' + syntax + '(linear,left top,right bottom,from(#9f9),to(white));';
	if ( div.style.backgroundImage ) {
		return syntax;
	}
})();


// fun background!
var BG = new (function(){
	this.angle = 0;
	this.angleInc = -40;
	this.color = ['#7AB8D0','#FA8E9B','#FFCA91','#9BEB86','#9586D8','#F1FC90','#C47BD3','#C6F48B'];
	this.baseColor = '#FFFFFF';
	this.left = 0;
	this.center = 50;
	this.right = 100;
	// SCHEME: http://colorschemedesigner.com/
	// http://colorschemedesigner.com/#5z425p1w0w0w0

	this.load = function(){
		this.fun(0, this.angleInc);
	}

	this.next = function(){
		var newColor = Math.floor(Math.random() * (this.color.length - 1));
		this.fun(newColor, this.angleInc);
	}

	this.fun = function(c, a){
		this.angle += a;
		// legacy browser compatibility
		if (gradientSyntax != '-webkit-gradient'){
			$("#BG").transition({
				rotate: this.angle +'deg',
				'background-image' : gradientSyntax + '(left, ' + this.baseColor + ' ' + this.left + '%, ' + this.color[c] + ' ' + this.center + '%, ' + this.baseColor + ' ' + this.right +'%)'
			}, 500);
		} else {
			$("#BG").transition({
				rotate: this.angle +'deg',
				'background-image' : gradientSyntax + '(linear,left top,right top, color-stop(' + this.left/100 + ', ' + this.baseColor + '),color-stop(' + this.center/100 + ', ' + this.color[c] + '), color-stop(' + this.right/100 + ', ' + this.baseColor + ') )'
			}, 500);
		}


	}
})();

// ***** runs on page load
$(window).load(function(){
	// start BG fun
	//BG.load();

	// menu buttons call up new content
	$('.menuButton').click(function(){menuClick( $(this).attr('id') )});

	// clicking on header returns to home page
	$('#headerc').click(function(){$('#news').click();});

	// clicking on photos makes toggle big / small
	$('#photosC img').click(function(){
		if( $(this).hasClass('zoomIn') )
			$(this).removeClass('zoomIn');
		else{
			$('#photosC img').removeClass('zoomIn');
			$(this).addClass('zoomIn');
		}
	});

	// all links in the blog open in new windows
	$("#blog a").attr('target', '_blank');

/*
	// randomly grab a video for "featured" video
	var vidNumber = $(".youtubelink").length;
	var vidFeatured = Math.floor((Math.random()*vidNumber)+1);
	var vidHTML = $(".youtubelink")[vidFeatured - 1].innerHTML;
	$("#featuredVideo").html(vidHTML);
	// featured video links to video page and loads featured video
	var clickFeatured = $(".youtubelink")[vidFeatured - 1].onclick;
	$("#featuredVideo").click(clickFeatured);
	$("#featuredVideo").click(function(){
		$("#video").click();
	});
*/

	// grab latest soundcloud post for "featured" audio
	// var audNumber = $(".soundcloudlink").length;
	// var audFeatured = Math.floor((Math.random()*audNumber)+1);
	// if statement added in case soundcloud isn't loading
	if ($(".soundcloudlink")[0]){
		var audHTML = $(".soundcloudlink")[0].innerHTML;
		$("#featuredAudio").html(audHTML);
		// featured audio links to audio page and loads featured audio
		var clickFeaturedA = $(".soundcloudlink")[0].onclick;
		$("#featuredAudio").click(clickFeaturedA);
	}
	
	$("#featuredAudio").click(function(){
		$("#audio").click();
	});

	// grab all show posts for front page calendar
	var showNumber = $(".showsItem").length;
	for (var i = 1; i < showNumber; i++){
		$("#featuredShow").append( $(".showsItem")[i].innerHTML );
		$("#featuredShow").append('<br>');
	}

});

// ***** goes to specific content
function menuClick(choice){
	//BG.next();
	var content = '#' + choice + 'C';
	$('.content').transition({left: ($('body').width() * -1)},500,function(){
		$('.content').css({'visibility': 'hidden'});
		$(content).css({'visibility': 'visible', 'opacity': '0', 'left': '5px'});
		setTimeout(function(){$(content).stop().transition({opacity: 1},500);},50);
	});
}

// ***** loads a youtube video into the player area
function loadVideo(video)
{
	var videoHtml = "<iframe width='640' height='360' src='http://www.youtube.com/embed/"+ video +"?rel=0' frameborder='0' allowfullscreen></iframe>"

	$('#videotarget').html(videoHtml);
}

// ***** loads a soundcloud player into the player area
function loadAudio(audio)
{
	var audioHtml = "<iframe width='100%' height='166' scrolling='no' frameborder='no' src='http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F" + audio + "&amp;auto_play=false&amp;show_artwork=true&amp;color=45116F'></iframe>"

	$('#audiotarget').html(audioHtml);
}









