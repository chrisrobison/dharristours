<?php
   if ($_POST['survey_submitted']) {
      print_r($_POST);
   }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Simple Customer Development Survey</title>
	<meta http-equiv="content-type" content="text/xhtml; charset=utf-8" />
	<!-- Stylesheets -->
	<link type="text/css" rel="stylesheet" media="screen" href="survey.css" />
	
</head>
<body>
<div id="wrapper">
		<h1>The Simple Software Application Survey</h1>
		
	<div class="sep1">
		<p>Thank you for taking the time to complete our survey. There are <strong class="highlight">8 questions</strong> below, which generally takes less than <strong class="highlight">5 minutes</strong> to complete.</p>
	</div>
	<div class="sep">
		<form method="post">
			<ol id="questions">
				<li>
					<span class="num">1</span>
					<h2>How did you discover Simple Software?</h2>
					<ul>
						<li><input type="radio" name="Survey[1]['value']" value="Blog" id="q1-1" /> <label for="q1-1">Blog</label></li>
						<li><input type="radio" name="Survey[1]['value']" value="Friend or colleague" id="q1-2" /> <label for="q1-2">Friend or colleague</label></li>
						<li><input type="radio" name="Survey[1]['value']" value="Search engine" id="q1-3" /> <label for="q1-3">Search engine (e.g. Google, Yahoo!)</label></li>
						<li><input type="radio" name="Survey[1]['value']" value="Facebook" id="q1-4" /> <label for="q1-4">Facebook</label></li>
						<li><input type="radio" name="Survey[1]['value']" value="Twitter" id="q1-5" /> <label for="q1-5">Twitter</label></li>
						<li><input type="radio" name="Survey[1]['value']" value="Other" id="q1-6" /> <label for="q1-6">Other (please specify)</label> <input type="text" class="text" name="Survey[1]['input']" id="q1-6-2" /></li>
					</ul>
				</li>
				<li>
					<span class="num">2</span>
					<h2>How would you feel if you could no longer use The Simple Software Application?</h2>
					<ul>
						<li><input type="radio" name="Survey[2]['value']" value="Very disappointed" id="q2-1" /> <label for="q2-1">Very disappointed</label></li>
						<li><input type="radio" name="Survey[2]['value']" value="Somewhat disappointed" id="q2-2" /> <label for="q2-2">Somewhat disappointed</label></li>
						<li><input type="radio" name="Survey[2]['value']" value="Not disappointed (it really isn&rsquo;t that useful)" id="q2-4" /> <label for="q2-4">Not disappointed (it really isn&rsquo;t that useful)</label></li>
						<li><input type="radio" name="Survey[2]['value']" value="N/A - I no longer use The Simple Software Application" id="q2-5" /> <label for="q2-5">N/A - I no longer use The Simple Software Application</label></li>
						<li id="why">
							<label for="q2-6">Please help us understand why you selected <span class="answer">this answer</span>.</label><br />
							<textarea class="textarea" name="Survey[2]['input']" id="q2-6"></textarea>
						</li>
					</ul>
				</li>
				<li>
					<span class="num">3</span>
					<h2>What would you likely use as an alternative if The Simple Software Application were no longer available?</h2>
					<ul>
						<li><input type="radio" name="Survey[3]['value']" value="I probably wouldn&rsquo;t use an alternative" id="q3-1" /> <label for="q3-1">I probably wouldn&rsquo;t use an alternative</label></li>
						<li><input type="radio" name="Survey[3]['value']" value="I would use:" id="q3-2" /> <label for="q3-2">I would use:</label> <input type="text" class="text" name="Survey[3]['input']" id="q3-2-2" /></li>
					</ul>
				</li>
				<li>
               <span class="num">4</span>
               <h2 for="q4">What is the primary benefit that you have received from The Simple Software Application?</h2>
               <textarea class="textarea" name="Survey[4]['input']" id="q4"></textarea>
				</li>
				<li>
					<span class="num">5</span>
					<h2>Have you recommended The Simple Software Application to anyone?</h2>
					<ul>
						<li><input type="radio" name="Survey[5]['value']" value="No" id="q5-1" /> <label for="q5-1">No</label></li>
						<li><input type="radio" name="Survey[5]['value']" value="Yes" id="q5-2" /> <label for="q5-2">Yes (Please explain how you described it)</label><br /><textarea class="textarea" name="Survey[5]['input']" id="q5-2-2"></textarea></li>
					</ul>
				</li>
				<li>
               <span class="num">6</span>
               <h2 for="q6">What type of person do you think would benefit most from Simple Software?</h2>
               <textarea class="textarea" name="Survey[6]['input']" id="q6"></textarea>
				</li>
				<li>
               <span class="num">7</span>
               <label for="q7">How can we improve Simple Software to better meet your needs?</label>
               <textarea class="textarea" name="Survey[7]['input']" id="q7"></textarea>
				</li>
				<li>
					<span class="num">8</span>
					<h2>Would it be okay if we followed up by email to request a clarification to one or more of your responses?</h2>
					<ul>
						<li><input type="radio" name="Survey[8]['value']" value="No" id="q8-1" /> <label for="q8-1">No</label></li>
						<li><input type="radio" name="Survey[8]['value']" value="Yes" id="q8-2" /> <label for="q8-2">Yes (please enter the best email address to contact you by)</label><br /><input type="text" class="text" name="Survey[8]['input']" id="q8-2-2" /></li>
					</ul>
				</li>
				<li class="end">
					<p class="center">
					  <input type="hidden" name="logger_session" value="" />
					  <input type="hidden" name="set" value="" />
						<input type="hidden" name="started" value="<?php print time(); ?>" />
						<input type="hidden" name="survey_submitted" value="true" />
						<input type="submit" name="submit_survey" value="Submit Survey" />
					</p>
					
				</li>
			</ol>
		</form>
	</div>
</div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8">
  
  $(document).ready(function(){
  	$("ol#questions li").click(function() {
  		$("ol#questions li span.num").removeClass("highlight");
  		$(this).find("span.num").addClass("highlight");
  	});
  	$("input#q1-6-2").focus(function() {
  		$("input#q1-6").attr("checked", "checked");
  	});
  	$("input#q3-2-2").focus(function() {
  		$("input#q3-2").attr("checked", "checked");
  	});
  	$("textarea#q5-2-2").focus(function() {
  		$("input#q5-2").attr("checked", "checked");
  	});
  	$("input[name='q2']").change(function() {
  		var selected = $("input[name='q2']:checked").val();
  		$("span.answer").html('<strong>"' + selected + '"</strong>');
  		$("textarea#q2-6").focus();
  	});
  	$("input#q1-6").change(function() {
  		$("input#q1-6-2").focus();
  	});
  	$("input#q3-2").change(function() {
  		$("input#q3-2-2").focus();
  	});
  	$("input#q5-2").change(function() {
  		$("textarea#q5-2-2").focus();
  	});
  	$("input#q8-2-2").focus(function() {
  		$("input#q8-2").attr("checked", "checked");
  	});
  	$("input#q8-2").change(function() {
  		$("input#q8-2-2").focus();
  	});
  });
  
</script>
</body>
</html>
