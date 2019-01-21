@extends('layouts.steak')

@section('content')
<!-- Home section -->
<section id="home" class="parallax-section">
	<div class="gradient-overlay"></div>
	<div class="container">
		<div class="row">
			<word-div
					:word="{{$word}}"
					:morebuttonenabled="{{$moreButtonEnabled ? 'true' : 'false'}}"
					:tag_prefix="`{{url('/tag/words?tag_id=')}}`"
					:load_word="{{$doLoadWord ? 'true' : 'false'}}"
			>
			</word-div>
		</div>
	</div>
</section>

<script >
    Vue.component("word-div", {
        props: ["word", "morebuttonenabled", "tag_prefix", "load_word"],
        data() {
            return this.word ? { localWord: this.word } :
				{
					localWord: {
						word: 'Word not found',
						definition: '',
						tags: [],
						link_for_more: '#'
				},
					wordNotFound: {
						word: 'Word not found',
						definition: '',
						tags: [],
						link_for_more: '#'
                }
            };
        },
        template: `
		<div class="col-md-offset-2 col-md-8 col-sm-12">
            <h1 id="result-word" class="wow fadeInUp" data-wow-delay="0.6s" v-text=localWord.word></h1>
            <p id="result-definition" class="wow fadeInUp" data-wow-delay="1.0s" v-text="localWord.definition"></p>
            <div class="tag-container">
                <a href="#" class="tag-element-boilerplate fadeInUp btn btn-default btn-sm hvr-bounce-to-top smoothScroll" style="display: none" data-wow-delay="1.3s">#</a>
                <a 	class="word-tag fadeInUp btn btn-default btn-sm hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s"
					v-for="tag in this.localWord.tags"
					v-text="tag.tag"
					v-bind:href ="tag_prefix + tag.id"
				></a>
            </div>
            <a id="result-link-for-more" v-bind:href="localWord.link_for_more" class="fadeInUp btn btn-default hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s">Детали...</a>

            <a v-if="morebuttonenabled" @click="another_word()" id="" href="#" class="fadeInUp btn btn-default hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s">Еще...</a>
        </div>
	`,
        created() {
            if (this.load_word) {
                this.another_word();
            }
        },
        methods: {
            another_word: function () {
                axios.get('http://becomesmartass/api/random')
                    .then(function(response) {
                        if (response.status === 200) {
                            this.localWord = response.data;
                        }
                        else {
                            this.localWord = this.wordNotFound;
						}
                    }.bind(this));
            }
        }
    });

    const app = new Vue({
        el: '#home',
        data() {
            return {}
        }
    });
</script>
@endsection