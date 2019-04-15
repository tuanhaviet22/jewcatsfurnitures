$(document).ready(function() {
	$('#section1').show();
	$('#op1').css({"background":"#007BFF", "color":"white"});
	$('#section2').hide();
	$('#op2').css({"color":"#28A745"});
	$('#section3').hide();
	$('#op3').css({"color":"#DC3545"});
	// $('#section2 input').removeAttr("required");
	// $('#section3 input').removeAttr("required");


	$('#op1').click(function(){
		$('#section1').show();
		$('#section2').hide();
		$('#section3').hide();
		$('#op1').css({"background":"#007BFF", "color":"white"});
		$('#op2').css({"background":"transparent", "color":"#28A745"});
		$('#op3').css({"background":"transparent", "color":"#DC3545"});
		// $('#section1 input').attr("required","required");
		// $('#section2 input').removeAttr("required");
		// $('#section3 input').removeAttr("required");		
	})
	$('#op2').click(function(){
		$('#section1').hide();
		$('#section2').show();
		$('#section3').hide();
		$('#op1').css({"background":"transparent", "color":"#007BFF"});
		$('#op2').css({"background":"#28A745", "color":"white"});
		$('#op3').css({"background":"transparent", "color":"#DC3545"});
		// $('#section2 input').attr("required","required");
		// $('#section1 input').removeAttr("required");
		// $('#section3 input').removeAttr("required");	
	})
	$('#op3').click(function(){
		$('#section1').hide();
		$('#section2').hide();
		$('#section3').show();
		$('#op1').css({"background":"transparent", "color":"#007BFF"});
		$('#op2').css({"background":"transparent", "color":"#28A745"});
		$('#op3').css({"background":"#DC3545", "color":"white"});
		// $('#section3 input').attr("required","required");
		// $('#section2 input').removeAttr("required");
		// $('#section1 input').removeAttr("required");	
	})
});

    