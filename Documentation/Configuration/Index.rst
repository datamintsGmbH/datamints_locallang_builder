.. include:: ../Includes.txt

.. _configuration:

=============
Configuration
=============

Please include the Static Typoscript Template, either by going to "Template -> Includes" and selecting "datamints Locallang Builder" OR by including them in the filesystem:


.. code-block:: typoscript
setup:
   <INCLUDE_TYPOSCRIPT: source="FILE:EXT:datamints_locallang_builder/Configuration/TypoScript/setup.typoscript">
constants:
   <INCLUDE_TYPOSCRIPT: source="FILE:EXT:datamints_locallang_builder/Configuration/TypoScript/constants.typoscript">

.. _configuration-typoscript:


Example
===============
The extension is usable without any custom configuration. If you want to use an auto-translation-provider, you have to enter your own API-Key and flag the provider active.

If you want to enable azure as provider, enter this:

.. code-block:: typoscript
module.tx_datamintslocallangbuilder_tools_locallangbuildertranslate {
  settings {
    providers {
      azure {
         active = 1
         key = YOUR_KEY
      }
    }
  }
}


TypoScript Reference
====================

======================================  =============  ======================================================================================  =====================================
Property:                               Data type:     Description:                                                                            Default:
======================================  =============  ======================================================================================  =====================================
azure.url                               string         there should be no need to modify this value. It's the api-host for azure               https://api.cognitive.microsofttranslator.com/translate
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
azure.version                           string         API-Version number for azure                                                            3.0
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
azure.key                               string         Your API-Key for Azure                                                                  <empty>
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
azure.area                              string         Your defined area, defined in the azure console                                         global
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
azure.active                            int            Flag, if this provider is active. Keep in mind to select not more than one provider     0
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
deepl.url                               string         there should be no need to modify this value. It's the api-host for Deepl               https://api-free.deepl.com/v2/translate
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
deepl.version                           string         Not in use by DeepL
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
deepl.key                               string         Your API-Key for DeepL                                                                  <empty>
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
deepl.area                              string         Not in use by DeepL
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
deepl.active                            int            Flag, if this provider is active. Keep in mind to select not more than one provider     0
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.url                               string         there should be no need to modify this value. It's the api-host for Google             https://google.com
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.version                           string         Not in use by google
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.key                               string         Your API-Key for google                                                                  <empty>
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.area                              string         Not in use by google
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.active                            int            Flag, if this provider is active. Keep in mind to select not more than one provider     0
======================================  =============  ======================================================================================  =====================================
