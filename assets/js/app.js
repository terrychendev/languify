"use strict";

var plugin_toastr = function(){
	toastr.options = {
		"closeButton": false,
		"debug": false,
		"positionClass": "toast-top-right",
		"onclick": null,
		"showDuration": "100",
		"hideDuration": "100",
		"timeOut": "2000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
}();



var	record = {
		wordId : '',
		languageId : '',

		switchToInputField : function (event){
			//Query the IDs from DOM
			var wordId = $(this).attr("data-wordID");
			var languageId = $(this).attr("data-languageID");
			var current_string = $(this).text().replace(/ |\n/g,"");
			var identifier = wordId + '#' + languageId;

			//Switch td to some kinda input field
			var inputField = '<td data-wordID="' + wordId + '" data-languageID="' + languageId + '"><input type="text" name="' + identifier + '" value="" ></input></td>';
			$( this ).replaceWith( inputField );


			$( "table tbody tr td input[name=" + wordId + "#" + languageId + "]" ).trigger("focus").attr( "value" , current_string ).focusout(function(){
				var self = $( this );
				//Capture string value
				var new_string = $(this).val();

				//Basic validation
				//if ( string.search(/\W|\d/g) < 0 ){
				if ( new_string ) {

					if ( new_string != current_string ) {

						//Ready for Ajax Call
						//$(this).addClass('disabled');

						var spinner = '<i class="fa fa-spinner fa-spin" name="' + identifier + '"></i>';
						
						//Parsing strings to int
						wordId = parseInt(wordId);
						languageId = parseInt(languageId);

						//It is a POST/PUT for languages/translations (other than English)
						if ( languageId != 1 ){
							$(this).replaceWith(spinner);
							//POST Request translations
							var data = {
								language_id : languageId,
								word_id : wordId,
								translation : new_string
							};
							//catch previous obj
							var self = $( this );
							//Ajax Translations
							$.ajax({
								url : '/api/translations',
								data : data,
								dataType: "JSON",
								type: "POST",
								success : function ( response ) {
									console.log(response.message);
									if ( response.status == 'success' ) {
										/*self.css('background', '#E5FFDD');
								        setTimeout(function() {
								            self.css( 'background', '' );
								        	self.replaceWith(new_string);
								        	record.detector();
								        }, 1500);*/
										$( "table tbody tr td i[name=" + identifier + "]" ).replaceWith(new_string);
										toastr.success( '" ' + new_string + ' " is updated from ' + '" ' + current_string + ' "' );
										record.detector();
									} else {
										/*self.css('background', '#FFB6C1')
										setTimeout(function() {
								            self.css( 'background', '' );
								        	self.replaceWith(current_string);
								        	record.detector();
								        }, 1500);*/
										$( "table tbody tr td i[name=" + identifier + "]" ).replaceWith(current_string);
										toastr.error("Invalid input, please verify");
										record.detector();
									}
								},
								error : function ( response, status, err ) {
									$( "table tbody tr td i[name=" + identifier + "]" ).replaceWith(current_string);
									toastr.error("Database Failed");
									record.detector();
								}
							});
						}
						//It is a PUT for primary
						else if ( languageId === 1) {
							// Validate Primary
							if ( new_string.search(/\W|\d/g) < 0 ) {
								$(this).replaceWith(spinner);
								//Put Request updates
								var data = {
									word_id : wordId,
									word : new_string
								}
								//catch previous obj
								var self = $( this );
								//Ajax Words
								$.ajax({
									url : '/api/words',
									data : data,
									dataType: "JSON",
									type: "PUT",
									success : function ( response ) {
										console.log(response.message);
										if ( response.status == 'success' ) {
											/*self.css('background', '#E5FFDD');
									        setTimeout(function() {
									            self.css( 'background', '' );
									        	self.replaceWith(new_string);
									        	record.detector();
									        }, 1500);*/
											$( "table tbody tr td i[name=" + identifier + "]" ).replaceWith(new_string);
											toastr.success( '" ' + new_string + ' " is updated from ' + '" ' + current_string + ' "' );
											record.detector();
										} else {
											/*self.css('background', '#FFB6C1')
											setTimeout(function() {
									            self.css( 'background', '' );
									        	self.replaceWith(current_string);
									        	record.detector();
									        }, 1500);*/
									        $( "table tbody tr td i[name=" + identifier + "]" ).replaceWith(current_string);
											toastr.error("Invalid input, please verify");
											record.detector();
										}
									},
									error : function ( response ) {
								        $( "table tbody tr td i[name=" + identifier + "]" ).replaceWith(current_string);
										toastr.error("Invalid input, please verify");
										record.detector();
									}
								});
							}
							else {
								$(this).css("background-color","#f89406");
								toastr.warning( 'Please input a correct word' );
							}
						}

					}
					else {
						//var original_content = '<td data-wordid="' + wordId + '" data-languageid="' + languageId + '">' + new_string + '</td>';
						$( this ).replaceWith(current_string);
						record.detector();

					}

				}
				else if (current_string === new_string) {
					//from none to none, just ignore
					$( this ).replaceWith(current_string);
					record.detector();
				}
				else{
					//from something to none, not allowed
					toastr.warning( 'Edit failed, empty input is not allowed' );
					$( this ).replaceWith(current_string);
					record.detector();
				}

			});
		},


		addRecord : function(){
			//Adding some record
			$("tbody").prepend("<tr><td><input name='newRecord'></input></td></tr>");
			$("tbody tr input[name=newRecord]").trigger("focus").focusout(function(){
				//Capture string value
				var new_string = $(this).val();
				if ( new_string.search(/\W|\d/g) >= 0 ){
					$( this ).parent().parent().remove("tr");
					//Also output that the word must be legit (Cause: 1. user does not input anything 2. User put some dipshit)
				}
				else {
					//Ajax Call POST Word
					$( this ).addClass('disabled');
					var data = {
						word : new_string
					};
					var self = $(this);
					$.ajax({
						url : '/api/words',
						data : data,
						dataType: "JSON",
						type: "POST",
						success : function ( response ) {
							console.log(response.message);
							if ( response.status == 'success' ) {
								// Show green for success
								//self.css('background', '#E5FFDD');
								toastr.success('Word: '+ new_string + ' added');

						        // Append the important data attributes to this english cell
						        self.closest('td').attr('data-wordID', response.word_id);
						        self.closest('td').attr('data-languageID', '1');

						        // Make cells for all relevant translation columns for this word
						        $('thead tr th[data-languageID]').each(function(key){
						        	var colLang = $(this).data('languageid');
						        	if ( colLang != '1' ) {
						        		self.closest('tr').append('<td data-wordID="'+response.word_id+'" data-languageID="'+colLang+'"></td>');
						        	}
						        });

						        /*setTimeout(function() {
						            self.css( 'background', '' );
						            self.replaceWith(new_string);
						        	record.detector();
						        }, 1500);*/
						        self.replaceWith(new_string);
						        record.detector();
							} else {
								toastr.error('Word: '+ new_string + ' is duplicated with our record');
								//self.css('background', '#FFB6C1')
								/*setTimeout(function() {
						            self.css( 'background', '' );
						        	self.removeClass('disabled');
						        }, 1500);*/
								self.removeClass('disabled');
							}
						},
						error : function ( response ) {
							console.log(response);
						}
					});

				}
			});

		},



		detector : function() {
			$("table tbody tr td[data-wordID][data-languageID]").off("click", record.switchToInputField);
			return $("table tbody tr td[data-wordID][data-languageID]").on("click", record.switchToInputField);
		},

		newRecord : function() {
			return $("i.fa-plus-square").on("click", record.addRecord);
		} 

};


$(document).ready(function(){

	record.detector();
	record.newRecord();

});