var spinner = '<i class="fa fa-spinner fa-spin"></i>';

var	record = {

		wordId : '',
		languageId : '',

		switchToInputField : function (event){
			//Query the IDs from DOM
			var wordId = $(this).attr("data-wordid");
			var languageId = $(this).attr("data-languageID");
			var current_string = $(this).text().replace(/ /g,"");;

			var inputField = '<td><input type="text" name="' + wordId + '#' + languageId + '" value="" ></input></td>';

			//Switch td to some kinda input field
			$( this ).replaceWith( inputField );

			$( "table tbody tr input[name=" + wordId + "#" + languageId + "]" ).trigger("focus").attr( "value" , current_string ).focusout(function(){
				
				//Capture string value
				var string = $(this).val();

				//Basic validation
				if ( string.search(/\W|\d/g) < 0 ){

					//Ready for Ajax Call
					$( this ).replaceWith( spinner );

				}
				else {
					alert("error");

				}

			});
		},
};


$(document).ready(function(){

	$("table tbody tr td").on("click", record.switchToInputField);

});


function switchToInputField(event) {

	var thisWordId = $(this).attr("data-wordid");
	var thisLanguageId = $(this).attr("data-languageID");



}