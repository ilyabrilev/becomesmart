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
            <a class="btn" @click="like_word()" v-if="is_liked">
                <span class="icon is-small" >
                    <i class="fas fa-heart"></i>
                </span>
                <span v-text="localWord.likes_count"></span>
            </a>
            <a class="btn" @click="like_word()" v-if="is_disliked">
                <span class="icon is-small">
                    <i class="far fa-heart"></i>
                </span>
                <span v-text="localWord.likes_count"></span>
            </a>
            <a v-if="morebuttonenabled" v-bind:class="{ 'is-active': isLoading, 'active': isLoading }" @click="another_word()" class="btn">Еще...</a>
        </div>
    </div>
</template>

<script >
    export default {
        props: ["word", "morebuttonenabled", "tag_prefix", "load_word", "get_random_word_url", "like_word_url"],
        data() {
            return {
                    isLoading: false,
                    localWord: {
                        id: -1,
                        word: 'Word not found',
                        definition: '',
                        tags: [],
                        link_for_more: '#',
                        likes_count: 0,
                        is_current_user_like: false
                    },
                    wordNotFound: {
                        id: -1,
                        word: 'Word not found',
                        definition: '',
                        tags: [],
                        link_for_more: '#',
                        likes_count: 0,
                        is_current_user_like: false
                    },
                    wordIsLoading: {
                        id: -1,
                        word: 'Загрузка...',
                        definition: '',
                        tags: [],
                        link_for_more: '#',
                        likes_count: 0,
                        is_current_user_like: false
                    }
                };
        },
        computed: {
            is_liked: function() {
                return this.localWord.is_current_user_like;
            },
            is_disliked: function() {
                return !this.localWord.is_current_user_like;
            }
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
            },
            like_word: function() {
                axios.post(this.like_word_url, {word_id: this.localWord.id})
                    .then(function(response) {
                        this.localWord.likes_count = response.data.likes_count;
                        this.localWord.is_current_user_like = response.data.user_liked;
                    }.bind(this))
                    .catch(function() {
                        //toDo: emit an event to an error component
                    }.bind(this));
            }
        }
    };

</script>