import Vue from 'vue'
import Vuex from 'vuex'

// Module importieren
import config from './config';
import extension from './extension';
import language from './language';

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    extension,
    language,
    config,
  }
})
