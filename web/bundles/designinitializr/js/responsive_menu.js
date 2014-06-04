/*
Utilisation:
	Ajouter la class "menu-responsive" a ul
	Ajouter un noeud ' 	<div class="menu-small">
							<img src="img/bandes_menu.png"/>
						</div> ' 
		avant votre ul, dans le même wrapper
	Ajouter l'image dans le dossier img
*/

$(document).ready(function()
{

	$('.menu-small').click(function()
	{
		if( $('.menu-responsive').css("display") == "none" )
			$('.menu-responsive').slideDown();
		else
			$('.menu-responsive').slideUp();
	});

}); 