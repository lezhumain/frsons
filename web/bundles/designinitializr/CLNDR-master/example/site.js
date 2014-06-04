// call this from the developer console and you can control both instances
var calendars = {};

$(document).ready( function()
{
	// assuming you've got the appropriate language files,
	// clndr will respect whatever moment's language is set to.
	// moment.lang('ru');

	// here's some magic to make sure the dates are happening this month.
	var thisMonth = moment().format('YYYY-MM');

	var eventArray =
		[
			{ startDate: '2014-05-06', endDate: '2014-05-09', title: 'Long event', description: '' },
			{ startDate: '2014-05-17', endDate: '2014-05-17', title: 'CLNDR GitHub Page FinisheDD', description: 'http://github.com/kylestetz/CLNDR' }
		];
	
	// adding my events
	var s = 0;
	if(stages != undefined && stages.length != 0)
		for(; s<stages.length; ++s)
			eventArray.push(stages[s]);
	
	console.log(eventArray);
	// ----------------

	// the order of the click handlers is predictable.
	// direct click action callbacks come first: click, nextMonth, previousMonth, nextYear, previousYear, or today.
	// then onMonthChange (if the month changed).
	// finally onYearChange (if the year changed).

	calendars.clndr1 = $('.cal1').clndr({
		events: eventArray,
		// constraints: {
		//	 startDate: '2013-11-01',
		//	 endDate: '2013-11-15'
		// },
		clickEvents: {
			click: function(target) {
				console.log(target);
				clicked(target);
				// if you turn the `constraints` option on, try this out:
				// if($(target.element).hasClass('inactive')) {
				//	 console.log('not a valid datepicker date.');
				// } else {
				//	 console.log('VALID datepicker date.');
				// }
			},
			nextMonth: function() {
				console.log('next month.');
			},
			previousMonth: function() {
				console.log('previous month.');
			},
			onMonthChange: function() {
				console.log('month changed.');
			},
			nextYear: function() {
				console.log('next year.');
			},
			previousYear: function() {
				console.log('previous year.');
			},
			onYearChange: function() {
				console.log('year changed.');
			}
		},
		multiDayEvents: {
			startDate: 'startDate',
			endDate: 'endDate'
		},
		showAdjacentMonths: true,
		adjacentDaysChangeMonth: false
	});

	calendars.clndr2 = $('.cal2').clndr({
		template: $('#template-calendar').html(),
		events: eventArray,
		multiDayEvents: {
			startDate: 'startDate',
			endDate: 'endDate'
		},
		startWithMonth: moment().add('month', 1),
		clickEvents: {
			click: function(target) {
				console.log(target);
			}
		},
		forceSixRows: true
	});

	// bind both clndrs to the left and right arrow keys
	$(document).keydown( function(e) {
		if(e.keyCode == 37) {
			// left arrow
			calendars.clndr1.back();
			calendars.clndr2.back();
		}
		if(e.keyCode == 39) {
			// right arrow
			calendars.clndr1.forward();
			calendars.clndr2.forward();
		}
	});
	
	// fonction dans .../CLNDR-master/example/script.js
	ready();
});