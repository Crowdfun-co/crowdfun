<?php
/**
 * @file
 * crowdfun.rules_defaults.inc
 */

/**
 * Implements hook_default_rules_configuration().
 */
function crowdfun_default_rules_configuration() {
  $items = array();
  $items['rules_create_user_account'] = entity_import('rules_config', '{ "rules_create_user_account" : {
      "LABEL" : "Create user account",
      "PLUGIN" : "reaction rule",
      "OWNER" : "rules",
      "REQUIRES" : [ "rules", "hybridauth" ],
      "ON" : { "hybridauth_identity_added" : [] },
      "DO" : [
        { "data_set" : {
            "data" : [ "hybridauth-user:field-first-name" ],
            "value" : "[hybridauth:firstName]"
          }
        },
        { "data_set" : {
            "data" : [ "hybridauth-user:field-last-name" ],
            "value" : "[hybridauth:lastName]"
          }
        },
        { "data_set" : {
            "data" : [ "hybridauth-user:field-summary" ],
            "value" : "[hybridauth:description]"
          }
        },
        { "data_set" : {
            "data" : [ "hybridauth-user:field-city" ],
            "value" : "[hybridauth:city]"
          }
        },
        { "data_set" : {
            "data" : [ "hybridauth-user:field-country" ],
            "value" : "[hybridauth:country]"
          }
        },
        { "hybridauth_dmy_to_date" : {
            "USING" : {
              "day" : "[hybridauth:birthDay]",
              "month" : "[hybridauth:birthMonth]",
              "year" : "[hybridauth:birthYear]"
            },
            "PROVIDE" : { "date" : { "birthday" : "Birthday" } }
          }
        },
        { "data_set" : {
            "data" : [ "hybridauth-user:field-birthday" ],
            "value" : [ "birthday" ]
          }
        }
      ]
    }
  }');
  return $items;
}
