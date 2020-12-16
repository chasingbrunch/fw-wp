function format_currency( number ) {
	
	var formatted = number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
	
	return formatted;

	
}