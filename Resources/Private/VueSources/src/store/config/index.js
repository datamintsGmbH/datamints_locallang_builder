/**
 * Store State
 */
import * as utility from "../../scripts/Utility";

const state = {
  config: JSON.parse(utility.metaAttribute('config'))
};

/**
 * Store Mutations
 */
const mutations = {}

/**
 * Store Actions
 */
const actions = {}

/**
 * Store Getters
 */
const getters = {
  config: state => state.config,
  provider: state => state.config.provider,
}

/**
 * Combined Object for vuex
 */
const configModule = {
  state,
  mutations,
  actions,
  getters
}


export default configModule;
