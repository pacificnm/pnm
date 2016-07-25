<?php
return array(
    'CallLogNote\\V1\\Rest\\CallLogNote\\Controller' => array(
        'collection' => array(
            'GET' => array(
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log-note"
       },
       "first": {
           "href": "/api/call-log-note?page={page}"
       },
       "prev": {
           "href": "/api/call-log-note?page={page}"
       },
       "next": {
           "href": "/api/call-log-note?page={page}"
       },
       "last": {
           "href": "/api/call-log-note?page={page}"
       }
   }
   "_embedded": {
       "call_log_note": [
           {
               "_links": {
                   "self": {
                       "href": "/api/call-log-note[/:call_log_note_id]"
                   }
               }
              "callLogNoteId": "",
              "callLogId": "",
              "callLogNoteText": "",
              "callLogNoteCreateBy": "",
              "callLogCreated": ""
           }
       ]
   }
}',
            ),
        ),
        'entity' => array(
            'GET' => array(
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log-note[/:call_log_note_id]"
       }
   }
   "callLogNoteId": "",
   "callLogId": "",
   "callLogNoteText": "",
   "callLogNoteCreateBy": "",
   "callLogCreated": ""
}',
            ),
            'PUT' => array(
                'request' => '{
   "callLogNoteId": "",
   "callLogId": "",
   "callLogNoteText": "",
   "callLogNoteCreateBy": "",
   "callLogCreated": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log-note[/:call_log_note_id]"
       }
   }
   "callLogNoteId": "",
   "callLogId": "",
   "callLogNoteText": "",
   "callLogNoteCreateBy": "",
   "callLogCreated": ""
}',
            ),
            'DELETE' => array(
                'request' => '{
   "callLogNoteId": "",
   "callLogId": "",
   "callLogNoteText": "",
   "callLogNoteCreateBy": "",
   "callLogCreated": ""
}',
                'response' => '{
   "_links": {
       "self": {
           "href": "/api/call-log-note[/:call_log_note_id]"
       }
   }
   "callLogNoteId": "",
   "callLogId": "",
   "callLogNoteText": "",
   "callLogNoteCreateBy": "",
   "callLogCreated": ""
}',
            ),
            'POST' => array(
                'request' => '{
   "callLogNoteId": "",
   "callLogId": "",
   "callLogNoteText": "",
   "callLogNoteCreateBy": "",
   "callLogCreated": ""
}',
            ),
        ),
    ),
);
