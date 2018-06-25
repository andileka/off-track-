var scheduler = function () {
	var _items			= new Array();
	var appointments	= new Array();
	var source			= "";
	var adapter			= "";
	var _id				= "";
	var date			= "";
	var views			= {};
	var selectedView	= "monthView";
	var orientation		= "none";
	var _localization	= {};

	function editDialogCreate(fields) {
		/* Disable fields */
		fields.statusContainer.hide();
		fields.locationContainer.hide();
		fields.timeZoneContainer.hide();
		fields.descriptionContainer.hide();
		fields.resourceContainer.hide();
		fields.colorContainer.hide();
		fields.repeatContainer.html("");
	}

	function SetClosingDays() {
		// prepare the data
		var source =
				{
					dataType: 'json',
					dataFields: [
						{name: 'id', type: 'string'},
						{name: 'description', type: 'string'},
						{name: 'location', type: 'string'},
						{name: 'subject', type: 'string'},
						{name: 'calendar', type: 'string'},
						{name: 'start', type: 'date'},
						{name: 'end', type: 'date'}
					],
					id: 'id',
					localData: appointments
				};

	}

	return {
		init: function (strId) {
			_id = strId;

		},
		SetItems: function(arrItems) {
			_items = [];
			for(var i=0;i<arrItems.length;i++) {
				_items.push({
					"id"			:arrItems[i]["Id"],
					"calendar"		:arrItems[i]["Expert"],
					"subject"		:arrItems[i]["Subject"],
					"background"	:arrItems[i]["Background"],
					"start"			:new Date(arrItems[i]["Start"]*1000),
					"end"			:new Date(arrItems[i]["End"]*1000)
				});
			}
		},
		SetViews: function (strView, _selectedView) {
			views = strView
			selectedView = _selectedView;
		},
		SetLocation: function (strLocation) {
			_localization = strLocation;
		},
		getSelectedDates: function () {
			/* GetAllSelectetDates */
			var jsonString = $("#"+_id).jqxScheduler('getDataAppointments');
			return JSON.stringify(jsonString);
		},
		setToday: function (strDate) {
			date = strDate;
		},
		setMultipleExpertsViews: function(_view){
			orientation = _view;
		},
		DrawCalendar: function () {
			$(document).ready(function () {
				// prepare the data
				var source =
				{
					dataType: "array",
					dataFields: [
						{ name: 'id', type: 'string' },
						{ name: 'description', type: 'string' },
						{ name: 'subject', type: 'string' },
						{ name: 'calendar', type: 'string' },
						{ name: 'start', type: 'date' },
						{ name: 'end', type: 'date' }
					],
					id: 'id',
					localData: _items
				};
				var adapter = new $.jqx.dataAdapter(source);
				$("#" + _id).jqxScheduler({
					date: new $.jqx.date(date),
					localization: _localization,
					/*localization: {
						days: {
							// full day names
							names: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
							// abbreviated day names
							namesAbbr: ["Sonn", "Mon", "Dien", "Mitt", "Donn", "Fre", "Sams"],
							// shortest day names
							namesShort: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"]
						},

						months: {
							// full month names (13 months for lunar calendards -- 13th month should be "" if not lunar)
							names: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember", ""],
							// abbreviated month names
							namesAbbr: ["Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dez", ""]
						},
						
						backString: "Vorhergehende",
						forwardString: "Nächster",
						toolBarPreviousButtonString: "Vorhergehende",
						toolBarNextButtonString: "Nächster",
						emptyDataString: "Nokeine Daten angezeigt",
						loadString: "Loading...",
						clearString: "Löschen",
						todayString: "Heute",
						dayViewString: "Tag",
						weekViewString: "Woche",
						monthViewString: "Monat",
						timelineDayViewString: "Zeitleiste Day",
						timelineWeekViewString: "Zeitleiste Woche",
						timelineMonthViewString: "Zeitleiste Monat",
						loadingErrorMessage: "Die Daten werden noch geladen und Sie können eine Eigenschaft nicht festgelegt oder eine Methode aufrufen . Sie können tun, dass, sobald die Datenbindung abgeschlossen ist. jqxScheduler wirft die ' bindingComplete ' Ereignis, wenn die Bindung abgeschlossen ist.",
						editRecurringAppointmentDialogTitleString: "Bearbeiten Sie wiederkehrenden Termin",
						editRecurringAppointmentDialogContentString: "Wollen Sie nur dieses eine Vorkommen oder die Serie zu bearbeiten ?",
						editRecurringAppointmentDialogOccurrenceString: "Vorkommen bearbeiten",
						editRecurringAppointmentDialogSeriesString: "Bearbeiten Die Serie",
						editDialogTitleString: "Termin bearbeiten",
						editDialogCreateTitleString: "Erstellen Sie Neuer Termin",
						contextMenuEditAppointmentString: "Termin bearbeiten",
						contextMenuCreateAppointmentString: "Erstellen Sie Neuer Termin",
						editDialogSubjectString: "Subjekt",
						editDialogLocationString: "Ort",
						editDialogFromString: "Von",
						editDialogToString: "Bis",
						editDialogAllDayString: "Den ganzen Tag",
						editDialogExceptionsString: "Ausnahmen",
						editDialogResetExceptionsString: "Zurücksetzen auf Speichern",
						editDialogDescriptionString: "Bezeichnung",
						editDialogResourceIdString: "Kalender",
						editDialogStatusString: "Status",
						editDialogColorString: "Farbe",
						editDialogColorPlaceHolderString: "Farbe wählen",
						editDialogTimeZoneString: "Zeitzone",
						editDialogSelectTimeZoneString: "Wählen Sie Zeitzone",
						editDialogSaveString: "Sparen",
						editDialogDeleteString: "Löschen",
						editDialogCancelString: "Abbrechen",
						editDialogRepeatString: "Wiederholen",
						editDialogRepeatEveryString: "Wiederholen alle",
						editDialogRepeatEveryWeekString: "woche(n)",
						editDialogRepeatEveryYearString: "Jahr (en)",
						editDialogRepeatEveryDayString: "Tag (e)",
						editDialogRepeatNeverString: "Nie",
						editDialogRepeatDailyString: "Täglich",
						editDialogRepeatWeeklyString: "Wöchentlich",
						editDialogRepeatMonthlyString: "Monatlich",
						editDialogRepeatYearlyString: "Jährlich",
						editDialogRepeatEveryMonthString: "Monate (n)",
						editDialogRepeatEveryMonthDayString: "Day",
						editDialogRepeatFirstString: "erste",
						editDialogRepeatSecondString: "zweite",
						editDialogRepeatThirdString: "dritte",
						editDialogRepeatFourthString: "vierte",
						editDialogRepeatLastString: "letzte",
						editDialogRepeatEndString: "Ende",
						editDialogRepeatAfterString: "Nach",
						editDialogRepeatOnString: "Am",
						editDialogRepeatOfString: "von",
						editDialogRepeatOccurrencesString: "Eintritt (e)",
						editDialogRepeatSaveString: "Vorkommen Speichern",
						editDialogRepeatSaveSeriesString: "Save Series",
						editDialogRepeatDeleteString: "Vorkommen löschen",
						editDialogRepeatDeleteSeriesString: "Series löschen",
						editDialogStatuses:
						{
							free: "Frei",
							tentative: "Versuchsweise",
							busy: "Beschäftigt",
							outOfOffice: "Ausserhaus"
						}
					},*/
					width: "100%",
					height: 600,
					rowsHeight: 15,
					source: adapter,
					showLegend: true,
					showToolbar : true,
					editDialogCreate: function (dialog, fields, editAppointment) {
						editDialogCreate(fields);
					},
					ready: function () {
//						$("#" + _id).jqxScheduler('ensureAppointmentVisible', 'id1');
					},
					resources:
					{
						colorScheme: "scheme05",
						dataField: "calendar",
						source:  new $.jqx.dataAdapter(source),
						orientation : orientation
					},
					appointmentDataFields:
					{
						background : "background",
						color : "color",
						from: "start",
						to: "end",
						id: "id",
						subject: "subject",
						resourceId: "calendar",

					},
					view: selectedView,	
					views: views
				});
			});
			
			$('#'+_id).on('appointmentAdd', function (event) {
				console.log("appointmentAdd");
				var args = event.args;
				var appointment = args.appointment;
				qcubed.recordControlModification(_id, "_SelectedValue", appointment.originalData);
				$('#'+_id).trigger("scheduleritemcreate");
			});
			
			$('#'+_id).on('appointmentDelete', function (event) {
				console.log("appointmentDelete");
				var args = event.args;
				var appointment = args.appointment;
				qcubed.recordControlModification(_id, "_SelectedValue", appointment.originalData);
				$('#'+_id).trigger("scheduleritemdelete");
			});
			$('#'+_id).on('appointmentChange', function (event) {
				var args = event.args;
				var appointment = args.appointment;
				qcubed.recordControlModification(_id, "_SelectedValue", appointment.originalData);
				$('#'+_id).trigger("scheduleritemchange");
			});

		}
	};
}();