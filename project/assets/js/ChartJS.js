var ChartJS = function () {
	var ctx			= "";
	var _id			= "";
	var _type		= "";
	var  _color		= [];
	var _dataSet	= [];
	var _labels		= [];
	var _setLegend  = false; 
	
	
	return {
		init: function (strId) {
			ctx = $("#chart_"+strId + "");
		},
		SetLegend: function(blnlegend){
			_setLegend = blnlegend;
		},
		SetLabels: function(labels){
			_labels = JSON.parse(labels);
		},
		SetType: function (type){
			_type = type;
		},
		SetDataSet: function (dataSet){
			_dataSet = JSON.parse(dataSet);
		},
		SetColor: function (color){
			if(_type == "doughnut"){
				_color = JSON.parse(color);
			}else{
				_color = "";
				_color = color;
			}
			
		},
		DrawStacked: function (){
			var barChartData = {
				labels: _labels,
				datasets: [{
					backgroundColor: _color,
					borderColor: _color,
					borderWidth: 1,
					data: _dataSet
				}]

			};
			new Chart(ctx, {
				type: _type,
				data: barChartData,
				options: {
					responsive: true,
					legend: {
						display : _setLegend,
						position: 'top',
					},
					title: {
						display: false,
					}
				}
			});
		},
		Draw: function () {
			new Chart(ctx, {
			type: _type,
			data: {
			  labels: _labels,
			  datasets: _dataSet,
			},
			options: {
			  legend: {
					display: true,
			  },
			  scales: {
				yAxes: [{
				  stacked: true,
				  ticks: {
					beginAtZero: true
				  }
				}],
				xAxes: [{
				  stacked: true,
				  ticks: {
					beginAtZero: true
				  }
				}]

			  },

			}
		  });

		}
	};
}();
