.. include:: ../Includes.txt

.. _changelog:

==========
Change log
==========


Version 1.0.16
-------------

- Changed module icon
- Removed unnecessary "required"-attribute from language-fields. It is now possible to create new keys only with the default-language.
- Improved Layout for "New Key"-View
- Set "Create backup" initially to false

Version 1.0.15
-------------

- new feature: Display ViewHelper Snippets for Fluid (+ inline) & Extbase-Integration

Version 1.0.14
-------------

- renamed wrong file name from DeepLProvider to DeeplProvider. It didnt match the class name before

Version 1.0.13
-------------

- added option to delete the whole translation-record
- moved translation-action-area to the top of the collapse-button to save some space

Version 1.0.12
-------------

- hide Objects in List-View
- removed the disable-function when waiting for a response
- Changed the appearance of the auto-save overlay so that it is no longer so intrusive

Version 1.0.11
-------------

- added lazy annotations for a much better performance
- changed repo query to generic constraint system to avoid storage-restriction
- compiled the vue project (improved error-handling for invalid locallang-attributes)
- Disabled the language recognition by xliff target-language attribute because we cant always rely on the correct-value. Otherwise some files cannot be scanned. (thx Wolfang Wagner for the hint)

Version 1.0.10
-------------

- Replaced "is_file" checks with "is_dir" checks. (Thanks to @dbunkerd )

Version 1.0.9
-------------

- fixed read-process for the approved attribute (thanks @opi99 https://github.com/datamintsGmbH/datamints_locallang_builder/issues/3)

Version 1.0.8
-------------

- fixed missing fields for "approved" and "xml:space" in the export-function
- removed old deprecated tca-files when the extension had a different nam

Version 1.0.7
-------------

- Added fallback when a file does not contain a target-language attribute while scanning those. Instead we fetch the language code from the filename
- hotfix for wrong format of api-request;
- changed order of alert-component when a critical error occurs
- Modified the locallang-prefixes to match the ident "datamintslocallangbuilder" instead of the old extension ident "locallangbuilder"
- Replaced all places where "locallangbuilder" appeared (Thanks to @opi99 )

Version 1.0.6
-------------

- Hotfix for invalid flag-paths (en.svg etc.)

Version 1.0.5
-------------

- Switched to the native TYPO3 Logging instead of own implementation
- fixed some documentation-stuff
- locked auto-translate when there is no provider configured. Instead a info will be given.

Version 1.0.4
-------------

- Added clear cache on load-flag to prevent autoloader-bugs
- Fixed some documentation-issues with rst-format
- Removed dummy-Boxes for statistics (not finished yet)
- some misc stuff

Version 1.0.3
-------------

Release of the first stable version.




