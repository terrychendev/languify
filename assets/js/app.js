"use strict";
var	record = {

		wordId : '',
		languageId : '',
		spinner : '<i class="fa fa-spinner fa-spin"></i>',

		switchToInputField : function (event){
			//Query the IDs from DOM
			var wordId = $(this).attr("data-wordid");
			var languageId = $(this).attr("data-languageID");
			var current_string = $(this).text().replace(/ |\n/g,"");

			var inputField = '<td data-wordid="' + wordId + '" data-languageid="' + languageId + '"><input type="text" name="' + wordId + '#' + languageId + '" value="" ></input></td>';

			//Switch td to some kinda input field
			$( this ).replaceWith( inputField );

			$( "table tbody tr td input[name=" + wordId + "#" + languageId + "]" ).trigger("focus").attr( "value" , current_string ).focusout(function(){
				
				//Capture string value
				var new_string = $(this).val();

				//Basic validation
				//if ( string.search(/\W|\d/g) < 0 ){
				if ( new_string ) {

					if ( new_string != current_string ) {

						//Ready for Ajax Call
						$( this ).replaceWith( record.spinner );

						//Parsing strings to int
						wordId = parseInt(wordId);
						languageId = parseInt(languageId);

						//It is a POST/PUT for languages/translations (other than English)
						if ( languageId != 1 ){
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
								success : function ( res ) {
									//self.replaceWith("Success");
								},
								error : function ( jq, status, err ) {
									console.log(jq);
									alert(err);
								}
							});
						}
						//It is a PUT for primary
						else if ( languageId === 1) {
							// Validate Primary
							if ( new_string.search(/\W|\d/g) < 0 ) {
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
									success : function ( res ) {
										self.replaceWith("Success");
									},
									error : function ( err ) {
										alert(err);
									}
								});
							}
							else {
								// Validation Fails, Primary must be a legit word
							}
						}

					}
					else {
						//var original_content = '<td data-wordid="' + wordId + '" data-languageid="' + languageId + '">' + new_string + '</td>';
						$( this ).replaceWith(current_string);
						record.detector();

					}

				}
				else {
					alert("error, please input some value");
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
					$( this ).replaceWith( record.spinner );
					var data = {
						word : new_string
					};
					$.ajax({
						url : '/api/words',
						data : data,
						dataType: "JSON",
						type: "POST",
						success : function ( res ) {
							//Check if duplicated data exists
							self.replaceWith("Success");
						},
						error : function ( err ) {
							alert(err);
						}
					});

				}
			});

		},

		detector : function() {
			return $("table tbody tr td").on("click", record.switchToInputField);
		},

		newRecord : function() {
			return $("i.fa-plus-square").on("click", record.addRecord);
		} 

};


$(document).ready(function(){

	record.detector();
	record.newRecord();

});