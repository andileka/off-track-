var getRating = function () {
	var shop			= "";
	var shopItem		= "";
	var maxRating		= "";
	var currentRating	= "";
	var id				= "";
	return {
		init: function (_id) {
			id = _id;
		},
		buildRatingItem : function(){
			shop = document.querySelector("#"+id +"");
			if(shop){
				shopItem = document.createElement("div");
				var html = "<ul class=c-rating></ul>";

				shopItem.innerHTML = html;
				shop.appendChild(shopItem);
			}
			
			
		},
		setCurrentRating: function(_rating){
			currentRating = _rating;
		},
		setMaxRating: function(_Maxrating){
			maxRating = _Maxrating;
		},
		addRatingWidget: function () {
			if(shop){
				var ratingElement = shopItem.querySelector(".c-rating");
				var callback = function(rating) {
					qcubed.recordControlModification(id, "_SelectedValue", rating);
					$('#'+id).trigger("RatingSelected");
				};
				var r = rating(ratingElement, currentRating, maxRating, callback);
			}
			
		},
		Rebuild: function () {
			$("#"+id +"").html("");
		}
	};
}();