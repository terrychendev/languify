//Global.js
"use strict";

	//This is a 2D array
var masterData = [],
	//Number of languages (ohter than primary english)
	lang_num,
	//Number of database record
	db_record;


//Initialize 2D array
function iniMaster () {

	master = new Array(lang_num);
	var i = 0;
	for ( i = 0 ; i <= db_record ; i++ ) {
		masterData[i] = new Array(lang_num);
	}
};


$(document).ready(function() {

	populateTable();

	$('div.table-responsive table tbody').on('click', 'td a.reference_number', addRecord);


});

function populateTable() {

	iniMaster();

	//Empty content sring
	var tableContent = '';

	//Ajax call get data
	//Append data to masterData
	//After ajax call, add content to DOM
	//If this.LANGUAGE = null, this.LANGUAGE = "Add"
	$.each(data, function(){
      tableContent += '<tr>';
      tableContent += '<td><a href="#" class="lang_en" rel="' + this.word + '" title="english">' + this.word + '</td>';
      tableContent += '<td><a href="#" class="lang_fr" rel="' + this.french + '" title="french">' + this.french + '</td>';
      tableContent += '<td><a href="#" class="lang_sp" rel="' + this.spanish + '" title="english">' + this.spanish + '</td>';
      tableContent += '<td><a href="#" class="lang_ct" rel="' + this.chinese_t + '" title="english">' + this.chinese_t + '</td>';
      tableContent += '<td><a href="#" class="lang_cs" rel="' + this.chinese_s + '" title="english">' + chinese_s + '</td>';
      tableContent += '<td><a href="#" class="lang_ru" rel="' + this.russian + '" title="english">' + russian + '</td>';
      tableContent += '</tr>';
    });

	//Append
    $('div.table-responsive table tbody').html(tableContent);

};

function addRecord() {

	//Ajax add record to db

	populateTable();

};