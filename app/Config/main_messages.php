<?php
//Search
define("MSG_NO_SEARCH_RECORDS","Sorry, there are no records that match your search criteria.  Please enter a different keyword and try again.");
define("MSG_NO_PRODUCTS", "Currently there is no product available.");
define("MSG_NO_MYPRODUCTS", "You have not uploaded any product yet.");

/*Registration Form*/
define("ERR_NICKNAME_EMPTY","Please enter your nick name.");
define('ERR_NICKNAME_EXISTS','This nick name already exists in our database. Please select a different nick name and try again.');
define("ERR_FIRSTNAME_EMPTY","Please enter your first name.");
define("ERR_PASSWORD_EMPTY","Please enter your password.");
define("ERR_EMAIL_EMPTY","Please enter your email address.");
define("ERR_CONFIRMPASSWORD_EMPTY","Please confirm the password.");
define("ERR_PASSNOTMATCH_EMPTY","Password and confirm password values do not match. Please try again.");
define('ERR_EMAIL_INVALID','Please enter a valid email address.');
define('ERR_USERNAME_EXISTS','This username already exists in our database. Please select a different username and try again.');
define('ERR_EMAIL_EXISTS','This e-mail address already exists in our database. Please select a different e-mail address and try again.');
//define('ERR_USERNAME_INVALID','Please use alphabets and numbers only for first name.');
define('ERR_NICKNAME_INVALID','Please use alphabets and numbers only for nick name.');
define("MSG_SUCCESS_LOGGEDOUT","You have been successfully logged out.");

define("ERR_OLDPASSWORD_EMPTY","Please enter your old password.");
define("ERR_OLDPASSWORD_INVALID","Incorrect old password. Please try again.");
define("MSG_OLDPASS_REQUIRED","Please enter your old password.");
define("MSG_CHANGE_PASSWORD","Password has been changed successfully.");

define("ERR_GENDER_EMPTY", "Please select the gender.");
define("ERR_ADDRESS1_EMPTY", "Please enter the address.");
define("ERR_STREET_EMPTY", "Please enter the street.");
define("ERR_STATE_EMPTY", "Please enter the state.");
define("ERR_ZIP_EMPTY", "Please enter the postal code.");
define("ERR_PHONE_EMPTY", "Please enter the telephone number.");
define("ERR_COUNTRY_EMPTY", "Please select the country.");
define("ERR_IAGREE_EMPTY", "Please confirm that you have read and agree to our terms and conditions mentioned above.");

define("MSG_NEW_REGISTERED","Registration confirmation from ".SITE_NAME);
define("ERR_MSG_SESSION", "Your session has expired. Please login again.");
define("ERR_EMAIL_NOTAVAILABLE", "This email address does not exists in our database.");
define("MSG_EMAIL_NOTAVAILABLE", "Your login details have been emailed to: ");

define("ERR_NO_RECORD", "Sorry, there is no record available at the moment.");
define("MSG_NO_PROVIDER_DETAILS", "Sorry, currently there are no details available.");

define("SUBMIT_REVIEW", "Your review has been submitted.");
define("MSG_REVIEW_LINK", "Your friend has recommended this link");
define("MSG_REVIEW_REPLY", "Website user wishes to contact you");
define("MSG_REVIEW_FLAGGED", "Review has been flagged");
/*End*/

define("ERR_FORMAT_INVALID","Please enter valid format name.");
define("ERR_NAME_EMPTY","Please enter name.");
define("MSG_EMAIL_CONTACT","Contact information");
define("MSG_EMAIL_SEND_CONTACT","Thank you for contacting us. We will contact you shortly.");
define("MSG_NO_HELPCATEGORY","Sorry, currently there is no help category available.");
define("MSG_NO_HELPQUESTION","Sorry, currently there is no question available.");
define("MSG_FIELD_REQUIRED","All fields marked with (*) are required.");

/*Forums*/
define("FORUM_MESSAGE_LENGTH","10");
define("MSG_NO_THREADS","Sorry, currently there is no thread available.");
define("MSG_NO_TOPIC","Sorry, currently there is no topic available.");
define("ERR_TITLE_EMPTY","Please enter the title.");
define("ERR_MESSAGE_EMPTY","Please enter the message.");
define("ERR_MESSAGE_LENGTH","Message is too short. Please enter at least ".FORUM_MESSAGE_LENGTH." characters");
define("MSG_POST_INSERTED","Reply has been posted.");
define("MSG_POST_UPDATED","Reply has been updated.");
define("MSG_POST_INSERTED_NEED_APPROVAL","Reply has been posted. It will appear on the forum after approval.");
define("MSG_POST_UPDATED_NEED_APPROVAL","Reply has been updated. It will appear on the forum after approval.");
define("MSG_NO_FAQCATEGORY","Sorry, currently there is no help category available.");
define("MSG_NO_FAQQUESTION","Sorry, currently there is no question available.");
define("MSG_THREAD_INSERTED_NEED_APPROVAL","Thread has been posted. It will appear on the forum after approval.");
define("MSG_THREAD_INSERTED","Thread has been posted.");
define("MSG_THREAD_UPDATED_NEED_APPROVAL","Thread has been updated. It will appear on the forum after approval.");
define("MSG_THREAD_UPDATED","Thread has been updated.");
define("MSG_NO_BLOGS","Sorry, there is no blog entry available.");
define("ERR_RATE_FIRST","Please also submit your rating along with the review.");
define("MSG_PASSWORD_CHANGED","Password changed successfully.");


define("ERR_USERNAME_EMPTY","Please enter your username.");
define('ERR_USERNAME_INVALID','Please use alphabets and numbers only for username.');
define("MSG_PASSWORD_BLANK","Please leave the password field blank if it is not to be changed.");
define("ERR_INVALID_LOGIN","Either the username/ password entered is incorrect.");
define("ERR_INVALID_FORGOT","Either the username/ email entered is incorrect.");
define("ERR_NOT_AUTHORIZED","Invalid login details or You are not authorized to perform this task.");
define("MSG_RECORD_INSERTED","Record has been inserted.");
define("MSG_RECORD_UPDATED","Record(s) updated sucessfully.");
define("MSG_EXCEPTION","Exceptional error occured.");
define("MSG_RECORD_DELETED","Record(s) deleted successfully.");
define("MSG_CONFIRM_ADMINDELETE","Are you sure you wish to delete the record(s)?");
define("MSG_CONFIRM_ADMINDELETE_ALL","Are you sure you wish to delete all the record(s)?");
define("MSG_CONFIRM_ADMINDELETE_CAT","Deleting the category will delete all the sub-categories associated with it. Are you sure you wish to delete the record(s)?");
define("MSG_CHANGE_PASS","The password has been updated.");

/* ERROR MESSAGES FOR THE REGISTERATION PAGE */  
define("EMPTY_USERNAME","Please enter Username.");
define("EMPTY_PASSWORD","Please enter Password.");
define("EMPTY_BIRTHDAY","Please enter your Birthday.");
define("EMPTY_GENDER","Please select Gender.");
define("EMPTY_EMAIL_ADDRESS","Please enter Email Address.");
define("EMPTY_TELEPHONE_NUMBER","Please enter Telephone Number.");
define("ERR_REG_EMAIL","Please enter valid email address.");

/* ERROR MESSAGES FOR THE CONTACT PAGE */  
define("EMPTY_TOPIC","Please select a topic.");
define("EMPTY_CONTACT_EMAIL","Please enter Email Address.");
define("EMPTY_COMMENT","Please enter Comment.");
define("EMPTY_CATEGORY","Please select category.");
define("EMPTY_PROD_CODE","Please enter product code.");
define("MULTIPLE_SELECT","Press CLTR for multiple select.");
define("EMPTY_IMAGE","Please select image.");



?>