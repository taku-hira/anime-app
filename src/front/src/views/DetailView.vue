<template>
  <v-container>
    <v-row>
      <v-col
        col="12"
        md="6"
        sm="12"
        xs="12"
      >
        <h1 class="mb-5">{{ anime.title }}</h1>
        <p>
          {{ anime.summary }}
        </p>
        <div v-if="onAirData.date">
          <h4 class="mt-4">放送日</h4>
          {{ onAirData.date }}
          <v-divider />
          <h4 class="mt-4">放送情報</h4>
          {{ onAirData.info }}
          <v-divider />
        </div>
        <div v-if="!onAirData.date">
          番組情報はありません
        </div>
        <router-link to="/home">
          <v-btn
            color="primary"
            elevation="6"
            class="my-4"
          >
            戻る
          </v-btn>
        </router-link>
      </v-col>
      <v-col
        col="12"
        md="6"
        sm="12"
        xs="12"
        class="mb-4"
      >
        <v-img
          :src="anime.img_file_name"
        ></v-img>
      </v-col>
    </v-row>
    <div>
      <v-form ref="form" @submit.prevent="sendComment">
        総合評価
        <star-rating
        :show-rating="false"
        v-bind:star-size="30"
        v-model="input.stars"
        ></star-rating>
        <v-textarea
        solo
        v-model="input.comment"
        label="コメント・感想"
        ></v-textarea>
        <div class="err_msg">
          {{ message }}
        </div>
        <v-btn
        class="mb-4 ml-auto"
        type="submit"
        >
          コメントする
        </v-btn>
      </v-form>
    </div>
    <div
    v-for="comment in comments"
    :key="comment.id"
    :id="'commentContents' + comment.id"
    >
      <v-card
      elevation="2"
      class="ma-4 pa-4"
      >
        <v-icon>
          mdi-account
        </v-icon>
        {{ comment.user.name }}
        {{ comment.created_at }}
        <star-rating
        :read-only="true"
        :rating="comment.stars"
        :show-rating="false"
        :id="'commentStar' + comment.id"
        v-bind:star-size="20"
        ></star-rating>
        <p
         style="white-space: pre-wrap;"
         v-text="comment.comment"
         :id="'commentText' + comment.id"></p>
        <comment-edit-dialog-component
        v-if="user.id === comment.user.id"
        :id="comment.id"
        :comment="comment.comment"
        :stars="comment.stars"
        ></comment-edit-dialog-component>

        <comment-delete-dialog-component
        v-if="user.id === comment.user.id"
        :id="comment.id"
        :anime_id="comment.anime_id"
        ></comment-delete-dialog-component>
      </v-card>
    </div>
  </v-container>
</template>

<script>
  import StarRating from "vue-star-rating"
  import CommentEditDialogComponent from '../components/CommentEditDialogComponent.vue'
  import CommentDeleteDialogComponent from '../components/CommentDeleteDialogComponent.vue'
  export default {
      props: {
        id: String
      },
      components: {
        StarRating,
        CommentEditDialogComponent,
        CommentDeleteDialogComponent
      },
      data() {
          return {
              anime: {},
              user: {},
              comments: {},
              onAirData: {},
              message: '',
              input: {
                'anime_id': this.$route.params.id,
                'comment': '',
                'stars': 0,
              },
          }
      },
      metaInfo () {
        return {
          title: this.anime.title
        }
      },
      methods: {
        getAnime() {
          this.$axios.get('/api/anime/' + this.$route.params.id)
            .then((res) => {
              this.anime = res.data;
            })
        },
        getOnAirData() {
          this.$axios.get('/api/onair/' + this.$route.params.id)
            .then((res) => {
              this.onAirData = res.data
            })
            .catch(() => {
              this.onAirData = null
            })
        },
        getComments() {
          this.$axios.get('api/comments/' + this.$route.params.id)
            .then((res) => {
              this.comments = res.data
            })
        },
        sendComment() {
          this.$axios.post('api/comment/' + this.$route.params.id, {
            anime_id: this.input.anime_id,
            comment: this.input.comment,
            stars: this.input.stars,
          })
            .then(() => {
              this.getComments()
              this.input.comment = ''
              this.input.stars = 0
            })
            .catch((error) => {
              this.message = error.response.data.message
            })
        },
        getUser() {
          this.$axios.get('/api/user')
          .then((res) => {
            this.user = res.data
          })
        }
      },
      mounted() {
        this.getAnime(),
        this.getOnAirData(),
        this.getComments(),
        this.getUser()
      }
    }
</script>
