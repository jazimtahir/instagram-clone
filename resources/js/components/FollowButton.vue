<template>
    <div>
<!--        class="" :class="this.follow ?' btn btn-sm btn-outline-primary ml-2':'btn btn-sm btn-primary ml-2'"-->
        <button v-bind:class="{'btn btn-sm btn-outline-primary ml-2': this.status, 'btn btn-sm btn-primary ml-2': !this.status}" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {

        props: ['userId', 'follow'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function() {
            return {
                status: this.follow,
                url: 'http://localhost/insta/',
            }
        },

        methods: {
            followUser()
            {
                axios.post(this.url + 'follow/' + this.userId)
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

        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
