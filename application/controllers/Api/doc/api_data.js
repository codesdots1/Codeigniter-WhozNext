define({ "api": [
  {
    "type": "post",
    "url": "Api/SamajWebService/addEditBusiness",
    "title": "Add/Edit Business",
    "name": "Add_Edit_Business",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Business",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": true,
            "field": "business_id",
            "defaultValue": "1",
            "description": "<p>The Business Id  for Editing Business.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "business_type_id",
            "defaultValue": "1",
            "description": "<p>member type id to insert/update business type data.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "owner_name",
            "defaultValue": "owner Name",
            "description": "<p>Owner detail to get Owner name from user to insert/update.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "defaultValue": "Business Address",
            "description": "<p>Address to get business Address from user to insert/update.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address_geo",
            "defaultValue": " Geo Address",
            "description": "<p>Address wil get from user through map to insert/update business address.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "description",
            "defaultValue": "Business Description",
            "description": "<p>Address wil get from user through map to insert/update business address.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "lat",
            "defaultValue": "Address latitude",
            "description": "<p>lat is use to insert or update latitude of your address.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "lng",
            "defaultValue": "Address longitude",
            "description": "<p>lng is use to insert or update longitude of your address.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "business_mobile[]",
            "defaultValue": "1234567890",
            "description": "<p>Multiple mobile numbers for business to insert or update.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "business_email[]",
            "defaultValue": "Email Address",
            "description": "<p>Multiple Email Addresses for business to insert or update.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "business_telephone[]",
            "defaultValue": "0262222222",
            "description": "<p>Multiple Telephone Number for business to insert or update.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "business_image[]",
            "defaultValue": "image.jpg",
            "description": "<p>Image to Insert or update Image for Business    .</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Add/Edit Business",
          "content": "{\n\"status\": true,\n\"responseCode\": 200,\n\"message\": \"Business inserted/updated successfully\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/addEditBusiness"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Business",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getBusinessList",
    "title": "Business-List",
    "name": "Business_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Business",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getBusinessList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Business Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                 \"business_id\": \"250\",\n                   \"member_id\": \"12\",\n                   \"member_name\": \"Blake Dummy Gaines\",\n                   \"business_name\": \"Dummy Business\",\n                   \"owner_name\": \"Dummy Owner\",\n                   \"address\": \"A-301, A Wing, Hetal Arch, Opp. Natraj Market,\\nS.V. Road, Malad West, Mumbai.\",\n                   \"address_geo\": \"Babulal Avasti Compound, Opp. Arun Mill, Wallbhat Road, Goregaon (East), Mumbai, Maharashtra 400063, India\",\n                   \"description\": \"<p>ABC</p>\",\n                   \"business_type_id\": \"1\",\n                   \"business_type_name\": \"New Dummy\",\n                   \"lat\": \"19.1581061057055\",\n                   \"lng\": \"72.85170933337395\",\n                   \"file\": \"9cd5b562bdd65f377c100c9d83793746.png\",\n                   \"business_image_path\": \"http://192.168.0.128/samaj/uploads/business_path/9cd5b562bdd65f377c100c9d83793746.png\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getBusinessList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Business",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/deleteBusiness",
    "title": "Delete-Business",
    "name": "Delete_Business",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Business",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "deleteBusiness",
          "content": "{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"message\": \"Business deleted successfully\",\n     \"limit\": 10,\n     \"data\":\n         {\n          \"success\": true\n         }\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/deleteBusiness"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Business",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "business_id",
            "defaultValue": "1",
            "description": "<p>The Business Id  for Deleting Business.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getBusinessTypeList",
    "title": "BusinessType-List",
    "name": "BusinessType_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Business_Type",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getBusinessTypeList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"BusinessType Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                      \"business_type_id\": \"1\",\n                      \"parent_business_type_id\": \"0\",\n                      \"business_type_name\": \"New Dummy\",\n                      \"sort_order\": \"1\",\n                      \"is_active\": \"1\",\n                      \"created_at\": \"2019-02-21 16:46:00\",\n                      \"created_by\": \"1\",\n                      \"updated_at\": \"2019-02-21 16:46:00\",\n                      \"updated_by\": \"1\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getBusinessTypeList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Business_Type",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "varname1",
            "description": "<p>No type.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "varname2",
            "description": "<p>With type.</p>"
          }
        ]
      }
    },
    "type": "",
    "url": "",
    "version": "0.0.0",
    "filename": "./doc/main.js",
    "group": "C__xampp_htdocs_samaj_application_controllers_Api_doc_main_js",
    "groupTitle": "C__xampp_htdocs_samaj_application_controllers_Api_doc_main_js",
    "name": ""
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/addEventRsvp",
    "title": "Add Event Rsvp",
    "name": "Add_Event_Rsvp",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Event",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "addEventRsvp",
          "content": "{\n\"status\": true,\n    \"responseCode\": 200,\n    \"message\": \"Event Rsvp inserted successfully\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/addEventRsvp"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Event",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "event_id",
            "defaultValue": "1",
            "description": "<p>It is use to get particular Event</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_interested",
            "defaultValue": "1/0",
            "description": "<p>it is use to get interest of member for particular Event</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getEventList",
    "title": "Event-List",
    "name": "Event_Listing",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Event",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getEventList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Event Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                  \"event_id\": \"5\",\n                  \"event_name\": \"FASHION SHOW\",\n                  \"short_description\": \"A fashion show (French d??fil?? de mode) is an event put on by a fashion designer to show\",\n                  \"long_description\": \"<p><span class=\\\"ILfuVd\\\">A <b>fashion show</b> (French d??fil?? de mode) is an <b>event</b> put on by a <b>fashion</b> designer to showcase their upcoming line of clothing and/or accessories during <b>Fashion Week</b>. ... In a typical <b>fashion show</b>, models walk the catwalk dressed in the clothing created by the designer.</span></p>\\r\\n\",\n                  \"start_date\": \"25-02-2019\",\n                  \"end_date\": \"25-02-2019\",\n                  \"location_geo\": \"Apollo Bandar, Colaba, Mumbai, Maharashtra, India\",\n                  \"location_general\": \"Apollo Bandar, Colaba, Mumbai, Maharashtra 400001\",\n                  \"is_required\": \"0\",\n                  \"start_time\": \"13:40\",\n                  \"end_time\": \"13:40\",\n                  \"lat\": \"18.9203886\",\n                  \"lng\": \"72.83013059999996\",\n                  \"file\": \"b46b2ca9076ebc7a27709554819ab7c5.jpg\",\n                  \"gallery_image_path\": \"http://192.168.0.128/samaj/uploads/event_path/b46b2ca9076ebc7a27709554819ab7c5.jpg\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getLanguageList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Event",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getGalleryListing",
    "title": "Gallery-List",
    "name": "Gallery_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Gallery",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getGalleryList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Gallery Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                          \"gallery_id\": \"1\",\n                          \"gallery_name\": \"Art\",\n                          \"parent_gallery_name\": null,\n                          \"filename\": \"382aadc9012c72056ab73e1a592e03b3.jpg\",\n                          \"gallery_image_path\": \"http://192.168.0.128/samaj/uploads/gallery_path/382aadc9012c72056ab73e1a592e03b3.jpg\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getGalleryList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Gallery",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getLanguageList",
    "title": "Language-List",
    "name": "Language_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Language",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getLanguageList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Language Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                      \"language_id\": \"1\",\n                      \"language_code\": \"EN\",\n                      \"language_name\": \"English\",\n                      \"is_default\": \"1\",\n                      \"is_active\": \"1\",\n                      \"created_at\": \"2019-02-12 02:17:16\",\n                      \"created_by\": \"1\",\n                      \"updated_at\": \"2019-09-18 03:05:08\",\n                      \"updated_by\": \"1\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getLanguageList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Language",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/checkOtp",
    "title": "Check-Otp",
    "name": "Check_Otp",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Login",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getMemberList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Member Data is Available\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                        \"member_id\": \"12\",\n                        \"samaj_id\": \"13\",\n                        \"member_number\": \"565656565\",\n                        \"parent_member_id\": \"28\",\n                        \"member_name\": \"Blake Patel\",\n                        \"samaj_name\": \"Christ\",\n                        \"first_name\": \"Blake\",\n                        \"middle_name\": \"Dummy\",\n                        \"surname\": \"Gaines\",\n                        \"email\": \"widop@mailinator.net\",\n                        \"blood_group\": \"Quas\",\n                        \"marital_status\": \"Perspiciatis\",\n                        \"date_of_birth\": \"29-10-2018\",\n                        \"aadhar_card_no\": \"134564654414\",\n                        \"auth_token\": \"zjul8iiptd2lxq71pkcb\",\n                        \"is_active\": \"1\",\n                        \"member_image_path\": \"http://192.168.0.128/samaj/uploads/member_image/0574a16046e21957fba985455256a5de.jpg\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/login"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "otp",
            "defaultValue": "123456",
            "description": "<p>One Time Password  for login.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "406-",
            "description": "<p>&quot;invalid OTP&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "407-",
            "description": "<p>&quot;OTP Expired&quot;</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        },
        {
          "title": "Invalid OTP",
          "content": "{\n  \"status\": false,\n\t \"responseCode\": 406,\n\t \"message\": \"invalid OTP\",\n\t \"limit\": 10,\n\t \"data\": null\n}",
          "type": "json"
        },
        {
          "title": "Expired OTP",
          "content": "{\n  \"status\": false,\n\t \"responseCode\": 407,\n\t \"message\": \"OTP validity has been expired\",\n\t \"limit\": 10,\n\t \"data\": null\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/login",
    "title": "Login",
    "name": "Login",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Login",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getMemberList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Notification Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                        \"otp\": \"874376\",\n                        \"otp_validity\": \"2018-12-13 17:32:22\",\n                        \"member_id\": \"12\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/login"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "mobile",
            "defaultValue": "999999999",
            "description": "<p>Mobile Number for login.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/addEditMember",
    "title": "Add/Edit Member",
    "name": "Add_Edit_Member",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Member",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "Add/Edit Member",
          "content": "{\n\"status\": true,\n\"responseCode\": 200,\n\"message\": \"Member inserted/updated successfully\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/addEditMember"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Member",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "aadhar_card_no",
            "defaultValue": "123456789123",
            "description": "<p>Adhar card number of member.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "member_number",
            "defaultValue": "A1",
            "description": "<p>Unique number for member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "defaultValue": "Email Address",
            "description": "<p>Email Addresses of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "first_name",
            "defaultValue": "First Name",
            "description": "<p>First name of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "middle_name",
            "defaultValue": "Middle Name",
            "description": "<p>Middle name of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "surname",
            "defaultValue": "Surname",
            "description": "<p>Surname of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "blood_group",
            "defaultValue": "Blood Group",
            "description": "<p>Blood Group of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "marital_status",
            "defaultValue": "Married/Unmarried",
            "description": "<p>Marital Status of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "date_of_birth",
            "defaultValue": "00/00/0000",
            "description": "<p>Date Of Birth of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_active",
            "defaultValue": "1/0",
            "description": "<p>Use to make Post active or inactive.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "education",
            "description": "<p>Education of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "age",
            "defaultValue": "18",
            "description": "<p>Age of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "home_town",
            "defaultValue": "Home Town",
            "description": "<p>Home Town of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "current_work",
            "defaultValue": "current_work",
            "description": "<p>Current of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "member_mobile",
            "defaultValue": "1234567890",
            "description": "<p>Mobile number of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "member_mobile_type",
            "defaultValue": "Home/office etc.",
            "description": "<p>Mobile number type of Member.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "samaj_id",
            "defaultValue": "1",
            "description": "<p>Samaj id use to get Samaj data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": true,
            "field": "parent_member_id",
            "description": "<p>Parent member id to get Sub members</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/changeStatus",
    "title": "Change-Status",
    "name": "Change_Status",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Member",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "changeStatus",
          "content": "{\n\n               \"status\": true,\n               \"responseCode\": 200,\n               \"message\": \"Member Status Changed successfully\",\n               \"limit\": 10,\n               \"data\": true\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/changeStatus"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Member",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_active",
            "defaultValue": "1/0",
            "description": "<p>Use to make Post active or inactive.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_detail_id",
            "defaultValue": "1",
            "description": "<p>The member Id passed from user's device.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getMemberExtraData",
    "title": "MemberExtra-Data",
    "name": "MemberExtra_Data",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Member",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getMemberExtraData",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Marital Status and Blood Group Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                {\n                       \"marital_status\":\n                       [\n                       {\n                       \"marital_status_id\": \"1\",\n                       \"member_id\": \"1\",\n                       \"marital_status\": \"married\"\n                       },\n                       {\n                       \"marital_status_id\": \"2\",\n                       \"member_id\": \"0\",\n                       \"marital_status\": \"unmarried\"\n                       }\n                       ],\n                       \"blood_group\": [\n                       {\n                       \"blood_group_id\": \"1\",\n                       \"member_id\": \"1\",\n                       \"blood_group\": \"A+\"\n                       },\n                       {\n                       \"blood_group_id\": \"2\",\n                       \"member_id\": \"0\",\n                       \"blood_group\": \"O+\"\n                       },\n                       {\n                       \"blood_group_id\": \"3\",\n                       \"member_id\": \"0\",\n                       \"blood_group\": \"B+\"\n                       },\n                       {\n                       \"blood_group_id\": \"4\",\n                       \"member_id\": \"0\",\n                       \"blood_group\": \"AB+\"\n                       },\n                       {\n                       \"blood_group_id\": \"5\",\n                       \"member_id\": \"0\",\n                       \"blood_group\": \"A+\"\n                       },\n                       {\n                       \"blood_group_id\": \"6\",\n                       \"member_id\": \"0\",\n                       \"blood_group\": \"O-\"\n                       },\n                       {\n                       \"blood_group_id\": \"7\",\n                       \"member_id\": \"0\",\n                       \"blood_group\": \"B-\"\n                       },\n                       {\n                       \"blood_group_id\": \"8\",\n                       \"member_id\": \"0\",\n                       \"blood_group\": \"AB-\"\n                       }\n                   ]\n               }\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getMemberExtraData"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Member",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getMemberList",
    "title": "Member-List",
    "name": "Member_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Member",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": true,
            "field": "member_id",
            "description": "<p>member id to get particular Member Detail</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": true,
            "field": "parent_member_id",
            "description": "<p>Parent member id to get Sub members</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "getMemberList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Member Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                  \"member_id\": \"1\",\n                  \"member_name\": \"Jamesss Rrr Goslinn\",\n                  \"member_number\": \"BH-00111212\",\n                  \"file\": \"0574a16046e21957fba985455256a5de.jpg\",\n                  \"education\": \"Mscs\",\n                  \"age\": \"22\",\n                  \"hometown\": \"Timminss\",\n                  \"current_work\": \"Google Inc.s\",\n                  \"member_image_path\": \"http://192.168.0.128/samaj/uploads/member_image/0574a16046e21957fba985455256a5de.jpg\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getMemberList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Member",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getSurnameList",
    "title": "Surname-List",
    "name": "Surname_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Member",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getSurnameList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Surname Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                     \"surname_id\": \"1\",\n                       \"samaj_id\": \"32\",\n                       \"surname\": \"Digitattva\",\n                       \"created_by\": \"1\",\n                       \"created_at\": \"2019-03-08 12:56:00\",\n                       \"updated_by\": \"1\",\n                       \"updated_at\": \"2019-03-08 12:56:00\",\n                       \"surname_description_id\": \"1\",\n                       \"language_id\": \"1\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getSurnameList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Member",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getNotificationList",
    "title": "Notification-List",
    "name": "Notification_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Notification",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getMemberList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Notification Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                   \"notification_id\": \"227\",\n                   \"notification_title\": \"New Data\",\n                   \"description\": \"New Description\",\n                   \"send_to\": \"Android\",\n                   \"send_type\": \"Send_Now\",\n                   \"notification_image\": \"668241f8d0658353ecd9f8c8be48d287.jpg\",\n                   \"notification_type_id\": \"0\",\n                   \"notification_type\": \"general\",\n                   \"is_active\": \"1\",\n                   \"created_at\": \"2018-10-05 11:45:44\",\n                   \"created_by\": \"1\",\n                   \"updated_at\": \"2018-10-05 11:45:44\",\n                   \"updated_by\": \"1\",\n                   \"notification_image_path\": \"http://192.168.0.128/samaj/uploads/notification_image/668241f8d0658353ecd9f8c8be48d287.png\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getNotificationList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Notification",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getPachkhanList",
    "title": "Pachkhan-List",
    "name": "Pachkhan_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Pachkhan",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getPachkhanList",
          "content": "{\n\n\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getPachkhanList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Pachkhan",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "pachkhan_id",
            "defaultValue": "1",
            "description": "<p>User id use to get users data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getPollListing",
    "title": "Poll-Listing",
    "name": "Poll_Listing",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Poll",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getPollListing",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Poll Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                        \"poll_id\": \"1\",\n                        \"question\": \"Gender\",\n                        \"sort_order\": \"8\",\n                        \"is_active\": \"0\",\n                        \"is_required\": \"1\",\n                        \"is_multiple\": \"1\",\n                        \"field_type\": \"text\",\n                        \"samaj_id\": \"13\",\n                        \"samaj_name\": \"Christ\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getPollListing"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Poll",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/addEditPost",
    "title": "Add/Edit Post",
    "name": "Add_Edit_Post",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Post",
    "version": "0.1.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": true,
            "field": "post_id",
            "description": "<p>Post Id to edit particular Post.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "samaj_id",
            "defaultValue": "1",
            "description": "<p>Samaj id use to get Samaj data.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "defaultValue": "content Post",
            "description": "<p>Content for particular Post.</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "tags[]",
            "defaultValue": "Tag Post",
            "description": "<p>Tags for particular Post.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_active",
            "defaultValue": "1/0",
            "description": "<p>Use to make Post active or inactive.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "category_id[]",
            "defaultValue": "1",
            "description": "<p>category id to insert and update category in post.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "other_oil[]",
            "defaultValue": "1",
            "description": "<p>Oil id to insert and update Oil in post.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "post_image[]",
            "defaultValue": "image.jpg",
            "description": "<p>Image to Insert or update Image for post.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "Add/Edit Post",
          "content": "{\n\"status\": true,\n\"responseCode\": 200,\n\"message\": \"Post inserted/updated successfully\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/addEditPost"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Post",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/deletePost",
    "title": "Delete-Post",
    "name": "Delete_Post",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "deletePost",
          "content": "{\n     \"status\": true,\n     \"responseCode\": 200,\n     \"message\": \"Post Listing successfully\",\n     \"limit\": 10,\n     \"data\":\n         {\n          \"success\":  true\n         }\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/deletePost"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "post_id",
            "defaultValue": "1",
            "description": "<p>The Post Id  for Deleting Post.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getPostList",
    "title": "Post-List",
    "name": "Post_List",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getPostList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Post Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                  \"post_id\": \"2\",\n                  \"title\": \"new\",\n                  \"tags\": \"\",\n                  \"is_active\": \"1\",\n                  \"samaj_name\": null,\n                  \"post_date\": \"14-12-2018\",\n                  \"category_name\": null,\n                  \"user_name\": null,\n                  \"total_post_like\": \"3\",\n                  \"content\": \"ply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only\",\n                  \"file\": \"bd0e7bf92b2d8f3e0c03e398ef6700ce.jpg\",\n                  \"post_image_path\": \"http://192.168.0.128/samaj/uploads/post_path/bd0e7bf92b2d8f3e0c03e398ef6700ce.jpg\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getPostList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "search",
            "description": "<p>Search parameter for data filtration</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/setPostLike",
    "title": "Set-Post-Like",
    "name": "Set_Post_Like",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Post",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "setQuesti  onLike",
          "content": "{\n    \"status\": true,\n    \"responseCode\": 200,\n    \"message\": \"unlike\",\n    \"no_of_like\": \"1\"\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/setPostLike\n\npublic function setPostLike_post()\n{\n$this->form_validation->set_rules('auth_token', 'Token', 'required');\n$this->form_validation->set_rules('member_id', 'MemberID', 'required');\n$this->form_validation->set_rules('post_id', 'PostID', 'required');\n$this->form_validation->set_rules('like_status', 'Like Status', 'required');\n$this->form_validation->set_message('required', '%s is required');\nif ($this->form_validation->run() === FALSE) {\n$strip_message = strip_tags(validation_errors(\"\"));\n$this->response(array(\n\"status\" => FALSE,\n\"message\" => trim(preg_replace(\"/\\r\\n|\\r|\\n/\", ',', $strip_message), \",\"),\n'responseCode' => self::HTTP_BAD_REQUEST,\n), REST_Controller::HTTP_BAD_REQUEST);\n}\n$postId = $this->input->post('post_id');\n$MemberId = $this->input->post('member_id');\n$likeStatus = $this->input->post(\"like_status\");\n$existence = $this->Mdl_post->checkPostId($postId, $this->config->item('PostTable'));\nif ($existence['count'] == 0) {\n$this->response(array(\n\"status\" => FALSE,\n\"message\" => \"No Such Post Exist\",\n'responseCode' => self::HTTP_BAD_REQUEST,\n), REST_Controller::HTTP_BAD_REQUEST);\n}\n$recordExist = $this->Mdl_post->checkPostId($postId, $this->config->item('LikeTable'), $MemberId);\nif ($recordExist['count'] == 0) {\n$operation_status = \"insert\";\n$post_like_data = array(\n'member_id' => $MemberId,\n'post_id' => $postId,\n'is_liked' => $likeStatus,\n);\n} else {\n$operation_status = \"update\";\n$post_like_data = array(\n'member_id' => $MemberId,\n'post_id' => $postId,\n'is_liked' => $likeStatus,\n);\n}\n$likeResult = $this->Mdl_post->setPostLike($post_like_data, $operation_status);\nif ($likeResult == true) {\n$this->response(array(\n'status' => TRUE,\n'responseCode' => self::HTTP_OK,\n'message' => ($post_like_data['is_liked'] == 1) ? 'like' : \"unlike\",\n'no_of_like' => $this->Mdl_post->getNumberOfLikesByPostId($postId),\n), REST_Controller::HTTP_OK);\n} else {\n$this->response(array(\n\"status\" => FALSE,\n'responseCode' => self::HTTP_NOT_FOUND,\n'message' => \"Like Status ain't Changed\",\n'data' => null,\n), REST_Controller::HTTP_NOT_FOUND);\n}\n}"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "post_id",
            "defaultValue": "1",
            "description": "<p>The Post Id  for Deleting Post.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "like_status",
            "defaultValue": "1",
            "description": "<p>The Like Status passed from user's device.(Like or Unlike)</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "Api/SamajWebService/getSamajList",
    "title": "Samaj-List",
    "name": "Samaj_Listing",
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "string",
            "optional": false,
            "field": "API-KEY",
            "defaultValue": "123456",
            "description": "<p>API-KEY For User</p>"
          }
        ]
      }
    },
    "group": "Samaj",
    "version": "0.1.0",
    "success": {
      "examples": [
        {
          "title": "getSamajList",
          "content": "{\n\n          \"status\": true,\n          \"responseCode\": 200,\n          \"message\": \"Samaj Listing successfully\",\n          \"limit\": 10,\n          \"data\":\n                 [{\n                    \"samaj_id\": \"32\",\n                    \"samaj_name\": \"Hindu\",\n                    \"parent_samaj_id\": \"33\",\n                    \"parent_samaj\": \"\",\n                    \"short_description\": \"Hindu\",\n                    \"long_description\": \"<p>Hindu</p>\\n\",\n                    \"is_active\": \"1\"\n                 }\n              ]\n\n}",
          "type": "json"
        }
      ],
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "optional": false,
            "field": "status",
            "description": "<p>True or False based on successful response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "responseCode",
            "description": "<p>Different response code send according to response of api.</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "message",
            "description": "<p>The relevant message</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "limit",
            "description": "<p>The number of data to be retrieved</p>"
          },
          {
            "group": "Success 200",
            "optional": false,
            "field": "data",
            "description": "<p>return null array or appropriate data in array.</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "http://localhost/samaj/Api/SamajWebService/getSamajList"
      }
    ],
    "filename": "./SamajWebService.php",
    "groupTitle": "Samaj",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "auth_token",
            "defaultValue": "sytMwXCdvUwfqJUIjRhrU0RzKibmZa",
            "description": "<p>The auth token is the most commonly used type of token. This type of token is needed any time the app calls an API to read, modify or write data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "defaultValue": "1",
            "description": "<p>Member id pass from user device to get data.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "start",
            "defaultValue": "0",
            "description": "<p>The input number for paging purpose.</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "language_id",
            "defaultValue": "1",
            "description": "<p>The Language Id passed from user's device.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "400-RequiredParameter",
            "description": "<p>Required Parameter</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "401-InvalidAuthToken",
            "description": "<p>Invalid AuthToken</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "402-AuthTokenExpire",
            "description": "<p>Authtoken Expire</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "403-InvalidApiKey",
            "description": "<p>Invalid API Key</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "404-NoDataFound",
            "description": "<p>No Data Found</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "405-UnknownMethod",
            "description": "<p>Unknown Method</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Required Parameter",
          "content": "{\n \"status\": false,\n \"error\": \"User id is required,Token is required,Start is required,Limit is required\",\n \"responseCode\": 400,\n}",
          "type": "json"
        },
        {
          "title": "Invalid AuthToken",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid Token\",\n \"responseCode\": 401,\n}",
          "type": "json"
        },
        {
          "title": "AuthToken Expire",
          "content": "{\n \"status\": false,\n \"error\": \"Auth token Expire\",\n \"responseCode\": 402,\n}",
          "type": "json"
        },
        {
          "title": "Invalid API Key",
          "content": "{\n \"status\": false,\n \"error\": \"Invalid API key\",\n \"responseCode\": 403,\n}",
          "type": "json"
        },
        {
          "title": "No Data Found",
          "content": "{\n \"status\": false,\n \"error\": \"No Data Found\",\n \"responseCode\": 404,\n}",
          "type": "json"
        },
        {
          "title": "Unknown Method",
          "content": "{\n \"status\": false,\n \"error\": \"Unknown Method\",\n \"responseCode\": 405,\n}",
          "type": "json"
        }
      ]
    }
  }
] });
