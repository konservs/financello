$(document).ready(function(){
	$.fn.select2.amd.require(['select2/data/array','select2/utils'], function (ArrayData, Utils) {
	function CustomDataFinCurrencies ($element, options) {
		CustomDataFinCurrencies.__super__.constructor.call(this, $element, options);
		}
	Utils.Extend(CustomDataFinCurrencies, ArrayData);
	CustomDataFinCurrencies.prototype.current = function (callback) {
		var data = [];
		var currentVal = this.$element.val();
		if (!this.$element.prop('multiple')) {
			currentVal = [currentVal];
			}
		for (var v = 0; v < currentVal.length; v++) {
			data.push({id: currentVal[v],text: currentVal[v]});
			}
		callback(data);
		};

	var $element = $(".select2fincurrencieslist").select2({
		dataAdapter: CustomDataFinCurrencies
		});
	var $request = $.ajax({
		url: window.urls.select2currenciesfilter
		});
	$request.then(function (data) {
		// This assumes that the data comes back as an array of data objects
		// The idea is that you are using the same callback as the old `initSelection`
		for (var d = 0; d < data.length; d++) {
			var item = data[d];
			// Create the DOM option that is pre-selected by default
			var option = new Option(item.text, item.id, true, true);
			// Append it to the select
			$element.append(option);
			}
		// Update the selected options that are displayed
		$element.trigger('change');
		});
	//
	});
});

