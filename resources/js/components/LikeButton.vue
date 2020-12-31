<template>
    <div>
<!--        class="" :class="this.follow ?' btn btn-sm btn-outline-primary ml-2':'btn btn-sm btn-primary ml-2'"-->
        <i v-bind:class="{'fa fa-heart liked': this.status, 'fa fa-heart-o unliked': !this.status}" @click="likePost"></i>
<!--        <button v-bind:class="{'btn btn-sm btn-outline-primary ml-2': this.status, 'btn btn-sm btn-primary ml-2': !this.status}" @click="followUser" v-text="buttonText"></button>-->
    </div>
</template>

<script>
    export default {

        props: ['postId', 'like', 'url'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function() {
            return {
                status: this.like,
            }
        },

        methods: {
            likePost()
            {
                axios.post(this.url + '/like/' + this.postId)
                .then(response => {
                    this.status = ! this.status;
                })
                    .catch(errors => {
                        if (errors.response.status === 401) {
                            window.location = 'login';
                        }
                    });
            }
        },
    }
</script>
