module.exports = {
  publicPath: process.env.NODE_ENV === 'production'
    ? '/'
    : '/',
  outputDir: process.env.NODE_ENV === 'production'
    ? '../../Public/VueGenerated/'
    : '/public/dist',
  filenameHashing: false,
  chainWebpack: config => {
    if (process.env.NODE_ENV === 'production') {
      config.plugins.delete('html')
      config.plugins.delete('prefetch')
      config.plugins.delete('preload')
    }

  }
}
