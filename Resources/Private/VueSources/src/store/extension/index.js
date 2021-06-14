import axios from 'axios';
import * as proxy from './../../scripts/Proxy.js'

/**
 * Store State
 */
const state = {
  extensions: [],
  toastMessages: [] // Toasts- TODO - Add to different module
}

/**
 * Store Mutations
 */
const mutations = {
  ADD_TOAST_MESSAGE: (state, toastMessage) => (state.toastMessages = [...state.toastMessages, toastMessage]),
  LOCALLANG_EXPORT(state, payload) {
    console.log(state + payload) // dont need it right now
  },

  UPDATE_EXTENSIONS(state, payload) {
    state.extensions = payload;
  },
  UPDATE_TRANSLATION(state, payload) {
    // TODO trololol loopmess. Better use .filter() to find matches. Had no better idea as vue-noob
    for (let extensionKey in state.extensions) {
      for (let locallangKey in state.extensions[extensionKey].locallangs) {
        for (let translationKey in state.extensions[extensionKey].locallangs[locallangKey].translationsArray) {
          if (state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.uid === payload.uid) {
            state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object = payload;
            return;
          }
        }
      }
    }
    console.error("Could not update translation value.");
  },
  UPDATE_TRANSLATION_VALUE(state, payload) {
    // TODO trololol loopmess. Better use .filter() to find matches. Had no better idea as vue-noob
    for (let extensionKey in state.extensions) {
      for (let locallangKey in state.extensions[extensionKey].locallangs) {
        for (let translationKey in state.extensions[extensionKey].locallangs[locallangKey].translationsArray) {
          for (let translationValueKey in state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues) {
            if (state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues[translationValueKey].uid === payload.uid) {
              // Vue.set(state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues, state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues[payload.uid], payload);
              state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues[translationValueKey] = payload;
              return;
            }
          }
        }
      }
    }
    console.error("Could not update translation value.");
  },
  DELETE_TRANSLATION_VALUE(state, payload) {
    // TODO trololol loopmess. Better use .filter() to find matches. Had no better idea as vue-noob
    for (let extensionKey in state.extensions) {
      for (let locallangKey in state.extensions[extensionKey].locallangs) {
        for (let translationKey in state.extensions[extensionKey].locallangs[locallangKey].translationsArray) {
          for (let translationValueKey in state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues) {
            if (state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues[translationValueKey].uid === payload.return) {
              // Vue.set(state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues, state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues[payload.uid], payload);
              delete state.extensions[extensionKey].locallangs[locallangKey].translationsArray[translationKey].object.translationValues[translationValueKey];
              return;
            }
          }
        }
      }
    }
    console.error("Could not delete translation value.");
  },
  GET_LOCALLANG(state, payload) {
    for (let extensionKey in state.extensions) {
      let locallangs = state.extensions[extensionKey].locallangs;
      for (let locallangKey in locallangs) {
        if (locallangs[locallangKey].uid === parseInt(payload.uid)) {
          locallangs[locallangKey] = payload;
          return;
        }
      }
    }
  },
  ADD_TRANSLATION(state, payload) {
    let locallangUid = payload.return;
    payload = payload.data;

    for (let extensionKey in state.extensions) {
      let locallangs = state.extensions[extensionKey].locallangs;
      for (let locallangKey in locallangs) {
        let locallang = locallangs[locallangKey];
        if (locallang.uid === parseInt(locallangUid)) {
          locallang.translationsArray.unshift({object: payload, key: payload.translationKey, _showDetails: true});
          return;
        }
      }
    }
    console.error("Could not add translation value.");
  },
  ADD_TRANSLATION_VALUE(state, payload) {
    let translationUid = payload.return;
    payload = payload.data;

    for (let extensionKey in state.extensions) {
      let locallangs = state.extensions[extensionKey].locallangs;
      for (let locallangKey in locallangs) {
        let locallang = locallangs[locallangKey];
        for (let translationKey in locallang.translationsArray) {
          let translation = locallang.translationsArray[translationKey].object;
          if (translation.uid === parseInt(translationUid)) {
            // Vue.set(translation.translationValues, translation.translationValues[payload.uid], payload);
            translation.translationValues[payload.ident] = payload;
            return;
          }
        }
      }
    }
    console.error("Could not add translation value.");
  },
  CLEAR_EXTENSIONS(state) {
    state.extensions = [];
    return;
  },

}

/**
 * Store Actions
 */
const actions = {
  async getExtensions({commit}) {
    await axios.get(proxy.apiPath('api-extensions'))
      .then((response) => {
        analyzeResponse(response, commit);

        commit('UPDATE_EXTENSIONS', response.data.data);


      }).catch(catchFallback)
  },
  async getLocallangByUid(context, payload) {
    await axios.get(proxy.apiPath('api-locallang-getby-uid', [payload.uid]))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('GET_LOCALLANG', response.data.data);
      }).catch(catchFallback)
  },
  async clearExtensions(context, payload) {
    await axios.post(proxy.apiPath('api-extensions-clear'), new URLSearchParams(payload))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('CLEAR_EXTENSIONS');
      }).catch(catchFallback);

  },
  async addTranslationValue(context, payload) {
    await axios.post(proxy.apiPath('api-translation-addtranslationvalue', [payload.uid]), new URLSearchParams(payload))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('ADD_TRANSLATION_VALUE', response.data);
      }).catch(catchFallback);
  },
  async addTranslation(context, payload) {
    await axios.post(proxy.apiPath('api-translation-add', [payload.uid]), new URLSearchParams(payload))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('ADD_TRANSLATION', response.data);
      }).catch(catchFallback);
  },
  async deleteTranslationValue(context, payload) {
    await axios.post(proxy.apiPath('api-translation-deletetranslationvalue', [payload.uid]))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('DELETE_TRANSLATION_VALUE', response.data);
      }).catch(catchFallback);
  },
  async updateTranslationValue(context, payload) {
    await axios.post(proxy.apiPath('api-translationvalue-update', [payload.uid]), new URLSearchParams(payload))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('UPDATE_TRANSLATION_VALUE', response.data.data);
      }).catch(catchFallback);
  },
  async updateTranslation(context, payload) {
    await axios.post(proxy.apiPath('api-translation-update', [payload.uid]), new URLSearchParams(payload))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('UPDATE_TRANSLATION', response.data.data);
      }).catch(catchFallback);
  },
  async exportLocallang(context, payload) {
    await axios.post(proxy.apiPath('api-locallang-export', [payload.uid]), new URLSearchParams(payload))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('LOCALLANG_EXPORT', response.data.data);
      }).catch(catchFallback);
  },
  async autoTranslate(context, payload) {
    await axios.get(proxy.apiPath('api-autotranslate', [payload.uid, payload.textToTranslate]))
      .then((response) => {
        analyzeResponse(response, context.commit);
        context.commit('UPDATE_TRANSLATION_VALUE', response.data.data);
      }).catch(catchFallback);
  },
}

/**
 * Store Getters
 */
const getters = {
  extensions: state => state.extensions,
  locallang: (state) => (uid) => {
    if (uid === null) return null;
    for (let extensionKey in state.extensions) {
      for (let locallangKey in state.extensions[extensionKey].locallangs) {
        if (state.extensions[extensionKey].locallangs[locallangKey].uid == uid) {
          return state.extensions[extensionKey].locallangs[locallangKey]
        }
      }
    }
    return null;
  }
}

/**
 * Combined Object for vuex
 */
const extensionModule = {
  state,
  mutations,
  actions,
  getters
}

/**
 * Fallback, when API cant execute an command
 * @param {error} err
 */
const catchFallback = ((err) => {
  console.log('ERROR');
  console.log(err);
  window.dispatchEvent(new Event('CRITICAL_ERROR'));
})

const analyzeResponse = ((response, commit) => {
  if (response && response.data != null) {
    if (typeof response.data === 'string') {
      window.dispatchEvent(new Event('CRITICAL_ERROR', {
        message: "meow"
      }));
    }
    commit('ADD_TOAST_MESSAGE', {
      text: response.data.message,
      title: response.data.status,
      variant: response.data.status
    });
  }
})


export default extensionModule;
