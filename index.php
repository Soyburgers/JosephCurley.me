<?php session_start() ?>  
<!DOCTYPE html>
<html clas="no-js" lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Joseph Curley, Designer & Developer | josephcurley.me</title>
		<link rel="stylesheet/less" type="text/css" href="css/style.less">
		<meta name="keywords" content="Portfolio, Joseph, Curley, Joseph Curley, Design, Develop, CSS, UI/UX, HTML5, Plymouth, Boston, CSS3, Webdesign">
		<meta name="description" content="The Portfolio Website of Graphic Designer and Front-End Web Developer, Joseph Curley">
	 	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	 	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
		<script src="js/jquery-ui-1.8.22.custom.min.js"></script>
		<script src="js/less-1.3.0.min.js" type="text/javascript"></script>
		<script src="js/modernizr-2.0.6.min.js"></script>
		<script src="js/script.js" type="text/javascript"></script>
	</head>
	<body>
		<div id="interested">
			<div id="contact-form" class="clearfix">
    			<h1>Let's talk!</h1>    			
    			<!--I created this form through use of a tutorial!-->
    			
    			<?php
	    			//init variables
	    			$cf = array();
	    			$sr = false;

	    			if(isset($_SESSION['cf_returndata'])){
		    			$cf = $_SESSION['cf_returndata'];
		    			$sr = true;
    				}
    			?>

  
  
    			<ul id="errors" class="<?php echo ($sr && !$cf['form_ok']) ? 'visible' : ''; ?>">
	    			<li id="info">You did something wrong! Try again!</li>
	    			<?php
		    			if(isset($cf['errors']) && count($cf['errors']) > 0) :
		    			foreach($cf['errors'] as $error) :
		    		?>
		    		<li>
		    		<?php echo $error ?></li>
		    		<?php
			    		endforeach;
			    		endif;
			    	?>
			    </ul>
			    <p id="success" class="<?php echo ($sr && $cf['form_ok']) ? 'visible' : ''; ?>">Thanks for your message! I'll get back to you as soon as I can!</p>

			    <form method="post" action="process.php">
			   		 <label for="name">Name: <span class="required">*</span></label>
			   		 <input type="text" id="name" class="txtfield" name="name" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['name'] : '' ?>" placeholder="Morrissey" required="required" />

			   		 <label for="email">Email Address: <span class="required">*</span></label>
			   		 <input type="email" id="email" class="txtfield" name="email" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['email'] : '' ?>" placeholder="Girlfriend@InA.Coma" required="required" />

			   		 <label for="telephone">Phone number: </label>
			   		 <input type="tel" id="telephone" class="txtfield" name="telephone" value="<?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['telephone'] : '' ?>" />

			   		 <label for="enquiry">Enquiry: </label>
			   		 <select id="enquiry" name="enquiry" class="txtfield">
					    <option value="General" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'General') ? "selected='selected'" : '' ?>>General!</option>
					    <option value="Design" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'Design') ? "selected='selected'" : '' ?>>Need something designed or built?</option>
					    <option value="Internship" <?php echo ($sr && !$cf['form_ok'] && $cf['posted_form_data']['enquiry'] == 'Internship') ? "selected='selected'" : '' ?>>Looking to take on an intern?</option>

				    <label for="message">Message: <span class="required">*</span></label>
				    <textarea id="message" name="message" placeholder="Fill this out and I'll reply soon." required="required" data-minlength="2"><?php echo ($sr && !$cf['form_ok']) ? $cf['posted_form_data']['message'] : '' ?></textarea>

				    <span id="loading"></span>
				    <input type="submit" value="Send!" id="submit-button" />
				    <p id="req-field-desc"><span class="required">*</span> indicates a required field</p>

			    </form>
			    <?php unset($_SESSION['cf_returndata']); ?>  
			</div>
			<div id="close">
				<a href="#">Close</a>
			</div>

		</div>
		<header>
			<hgroup>
				<h1>Hey I'm Joseph!</h1>
				<h2>I'm a designer</h2>
			</hgroup>
		</header>
		<div id="content">
			<div id="work">
				<div id="workview">
					<div id="workframe"></div>
					<div id="workhide">
						<a href="#" id="link_close">Close this piece</a>
						<a href="#aboutme" id="link_down">About this piece</a>
					</div>
				</div>
				<div id="thumbnails">
					<a href="#"><img src="images/icons_bw/catscradle.png" alt="Cat's Cradle Poster"></a>
					<a href="#"><img src="images/icons_bw/brandire.png" alt="Brandire Type Design"></a>
					<a href="#"><img src="images/icons_bw/mondrian.png" alt="Piet Mondrian Logo"></a>
					<a href="#"><img src="images/icons_bw/singolo.png" alt="Singolo Logo"></a>
					<a href="#"><img src="images/icons_bw/bodoni.png" alt="Bodoni Logo"></a>
					<a href="#"><img src="images/icons_bw/conformist.png" alt="Conformist Poster"></a>
					<a href="#"><img src="images/icons_bw/bayend.png" alt="BayEnd Farm Website"></a>
					<a href="#"><img src="images/icons_bw/cookbook.png" alt="Cook Book Design"></a>
					<a href="#"><img src="images/icons_bw/gennaros.png" alt="Gennaro's Website"></a>
				</div>
			</div>
			<div id="aboutme">
				<p class="description"> A poster design for Kurt Vonnegut's novel Cat's Cradle. Designed for Mark Laughlin's design class in April of 2012. The goal of this project was to isolate a novel down to it's most important themes then to show each of these themes while establishing a clear visual hierarchy. This piece was featured in my university's art show in Spring of 2012</p>
				<p class="description"> Typeface design done for Don Tarallo's Typography class in April of 2012. The typeface was designed to combine Art Deco aesthetics and the hairline strokes of Bodoni and Didot. </p>
				<p class="description"> Logo design created as part of an assignment in Don Tarallo's graphic design class in September of 2011. The goal of this piece was to create a logo that captures the visual identity of a historic artist. </p>
				<p class="description">A logo designed as part of an Introduction to Adobe Illustrator class </p>
				<p class="description">Designed in Franz Werner's Type + Image class during RISD SIGDS. The goal of the piece was to design a logotype for an existing typeface and to then apply that logotype to a postcard as a hypothetical promotional card sent by a foundry. The logo shows each letter as a piece of metal type viewed from straight on. The photo in the background was taken on the surface of a letterpress in the RISD printshop.</p>
				<p class="description">Designed in Franz Werner's Type + Image class during RISD SIGDS 2012. The goal of this piece was to create a poster that represents the beautiful film "The Conformist". I reduced the concept of each individual person down to a simple image of a hat. The one red hat was done to capture the violent elements of the film. I chose to show the italian flag with altered values to express the bleak and tragic elements of the film.</p>
				<p class="description"> A website design done for a local farm. This piece is still a work in progress. A link to the actual site will be up once I put the finishing touches on it.</p>
				<p class="description"> A 16 page book designed for Douglas Scott's Book Design class. I created a vegan cookbook featuring my favorite dishes. The book included a cover, a bastard title, a colophon, an index, and chapter opens. More of the book can be seen below.
				<a href="images/portfolio/cookbook_spread1.png"><img src="images/portfolio/cookbook_spread1.png" alt="spread1"></a>
				<a href="images/portfolio/cookbook_spread2.png"><img src="images/portfolio/cookbook_spread2.png" alt="spread2"></a>
				<a href="images/portfolio/cookbook_spread3.png"><img src="images/portfolio/cookbook_spread3.png" alt="spread3"></a> </p>
				<p class="description">A <a class="external" href="http://josephcurley.me/gennaros">website</a> for Gennaro's At 5 North Square Restuarant in the North End of Boston. This piece was completed during the Fall of 2012. The site was designed with mobile devices in mind and is 100 percent responsive. It was created as a single page to make navigation on a mobile device more fluid and friendly.</p>
				<p id="about">I'm a graphic designer and front-end web developer living in Plymouth, MA currently finishing up my senior year of college. When I'm not in class I work as a freelance front-end developer for a certain studio. Beyond the work I do through the studio, I am currently taking on jobs for clients personally I'm experienced with Illustrator, Photoshop, Indesign and I'm excellent with HTML, CSS and Jquery. I built this site with LESS and Jquery. Check out my portfolio by clicking around the thumbnails or using the arrow keys, and if you like what you see...</p>
				<a href="#" id="click">Get in touch!</a>
			</div>
		</div>
		<script type="text/javascript">
	 var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-32675172-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

	</body>
</html>

