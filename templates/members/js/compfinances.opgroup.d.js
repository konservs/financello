function newopgroup(){
	var newopg=$('#opgroupexample').clone();

	$('#opgoperations').append(newopg);
	newopg.show();
	}

$(document).ready(function(){
	window.console&&console.log('[OpGroup.Add] the document is ready.');
	//newopgroup();
	$('#opgaddbutton').click(function(){
		window.console&&console.log('[OpGroup.Add] Add button clicked.');
		newopgroup();
		});
	});
