# CYZER - MVC Driven PHP Framework.


## Preamble

## Directory Structure

Cyzer has following directory structure. Read documentation for more insight.

- cyz-app - Application Directory
- cyz-gen - Auto Generated Directory
- cyz-inc - Cyzer Core Files
  - admin - Cyzer Super User / Adminstration Files
  - comp  - Cyzer Core Components
  - lib   - Cyzer Core Controllers Library
  - cyz-start.php
  - cyz-init.php
  - cyz-version.php
- index.php

## Naming Convention

Typical, but worth mentioning


|     Type                      |              Naming Convention                                                                                       |
|-------------------------------|----------------------------------------------------------------------------------------------------------------------|
|File Names                     |Lower cased separated with dash (**cyzer-start.php**)                                                                 |
|Variables                      |Lower cased separated with underscored (**$file_system**)                                                             |
|Global variables               |All upper case and underscored (**$GLOBAL_VARIABLE**)                                                                 |
|Instances variables / Objects  |Suffix **_obj** (**$file_operator_obj**)                                                                              |
|Reserved variables             |Prefix **cyz_** (**$cyz_file_operator_obj**)                                                                          |
|Array                          |Lower cased separated with underscored (**array('the_key'=>'the_value')**)                                            |
|Constants                      |All upper case and underscored (**THE_CONSTANT_VAR**)                                                                 |
|Classes                        |Camel case / Pascal case (Note that, when using camel case, the initial character is upper case) (**FileOperator**)   |
|Methods                        |Lower cased separated with underscored (**the_function()**)                                                           |
