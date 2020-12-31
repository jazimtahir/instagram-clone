<template>
    <div>
        <div class="position-relative">
            <div class="input-group">
                <input class="form-control py-2 border-right-0 border" placeholder="Search" type="text" v-model="keywords"></input>
                <span class="input-group-append input-group-text">
                    <i class="fa fa-search"></i>
                </span>
            </div>
            <div class="position-absolute w-100">
                <ul class="list-group" v-if="results.length > 0 && keywords.length > 0">
                    <a v-for="result in results" :href="url + '/' + result.username">
                        <li class="d-flex align-items-baseline list-group-item text-dark font-weight-bold" :key="result.id">
                            <div>
                                <img v-bind:src="url + profileImg(result)" style="max-height: 30px; max-width: 30px" class="rounded-circle img-fluid pl-0 ml-0 mr-3">
                            </div>
                            <div v-text="result.username"></div>
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        props: ['url'],

        data: function() {
            return {
                keywords: null,
                results: []
            }
        },
        watch: {
            keywords(after, before) {
                this.fetch();
            }
        },
        methods: {
            fetch() {
                axios.get(this.url + '/api/search', { params: { keywords: this.keywords } })
                .then(response => {
                    this.results = response.data;
                    this.flush();
                })
                .catch(error => {});
            },

            flush() {
                if (this.keywords == '') {
                    this.results.splice(0);
                }
            },

            profileImg(result) {
                if (result.profile.image) {
                    return '/storage/' + result.profile.image;
                } else {
                    return '/image/default.png';
                }
            }
        },
    }
</script>
