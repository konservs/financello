$(document).ready(function(){
	window.console&&console.log('[Select2.FinCurrencies] Initializing...');
	/**
	 * Format results list item.
	 */
	function userformatresult(categorycity){
	        console.log(categorycity);
		return categorycity.text+' (id #'+categorycity.id+')';
		}
	/**
	 *
	 */
	function userformatselection(categorycity){
		return categorycity.text+' (id #'+categorycity.id+')';
		}
	/**
	 *
	 */		
	function getclassified_catfilter(clas){
		if($(clas).attr('filter')===undefined) return '';
		var obj=JSON.parse($(clas).attr('filter'));
		
		var str = [];
		for(var propertyName in obj) {
			str.push(propertyName+'='+obj[propertyName]);
			}
		if(str.length==0){
			return '';
			}
		return '?'+str.join('&');
		}
	/**
	 *
	 */
	$('.select2.fincurrencieslist').select2({
		allowClear: true,
		tokenSeparators: [",", ";"],
		tags: true,
		placeholder: "Please, choose currency",
		ajax: {
			url: "/finances/currencies/filter.json",
			dataType: 'json',
			data: function (term, page) {
				return {
					q: term, // search term
					page_limit: 10
					};
				},
			results: function (data, page) { // parse the results into the format expected by Select2.
				// since we are using custom formatting functions we do not need to alter remote JSON data
					return {results: $.map(data.categories, function (item) {
					    return {
						text: item.name,
						id: item.id
						}
					   })};
				}
			},
		formatResult: userformatresult, // omitted for brevity, see the source of this page
		formatSelection: userformatselection,  // omitted for brevity, see the source of this page
		dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller

	        /**
        	 *
	         * @param term
        	 * @param data
	         * @returns {{id: number, new: boolean, text: *}}
	         */
		//createSearchChoice:function(term, data) {
			//return {id:term, new:true, text:term};
		//	},
		/**
		 *
		 */
		initSelection: function(element, callback) {
			var id=$(element).val();
			console.log('default falue: '.id);
			if (id!=="") {
				$.ajax({
					url: "/classified/cats/filter.json",
					data: {ids: id},
					dataType: "json"
					}).done(function(data) {
						var datap = [];
						$.each(data.categories,function(index,val){
							window.console&&console.log('[Select2.FinCurrencies] got category id='+val.id+', name='+val.name);
							datap.push({text:val.name,id:val.id});
							});
						callback(datap);
						});
				}
			},
		escapeMarkup: function (m) {
			console.log(m);
			 return m; } // we do not want to escape markup since we are displaying html in results);
		});
	});

