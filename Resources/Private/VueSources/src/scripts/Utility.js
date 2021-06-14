String.prototype.replaceArray = function (find, replace) {
  var replaceString = this;
  for (var i = 0; i < find.length; i++) {
    replaceString = replaceString.replace(find[i], replace[i]);
  }
  return replaceString;
};


export let metaAttribute = function (attr) {
  let metaElement = document.getElementById('meta');
  if (metaElement === null) {
    return null;
  }
  return metaElement.getAttribute('data-' + attr);
}

export let replaceVariables = function (string, vars) {
  return decodeURI(string).replaceArray(['%s1', '%s2'], vars);
}

export let getLanguageSvg = function (languageCode) {
  return "/typo3conf/ext/datamints_locallang_builder/Resources/Public/Icons/svg/" + languageCode.toUpperCase() + ".svg";
}
