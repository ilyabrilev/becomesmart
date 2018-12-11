<!DOCTYPE html>
<html lang="en">
<head>

	<title>Steak House - Free HTML CSS Template</title>
<!--

Template 2083 Steak House

http://www.tooplate.com/view/2083-steak-house

-->
  	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="">
  	<meta name="description" content="">

	<!-- stylesheets css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">

  	<link rel="stylesheet" href="css/magnific-popup.css">

	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">

  	<link rel="stylesheet" href="css/nivo-lightbox.css">
  	<link rel="stylesheet" href="css/nivo_themes/default/default.css">

  	<link rel="stylesheet" href="css/hover-min.css">
  	<link rel="stylesheet" href="css/flexslider.css">

	<link rel="stylesheet" href="css/style.css">

  	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
  	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,600' rel='stylesheet' type='text/css'>

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

<!-- Preloader section -->
<div class="preloader">
	<div class="sk-spinner sk-spinner-pulse"></div>
</div>

<!-- Navigation section -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand">Steak House</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#top" class="smoothScroll">Home</a></li>
				<li><a href="#feature" class="smoothScroll">Features</a></li>
				<li><a href="#about" class="smoothScroll">About</a></li>
				<li><a href="#menu" class="smoothScroll">Menu</a></li>
			</ul>
		</div>

	</div>
</div>

<!-- Home section -->
<section id="home" class="parallax-section">
  <div class="gradient-overlay"></div>
    <div class="container">
      <div class="row">
          <div class="col-md-offset-2 col-md-8 col-sm-12">
              <h1 id="result-word" class="wow fadeInUp" data-wow-delay="0.6s">{{$word->word}}</h1>
              <p id="result-definition" class="wow fadeInUp" data-wow-delay="1.0s">{{$word->definition}}</p>
			  <div class="tag-container">
				  <a href="#" class="tag-element-boilerplate fadeInUp btn btn-default btn-sm hvr-bounce-to-top smoothScroll" style="display: none" data-wow-delay="1.3s">#</a>
				  @foreach ($word->tags as $tag)
					  <a href="#" class="word-tag fadeInUp btn btn-default btn-sm hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s">#{{$tag->tag}}</a>
				  @endforeach
			  </div>
              <a id="result-link-for-more" href="{{$word->link_for_more}}" class="fadeInUp btn btn-default hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s">Детали...</a>
			  <a id="get-another-word" href="#" class="fadeInUp btn btn-default hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s">Еще...</a>
          </div>
      </div>
    </div>
</section>

<!-- Copyright section -->
<section id="copyright">
  <div class="container">
    <div class="row">

      <div class="col-md-8 col-sm-8 col-xs-8">
        <p>Copyright © 2018 Whatever Company - Designed by <a class="designed-by" href="https://plus.google.com/+Tooplate/" target="_blank">Tooplate</a></p>
      </div>
    </div>
  </div>
</section>

<!-- javscript js -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.magnific-popup.min.js"></script>

<script src="js/jquery.sticky.js"></script>
<script src="js/jquery.backstretch.min.js"></script>

<script src="js/isotope.js"></script>
<script src="js/imagesloaded.min.js"></script>
<script src="js/nivo-lightbox.min.js"></script>

<script src="js/jquery.flexslider-min.js"></script>

<script src="js/jquery.parallax.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/wow.min.js"></script>

<script src="js/custom.js"></script>

<script>
	linkForMore = "{{url('/api/random')}}";
</script>

</body>
</html>