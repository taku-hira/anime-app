<template>
  <v-dialog
    v-model="dialog"
    persistent
    max-width="400"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        class="mb-4 ml-4"
        v-bind="attrs"
        v-on="on"
      >
        編集する
      </v-btn>
    </template>
    <v-card class="pa-4">
      <v-card-title class="text-h5">
        コメント編集
      </v-card-title>
      <div>
        <v-form ref="form" @submit.prevent="sendComment">
          総合評価
          <star-rating
          :show-rating="false"
          v-bind:star-size="30"
          :rating="input.stars"
          v-model="input.stars"
          ></star-rating>
          <v-textarea
          solo
          v-model="input.comment"
          ></v-textarea>
        </v-form>
      </div>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="green darken-1"
          text
          @click="editComment"
        >
          編集する
        </v-btn>
        <v-btn
          text
          @click="dialog = false"
        >
          キャンセル
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
  import StarRating from "vue-star-rating"
  export default {
    components: {
      StarRating,
    },
    props: ['id', 'comment', 'stars'],
    data() {
      return {
        dialog: false,
        input: {
          'comment': this.comment,
          'stars': this.stars,
        }
      }
    },
    methods: {
      editComment() {
        this.$axios.put('api/comment/' + this.id, {
            comment: this.input.comment,
            stars: this.input.stars,
          })
            .then(() => {
              document.getElementById('commentText' + this.id).innerHTML=this.input.comment;
              if (this.input.stars == '1') {
                document.getElementById('commentStar' + this.id).innerHTML="<span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span>";
              } else if (this.input.stars == '2') {
                document.getElementById('commentStar' + this.id).innerHTML="<span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span>";
              } else if (this.input.stars == '3') {
                document.getElementById('commentStar' + this.id).innerHTML="<span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span>";
              } else if (this.input.stars == '4') {
                document.getElementById('commentStar' + this.id).innerHTML="<span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#d8d8d8;font-size:20px;'>★</span>";
              } else if (this.input.stars == '5') {
                document.getElementById('commentStar' + this.id).innerHTML="<span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055;font-size:20px;'>★</span><span style='color:#ffd055; font-size:20px;'>★</span>";
              }
              this.dialog = false
            })
            .catch((error) => {
              this.message = error.response.data.message
              console.log(this.message)
            })
      },
    }
  }
</script>
