<?php

/* Create the function if the site should contain the functionality for user-based searches.  Note that
 * this code configured to allow keying of the user search (via textbox entry), as well as clicking buttons
 * to return "most recent" badges, and any tags that currently exist within the open badge database.
 *
 * If your site should only have textbox searches avaiable, you can comment out / delete the php code that 
 * corresponds to "most-recent" and "all-tags", as the code associated with these elements needs to be within
 * function 'user_defined_search()', as it is used to build the $search_string variable that the function returns. 
 * 
 * Or, if your site should only output 'most-recent' and / or 'all-tags', the code outside of these if test
 * can be removed.  
 * 
 * Note that you would want to modify the 'index.php' page of this library to restrict the search(es) for your
 * site.  
 */
 
function user_defined_search() {

   /* Create all variables necessary for any search string and set to defaults to blank.  Also, create 
    * and set a variable 'indocator' that is used to show that an upstream search string within the code has been 
    * entered by a user.  Based on 'indicator' (value of either 0 or >= 1), set the $search_string variables for the 
    * upcoming cURL session to use.
    */
   $keyword = "";
   $tags = "";
   $name = "";
   $issuer = "";
   $indicator = 0;
   
   /* Section of the code that corresponds to textbox user entry only.  Can comment out / remove
    * if your site will not have textbox searches available to users.
    */
   if ($_POST["keyword"] != "") {
    
      /* First, replace any spaces with URL encoding for spacebar, as the search will not work with spaces, and need to replace
       * comma delimiter with URL encoding for a comman */ 
      $keyword_string = str_replace(' ', '%20', $_POST["keyword"]);
      $keyword_string = str_replace(',', '%2C', $keyword_string);
      $keyword = "search?q=" . $keyword_string;
      
      $indicator = $indicator + 1;
       
   } 
    
   if ($_POST["tags"] != "") {
    
      /* Follow the previous with URL encoding for spaces and commas */
      $tags_string = str_replace(' ', '%20', $_POST["tags"]);
      $tags_string = str_replace(',', '%2C', $tags_string);
      
      if ($indicator == 0) {
         $tags = "search?tags=" . $tags_string;
      } else {
         $tags = "&tags=" . $tags_string;
      }
      
      $indicator = $indicator + 1;

   }
   
   if ($_POST["name"] != "") {
   
      /* Follow the previous with URL encoding for spaces and commas */
      $name_string = str_replace(' ', '%20', $_POST["name"]);
      $name_string = str_replace(',', '%2C', $name_string);
      
      if ($indicator == 0) {
         $name = "search?name=" . $name_string;
      } else {
         $name = "&name=" . $name_string;
      }
      
      $indicator = $indicator + 1;
    
   }
   
   if ($_POST["issuer"] != "") {
   
      /* Follow the previous with URL encoding for spaces and commas */
      $issuer_string = str_replace(' ', '%20', $_POST["issuer"]);
      $issuer_string = str_replace(',', '%2C', $issuer_string);
      
      if ($indicator == 0) {
         $issuer = "search?issuer=" . $issuer_string;
      } else {
         $issuer = "&issuer=" . $issuer_string;
      }
      
      $indicator = $indicator + 1;
       
   }
   
   /* Section of the code that corresponds to 'most-recent' button click only.  Can comment out / remove
    * if your site will not 'most-recent' button searches available to users.
    * 
    * Check to see if the user clicked the "Most Recent" button.  Per the API this will return the 
    * most recent badges */
   if ($_POST["most-recent"] == "recent") {
   
      /* user clicked 'most-recent' button.  Use this as the keyword in the search, and set 
       * all other variables equal to blank, as the API does not support the recent search with 
       * additional search fields.
       */
      $keyword = "recent";
      $tags = "";
      $name = "";
      $issuer = "";
      
   }
   
   /* Check to see if the user clicked the "tags" button.  Per the API this returns only tags information */
   if ($_POST["all-tags"] == "tags") {
   
      /* user clicked 'most-recent' button.  Use this as the keyword in the search, and set
       * all other variables equal to blank, as the API does not support the recent search with 
       * additional search fields.
       */
      $keyword = "tags";
      $tags = "";
      $name = "";
      $issuer = "";
      
   }
   
   /* Per the API, the default for the number of records returned is 10.  Note that if you do not append
    * the "&limit=" to the end of the cURL search string, the cURL call will by default return a max of 10 badges.
    * Because we want the limit value to always appear in our 'search_string' variable so that cURL does not fail, 
    * the default limit of 10 is set in the 'count' text box on index.php and is passed into the 'limit' variable below.  
    * You can therefore set the default limit to whatever you want by placing a default value into the 'count' text box.
    * Note that the API uses the "limit" value differently if using "most-recent", so set this test to deliver the 
    * correct syntax for the search
    */
   if ($_POST["most-recent"] == "recent" OR $_POST["all-tags"] == "tags") {
   
      /* Using "most-recent" button for the search */
      $limit = '?limit=' . $_POST["count"];
   } else {
      /* Using keyword search */
      $limit = "&limit=" . $_POST["count"];
   }
   
   /* Currently the badge JSON data is only available at directory.openbadges.org.  If you want to
    * use data from an alternate JSON feed, just go ahead and update the URL for this alternate feed.
    * In this section of the code, set up the search string, the options for the cURL call, and the cURL
    * call itself. 
    */
   //$search_string = "http://test-openbadges-directory.herokuapp.com:80/" . $keyword; /*- This link is from the API*/
   $search_string = "http://directory.openbadges.org:80/" . $keyword . $tags . $name . $issuer . $limit;
   
   /* Return the variable to be used in the cURL call */
   return $search_string;

}


?>