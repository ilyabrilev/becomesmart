@extends('layouts.app')

@section('content')
<!-- Home section -->
<section id="tagwords" class="">
	<div class="tag-title-container">
		<h2>{{$tag->tag}}</h2>
		<h4>{{"Слова с тегом $tag->tag"}}</h4>
	</div>
	<div class="tag-column-container">
		<div class="container">
			<div class="columns is-1 is-multiline">
			@foreach ($tag->words as $word)
				<div class="column tag-column is-one-quarter">
					<div class="tag-column-content">
						<a href="{{url('/word?id=' . $word->id)}}">{{$word->word}}</a>
					</div>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</section>
@endsection