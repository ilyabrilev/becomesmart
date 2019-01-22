<template>
    <div>
        <h1 id="result-word" class="" v-text=localWord.word></h1>
        <p id="result-definition" class="" v-text="localWord.definition"></p>
        <div class="container tag-container">
            <a 	class="word-tag btn btn-sm"
                  v-for="tag in this.localWord.tags"
                  v-text="tag.tag"
                  v-bind:href ="tag_prefix + tag.id"
            ></a>
        </div>
        <div class="container">
            <a id="result-link-for-more" v-bind:href="localWord.link_for_more" class="btn">Детали...</a>
            <a v-if="morebuttonenabled" v-bind:class="{ 'is-active': isLoading, 'active': isLoading }" @click="another_word()" id="" href="#" class="btn">Еще...</a>
        </div>
    </div>
</template>

<script >
    export default {
        props: ["word", "morebuttonenabled", "tag_prefix", "load_word", "get_random_word_url"],
        data() {
            return {
                    isLoading: false,
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
                    },
                    wordIsLoading: {
                        word: 'Загрузка...',
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
                this.isLoading = true;
                this.localWord = this.wordIsLoading;
                axios.get(this.get_random_word_url)
                    .then(function(response) {
                        if (response.status === 200) {
                            this.localWord = response.data;
                        }
                        else {
                            this.localWord = this.wordNotFound;
                        }
                    }.bind(this))
                    .catch(function() {
                        this.localWord = this.wordNotFound;
                    }.bind(this))
                    .finally(function() {
                        this.isLoading = false;
                    }.bind(this));
            }
        }
    };


</script>