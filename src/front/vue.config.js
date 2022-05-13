const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: [
    'vuetify'
  ],
  devServer: {
    '^/api/': {
      target: 'http://localhost:8888',
      changeOrigin: true,
    }
  }
})
