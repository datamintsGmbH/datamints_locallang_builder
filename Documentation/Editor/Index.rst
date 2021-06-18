.. include:: ../Includes.txt

.. _for-editors:

===========
For Editors
===========

- You can access the "Locallang Builder" Menu-Item from the TYPO3-Backend. It's listed in "Admin-Tools".
- The first loading of this module may take a short moment, because all your active extensions are getting scanned and their locallang-files mapped into models.
- After the loading-process you can see all your active extensions on the left side. Expand one menu-item and select your desired locallang-file.
- Now you should see all translations collapsed in the content-area. Click on one entry to expand it. Every entry should have one default-language (EN) and if available, one or more translations (e.g. DE, FR, HU)
- You can define a comment for the default-language, which will be inserted into the locallang.xlf export file.
- For non-default-languages you can trigger the auto-translate function when configured in typoscript. The text-value for the default-language will be translated and saved to the language you selected.
- All changes are saved automatically after 4 seconds, so you don't have to watch out if you saved everything.
- At the bottom of the translation you can also have another language created for this entry.
- Completely new keys can be created using the action bar. A modal window will open in which you define the value of the standard language and into which language this value should be translated.
- When you are done with everything, you can trigger an export in the action bar. Here you can choose where the export should be saved.

It is possible for this export to overwrite the extension files directly or to use an intermediate directory.
If you are unsure, you can also have a backup of the previous translations made.

If you modify something in a locallang file at file level, please make sure that you then click on "Reimport" in the panel on the left so that the content is reloaded.

.. _editor-faq:

FAQ
===

Q: Some extensions are not listed

A: Only active extensions are shown. Perhaps the missing extension has no translations or these do not comply with the standard, e.g. because they use a different file extension or the content could not be read


Q: I can't use the auto-translate function. Whats wrong?

A: You have to set a API-Key in the Typoscript-Template for your desired provider. You also have to set the "active" field to 1 if a key is entered.


Q: Where to get the API-Key for Azure?

A: See https://github.com/datamintsGmbH/datamints_locallang_builder/blob/master/Documentation/Configuration/Index.rst#example-azure-cloud


Q: Where to get the API-Key for DeepL?

A: See https://github.com/datamintsGmbH/datamints_locallang_builder/blob/master/Documentation/Configuration/Index.rst#example-deepl


Q: Where to get the API-Key for Google Translate?

A: See https://github.com/datamintsGmbH/datamints_locallang_builder/blob/master/Documentation/Configuration/Index.rst#example-google
