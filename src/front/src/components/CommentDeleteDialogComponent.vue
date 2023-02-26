<template>
  <v-dialog
    v-model="dialog"
    persistent
    max-width="290"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        class="mb-4 ml-4 white--text"
        color="red lighten-1"
        v-bind="attrs"
        v-on="on"
      >
        削除
      </v-btn>
    </template>
    <v-card>
      <v-card-title class="text-h5">
        削除
      </v-card-title>
      <v-card-text>コメント削除しますか？</v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="red"
          text
          @click="deleteComment"
        >
          削除する
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
  export default {
    props: ['id', "anime_id"],
    data() {
      return {
        dialog: false,
      }
    },
    methods: {
      deleteComment() {
      this.$axios.delete('/api/comment/' + this.id)
      .then(() => {
        // this.$router.go({path: this.$router.currentRoute.path, force: true})
          document.getElementById('commentContents' + this.id).style.display='none';
          this.dialog = false
        }
      )
    },
    }
  }
</script>
