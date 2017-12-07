/**
 *
 * @param text
 * @returns {XML|*|string|void}
 */
function escapeHtml(text) {
	if(text==undefined){
		return '';
		}
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
		};
	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
	}

$(document).ready(function(){
	var $element = $(".select2fincurrencieslist").select2({
		ajax: {
			url: window.urls.select2currenciesfilter,
			dataType: 'json',
			processResults: function (data) {
				pg = {};
				pg.more = true;
				return {results: data.currencies, pagination:pg};
				}
			},
		templateResult: function (currency){
			return escapeHtml(currency.name)+ ' <b>' + currency.code3 +'</b> (#'+currency.id+')';
			},
		templateSelection: function (currency){
			return escapeHtml(currency.name)+ ' <b>' + currency.code3 +'</b> (#'+currency.id+')';
			}
		});
	});

