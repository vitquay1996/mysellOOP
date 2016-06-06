<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>PHP DAO Generator/Scaffolder</title>
    <link type="text/css" rel="stylesheet" href="index.css">
  </head>
  <body>

	<h1>PHP DAO</h1>

  <h2><a href="https://github.com/sbrbot/phpdao">Data Access Objects - Generator/Scaffolder on GitHub</a></h2>

  <p>This is simple web tool for automatic creation of DAO classes from existing MySQL database schema.</p>

  <ul>
    <li>lowest level of DAO class hierarchy is MySQLi databse singleton class <b>DataBase</b> (for DB connection) (username/password are stored in models/DAO/DA.php),</li>
    <li>above it is generic <b>EntityBase</b> class with generic CRUD(S) methods (models/DAO/DAO.php),</li>
    <li>for each database table one DAO core class is created extending EntityBase (models/DAO/*.dao.php)</li>
    <li>finally for each database table one empty business logic class is created (models/*.php)</li>
  </ul>

  <hr>

  <h3>Files organization</h3>

  <table cellspacing="20">
    <tr>
      <th>Initial PHP DAO file structure inside your project</th>
      <th>File tree after PHP DAO build for some tables</th>
    </tr>
    <tr>
      <td valign="top">
        <img src="phpdao-0a.png" alt="File tree before PHP DAO">
      </td>
      <td valign="top">
        <img src="phpdao-0b.png" alt="File tree after PHP DAO">
      </td>
    </tr>
  </table>

  <hr>

  <h3>Database connection</h3>
  <p>Put PHP DAO app folder inside web root folder of your web app on local server (make 'models' folder writable for PHPDAO) and start PHPDAO:</p>
  <p><a href="http://localhost/yourwebapp/PHPDAO/index.php">http://localhost/yourwebapp/PHPDAO/index.php</a></p>
  <p><img src="phpdao-1.png" alt="PHPDAO - database connection"></p>

  <hr>

  <h3>Database tables</h3>
  <p>The list of all tables from previously given db schema will be shown</p>
  <p><img src="phpdao-2.png" alt="PHPDAO - database tables"></p>
  <p>Select all tables you want to build DAO classes for. DAO PHP will try to guess name (singular and plural words) for each table/DAO class
     but don't rely on its english grammar capabilities :-). Put your own correct or other wanted names if necessary.
     For example, if you inside database have one-to-many relation between 'employees' and 'projects' tables,
     and for 'employees' table define 'Employee' (singular) and 'Employees' (plural) names
     and for 'projects' table define 'Project' (singular) and 'Projects' (plural) names, then PHP DAO will generate
     <b>Employee</b> class for 'employees' table and <b>getProjects()</b> function in it for retrieving related (many) objects from related table 'projects'
     and vice versa <b>getEmployee()</b> function for retrieving related (one) object inside <b>Project</b> class.</p>
  <p><u>NOTE</u>: Table comment (comment from database) will be used as initial description of class inside DAO code.
     PHP DAO uses CamelCase naming for classes (underscores are onitted), so if table name inside database is 'employees_projects',
     PHP DAO will guess that class name should be <b>EmployeeProject</b> (singular) and <b>EmployeeProjects</b> (plural)</p></p>

  <hr>

  <h3>Database columns</h3>
  <p>Previously selected tables are shown (as web accordion) with their columns and column attributes and relations to other tables.
     One can select here what columns should be included in DAO class build process. By default all columns are selected
     but you can exclude some of them if you want. (Primary key column(s) are selected and mandatory.)
     For example if column 'name' is selected, then class <b>Employee</b> will have public property <b>name</b> ($Employee->name).
     The similar thing is with finder functions, if you want particular finder functions for some columns, select them in finder column
     (columns that are indexed inside database are selected by default because PHP DAO assumes you want finder functions for them).
     So if finder is selected for column <b>name</b>, PHP DAO will create <b>findByName($name)</b> function (always prefixed with findBy).
     Here you defined creation of particular finder functions but, ff course, each DAO class will have generic 'find()' function
     you can use for searching/finding records by any column (columns given as associative array).</p>
  <p><u>NOTE</u>: Column comment (comment from database) will be used as initial description of property inside DAO code.
     PHP DAO uses CamelCase naming for properties (underscores are onitted), so if column name inside database is 'first_name',
     PHP will create finder function with name <b>findByFirstName($firstname)</b></p>
  <p><img src="phpdao-3.png" alt="PHPDAO - table columns"></p>

  <hr>

  <h3>Database build</h3>
  <p>PHP DAO generator starts and finally shows what classes have been created. (One DAO class for each selected table, plus DA.php and DAO.php core classes
    inside models/DAO/ subfolder and one table class inside models for customization).
    PHPDAO folder can be deleted if you do not intend to rebuild DAO layer for tables in database. But after every database model change one should rebuild
    DAO layer to reflect changes made in tables/columns. Only models/DAO/*.dao.php classes of DAO layer are overwritten (but backuped before).</p>
  <p><img src="phpdao-4.png" alt="PHPDAO - builder"></p>

  <hr>

  <h2>Functions</h2>

  <p>PHP DAO can build DAO classes for both; single and composite primary key tables.
    (Single primary key (PK) table has only one column as primary key and it can be auto-incremented (AI).
    Composite primary key table has primary key which is combination of more columns and in this case auto-increment is not possible - primary keys should be defined explicitelly.)</p>
    So CRUD(S) ('Create', 'Read', 'Update', 'Delete', and 'Save') functions accept as parameter single primary key value or associative array of primary key names => values:


  <h3>Create</h3>

    Example #1: (Single PK)

  <pre>

    try
    {
      $Employee=new Employee();
      $Employee->name='John';
      $Employee->create(); //PK empid is auto-incremented
    }
    catch(CreateException $e)
    {
      //handle exception
    }
  </pre>

    Example #2: (Composite PK - primary keys set explicitelly as properties):

  <pre>

    try
    {
      $Price=new Price();
      $Price->pr_season_id=1; // Primary key column #1
      $Price->pr_room_id=20; // Primary key column #2
      $Price->price=100;
      $Price->create();
    }
    catch(CreateException $e)
    {
      //handle exception
    }
  </pre>

    Example #3: (Composite PK - set inside associative array):

  <pre>

    try
    {
      $Price=new Price();
      $Price->price=100;
      $Price->create(array('pr_season_id'=>1,'pr_room_id'=>20);
    }
    catch(CreateException $e)
    {
      //handle exception
    }
  </pre>

  <h3>Read</h3>

    Example #1: (id given in read() function)

    <pre>

    try
    {
      $Project=new Project();
      $Project->read(1);
    }
    catch(ReadException $e)
    {
      //handle exception
    }
    </pre>

    Example #2: (id given in constructor)

    <pre>

    try
    {
      $Project=new Project(1);
    }
    catch(ReadException $e)
    {
      //handle exception
    }
    </pre>

    Example #3: (id given explicitelly as property)

    <pre>
    try
    {
      $Project=new Project();
      $Project->prid=1;
      $Project->read();
    }
    catch(ReadException $e)
    {
      //handle exception
    }
    </pre>

  <h3>Update</h3>

    Example #1:

    <pre>
    try
    {
      $Customer=new Customer(1); //create object and read customer
      $Customer->name='Johnny'; //change name of existing customer
      $Customer->update(); //update new data
    }
    catch(UpdateException $e)
    {
      //handle exception
    }
    </pre>

  <h3>Delete</h3>

  Example #1:

    <pre>

    try
    {
      $Room=new $Room();
      $Room->delete(1);
    }
    catch(DeleteException $e)
    {
      //handle exception
    }
    </pre>

  Example #2:

  <pre>
    try
    {
      $Room=new $Room(1);
      $Room->delete();
    }
    catch(DeleteException $e)
    {
      //handle exception
    }
    </pre>

  <h3>Save</h3>

  <p>Save function is specific for MySQL databases and it is based on specific SQL capability
    where MySQL can try to insert database record but if record already exist or any
    of referential constraints on this table is violated (unique key or referential constraint is violated)
    then new record is updated.
    (<a href="https://dev.mysql.com/doc/refman/5.5/en/insert-on-duplicate.html">See INSERT ... ON DUPLICATE KEY UPDATE ... in MySQL manual.</a>)</p>

  Example #1: (new record will be created, but if 'username' column is PK or column with unique key constraint
  and there's already record with username='jdepp', so PK or UQ constraint violated, then existing record will be updated!)

  <pre>
    try
    {
      $User=new Customer();
      $User->username='jdepp';
      $User->name='John';
      $User->save();
    }
    catch(DeleteException $e)
    {
      //handle exception
    }
  </pre>

  <h3>Specific finders</h3>

  Example #1: (specific findByName() finder created by PHP DAO)

  <pre>
    $Customer=new Customer();
    $Customers=$Customer->findByName('John');
    foreach($Customer as $Customer)
    {
      echo $Customer->surname.', '.$Customer->name;
    }
  </pre>

  <h3>Generic finder</h3>

  Example #1: (argument is associative array where keys are table column names)

  <pre>
    $Customer=new Customer();
    $Customers=$Customer->find(array('name'=>'Johnny','surname'=>'Depp'));
    foreach($Customer as $Customer)
    {
      echo $Customer->surname.', '.$Customer->name;
    }
  </pre>

  <h3>Mapping array elements to object properties</h3>

  Example #1: (imput array is $_POST mapped to object properties)

  <pre>
    try
    {
      $Customer=new Customer();
      $Customer->sanitize($_POST);
      $Customer->save();
    }
    catch(SaveException $e)
    {
      //handle exception
    }
  </pre>

  </body>
</html>

