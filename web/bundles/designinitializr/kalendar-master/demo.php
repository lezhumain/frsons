<!DOCTYPE html>
<html>
	<head>
		<meta name="twitter:card" content="summary">
		<meta name="twitter:site" content="@ericwenn">
		<meta name="twitter:creator" content="@ericwenn">
		<meta name="twitter:title" content="kalendar, a customizable jquery plugin">
		<meta name="twitter:description" content="">

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>kalendar, a demo</title>
		<link href="css/a.css" rel="stylesheet">
		<link href="css/kalendar.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>

	</head>
	<body class="playground">
		

		<main>
			<div class="kalendar"></div>
		</main>

		<script src="js/a.js"></script>
		<script src="js/kalendar.js"></script>

		<script>
		$(document).ready(function()
		{
			$('.kalendar').kalendar({ 
				events: [
					{
						title:"Colored events",
						url: "http://www.google.se",
						start: {
							date: 20140115,
							time: "12.00"
						},
						end: {
							date: "20140116",
							time: "14.00"
						},
						location: "London",
						color: "yellow"

					},
					{
						title:"Colored events",
						url: "http://www.google.se",
						start: {
							date: 20140115,
							time: "12.00"
						},
						end: {
							date: "20140116",
							time: "14.00"
						},
						location: "London"

					},
					{
						title:"Way Out West",
						start: {
							date: 20131230,
							time: "12.00"
						},
						end: {
							date: "20140106",
							time: "14.00"
						},
						location: "Gothenburg",
						color: "yellow"

					}
				],
				color: "green",
				firstDayOfWeek: "Sunday",
				eventcolors: {
					yellow: {
						background: "#FC0",
						text: "#000",
						link: "#000"
					},
					blue: {
						background: "#6180FC",
						text: "#FFF",
						link: "#FFF"
					}
				}
			});

		});
		</script>
	</body>

</html>