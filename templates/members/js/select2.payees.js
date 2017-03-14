/**
 * Escape string
 *
 * @param text
 * @returns {XML|*|string|void}
 */
function escapeHtml(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
		};
	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
	}
/**
 * Format 
 *
 * @param payee
 * @returns {string}
 */
function payeeformatresult(payee){
	//console.log(tag);
        if(payee.new){
		return payee.name+'&nbsp;<span class="new">new</span>';
		}
	return payee.name+' (#'+payee.id+')';
	}

/**
 *
 * @param tag
 * @returns {string}
 */
function payeeformatselection(payee){
        if(payee.new){
            return payee.name+'&nbsp;<span class="new">new</span>';
            }
        return payee.name+' (#'+payee.id+')';
	}

function select2_payees_init(obj){
	$(obj).select2({
		allowClear: true,
		tokenSeparators: [",", ";"],
		tags: true,
		placeholder: window.languages.SELECT2_PAYEE_PLACEHOLDER,
		maximumSelectionSize: 1,
		ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
			url: window.urls.select2payeefilter,
			dataType: 'json',
			data: function (term, page) {
				return {
					q: term, // search term
					page_limit: 10
					};
				},
			results: function (data, page) { // parse the results into the format expected by Select2.
				// since we are using custom formatting functions we do not need to alter remote JSON data
					return {results: $.map(data.items, function (item) {
					    return {
						name: escapeHtml(item.name),
						new: false,
						id: item.id
						}
					   })
                    			};
				}
			},
        	id: function (e){
	            var id='';
        	    if(e.new){
                	id='tx-'+ e.text;
	                }
        	    else{
                	id='id-'+ e.id;
	                }
        	    return id;
	            },
		formatResult: payeeformatresult, // omitted for brevity, see the source of this page
		formatSelection: payeeformatselection,  // omitted for brevity, see the source of this page
		dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
	        createSearchChoice:function(term, data) {
	            return {
			id:term,
			new:true,
			name:term
			};
        	    },
	        initSelection: function(element, callback) {
        	    var values=element.val();
	            var valuej=values.split(',');//$.parseJSON(values);

        	    $.ajax(window.urls.select2payeefilter+'?ids='+values, {
                	dataType: "json"
	                }).done(function(data) {
        	            var datap = [];
                	    $.each(data.tags,function(id,obj) {
                        	datap.push({
	                            id: obj.id,
        	                    new:false,
                	            text: escapeHtml(obj.name_ru)
                        	    });
	                        });
        	            callback(datap);
                	});
	            },
		escapeMarkup: function (m) {
			 return m;
            		} // we do not want to escape markup since we are displaying html in results);
		});//ENd of select2
	}

/**
 *
 */
$(document).ready(function(){
	window.console&&console.log('[Select2.Payees] The document is ready.');
	select2_payees_init($('.select2.payees'));
	});
