const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: [
    'vuetify'
  ],

  devServer: {
    proxy: {
      '^/api/': {
          target: 'http://localhost:8888',
          logLevel: 'debug',
          pathRewrite: { "^/api/": "/api/" }
      }
    }
  },

  pluginOptions: {
    s3Deploy: {
      registry: undefined,
      region: 'ap-northeast-1',
      bucket: 'anitify.com',
      assetPath: 'dist',
      deployPath: '/dist',
      pwa: true,
      pwaFiles: 'service-worker.js',
      enableCloudfront: true,
      cloudfrontId: 'E3AV9YJY7ME6YG',
      cloudfrontMatchers: '/*',
      uploadConcurrency: 5
    }
  }
})
