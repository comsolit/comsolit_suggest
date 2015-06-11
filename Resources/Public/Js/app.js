$(document).ready(function(){

  var suggester = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: '/?type=999&tx_comsolitsuggest_suggest[search]=%QUERY&tx_comsolitsuggest_suggest[method]=suggest',
      wildcard: '%QUERY',
      transport: function (ajaxOptions, onSuccess, onError) {
    	  ajaxOptions.dataType = "html";
	      $.ajax(ajaxOptions).done(done).fail(fail);
	
	      function done(data, textStatus, request) {
	          onSuccess(JSON.parse(removeHTML(data)));
	      }
	
	      function fail(request, textStatus, errorThrown) {
	          console.log('test');
	      }
	  }
    }
  });

  suggester.initialize();

  $('.typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    }, {
    displayKey: 'value',
    source: suggester.ttAdapter()
  });

  function removeHTML(input){
    return input.replace(/<\/?[^>]+>/gi, '');
  }

});