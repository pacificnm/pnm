<?php
return array(
    'CallLog\\V1\\Rest\\ClientCallLog\\Controller' => array(
        'entity' => array(
            'GET' => array(
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
            'PATCH' => array(
                'request' => '{
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
            'PUT' => array(
                'request' => '{
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
            'DELETE' => array(
                'request' => '{
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
        ),
        'collection' => array(
            'GET' => array(
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log"
       },
       "first": {
           "href": "/api/call-log?page={page}"
       },
       "prev": {
           "href": "/api/call-log?page={page}"
       },
       "next": {
           "href": "/api/call-log?page={page}"
       },
       "last": {
           "href": "/api/call-log?page={page}"
       }
   }
   "_embedded": {
       "client_call_log": [
           {
               "_links": {
                   "self": {
                       "href": "/api/call-log[/:callLogId]"
                   }
               }
              "callLogId": "",
              "clientId": "",
              "employeeId": "",
              "callLogTime": "",
              "callLogDetail": "",
              "callLogRequireCallBack": "",
              "callLogWillCallBack": "",
              "callLogVoiceMail": "",
              "callLogUrgent": "",
              "callLogRead": "",
              "callLogCreatedBy": ""
           }
       ]
   }
}',
            ),
            'POST' => array(
                'request' => '{
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
            'DELETE' => array(
                'request' => '{
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log"
       },
       "first": {
           "href": "/api/call-log?page={page}"
       },
       "prev": {
           "href": "/api/call-log?page={page}"
       },
       "next": {
           "href": "/api/call-log?page={page}"
       },
       "last": {
           "href": "/api/call-log?page={page}"
       }
   }
   "_embedded": {
       "client_call_log": [
           {
               "_links": {
                   "self": {
                       "href": "/api/call-log[/:callLogId]"
                   }
               }
              "callLogId": "",
              "clientId": "",
              "employeeId": "",
              "callLogTime": "",
              "callLogDetail": "",
              "callLogRequireCallBack": "",
              "callLogWillCallBack": "",
              "callLogVoiceMail": "",
              "callLogUrgent": "",
              "callLogRead": "",
              "callLogCreatedBy": ""
           }
       ]
   }
}',
            ),
        ),
    ),
    'CallLog\\V1\\Rest\\CallLog\\Controller' => array(
        'entity' => array(
            'GET' => array(
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
            'PUT' => array(
                'request' => '{
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
            'DELETE' => array(
                'request' => '{
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
            'POST' => array(
                'request' => '{
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log[/:callLogId]"
       }
   }
   "callLogId": "",
   "clientId": "",
   "employeeId": "",
   "callLogTime": "",
   "callLogDetail": "",
   "callLogRequireCallBack": "",
   "callLogWillCallBack": "",
   "callLogVoiceMail": "",
   "callLogUrgent": "",
   "callLogRead": "",
   "callLogCreatedBy": ""
}',
            ),
        ),
        'collection' => array(
            'GET' => array(
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log"
       },
       "first": {
           "href": "/api/call-log?page={page}"
       },
       "prev": {
           "href": "/api/call-log?page={page}"
       },
       "next": {
           "href": "/api/call-log?page={page}"
       },
       "last": {
           "href": "/api/call-log?page={page}"
       }
   }
   "_embedded": {
       "call_log": [
           {
               "_links": {
                   "self": {
                       "href": "/api/call-log[/:callLogId]"
                   }
               }
              "callLogId": "",
              "clientId": "",
              "employeeId": "",
              "callLogTime": "",
              "callLogDetail": "",
              "callLogRequireCallBack": "",
              "callLogWillCallBack": "",
              "callLogVoiceMail": "",
              "callLogUrgent": "",
              "callLogRead": "",
              "callLogCreatedBy": ""
           }
       ]
   }
}',
            ),
        ),
    ),
);
