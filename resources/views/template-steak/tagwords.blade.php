@extends('layouts.steak')

@section('content')
<!-- Home section -->
<section id="team" class="parallax-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10">
					<div class="wow fadeInUp section-title" data-wow-delay="0.3s">
						<h2>{{$tag->tag}}</h2>
						<h4>{{"Слова с тегом $tag->tag"}}</h4>
					</div>
				</div>
				<div class="iso-box-wrapper col4-iso-box">
				@foreach ($tag->words as $word)
					<div class="iso-box col-md-4 col-sm-6">
						<a href="{{url("/word?id=$word->id")}}">{{$word->word}}</a>
					</div>
				@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
@endsection