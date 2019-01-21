<template>
    <div>
        <h1 id="result-word" class="wow fadeInUp" data-wow-delay="0.6s" v-text=localWord.word></h1>
        <p id="result-definition" class="wow fadeInUp" data-wow-delay="1.0s" v-text="localWord.definition"></p>
        <div class="container tag-container">
            <a href="#" class="tag-element-boilerplate fadeInUp btn btn-default btn-sm hvr-bounce-to-top smoothScroll" style="display: none" data-wow-delay="1.3s">#</a>
            <a 	class="word-tag fadeInUp btn btn-default btn-sm hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s"
                  v-for="tag in this.localWord.tags"
                  v-text="tag.tag"
                  v-bind:href ="this.tag_prefix + tag.id"
            ></a>
        </div>
        <div class="container">
            <a id="result-link-for-more" v-bind:href="localWord.link_for_more" class="fadeInUp btn btn-default hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s">Детали...</a>
            <a v-if="morebuttonenabled" @click="another_word()" id="" href="#" class="fadeInUp btn btn-default hvr-bounce-to-top smoothScroll" data-wow-delay="1.3s">Еще...</a>
        </div>
    </div>
</template>

<script >
    export default {
        props: ["word", "morebuttonenabled", "tag_prefix", "load_word"],
        data() {
            return {
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
        created() {
            if (this.word) {
                this.localWord = this.word;
            }
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
    };


</script>