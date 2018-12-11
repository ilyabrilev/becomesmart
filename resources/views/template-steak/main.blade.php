@extends('layouts.steak')

@section('content')
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
@endsection