<?php

/***************************************************************************************************
 * 2014-09-06 - Achievery API Library Build
 * This index.php file is is the main document that will render a form that will allow a user to browse badges (specify basepath in a variable?).
 * All functions and API detail will be kept in the "functions" directory, and will be called by this file.
 ***************************************************************************************************/
 
 ?>
 
<html>

<head>
   <LINK href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<!-- Set up the main form that allows user to key in badge search criteria.  See the 
     following for the Open Badges API explorer - http://test-openbadges-directory.herokuapp.com/developers/api-explorer#!/search/search
     -->

<div class = "search-heading">
Open Badge User Search - Find Some Badges!<br>
<p>
Note that search terms can be combined to reduce the number of results that are returned (i.e.  Multiple fields can be used in a 
single search).
</div>

<div class="main-search">
<form action="results.php" method="post">
Choose Search By Entering Detail Below.<p>  
Search terms must be separated with a comma:
<!--<select name="search_type" id="search_type">
  <option value="fulltext">Full Text Search</option>
  <option value="tags">Search Badge Tags</option>
  <option value="name">Search Badge Name</option>
  <option value="issuer">Search Badge Issuer</option>
</select> -->
<p>
<p>
Keyword(s): <input type="text" name="keyword"><br>
<p>
Tags: <input type="text" name="tags"><br>
<p>
Name: <input type="text" name="name"><br>
<p>
Issuer: <input type="text" name="issuer"><br>
<p>
<p>
Limit on Badges Returned: <input type="text" name="count" value=10>
<p>
<p>
<input type="submit">
</div>

<div class = "alt-search">
Alternate Badge Search Methods<br>
<p>
<p>
<p>
Most Recent:  <button name="most-recent" type="submit" value="recent">Most Recent</button><p>
Export Tags:  <button name="all-tags" type="submit" value="tags">Export All Tags</button><p>
</div>

</form>

<br>
<br>

<!--
Alternate Badge Search Methods<br>
<p>
<p>
<form action="results.php" method="post">
Most Recent:  <button name="submit-recent" type="submit" value="recent">Most Recent</button>
</form>

<form action="results.php" method="post">
Export Tags:  <button name="all-tags" type="submit" value="tags">Export All Tags</button>
</form>
-->

<p>
<p>

</body>
</html> 
