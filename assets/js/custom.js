
$(document).on("click", ".excluir-autor", function(event) {
	event.preventDefault();
        var id = $(this).data('id');
        var url = "../autores/remover?id=" + id;
        $('#excluir-item').data('url', url);
        $('#modal-body').empty();
        $('#modal-body').append("<div>Tem certeza que deseja excluir o autor?</div>" );
        $('#modalConfirmacaoAcao').modal('show'); 	
});


$(document).on("click", ".excluir-genero", function(event) {
	event.preventDefault();        
 	var id = $(this).data('id');
        var url = "../generos/remover?id=" + id;
        $('#excluir-item').data('url', url);
        $('#modal-body').empty();
        $('#modal-body').append("<div>Tem certeza que deseja excluir o gênero?</div>" );
        $('#modalConfirmacaoAcao').modal('show'); 	
});

$(document).on("click", ".excluir-editora", function(event) {
	event.preventDefault();        
 	var id = $(this).data('id');
        var url = "../editoras/remover?id=" + id;
        $('#excluir-item').data('url', url);
        $('#modal-body').empty();
        $('#modal-body').append("<div>Tem certeza que deseja excluir a editora?</div>" );
        $('#modalConfirmacaoAcao').modal('show'); 	
});

$(document).on("click", ".excluir-livro", function(event) {
	event.preventDefault();        
 	var id = $(this).data('id');
        var url = "../livros/remover?id=" + id;
        $('#excluir-item').data('url', url);
        $('#modal-body').empty();
        $('#modal-body').append("<div>Tem certeza que deseja excluir o livro?</div>" );
        $('#modalConfirmacaoAcao').modal('show'); 	
});



 $('#excluir-item').click(function (event) {        
        var url = $(this).data('url');
        document.location = url;
    });


//$('input[name="nome_editora"]').autoComplete({
//    source: function(term, response){
//        $.getJSON('../editoras/listar_editoras', { q: term }, function(data){ response(data); });
//    }
//});


//$("input[name='nome_editora']").autoComplete({
//        placeholder: 'Editora',
//        minimumInputLength: 2,
//        maximumInputLength: 15,
//              source: function( request, response ) {
//        $.ajax({
//          url: "../editoras/listar_editoras",
//          dataType: "json",
//          data: {
//            q: "q"            
//          },
//          success: function( data ) {
//            response( $.map( data.entities, function( item ) {
//              return {
//                label: item.nome_editora,
//                value: item.id
//              }
//            }));
//          }
//        });
//      },
//        initSelection: function(element, callback) {
//            var id = $(element).val();
//            if (id !== "") {
//				$.get('../editoras/listar_editoras', {
//					id: id
//				})
//				.done(function(data) {
//					if (data.result === 'ok') {
//						 callback(data.client);
//					}
//				});
//            }
//        },
//        formatResult: SBFormat.resultClient,
//        formatSelection: SBFormat.selectionClient,
//        formatLoadMore: SBFormat.loadMore,
//        escapeMarkup: function (m) { return m; },
//        formatSearching: SBFormat.searching,
//        formatNoMatches: SBFormat.noMatches,
//        formatInputTooShort: SBFormat.inputTooShort,
//        containerCssClass: 'form-control',
//        dropdownCssClass: 'select2-dropdown'
	//});





//$( "#nome_editora" ).autoComplete({
//      source: function( request, response ) {
//        $.ajax({
//          url: "../editoras/listar_editoras",
//          dataType: "json",
//          data: {
//            featureClass: "P",
//            style: "full",
//            maxRows: 12,
//            name_startsWith: request.term
//          },
//          success: function( data ) {
//            response( $.map( data.entities, function( item ) {
//              return {
//                label: item.nome_editora,
//                value: item.id
//              }
//            }));
//          }
//        });
//      },
//      minlength: 2,
//      select: function( event, ui ) {
//        log( ui.item ?
//          "Selected: " + ui.item.label :
//          "Nothing selected, input was " + this.value);
//      },
//      open: function() {
//        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
//      },
//      close: function() {
//        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
//      }
//    });
  
  






//
// $('input[name="nome_editora"]').autoComplete({
//    minChars: 1,
//    source: function(term, suggest){
//        term = term.toLowerCase();
//        var choices = [['Australia', 'au'], ['Austria', 'at'], ['Brasil', 'br']];
//        var suggestions = [];
//        for (i=0;i<choices.length;i++)
//            if (~(choices[i][0]+' '+choices[i][1]).toLowerCase().indexOf(term)) suggestions.push(choices[i]);
//        suggest(suggestions);
//    },
//    renderItem: function (item, search){
//        var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
//        return '<div class="autocomplete-suggestion" data-langname="'+item[0]+'" data-lang="'+item[1]+'" data-val="'+search+'"><img src="img/'+item[1]+'.png"> '+item[0].replace(re, "<b>$1</b>")+'</div>';
//    },
//    onSelect: function(e, term, item){
//        alert('Item "'+item.data('langname')+' ('+item.data('lang')+')" selected by '+(e.type == 'keydown' ? 'pressing enter' : 'mouse click')+'.');
//    }
//}); 