<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


//ION_AUTH not Access Rights
defined('NO_ACCESS_SECTION') OR define('NO_ACCESS_SECTION', 'You do not have enough privileges to view this section.');

//set the SMTP port for the GMAIL server
defined('EMAIL_HOST') OR define('EMAIL_HOST', 'smtp.gmail.com');
defined('EMAIL_PORT') OR define('EMAIL_PORT', '465');
defined('EMAIL_SMTP_SECURE') OR define('EMAIL_SMTP_SECURE', 'ssl');

defined('FROM_EMAIL') OR define('FROM_EMAIL', 'digitattva.bcs@gmail.com');

defined('FROM_NAME') OR define('FROM_NAME', 'naitik');

defined('EMAIL_USERNAME') OR define('EMAIL_USERNAME', 'digitattva.tre@gmail.com');
defined('EMAIL_PASSWORD') OR define('EMAIL_PASSWORD', 'digitre@123');

//SITESETTING CONSTANTS
defined('PHP_DATE_FORMATE') OR define('PHP_DATE_FORMATE', 'd-m-Y');
defined('PHP_TIME_FORMATE') OR define('PHP_TIME_FORMATE', 'H:i');
defined('PHP_TIME_MYSQL_FORMAT') OR define('PHP_TIME_MYSQL_FORMAT', '%h:%i:%s %p');
defined('DATE_FORMATE') OR define('DATE_FORMATE', 'dd-mm-yy');
defined('DATE_FORMATE_MYSQL') OR define('DATE_FORMATE_MYSQL', '%d-%m-%Y');
defined('DATE_TIME_FORMATE_MYSQL') OR define('DATE_TIME_FORMATE_MYSQL', '%d-%m-%Y %H:%i:%s');
defined('PERPAGE_DISPLAY') OR define('PERPAGE_DISPLAY', 25);

defined('LEAD_PREFIX') OR define('LEAD_PREFIX', 'LEAD-');
defined('QUOTATION_PREFIX') OR define('QUOTATION_PREFIX', 'QTN-');
defined('PURCHASE_ORDER_PREFIX') OR define('PURCHASE_ORDER_PREFIX', 'PO-');
defined('SALES_ORDER_PREFIX') OR define('SALES_ORDER_PREFIX', 'SO-');
defined('DELIVER_NOTES_PREFIX') OR define('DELIVER_NOTES_PREFIX', 'DN-');
defined('STOCK_PREFIX') OR define('STOCK_PREFIX', 'STE-');
defined('STOCK_RECONCILIATION_PREFIX') OR define('STOCK_RECONCILIATION_PREFIX', 'SR-');
defined('SALES_INVOICE_PREFIX') OR define('SALES_INVOICE_PREFIX', 'SINV-');
defined('PURCHASE_INVOICE_PREFIX') OR define('PURCHASE_INVOICE_PREFIX', 'PINV-');
defined('EMAIL_TEMPLATE_PREFIX') OR define('EMAIL_TEMPLATE_PREFIX', 'EMTE-');
defined('DOCUMENT_PREFIX') OR define('DOCUMENT_PREFIX', 'DOC-');
defined('SUPPLIER_QUOTATION_PREFIX') OR define('SUPPLIER_QUOTATION_PREFIX', 'SQTN-');
defined('ASSETS_REPAIR_PREFIX') OR define('ASSETS_REPAIR_PREFIX', 'ARLOG-');
defined('PAYMENT_ENTRY_PREFIX') OR define('PAYMENT_ENTRY_PREFIX', 'PE-');
defined('HIRE_CONTRACT_PREFIX') OR define('HIRE_CONTRACT_PREFIX', 'RNT-HC-');
defined('LOCATION_TRANSFER_IN_PREFIX') OR define('LOCATION_TRANSFER_IN_PREFIX', 'LTI-');
defined('LOCATION_TRANSFER_OUT_PREFIX') OR define('LOCATION_TRANSFER_OUT_PREFIX', 'LTO-');



defined('SITE_NAME') OR define('SITE_NAME', 'WHOZ NXT!');


//Message Constants
defined('ROLE') OR define('ROLE', 'Role');
defined('EMPLOYEE') OR define('EMPLOYEE', 'Employee');
defined('FISCAL_YEAR') OR define('FISCAL_YEAR', 'Fiscal Year');
defined('CURRENCY_EXCHANGE') OR define('CURRENCY_EXCHANGE', 'Currency Exchange');
defined('INDUSTRY_TYPE') OR define('INDUSTRY_TYPE', 'Industry Type');
defined('TERMS_CONDITION') OR define('TERMS_CONDITION', 'Terms Condition');
defined('POST') OR define('POST', 'Post');
defined('POLL') OR define('POLL', 'Poll');
defined('VSPL') OR define('VSPL', 'VSPL');
defined('BANNER') OR define('BANNER', 'Banner');
defined('PAGE') OR define('PAGE', 'Page');
defined('EVENT') OR define('EVENT', 'Event');
defined('MONKLOCATION') OR define('MONKLOCATION', 'Monk Location');
defined('RELATIONSHIP') OR define('RELATIONSHIP', 'Relationship');
defined('MONK') OR define('MONK', 'Monk');
defined('GALLERY') OR define('GALLERY', 'Gallery');
defined('MEMBER') OR define('MEMBER', 'Member');
defined('PACHKHAN') OR define('PACHKHAN', 'Pachkhan');
defined('BUSINESS') OR define('BUSINESS', 'Business');
defined('BUSINESS_TYPE') OR define('BUSINESS_TYPE', 'Business Type');
defined('NATIVE') OR define('NATIVE', 'Native Location');
defined('EDUCATION') OR define('EDUCATION', 'Education');
defined('CASTE') OR define('CASTE', 'Caste');

defined('LANGUAGE') OR define('LANGUAGE', 'Language');

defined('GALLARY') OR define('GALLARY', 'Gallary');
defined('GALLERY') OR define('GALLERY', 'Gallery');
defined('MEMBER') OR define('MEMBER', 'Member');
defined('COUNTRY') OR define('COUNTRY', 'Country');
defined('RELIGION') OR define('RELIGION', 'Religion');
defined('SECTION') OR define('SECTION', 'Section');
defined('SCHEME') OR define('SCHEME', 'Scheme');
defined('BLOODGROUP') OR define('BLOODGROUP', 'Blood Group');
defined('CATEGORY') OR define('CATEGORY', 'Category');
defined('STATE') OR define('STATE', 'State');
defined('STAFF') OR define('STAFF', 'Staff');
defined('SERVICE') OR define('SERVICE', 'Service');
defined('BOOKING') OR define('BOOKING', 'Booking');
defined('SURNAME') OR define('SURNAME', 'Surname');
defined('GENDER') OR define('GENDER', 'Gender');
defined('MARITALSTATUS') OR define('MARITALSTATUS', 'Maritalstatus');
defined('CITY') OR define('CITY', 'City');
defined('CURRENCY') OR define('CURRENCY', 'Currency');
defined('ADDRESS_TYPE') OR define('ADDRESS_TYPE', 'Address Type');
defined('SUPPLIER_GROUP_NAME') OR define('SUPPLIER_GROUP_NAME', 'Supplier Group Name');
defined('COST_CENTER') OR define('COST_CENTER', 'Cost Center');
defined('AMSOM') OR define('AMSOM', 'Amsom');
defined('DESOM') OR define('DESOM', 'Desom');
defined('MANUFACTURER') OR define('MANUFACTURER', 'Manufacturer');

defined('SALUTATION') OR define('SALUTATION', 'Salutation');
defined('DEPARTMENT ') OR define('DEPARTMENT', 'Department');
defined('DESIGNATION') OR define('DESIGNATION', 'Designation');
defined('DOCUMENT_TYPE') OR define('DOCUMENT_TYPE', 'Document Type');
defined('SUPPLIER') OR define('SUPPLIER', 'Supplier');
defined('STATUS') OR define('STATUS', 'Status');
defined('SOURCE') OR define('SOURCE', 'Source');
defined('LEAD_TYPE') OR define('LEAD_TYPE', 'Lead Type');
defined('MARKET_SEGMENT') OR define('MARKET_SEGMENT', 'Market Segment');
defined('REQUEST_TYPE') OR define('REQUEST_TYPE', 'Request Type');
defined('ADDRESS') OR define('ADDRESS', 'Address');
defined('CONTACT') OR define('CONTACT', 'Contact');
defined('LEAD') OR define('LEAD', 'Lead');
defined('ITEM') OR define('ITEM', 'Item');
defined('PURCHASE_ORDER') OR define('PURCHASE_ORDER', 'Purchase Order');
defined('DELIVER_NOTES') OR define('DELIVER_NOTES', 'Deliver Notes');
defined('DELIVER_NOTES_ITEM') OR define('DELIVER_NOTES_ITEM', 'Deliver Notes Item');

defined('CUSTOMER_GROUP') OR define('CUSTOMER_GROUP', 'Customer Group');
defined('CUSTOMER') OR define('CUSTOMER', 'Customer');
defined('PRICE_LIST') OR define('PRICE_LIST', 'Price List');
defined('INQUIRY') OR define('INQUIRY', 'Inquiry');
defined('INQUIRY_TYPE') OR define('INQUIRY_TYPE', 'Inquiry Type');
defined('INQUIRY_ITEM') OR define('INQUIRY_ITEM', 'Inquiry Item');


defined('SPACE_TYPE') OR define('SPACE_TYPE', 'Space Type');
defined('SALES_INVOICE') OR define('SALES_INVOICE', 'Sales Invoice');
defined('SALES_INVOICE_ITEM') OR define('SALES_INVOICE_ITEM', 'Sales Invoice Item');
defined('PURCHASE_INVOICE') OR define('PURCHASE_INVOICE', 'Purchase Invoice');
defined('EMAIL_TEMPLATE') OR define('EMAIL_TEMPLATE', 'Email Template');
defined('PURCHASE_INVOICE_ITEM') OR define('PURCHASE_INVOICE_ITEM', 'Purchase Invoice Item');
defined('AREA') OR define('AREA', 'Area');
defined('BATCH') OR define('BATCH', 'Batch');
defined('BIN_TYPE') OR define('BIN_TYPE', 'Bin Type');
defined('BIN') OR define('BIN', 'Bin');
defined('SERIAL_NUMBER') OR define('SERIAL_NUMBER', 'Serial Number');
defined('PAYMENT_ENTRY') OR define('PAYMENT_ENTRY', 'Payment Entry');
defined('LOCATION') OR define('LOCATION', 'Location');
defined('ASSET_MAINTENANCE_TYPE') OR define('ASSET_MAINTENANCE_TYPE', 'Asset Maintenance Type');
defined('ASSET_MAINTENANCE') OR define('ASSET_MAINTENANCE', 'Asset Maintenance');
defined('ASSET_MAINTENANCE_TASK') OR define('ASSET_MAINTENANCE_TASK', 'Asset Maintenance Task');
defined('LOCATION_TRANSFER_IN') OR define('LOCATION_TRANSFER_IN', 'Location Transfer In');
defined('LOCATION_TRANSFER_IN_ITEM') OR define('LOCATION_TRANSFER_IN_ITEM', 'Location Transfer In Item');
defined('LOCATION_TRANSFER_OUT') OR define('LOCATION_TRANSFER_OUT', 'Location Transfer Out');
defined('LOCATION_TRANSFER_OUT_ITEM') OR define('LOCATION_TRANSFER_OUT_ITEM', 'Location Transfer Out Item ');
defined('ACTIVITY_LOG') OR define('ACTIVITY_LOG', 'Activity Log');

defined('ITEM_GROUP') OR define('ITEM_GROUP', 'Item Group');
defined('UNIT') OR define('UNIT', 'Unit');
defined('BRAND') OR define('BRAND', 'Brand');
defined('COMPANY') OR define('COMPANY', 'Company');
defined('WAREHOUSE') OR define('WAREHOUSE', 'Warehouse');
defined('TAX') OR define('TAX', 'Tax');
defined('TRANSPORTER') OR define('TRANSPORTER', 'Transporter');
defined('CHARGES') OR define('CHARGES', 'Charges');
defined('ACCOUNT') OR define('ACCOUNT', 'Account');

defined('QUOTATION') OR define('QUOTATION', 'Quotation');
defined('QUOTATION_ITEM') OR define('QUOTATION_ITEM', 'Quotation Item');
defined('PURCHASE_ORDER_ITEM') OR define('PURCHASE_ORDER_ITEM', 'Purchase Order Item');
defined('SUPPLIER_QUOTATION_ITEM') OR define('SUPPLIER_QUOTATION_ITEM', 'Supplier Quotation Item');
defined('SUPPLIER_QUOTATION_TAX') OR define('SUPPLIER_QUOTATION_TAX', 'Supplier Quotation TAX');
defined('PAYMENT_MODE') OR define('PAYMENT_MODE', 'Payment Mode');

defined('EMPLOYEE_TYPE') OR define('EMPLOYEE_TYPE', 'Employee Type');
defined('BRANCH') OR define('BRANCH', 'Branch');
defined('WORKSTATION') OR define('WORKSTATION', 'Workstation');
defined('PAYMENT_TERM') OR define('PAYMENT_TERM', 'Payment Term');
defined('INQUIRY_PREFIX') OR define('INQUIRY_PREFIX', 'INQ-');
defined('PURCHASE_RECEIPT') OR define('PURCHASE_RECEIPT', 'Purchase Receipt');
defined('PURCHASE_RECEIPT_PREFIX') OR define('PURCHASE_RECEIPT_PREFIX', 'PREC-');
defined('MATERIAL_REQUEST') OR define('MATERIAL_REQUEST', 'Material Request');
defined('MATERIAL_REQUEST_ITEM') OR define('MATERIAL_REQUEST_ITEM', 'Material Request Item');
defined('MATERIAL_REQUEST_PREFIX') OR define('MATERIAL_REQUEST_PREFIX', 'MREQ-');
defined('QUALITY_INSPECTION') OR define('QUALITY_INSPECTION', 'Quality Inspection');
defined('QUALITY_INSPECTION_ITEM') OR define('QUALITY_INSPECTION_ITEM', 'Quality Inspection Item');
defined('QUALITY_INSPECTION_PREFIX') OR define('QUALITY_INSPECTION_PREFIX', 'QI-');
defined('LEAVE_TYPE') OR define('LEAVE_TYPE', 'Leave Type');
defined('HOLIDAY') OR define('HOLIDAY', 'Holiday');
defined('WEEKLY_OFF') OR define('WEEKLY_OFF', 'Weekly Off');
defined('HOLIDAY_ITEM') OR define('HOLIDAY_ITEM', 'Holiday Item');
defined('SALES_ORDER') OR define('SALES_ORDER', 'Sales Order');
defined('SALES_ORDER_ITEM') OR define('SALES_ORDER_ITEM', 'Sales Order Item');
defined('READING') OR define('READING', 'Reading');
defined('INSPECTION_CRITERIA') OR define('INSPECTION_CRITERIA', 'Inspection Criteria');
defined('RACK') OR define('RACK', 'Rack');
defined('REQUEST_FOR_QUOTATION_PREFIX') OR define('REQUEST_FOR_QUOTATION_PREFIX', 'RFQ-');
defined('REQUEST_FOR_QUOTATION') OR define('REQUEST_FOR_QUOTATION', 'Request For Quotation');
defined('SUPPLIER_DETAILS') OR define('SUPPLIER_DETAILS', 'Supplier Details');
defined('ITEM_DETAILS') OR define('ITEM_DETAILS', 'Item Details');


defined('SALES_PARTNER') OR define('SALES_PARTNER', 'Sales Partner');
defined('SHIPPING_RULE') OR define('SHIPPING_RULE', 'Shipping Rule');
defined('STOCK') OR define('STOCK', 'Stock');
defined('STOCK_WAREHOUSE') OR define('STOCK_WAREHOUSE', 'Stock Warehouse');
defined('STOCK_COST') OR define('STOCK_COST', 'Stock Cost');

defined('STOCK_RECONCILIATION') OR define('STOCK_RECONCILIATION', 'Stock Reconciliation');
defined('STOCK_ITEM') OR define('STOCK_ITEM', 'Stock Item');
defined('SUPPLIER_QUOTATION') OR define('SUPPLIER_QUOTATION', 'Supplier Quotation');

defined('ASSETS') OR define('ASSETS', 'Assets');
defined('ASSETS_REPAIR') OR define('ASSETS_REPAIR', 'Assets Repair');
defined('ASSETS_REPAIR_ITEM') OR define('ASSETS_REPAIR_ITEM', 'Assets Repair Item');
defined('ASSETS_SCHEDULE') OR define('ASSETS_SCHEDULE', 'Depreciation Schedule');
defined('ASSETS_CATEGORY') OR define('ASSETS_CATEGORY', 'Assets Category');
defined('LETTER_HEAD') OR define('LETTER_HEAD', 'Letter Head');
defined('HIRE_CONTRACT') OR define('HIRE_CONTRACT', 'Hire Contract');
defined('HIRE_CONTRACT_ITEM') OR define('HIRE_CONTRACT_ITEM', 'Hire Contract Item');
defined('HIRE_CONTRACT_TAX') OR define('HIRE_CONTRACT_TAX', 'Hire Contract Tax');




defined('BTN_SUCCESS') OR define('BTN_SUCCESS', '#66BB6A');
defined('BTN_ERROR') OR define('BTN_ERROR', '#F44336');
defined('BTN_DELETE_INFO') OR define('BTN_DELETE_INFO', '#2196F3');
defined('BTN_DELETE_WARNING') OR define('BTN_DELETE_WARNING', '#FF7043');
defined('BTN_SPINNER_COLOR') OR define('BTN_SPINNER_COLOR', '#03A9F4');
//defined('FILE_UPLOAD_TYPE_MSG') OR define('FILE_UPLOAD_TYPE_MSG', 'jpeg | png | jpg');
defined('FILE_UPLOAD_TYPE') OR define('FILE_UPLOAD_TYPE', 'png,jpeg,jpg,pdf,doc,docx');
defined('DOCUMENT_FILE_UPLOAD_TYPE') OR define('DOCUMENT_FILE_UPLOAD_TYPE', 'xlsx,xls');


defined('MAX_IMAGE_SIZE_LIMIT') OR define('MAX_IMAGE_SIZE_LIMIT', 4096000);
//defined('FILE_UPLOAD_TYPE') OR define('FILE_UPLOAD_TYPE', 'png,jpeg,jpg,pdf');
defined('IMAGE_UPLOAD_MESSAGE') OR define('IMAGE_UPLOAD_MESSAGE', 'Accepted formats: jpeg, png,jpg Max file size 2Mb');
defined('FILE_UPLOAD_TYPE_MSG') OR define('FILE_UPLOAD_TYPE_MSG', 'jpeg | png | jpg | pdf | doc | docx');
defined('DOCUMENT_FILE_UPLOAD_TYPE_MSG') OR define('DOCUMENT_FILE_UPLOAD_TYPE_MSG', 'xlsx | xls');

defined('MAX_DOCUMENT_SIZE_LIMIT') OR define('MAX_DOCUMENT_SIZE_LIMIT', 2048000);
defined('IMAGE_DIR_URL')         OR define('IMAGE_DIR_URL', 'http://wezo.co.uk/WhozNxt/');
defined('AUDIO_DIR_URL')         OR define('AUDIO_DIR_URL', 'http://wezo.co.uk/WhozNxt/');
defined('SEARCH_FILTER_EXPORT') OR define('SEARCH_FILTER_EXPORT', 1);
defined('FISCAL_YEAR_CURRENT') OR define('FISCAL_YEAR_CURRENT',2);
defined('QUOTATION_ADD_DAYS') OR define('QUOTATION_ADD_DAYS',10);


defined('SBU_TYPES') OR define('SBU_TYPES',
    json_encode(array(
        "plant hire" => "plant hire",
        "trading" => "trading",
        "auto" => "auto",
        "job contracting" => "job contracting",
        "maintenance" => "maintenance",
    ))
);

defined('CHARGE_FREQUENCY') OR define('CHARGE_FREQUENCY',
    json_encode(array(
        "daily" => "daily",
        "monthly" => "monthly",
        "yearly" => "yearly",
    ))
);

/********* Date Constant *********/

define('STR_TO_TIME', strtotime(date("Y-m-d H:i:s")));

define('TODAY_DATE', date("d-m-Y"));

define('TODAY_DATE_YMD', date("Y-m-d"));

define('DATE_TIME_INDIAN', date("m-d-Y H:i:s"));

define('DATE_TIME_DATABASE', date("Y-m-d H:i:s"));

define('DATE_TIME_FORMAT', date("l dS F Y, H:i:s A", STR_TO_TIME));

define('DATETIMEFORMAT', date("l-dS-F-Y-H-i-s-A", STR_TO_TIME));

define('UPLOADPATH', $_SERVER['DOCUMENT_ROOT'] . "/samaj/uploads/");
//define('BUSINESSPATH', base_url().'uploads/business_path');



defined('DATA_LIMIT')                      OR define('DATA_LIMIT', 10);
defined('TIME_VALIDITY')                   OR define('TIME_VALIDITY', 90);//in days
defined('AUTH_TOKEN_TIME_VALIDITY')        OR define('AUTH_TOKEN_TIME_VALIDITY', 90);//in days
defined('OTP_TIME_VALIDITY')               OR define('OTP_TIME_VALIDITY',15);//in Minute

