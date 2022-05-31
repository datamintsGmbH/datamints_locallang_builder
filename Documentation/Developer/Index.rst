.. include:: ../Includes.txt

.. _developer:

================
Developer Corner
================

-  If you need to modify the templates or other stuff, you can initialize the git submodule in /Resources/Public/VueSources.

   -  The Submodule is fetched from https://github.com/datamintsGmbH/datamints_locallang_builder_vue

-  Then you have to run "npm install" to load all dependencies.
-  To build the "VueGenerated" files you have to run a Node-Script, see /Resources/Public/VueSources/package.json for possible script-names, e.g. "npm run watchProd"

Please be aware: See "datamints_locallang_builder/LICENSE.txt" before copying or using the 3rd party libraries included in this submodule. Some of them are licenced only for this purpose.

Hooks
===============
Currently I don't see a requirement to add hooks, so please tell me if you need a possibility to use a hook somewhere.

Vue-Frontend
===============
All source-files can be found in /Resources/Public/VueSources

The project was created with vue-cli, so you'll need to run a node script to compile the source-files and styles, which are dumped in /Resources/Public/VueGenerated
