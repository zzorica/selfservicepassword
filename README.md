# selfservicepassword
Containerized PHP application for LDAP password management. User reset or change, reset by email or sms, enforce password security policy, security questions, set user ssh key etc.

* [Instalation](#installation)
* [Quickstart](#quickstart)
* [Kubernetes](#kubernetes)
* [Configuration parameters](#configuration-parameters)
---

## Introduction

Docker image that provides web interface to change and reset password in an LDAP directory. Base image is php:7.2-apache and PHP application is the one at https://github.com/ltb-project/self-service-password

## Installation

Use build image from Dockerhub:

```bash
docker pull zzorica/selfservicepassword:latest
```

Or you can build your own using this repo with:

```bash
docker build -t zzorica/selfservicepassword github.com/zzorica/selfservicepassword
```

## Quickstart

To start the container this is the minimum needed to pass to `docker run`. Of course generate your own string for `keyphrase`.
```bash
docker run -d -p 8080:80 -e SSP_KEYPHRASE="OoSaiFeeChee3jeiphai5Aevae1ahRie" --name ssp zzorica/selfservicepassword:latest
```
Now you can access it on `http://localhost:8080`. Rest of the variables and their defaults are in table below.

## Kubernetes

Example of kubernetes deployment of ssp service can be found in `examples/k8s` folder. All passwords are setup using secrets, and service is exposed via ClusterIP. You can access it for example via ingress. Depending on your cluster environment of course. Depending on your ingress rules don't forget to adjust apache variables to reflect those rules (`SSP_HOSTNAME` and `SSP_SERVER_PATH`).

Also `SSP_LOGO` and `SSP_BACKGROUND_IMAGE` environment variables are set to empty string so it doesn't use default images. Looks much cleaner.

## Configuration parameters

Variables are all taken from PHP app defined in the file `conf/config.inc.local.php` so take a look at that file, which is commented quite well, for any extra explanation. Some defaults are changed to reflect average use (in my opinion that is). So here is the list of all the env variables that are available to be passed to the container:

#### Variables related to apache setup
env variable | default | description
------------ | ------------- | -------------
SSP_HOSTNAME | localhost | apache `ServerName`
SSP_SERVER_PATH | /ssp | apache `ServerPath`

#### Variables related to selfservicepassword PHP application
env variable | default
------------ | -------------
SSP_LDAP_URL | ldap://localhost 
SSP_LDAP_STARTTLS | false
SSP_LDAP_BINDDN | cn=manager,dc=example,dc=com 
SSP_LDAP_BINDPW | secret 
SSP_LDAP_BASE | dc=example,dc=com 
SSP_LDAP_LOGIN_ATTRIBUTE | uid 
SSP_LDAP_FULLNAME_ATTRIBUTE | cn 
SSP_LDAP_FILTER | (&(objectClass=person)(uid={login})) 
SSP_AD_MODE | false | 
SSP_AD_OPTIONS_FORCE_UNLOCK | false
SSP_AD_OPTIONS_FORCE_PWD_CHANGE| false
SSP_AD_OPTIONS_CHANGE_EXPIRED_PASSWORD | false
SSP_SAMBA_MODE | false
SSP_SAMBA_OPTIONS_MIN_AGE | 5
SSP_SAMBA_OPTIONS_MAX_AGE | 45
SSP_SHADOW_OPTIONS_UPDATE_SHADOWLASTCHANGE | false
SSP_SHADOW_OPTIONS_UPDATE_SHADOWEXPIRE | false
SSP_SHADOW_OPTIONS_UPDATE_SHADOWEXPIREDAYS | false
SSP_HASH | ssha
SSP_HASH_OPTIONS_CRYPT_SALT_PREFIX | $6$
SSP_HASH_OPTIONS_CRYPT_SALT_LENGTH | 6
SSP_PWD_MIN_LENGTH | 6 
SSP_PWD_MAX_LENGTH |0 
SSP_PWD_MIN_LOWER | 1 
SSP_PWD_MIN_UPPER | 1 
SSP_PWD_MIN_DIGIT | 1 
SSP_PWD_MIN_SPECIAL | 0 
SSP_PWD_SPECIAL_CHARS | ^a-zA-Z0-9 
SSP_PWD_FORBIDDEN_CHARS | @% 
SSP_PWD_NO_REUSE | true | 
SSP_PWD_DIFF_LOGIN | true
SSP_PWD_COMPLEXITY | 3
SSP_USE_PWNEDPASSWORDS | true
SSP_PWD_SHOW_POLICY | never
SSP_PWD_SHOW_POLICY_POS | above
SSP_WHO_CHANGE_PASSWORD | user
SSP_USE_CHANGE | true
SSP_CHANGE_SSHKEY | true
SSP_CHANGE_SSHKEY_ATTRIBUTE | sshPublicKey
SSP_WHO_CHANGE_SSHKEY | user
SSP_NOTIFY_ON_SSHKEY_CHANGE | false
SSP_USE_QUESTIONS | false
SSP_ANSWER_OBJECTCLASS | extensibleObject
SSP_ANSWER_ATTRIBUTE | info 
SSP_CRYPT_ANSWERS | true
SSP_MESSAGES_QUESTIONS_ICE |
SSP_USE_TOKENS | true
SSP_CRYPT_TOKENS | true
SSP_TOKEN_LIFETIME | 3600
SSP_MAIL_ATTRIBUTE | mail
SSP_MAIL_ADDRESS_USE_LDAP | true
SSP_MAIL_FROM | admin@example.com 
SSP_MAIL_FROM_NAME | Self Service Password
SSP_MAIL_SIGNATURE |
SSP_NOTIFY_ON_CHANGE | false
SSP_MAIL_SENDMAIL | /usr/sbin/sendmail
SSP_MAIL_PROTOCOL | smtp
SSP_MAIL_SMTP_DEBUG | 0 
SSP_MAIL_DEBUG_FORMAT | error_log
SSP_MAIL_SMTP_HOST | localhost
SSP_MAIL_SMTP_AUTH | false
SSP_MAIL_SMTP_USER |  
SSP_MAIL_SMTP_PASS |  
SSP_MAIL_SMTP_PORT | 25
SSP_MAIL_SMTP_TIMEOUT | 30
SSP_MAIL_SMTP_KEEPALIVE | false
SSP_MAIL_SMTP_SECURE | tls
SSP_MAIL_SMTP_AUTOTLS | true
SSP_MAIL_CONTENTTYPE | text/plain 
SSP_MAIL_WORDWRAP | 0
SSP_MAIL_CHARSET | utf-8
SSP_MAIL_PRIORITY | 3
SSP_MAIL_NEWLINE |
SSP_USE_SMS | false
SSP_SMS_METHOD | mail
SSP_SMS_API_LIB | lib/smsapi.inc.php
SSP_SMS_ATTRIBUTE | mobile
SSP_SMS_PARTIALLY_HIDE_NUMBER | true
SSP_SMS_MAIL_TO | {sms_attribute}@service.provider.com
SSP_SMS_MAIL_SUBJECT | Provider code
SSP_SMS_MESSAGES | {smsresetmessage} {smstoken}
SSP_SMS_SANITIZE_NUMBER | false
SSP_SMS_TRUNCATE_NUMBER | false
SSP_SMS_TRUNCATE_NUMBER_LENGTH | 10
SSP_SMS_TOKEN_LENGTH | 6
SSP_MAX_ATTEMPTS | 3
SSP_KEYPHRASE | secret
SSP_RESET_URL |
SSP_SHOW_HELP | false
SSP_LANG | en
SSP_ALLOWED_LANG | 
SSP_SHOW_MENU | true |
SSP_LOGO | images/ltb-logo.png
SSP_BACKGROUND_IMAGE | images/unsplash-space.jpeg
SSP_RESET_REQUEST_LOG |
SSP_LOGIN_FORBIDDEN_CHARS | *()&\|
SSP_USE_RECAPTCHA | false |
SSP_RECAPTCHA_PUBLICKEY |
SSP_RECAPTCHA_PRIVATEKEY |
SSP_RECAPTCHA_THEME | light
SSP_RECAPTCHA_TYPE | image
SSP_RECAPTCHA_SIZE | normal
SSP_RECAPTCHA_REQUEST_METHOD | null
SSP_DEFAULT_ACTION | change
SSP_MESSAGES_PASSWRODCHANGED_EXTRAMESSAGE |
SSP_MESSAGES_CHANGEHELP_EXTRAMESSAGE |
SSP_POSTHOOK |
SSP_DISPLAY_POSTHOOK_ERROR |
SSP_OBSCURE_FAILURE_MESSAGES | mailnomatch
