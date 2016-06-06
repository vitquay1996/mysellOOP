PHP DAO generator (scaffolder)
==============================

This is web application for creating Data Access Objects from your DB (MySQL) using MySQLi interface.
There's NO NEED for manual configuration, no need for manual definition of tables, columns, relations, etc.
This app will read your MySQL database structure; tables, columns, references, indexes, etc.
and generate DAO classes with CRUD(S) and finder methods automatically.

Installation and run
====================

1) save PHPDAO app inside yourwebapp on local web server and make 'models' subfolder writable
   (PHP DAO will generate and write files here)

2) start DAOPHP app on local server: 'http://localhost/yourwebapp/PHPDAO/index.php';
   in web form give credentials and access your existing database (schema), credentials
   data (host, schema, username, password) will be stored inside 'models/DAO/DA.php' for later use by DAO classes

3) then PHP DAO will read all tables from given schema an ask you to select what
   tables should be included in build (creating DAO classes) and what are object
   names: singular is used for this object, plural for reference by other objects

4) then PHP DAO will read all columns for selected tables, show their attributes
   and you have to select what columns should be included in build and for which
   columns finders should be generated (indexed columns are selected by default)

5) core dao classes will be created inside 'modules/DAO' subfolder, and classes
   that extend them will be created inside 'modules' folder. Every time you run
   PHP DAO generator it will overwrite core classes inside 'modules/DAO/' folder
   and make backup of existing ones. Module classes inside modules folder (they
   should contain your own business logic) will not be overwritten. This way you
   can regenerate your DAO core classes upon every DB model change.

For more info, look at: http://phpdao.ir.com.hr


