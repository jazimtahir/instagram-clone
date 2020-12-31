<template>
    <div>
        <!-- Div for BOX-->
        <div>
            <div class="form-group font-weight-bold">
                <textarea class="form-control" rows="2" id="comment" placeholder="Write Comment" v-model="commentBox"></textarea>
            </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-dark" @click.prevent="postComment">Add Comment</button>
            </div>
        </div>
        <!-- Div Ends for BOX-->
        <hr>
        <div class="h4">
            Comments
        </div>
        <!--Div for Comments-->
        <div v-for="comment in comments">
            <hr>
            <div class="d-flex align-items-baseline">
                <div>
                    <img v-bind:src="url + profileImg(comment)" style="max-height: 30px; max-width: 30px" class="rounded-circle img-fluid">
                </div>
                <div class="ml-2 font-weight-bold">
                    {{comment.user.username}}
                </div>
                <div class="ml-2">
                    {{comment.body}}
                </div>
            </div>
        </div>
        <!--Div End for Comments-->
    </div>
</template>
<script>
    export default {

        props: ['postId', 'userApi', 'url'],

        mounted() {
            this.getComments();
        },

        data: function() {
            return {
                comments: {},
                commentBox: '',
            }
        },

        methods: {
            getComments() {
                axios.get(this.url + '/api/post/' + this.postId + '/comments')
                .then((response) => {
                    this.comments = response.data
                })
                .catch(function (error) {
                    console.log(error);
                })
            },

            postComment() {
                axios.post(this.url + '/api/post/' + this.postId + '/comment',
                    {
                        api_token : this.userApi,
                        body: this.commentBox
                    })
                .then((response) => {
                    this.comments.unshift(response.data);
                    this.commentBox = '';
                })
                .catch(function (error) {
                    console.log(error);
                })
            },

            profileImg(comment) {
                if (comment.user.profile.image) {
                    return '/storage/' + comment.user.profile.image;
                } else {
                    return '/image/default.png';
                }
            }
        },
    }
</script>
