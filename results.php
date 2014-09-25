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

   <!-- Default page description.  Modify as necessary -->
   PHP + API!  You are now successfully viewing open badge details!<p>
   
   <p>Return to perform a new search: <a href="./index.php">Search</a></p>

   <p>Keyword for this search = <?php echo $_POST["keyword"]; ?> </p>
   <p>Tags for this search = <?php echo $_POST["tags"]; ?> </p>
   <p>Badge name for this search = <?php echo $_POST["name"]; ?> </p>
   <p>Issuer for this search = <?php echo $_POST["issuer"]; ?> </p>
   <!-- <p>Select List selection for this search = <?php echo $_POST["search_type"]; ?> </p> -->
   <p>Row Count Value = <?php echo $_POST["count"]; ?> </p>
   
   <p>
   <p>
   <p>
   
   <!-- Add PHP for function that cURLs the array -->
   <?php 
      
      /* Pull in required functions for rendering badge information */
      //require "./functions/cURL.php";
      require "./functions/get_data.php";
   
      /* Set up i value for main looping.  This looping will run on all items in the search array (but not sub-array 
       * items such as 'tags'.  Sub-array will be in it's own sub-loop. 
       * to build the variable "$array", call the getData function, from the ".functions/cURL.php" file. 
       */
      $array = getData();
      //print_r($array);
      $length = count($array[data]);
      
      /* Set up test to see if this is the tags cURL.  Handle this differently, as the array that is produced
       * has a different results count per the API
       */   
      if ($_POST["all-tags"] == "tags") {
         
         /* Run the loop to return all tags information in the overall search array */
         for ($i = 0; $i < $length; $i++) {
            $array0 = $array[data][$i][tag]; 
            $array1 = $array[data][$i][count];
            
            /* Turn off PHP temporarily so that HTML data can be rendered */
            ?>
            
            <br>
            ----------------------------------------------------------------
            <br>
            <br>
            <!--  Output HTML for testing, and can theme as necessary / per site specifications. 
                  Place leading numeral in front of badge name via php -->
            <?php echo $i+1 . '.' . '  '; ?><p>
            Tag Name =  <?php echo $array0; ?> <p> 
            Usage Count =  <?php echo $array1; ?> <p>
            <br>
         
            <?php
        
         }
         
      } else {
    
         /* Run the loop to return all badge information in the overall search array */
         for ($i = 0; $i < $length; $i++) {

            $array0 = $array[data][$i][name];
            $array1 = $array[data][$i][description]; 
            $array2 = $array[data][$i][image]; 
            //$array3 = $array[data][$i][tags];
            $array4 = $array[data][$i][issuerResolved][name];
            $array5 = $array[data][$i][issuer];
            $array6 = $array[data][$i][criteria];
         
            /* Run a sub-loop to render all tags associated with a badge */
            $length2 = count($array[data][$i][tags]);
            for ($i2 = 0; $i2 < $length2; $i2++) {
         
               /* Set 'if' to place comma in proper location for tags display */
               if ($i2 == 0) {
               
                  /* This is the first iteration of arrayTags.  No leading comma */
                  $arrayTags = $array[data][$i][tags][$i2];
               
               } else {
               
                  /* Assemble list separated by comma */
                  $arrayTags = $arrayTags . ', ' . $array[data][$i][tags][$i2];
               }
            }
         
            /* Turn off PHP temporarily so that HTML data can be rendered */
            ?>
         
            <br>
            ----------------------------------------------------------------
            <br>
            <br>
            <!--  Output HTML for testing, and can theme as necessary / per site specifications. 
                  Place leading numeral in front of badge name via php -->
            <?php echo $i+1 . '.' . '  '; ?><p>
            Badge Name =  <?php echo $array0; ?> <p> 
            Badge Description =  <?php echo $array1; ?> <p>
            Image = <img src="<?php echo $array2; ?>" width="200" height="200"> <p> 
            Tags =  <?php /*echo $array3;*/ echo $arrayTags; ?> <p>
            Badge Issuer =  <?php echo $array4; ?> <p>
            Badge Issuer URL =  <?php echo $array5; ?> <!--*** NOTE: Do we need this, and if so, do we need to cURL this separately?--> <p>
            Badge Criteria =  <a href="<?php echo $array6; ?>" target="_blank"><?php echo $array6; ?></a> <p>
            <br>
         
            <?php
        
         }
         
      }
   
   ?>
   
</body>
</html> 