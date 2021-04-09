CONTENTS OF THIS FILE
---------------------
 * Introduction
 * Resources Used 
 * Requirements
 * Installation
 * Configuration

INTRODUCTION
------------
Following requirements is done in this module.
* A new form text field named "Site API Key" needs to be added to the "Site Information" form with the default value of “No API Key yet”.
* When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".
* A Drupal message should inform the user that the Site API Key has been saved with that value.
* When this form is visited after the "Site API Key" is saved, the field should be populated with the correct value.
* The text of the "Save configuration" button should change to "Update Configuration".
* This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".

# Example URL:

http://localhost/page_json/FOOBAR12345/17


Resources Used
------------
 * https://www.drupal.org/docs/8/api/routing-system/access-checking-on-routes/custom-route-access-checking.
 * For some syntax I refered internet like (sending json response, access check on route)
 * Logic was built by myself.
 * Time take was approximately 2.5 hrs.


REQUIREMENTS
------------
No requirements!


INSTALLATION
------------
 * Install as you would normally install a contributed drupal module.
   See: https://drupal.org/documentation/install/modules-themes/modules-8
   for further information.


CONFIGURATION
-------------
 * Install the module
 * After module install you will get configure link and if the link is visited, a form will be shown to add site api key.

