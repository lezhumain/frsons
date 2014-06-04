/*
 * Formatte une date
 * sDate : format "YYYY-MM-DD"
 * return : "DD-MM-YYYY"
 */
function dateFormat(sDate)
{
	var aDate = sDate.split('-');
	return "" + aDate[2] + "-" + aDate[1] + "-" + aDate[0];
}

function getHtml(ev)
{
	var string ="";
	
	string = "<span><strong>Titre: </strong>"+ ev.title +"<br><br>";

	if(ev.date != undefined)
		string += "<strong>Date: </strong>" + dateFormat(ev.date) +"<br><br>";
	else
	{
		if (ev.startDate == ev.endDate)
			string += "<strong>Date: </strong>" + dateFormat(ev.startDate) +"<br><br>";
		else
			string += "<strong>Date de début: </strong>" + dateFormat(ev.startDate) + "<br><strong>Date de fin: </strong>" + dateFormat(ev.endDate) + "<br><br>";
	}
				
	string += "<strong>Description: </strong><p>" + ev.description + "</p>";

	string += "<strong>Instruments concernés: </strong><ul>"
	
	try
	{
		if(ev.instruments.length == 0)
			string += "aucun";
		else
			for(var i = 0; i < ev.instruments.length; ++i)
				string += "<li>" + ev.instruments[i].nom + "</li>";
	}
	catch (e)
	{
		console.log(e);
		
		string += "aucun";
	}
		
	string += "</ul></span>";
	
	return string;
}

/*
 * Retourne le cours (evnmt) contenu
 * dans l'array "cours" (dans agenda.html)
 * et correspondant à la date "date"
 */
function getCours(date)
{
	var i = 0;
	
	for(; i<cours.length; ++i)
	{
		//alert(cours[i].startDate);
		if(cours[i].startDate == date)
			return cours[i];
	};
	return null;
}

function getStage(date)
{
	var i = 0;
	
	for(; i<stages.length; ++i)
	{
		//alert(cours[i].startDate);
		if(stages[i].startDate == date)
			return stages[i];
	};
	return null;
}


function clicked(target)
{
	var wrap = $(".cal_details_wrapper");
	var events = target.events;
	var date =  dateFormat( target.date._i );
	var string = "";
	var type = "";

	if(events.length == 0)
	{ // peut etre un cours
		// cours recup d'une maniere diff
		var c = getCours(target.date._i);
		
		if(c == null) // aucun
			string = "aucun évènement";
		else // cours
		{
			string = getHtml(c);
			type = "Cours :";
		}
	}
	else // est un stage
	{
		var ev = target.events[0];
		string = getHtml(ev);
		type = "Stage :";
	}

	// leve le detail
	wrap.slideUp(function()
	{ // puis
		// le supprime
		$(this).children("span").remove();
		// cree le nouveau
		$(this).prepend("<span><h1>" + date + ":</h1><h2>" + type + "</h2>"+ string +"</span>");
		// le baisse
		switch (type)
		{
			case "Cours :":
				$("#evInscr").show();
				break;
			case "Stage :":
				$("#evInscr").show();
				break;
			default:
				$("#evInscr").hide();
				break;
		}
		$(this).slideDown();
	});	
}

/*
 * Affiche les bandes pour 
 * les cours dans les jours
 */
function ready()
{
	var date;
	var cpt = 0;
	
	if(cours == null || cours.length == 0)
		return;

	// on charge marque les jours pour lesquels
	// des cours existent
	for(; cpt<cours.length; ++cpt)
	{
		date = cours[cpt].startDate;

		$("td.calendar-day-" + date).append('<div class="cours_wrapper"><div class="cours"></div></div>');
	}
}