.. include:: ../Includes.txt

.. _configuration:

=============
Configuration
=============

Please include the Static Typoscript Template, either by going to "Template -> Includes" and selecting "datamints Locallang Builder" OR by including them in the filesystem:

setup

.. code-block:: typoscript

   <INCLUDE_TYPOSCRIPT: source="FILE:EXT:datamints_locallang_builder/Configuration/TypoScript/setup.typoscript">

constants

.. code-block:: typoscript

   <INCLUDE_TYPOSCRIPT: source="FILE:EXT:datamints_locallang_builder/Configuration/TypoScript/constants.typoscript">


.. _configuration-typoscript:

The extension is usable without any custom configuration. If you want to use an auto-translation-provider, you have to enter your own API-Key and flag the provider active.

Example Azure Cloud
===================
To use azure as translation-provider, enter this:

.. code-block:: typoscript

   module.tx_datamintslocallangbuilder_tools_datamintslocallangbuildertranslate {
     settings {
       providers {
         azure {
            active = 1
            key = YOUR_KEY
         }
       }
     }
   }

.. note::
 To get your API-Key follow this Link: https://docs.microsoft.com/en-us/azure/cognitive-services/Translator/translator-how-to-signup . It's a bit complicated at first, but it's worth it. Insert this API-Key in the "YOUR_KEY" Field in the typoscript configuration example above.


Example DeepL
===============
To use DeepL as translation-provider, enter this:

.. code-block:: typoscript

   module.tx_datamintslocallangbuilder_tools_datamintslocallangbuildertranslate {
     settings {
       providers {
         deepl {
            active = 1
            key = YOUR_KEY
         }
       }
     }
   }

.. note::
 DeepL is probably the easiest provider to set up. Simply register and call https://www.deepl.com/pro-account/plan . You need the "Authentificationkey". Insert this API-Key in the "YOUR_KEY" Field in the typoscript configuration example above.


Example Google
===============
To use Google as translation-provider, enter this:

.. code-block:: typoscript

   module.tx_datamintslocallangbuilder_tools_datamintslocallangbuildertranslate {
     settings {
       providers {
         google {
            active = 1
            key = YOUR_KEY
         }
       }
     }
   }

.. note::
 Get your API by calling: https://console.cloud.google.com/apis/api/translate.googleapis.com/credentials . Login to the Google Console and add a API-Key. Insert this API-Key in the "YOUR_KEY" Field in the typoscript configuration example above.


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
google.url                               string         there should be no need to modify this value. It's the api-host for Google             https://www.googleapis.com/language/translate
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.version                           string         API-Version number for azure                                                           v2
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.key                               string         Your API-Key for google                                                                  <empty>
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.area                              string         Not in use by google
--------------------------------------  -------------  --------------------------------------------------------------------------------------  -------------------------------------
google.active                            int            Flag, if this provider is active. Keep in mind to select not more than one provider     0
======================================  =============  ======================================================================================  =====================================
