<?php 
	if (array_key_exists('ajax', $_POST)) {

		print_r($_POST['ajax']);
	}
	else {
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Título</title>
	</head>
	<body>

<blockquote>
  <p>Far far away, behind the word mountains, far from the 
  countries Vokalia and Consonantia, there live the blind texts.<br>
  Separated they live in Bookmarksgrove right at the coast of the
  Semantics, a large language ocean. A small river named Duden
  flows by their place and supplies it with the necessary regelialia.</p>
  
  <p>It is a paradisematic country, in which roasted parts of sentences
  fly into your mouth. Even the all-powerful Pointing has no control
  about the blind texts it is an almost unorthographic life One day
  however a small line of blind text by the name of Lorem Ipsum decided
  to leave for the far World of Grammar.<br>
  The Big Oxmox advised her not to do so, because there were thousands
  of bad Commas, wild Question Marks and devious Semikoli, but the
  Little Blind Text didn’t listen.<br>
  She packed her seven versalia, put her initial into the belt and
  made herself on the way.</p>
  
  <p>When she reached the first hills of the Italic Mountains,
  she had a last view back on the skyline of her hometown
  Bookmarksgrove, the headline of Alphabet Village and the subline
  of her own road, the Line Lane.<br>
  Pityful a rethoric question ran over her cheek, then</p>
</blockquote>

<p>
  <input type="button" id="sel-text" value="Get selected text / 選択部分のテキストを取得" />
  <input type="button" id="sel-html" value="Get selected html / 選択部分のHTMLを取得" />
</p>

<h3>Result value / 取得結果</h3>
<textarea id="result" readonly="readonly"></textarea>

	</body>
	<script type="text/javascript" src="scripts/jquery.min.js"></script>
	<script type="text/javascript" src="http://madapaja.github.io/jquery.selection/src/jquery.selection.js"></script>
	<script type="text/coffeescript" src="scripts/app.coffee"></script>
	<script type="text/javascript">
		// Get selected text / 選択部分のテキストを取得
		$('#sel-text').click(function(){
		  $('#result').text($.selection());
		});

		// Get selected html / 選択部分のHTMLを取得
		$('#sel-html').click(function(){
		  $('#result').text($.selection('html'));
		});
	</script>
</html>

<?php 
	} // FIm do callbak
?>
