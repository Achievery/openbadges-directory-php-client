<?php 

/* Build function that is used to return JSON ouput from the directory.openbadges.org site.
 * This function can be modified for specific needs, but note that the dependent code is expecting
 * JSON output for parsing
 */
function getData() {

   /* Call necessary .php code containing all required functions to execute the cURL call. 
    * Note that the file controlling the data passed into the cURL call via the user
    * has the same surname as the function - 'user_defined_search'.  This can be renamed as 
    * necessary after downloading to your site.  Also, the variable 'search_variable' can be updated
    * within this code to be more descriptive and as necessary.  This variable is only used within this
    * file.
    */
   require "./functions/user_defined_search.php";
   $search_variable = user_defined_search();
   
   
   /* Output cURL.  
    * This is the section of the code where the URL + search parameters for retrieving 
    * badge information is controlled.  cURL options are set post initilization and used for the cURL 
    * session (curl_exec()).  The result is then parsed into a simple array and returned and made 
    * available for downstream processing in variable 'data'
    */
    
   /* Initialize the cURL session */
   $ch = curl_init();
   
   /* Update the options for the cURL settings as necessary.  Note that the variable 'search_string' 
    * is an option for the cURL CURLOPT_URL setting (below).
    */
   curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
   curl_setopt($ch, CURLOPT_HEADER, false);
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
   curl_setopt($ch, CURLOPT_URL, $search_variable);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   
   /* Set variables for the cURL result / error, and close the cURL session */
   $result = curl_exec($ch);
   $error = curl_error($ch);
   curl_close($ch);
   
   /* Run simple test for errors.  Any error string will be a numeric value of 1 or greater, so anything that has a value of zero  
    * (or more specifically for this test, less than 1) indicates that no error has occurred. 
    */
   $errorlen = strlen($error);
   if ($errorlen < 1) {
   
         /* No error has occurred - Continue 
          * Parse json string into simple array via json_decode(), and return $data for downstream processing.  Leave print_r 
          * for $data and the echo of $search_variable for debugging within your site. 
          */
         $data = json_decode($result, TRUE);
         //print_r($data);
         //echo $search_variable;
   
         return($data);
      
      } else {
      
         /* cURL error has occurred - Display error message upon function call by downstream code, and output the search string
          * corresponding with the error.
          */
         echo "cURL ERROR = " . $error . " for search string = " . $search_variable;
         
      }

   }  

?>
