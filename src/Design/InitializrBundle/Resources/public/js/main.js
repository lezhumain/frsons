function getTexte( elem )
{
	return elem.text();
}

function getNodeName( elem )
{
	return elem.get(0).nodeName;
}

/*function hasAttr(elem, name) { 
   return elem.attr(name) != undefined;
};*/
$.fn.hasAttr = function(name) { 
   return this.attr(name) != undefined;
};

function capitalize(str)
{
	return str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
	    return letter.toUpperCase();
	});
}

function aff_err()
{
	var partWrap = $("form .part-wrapper");
	var error = partWrap.children('ul');
	var offset = partWrap.children('input').offset();
	
	offset.left += 30; 
	
	error.css('margin', '0px');
	error.css('position','absolute');
	
	error.offset( { top: offset.top, left: offset.left } );
}

$(document).ready( function()
{
	// on selectionne le menu clique dernierement
	$('#'+cp).addClass('current');
	
	if( $('#Accueil a').attr('href') != 'http://localhost/Symfony-Initializr/web/app_dev.php/site/accueil' );
		$('#Accueil a').attr('href', 'http://localhost/Symfony-Initializr/web/app_dev.php/site/accueil');
	
	$(window).resize(function()
	{
		if( $(window).width() > 480  &&  $(".menubar .menu-responsive").hasAttr("style") )
			$(".menubar .menu-responsive").removeAttr("style");
	});
});