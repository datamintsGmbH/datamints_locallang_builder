CREATE TABLE tx_datamintslocallangbuilder_domain_model_extension (

	name varchar(255) DEFAULT '' NOT NULL,
	path varchar(255) DEFAULT '' NOT NULL,
	local smallint(5) unsigned DEFAULT '0' NOT NULL,
	locallangs int(11) unsigned DEFAULT '0' NOT NULL

);

CREATE TABLE tx_datamintslocallangbuilder_domain_model_locallang (

	extension int(11) unsigned DEFAULT '0' NOT NULL,

	filename varchar(255) DEFAULT '' NOT NULL,
	path varchar(255) DEFAULT '' NOT NULL,
	translations int(11) unsigned DEFAULT '0' NOT NULL,
	related_extension int(11) unsigned DEFAULT '0'

);

CREATE TABLE tx_datamintslocallangbuilder_domain_model_translation (

	locallang int(11) unsigned DEFAULT '0' NOT NULL,

	translation_key varchar(255) DEFAULT '' NOT NULL,
	translation_values int(11) unsigned DEFAULT '0' NOT NULL,
	related_locallang int(11) unsigned DEFAULT '0'

);

CREATE TABLE tx_datamintslocallangbuilder_domain_model_translationvalue (

	translation int(11) unsigned DEFAULT '0' NOT NULL,

	ident varchar(255) DEFAULT '' NOT NULL,
	value text,
	resname text,
	xml_space varchar(255) DEFAULT '' NOT NULL,
	approved smallint(5) unsigned DEFAULT '0' NOT NULL,
	comment text

);

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder