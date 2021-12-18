.. include:: ../Includes.txt

.. _configuration:

=============
Configuration
=============

Please include the Static Typoscript Template, either by going to "Template -> Includes" and selecting "datamints Locallang Builder" OR by including them in your site package:

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

.. confval:: azure.url

   :Datatype: string
   :Default: https://api.cognitive.microsofttranslator.com/translate

    There should be no need to modify this value. It's the api-host for azure.

.. confval:: azure.version

   :Datatype: string
   :Default: 3.0

   API-Version number for azure.

.. confval:: azure.key

   :Datatype: string
   :Default: <empty>

   Your API-Key for Azure.

.. confval:: azure.area

   :Datatype: string
   :Default: global

   Your defined area, defined in the azure console.

.. confval:: azure.active

   :Datatype: int
   :Default: 0

   Flag, if this provider is active. Keep in mind to select not more than one provider.

.. confval:: deepl.url

   :Datatype: string
   :Default: https://api-free.deepl.com/v2/translate

   There should be no need to modify this value. It's the api-host for Deepl.

.. confval:: deepl.version

   :Datatype: string

   Not in use by DeepL

.. confval:: deepl.key

   :Datatype: string
   :Default: <empty>

   Your API-Key for DeepL.

.. confval:: deepl.area

   :Datatype: string

   Not in use by DeepL

.. confval:: deepl.active

   :Datatype: int
   :Default: 0

   Flag, if this provider is active. Keep in mind to select not more than one
   provider.

.. confval:: google.url

   :Datatype: string
   :Default: https://www.googleapis.com/language/translate

   There should be no need to modify this value. It's the api-host for Google.

.. confval:: google.version

   :Datatype: string
   :Default: v2

   API-Version number for azure

.. confval:: google.key

   :Datatype: string
   :Default: <empty>

   Your API-Key for Google.

.. confval:: google.area

   :Datatype: string

   Not in use by Google.

.. confval:: google.active

   :Datatype: int
   :Default: 0

   Flag, if this provider is active. Keep in mind to select not more than one provider.

.. confval:: excludedExtensions

   :Datatype: string
   :Default: datamints_locallang_builder

   Comma-separated list of extension keys to be excluded from being displayed.
