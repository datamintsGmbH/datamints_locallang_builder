import Vue from 'vue'
import App from './App.vue'
import store from './store'


// Icons (Nucleon)
import KeyIcon from './icons/key'
import FloppyDiskIcon from './assets/icons/floppy-disk'
import FolderDevIcon from './assets/icons/folder-dev'
import FileFolderIcon from './assets/icons/file-folder'
import FileXmlIcon from './icons/file-xml'
import LanguageIcon from './icons/language'
import TranslationIcon from './assets/icons/translation'
import TranslationSymbolsIcon from './icons/translation-symbols'
import FCommentIcon from './icons/f-comment'
import FileAddIcon from './assets/icons/file-add'
import FlagIcon from './assets/icons/flag'
import EditIcon from './assets/icons/edit'
import DeleteForeverIcon from './assets/icons/delete-forever'
import CtrlUpIcon from './assets/icons/ctrl-up'
import CtrlDownIcon from './assets/icons/ctrl-down'
import SettingsGearIcon from './assets/icons/settings-gear'
import LogoGithubIcon from './assets/icons/logo-github'
import ReloadIcon from './assets/icons/reload'

// Argon
import Dashboard from './plugins/dashboard-plugin'

Vue.config.productionTip = false
//Vue.config.devtools = true;

// Adding icons globally
Vue.component('key-icon', KeyIcon);
Vue.component('floppy-disk-icon', FloppyDiskIcon);
Vue.component('file-xml-icon', FileXmlIcon);
Vue.component('translation-icon', TranslationIcon);
Vue.component('translation-symbols-icon', TranslationSymbolsIcon);
Vue.component('f-comment-icon', FCommentIcon);
Vue.component('folder-dev-icon', FolderDevIcon);
Vue.component('file-folder-icon', FileFolderIcon);
Vue.component('language-icon', LanguageIcon);
Vue.component('flag-icon', FlagIcon);
Vue.component('file-add-icon', FileAddIcon);
Vue.component('edit-icon', EditIcon);
Vue.component('delete-forever-icon', DeleteForeverIcon);
Vue.component('ctrl-up-icon', CtrlUpIcon);
Vue.component('ctrl-down-icon', CtrlDownIcon);
Vue.component('settings-gear-icon', SettingsGearIcon);
Vue.component('logo-github-icon', LogoGithubIcon);
Vue.component('reload-icon', ReloadIcon);

Vue.use(Dashboard);

new Vue({
  store,
  render: h => h(App),


}).$mount('#app')
