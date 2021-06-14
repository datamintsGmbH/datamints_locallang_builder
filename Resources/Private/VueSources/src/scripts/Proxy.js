import * as utility from './Utility.js'

export let apiPath = function (ident, apiArguments = []) {
  const STANDALONE = false;
  const baseStyles = [
    "color: #fff",
    "background-color: #631982",
    "padding: 2px 4px",
    "border-radius: 2px"
  ].join(';');

  let path = '';
  if (STANDALONE) {
    path = '/' + ident.replace(/-/g, '/');
  } else {
    path = utility.metaAttribute(ident)
  }
  if (apiArguments.length > 0) {
    path = utility.replaceVariables(path, apiArguments);
  }

  console.info(`%cProxy calling: %c${path}`, 'font-weight:bold', baseStyles);
  return path;
}
