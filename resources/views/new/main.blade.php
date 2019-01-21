@extends('layouts.app')

@section('content')
<!-- Home section -->
<section id="home" class="parallax-section">
	<div class="gradient-overlay"></div>
	<div class="container">
		<div class="row">
			<word-div :word="{{$word}}" :morebuttonenabled="true" :tag_prefix="'{{url('/tag/words?tag_id=')}}'"></word-div>
		</div>
	</div>
</section>

@endsection