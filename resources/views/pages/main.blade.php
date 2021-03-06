@extends('layouts.app')

@section('content')
<!-- Home section -->
<section id="home" class="app parallax-section">
	<div class="gradient-overlay"></div>
	<div class="container">
		<word-div
				:word="{{$word}}"
				:morebuttonenabled="{{$moreButtonEnabled ? 'true' : 'false'}}"
				:tag_prefix="`{{url('/tags/')}}`"
				:load_word="{{$doLoadWord ? 'true' : 'false'}}"
				:get_random_word_url="`{{url('api/ajax/random')}}`"
				:like_word_url="`{{url('api/ajax/like')}}`"
		>
		</word-div>
	</div>
</section>

@endsection
