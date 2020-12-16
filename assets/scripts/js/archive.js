jQuery('.side-nav button').click(function() {

	jQuery('.side-nav button.active').removeClass('active');
	jQuery('.archive-group.active').removeClass('active');
	
	var term = jQuery(this).data('term');
	var result = '.archive-group[data-term="' + term + '"]';
	
	jQuery(this).addClass('active');
	
	jQuery(result).addClass('active');
	
});

jQuery(document).ready(function() {

    var first = jQuery('.side-nav button.active').data('term');
    var active = '.archive-group[data-term="' + first + '"]';
    
    jQuery(active).addClass('active');

});

jQuery('.career-post > .title').click(function() {

	jQuery(this).parent().toggleClass('active');
		
});

jQuery('.team-info > .title').click(function() {

	jQuery(this).parent().toggleClass('active');
		
});

jQuery('.direction-row > h5').click(function() {

	jQuery(this).parent().toggleClass('active');
		
});

jQuery(document).ready(function() {

    jQuery('.cb-tabs button[data-tab=1-1]').addClass('active');
    jQuery('.tab-section[data-tab=1-1]').addClass('active');


});

jQuery('.cb-tabs button').click(function() {

	jQuery('.cb-tabs button.active').removeClass('active');
	jQuery('.tab-section.active').removeClass('active');
	
	var term = jQuery(this).data('tab');
	var result = '.tab-section[data-tab="' + term + '"]';
	
	jQuery(this).addClass('active');
	
	jQuery(result).addClass('active');
	
});