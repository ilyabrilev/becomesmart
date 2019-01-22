@extends('layouts.app')

@section('content')
<!-- Home section -->
<section id="home" class="parallax-section">
	<div class="gradient-overlay"></div>
	<div class="container">
		<word-div
				:word="{{$word}}"
				:morebuttonenabled="{{$moreButtonEnabled ? 'true' : 'false'}}"
				:tag_prefix="`{{url('/tag/words?tag_id=')}}`"
				:load_word="{{$doLoadWord ? 'true' : 'false'}}"
				:get_random_word_url="`{{url('http://becomesmartass/ajax/random')}}`"
				:like_word_url="`{{url('http://becomesmartass/ajax/like')}}`"
		>
		</word-div>
	</div>
</section>

@endsection