"use strict";
var	record = {

		wordId : '',
		languageId : '',
		spinner : '<i class="fa fa-spinner fa-spin"></i>',

		switchToInputField : function (event){
			//Query the IDs from DOM
			var wordId = $(this).attr("data-wordid");
			var languageId = $(this).attr("data-languageID");
			var current_string = $(this).text().replace(/ |\n/g,"");;

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
						//Put Request update

						//Ajax successes
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
				$( this ).parent().parent().remove("tr");
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