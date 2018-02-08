# userAPI

Walks Frontend userAPI based upon "php": ">=5.6.4", "laravel/lumen-framework": "5.4.*"


# to bring up vagrant:
## On Mac
### Install brew
	https://brew.sh/

### Install Vagrant
http://sourabhbajaj.com/mac-setup/Vagrant/README.html
	Vagrant uses Virtualbox to manage the virtual dependencies. You can directly download virtualbox and install or use homebrew for it.

	$ brew cask install virtualbox
	Now install Vagrant either from the website or use homebrew for installing it.

	$ brew cask install vagrant
	Vagrant-Manager helps you manage all your virtual machines in one place directly from the menubar.

	$ brew cask install vagrant-manager

### Install homestead
https://laravel.com/docs/5.4/homestead

vagrant box add laravel/homestead

mkdir homestead

mkdir projects

cd homestead/

git clone git@github.com:laravel/homestead.git .

bash init.sh

vi Homestead.yaml 
```
---
ip: "192.168.10.10"
memory: 2048
cpus: 1
provider: virtualbox

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

# set this walks localDev to where you created your projects directory on the host
folders:
    - map: ~/localDev/projects
      to: /home/vagrant/projects

# for the guest vhost you want of local-WHATEVER.walks.org
# add the sites - map entries

sites:
    - map: local-userapi.walks.org
      to: /home/vagrant/projects/userapi/public

# Also dont forget to add the host /etc/hosts entry for:
# 192.168.10.10	local-WHATEVER.walks.org

databases:
    - homestead
    - woi_prod

# blackfire:
#     - id: foo
#       token: bar
#       client-id: foo
#       client-token: bar

# ports:
#     - send: 50000
#       to: 5000
#     - send: 7777
#       to: 777
#       protocol: udp

```

### to start the vm
vagrant up

### note: if you change your Homestead.yaml file later to add a new sites entry run "vagrant provision"

### to connect to you new vm
vagrant ssh

### to save that config so you can use it out side of the homestead dir
```
vagrant ssh-config
Host homestead-7
  HostName 127.0.0.1
  User vagrant
  Port 2200
  UserKnownHostsFile /dev/null
  StrictHostKeyChecking no
  PasswordAuthentication no
  IdentityFile /Users/dla/locker/walks/homestead/.vagrant/machines/homestead-7/virtualbox/private_key
  IdentitiesOnly yes
  LogLevel FATAL
  ForwardAgent yes
```

Add the output above to .ssh/config

then ssh homestead-7
  
## To get the db:
dla@util-db-relay:~$ sh /usr/local/bin/db-relay-full-prod-dla.sh

get a recient copy of the db:


### If this your first running of this box you might need to do this:
```
vagrant@homestead:~/projects/userapi/utils$ mysql -u root --password=secret mysql
CREATE USER 'walks_db'@'%' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON * . * TO 'walks_db'@'%';
FLUSH PRIVILEGES;

vagrant@homestead:~/projects/userapi/utils$ mysql -u root --password=secret woi_prod < woi_prod_latest.sql
```

## Check out the project
```
cd projects/

git clone git@github.com:takewalks/userAPI.git 

cd userAPI
cp .env-local-walks .env
composer install
```


# How this project was built
##  Lumen Install
https://lumen.laravel.com/docs/5.4/installation


## model generator
https://github.com/reliese/laravel

php artisan -vvv code:models --table=clients 


## test routes:
http://local-userapi.walks.org/v1/user/78050



## creating models, tables

/*
https://laravel.com/docs/master/migrations#running-migrations

php artisan make:migration create_client_social_provider_table 

vi create_client_social_provider_table

php artisan migrate

php artisan migrate:rollback

php artisan migrate:rollback --step=1

php artisan migrate:refresh
*/


## update existing models and tables

Say I need to add one column user_name to the clients table after the id
Create the migration file
php artisan make:migration update_clients_table 
vi database/migrations/2017_08_16_165922_update_clients_table


```
class UpdateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('user_name')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('user_name');
        });
    }
}
```

### do it
php artisan migrate

### Oops!  undo it!
php artisan migrate:rollback --step=1



# auth passport https://github.com/dusterio/lumen-passport

composer require dusterio/lumen-passport

vi .env
APP_KEY=base64:MsUJo+qAhIVGPx52r1mbxCYn5YbWtCx8FQ7pTaHEvRo=


# Create new tables for Passport
php artisan migrate

# Install encryption keys and other necessary stuff for Passport
php artisan passport:install



SELECT * FROM `oauth_clients`;

local keys
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client Secret: oug8G4X5IbD550ib4ST7XyOTF3Z2qdRmjwoSQ1Cq
Password grant client created successfully.
Client ID: 2
Client Secret: GaZnu4SrDlqSntNvOG5UAyk2PqBfrSvCfIj0o1FP
Client ID: 3
Client Secret: rGDrbfaIFIsqJm4myBZvM0Lkh8I0dzGdJfpazEvM

update oauth_clients set secret = 'rGDrbfaIFIsqJm4myBZvM0Lkh8I0dzGdJfpazEvM' where id = 3;

staging keys
Personal access client created successfully.
Client ID: 1
Client Secret: pRYXcAv1ctvtDiJDaLjKK7vuK0e3CiW99pk9Tt0i
Password grant client created successfully.
Client ID: 2
Client Secret: 0RoHCDWwAMtifNALisjAHSKM8KCACi4yG9tfYifA
Client ID: 3
Client secret: Xq2cKRliAK3usM7uy2RABnNE91uh7kJcg8QSykJV


php artisan cache:clear 


## to save and restore tokens and such:

mysqldump -u walks_staging_db --password=V83eUel3c8Ri2Yok -h staging-db-main.local.walks woi_prod oauth_access_tokens oauth_auth_codes oauth_clients oauth_personal_access_clients oauth_refresh_tokens > woi_prod_oauth_backup_staging.sql

mysql -u walks_staging_db --password=V83eUel3c8Ri2Yok -h staging-db-main.local.walks woi_prod  <  woi_prod_oauth_backup_staging.sql

## to add a personal account to apiuser
INSERT INTO `api_users` VALUES (2,'api_user_internal','admins@walks.org','$2y$10$DR/LivKvB.3QnU.M.1idOOQR3xGXysrfc6jvbMhKx7aefBXHcyG8y','2017-08-10 19:49:50','2017-08-10 19:49:50');


grant_type:client_credentials
client_id:5
client_secret:{{client_secret}}
scope:*


# Documentation generation 
swagger-codegen generate -i userapi.json -l html -o swagger

## 
https://asciidoclive.com/edit/scratch/1

# Using the API



##	
## To get an access_token:
You will need to use your client id assigned = 3
and your staging client_secret = Xq2cKRliAK3usM7uy2RABnNE91uh7kJcg8QSykJV


This next call will generate a new access_token that is long lived so you should store the access_token you get and reuse it. 

```
curl -X POST "http://staging-userapi.walks.org/v1/oauth/token" -H "accept: application/json" -H "content-type: application/json" -d "{ \"grant_type\": \"client_credentials\", \"client_id\": 3, \"client_secret\": \"Xq2cKRliAK3usM7uy2RABnNE91uh7kJcg8QSykJV\", \"scope\": \"*\"}"


{"token_type":"Bearer","expires_in":31536000,"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFiMDBlMzU3NjVhNzU3MzBhNjBkYWYwYmQzZjU3MDUwNjA5MWMwN2I2ZTZlNDI5MWMxOGZmNDI2MDY4NGRmMjgyMWM0YjNkZDA4OGRiZmYyIn0.eyJhdWQiOiIzIiwianRpIjoiYWIwMGUzNTc2NWE3NTczMGE2MGRhZjBiZDNmNTcwNTA2MDkxYzA3YjZlNmU0MjkxYzE4ZmY0MjYwNjg0ZGYyODIxYzRiM2RkMDg4ZGJmZjIiLCJpYXQiOjE1MDI0MTU3MzIsIm5iZiI6MTUwMjQxNTczMiwiZXhwIjoxNTMzOTUxNzMyLCJzdWIiOiIiLCJzY29wZXMiOltdfQ.jpme2Mlm5H_Mtj84FYm91Ik8Ztd0TmcF-GjuyEsUXeCcYu-_QcGN1cKmTilzulvzeLxvU2YIwU12POaEV3kyBWyaksHVyK2q5FctanwoSaIZiQkMUM4oPwnSS9V_3F3wrwqLeYQuRBpCMhDpw8CR9kPiN5etGXsuxGckti_Fy8e13jaRWb-mWrAeWpcbUzsRcn4WPRvbCk_JPO7LcAQz1BJM7lhmB4bCUd_qD4pIG81hQF_2OIFbzJZbdbKy_6U6LcSfGLhR7cR7rz_22q1SZwZcQl47LqifTG736kXViaFIPnKQEZaqYjhK_a2BL3CHlqchtRxnx-HjHlqWFk8VXlRWFOQwGsfGJNfDmDZYhdj39Np-1MkbD-wqmi96E1W4amn1o7igvFrBc2qbxLekHCVJUZKp4vuX0nGPpMdG2QX1C1S869608lcEGk7oHqUZiOG1ZsFR-eoqCDcowY0FUbvnKdtvi7CnkRL0w2kft_OxFyeclORBBVjL3eDP6BD4Z5-cLef8CzcFRvmM5Xd_cmLOJJXenRnqqy0V6IgWEdcjgBPKGcsYJc9xG5v15O5q6acGeSWUlbw3tOhztpsi4hhFd8QAbGLd-IQueGuJDL7yLyln_w_m2j-hVZKhZzRjqP7P7kbMvNbcXg-1WtCNLdg6zGoozOvkApDWPLJE2eg"}
```


## How to use that access token:
Place the value of that access_token above into -H "Authorization: Bearer <access_token>" for every protected call.

Curl Request:
```
curl -X GET "http://staging-userapi.walks.org/v1/user/78050" -H "accept: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFiMDBlMzU3NjVhNzU3MzBhNjBkYWYwYmQzZjU3MDUwNjA5MWMwN2I2ZTZlNDI5MWMxOGZmNDI2MDY4NGRmMjgyMWM0YjNkZDA4OGRiZmYyIn0.eyJhdWQiOiIzIiwianRpIjoiYWIwMGUzNTc2NWE3NTczMGE2MGRhZjBiZDNmNTcwNTA2MDkxYzA3YjZlNmU0MjkxYzE4ZmY0MjYwNjg0ZGYyODIxYzRiM2RkMDg4ZGJmZjIiLCJpYXQiOjE1MDI0MTU3MzIsIm5iZiI6MTUwMjQxNTczMiwiZXhwIjoxNTMzOTUxNzMyLCJzdWIiOiIiLCJzY29wZXMiOltdfQ.jpme2Mlm5H_Mtj84FYm91Ik8Ztd0TmcF-GjuyEsUXeCcYu-_QcGN1cKmTilzulvzeLxvU2YIwU12POaEV3kyBWyaksHVyK2q5FctanwoSaIZiQkMUM4oPwnSS9V_3F3wrwqLeYQuRBpCMhDpw8CR9kPiN5etGXsuxGckti_Fy8e13jaRWb-mWrAeWpcbUzsRcn4WPRvbCk_JPO7LcAQz1BJM7lhmB4bCUd_qD4pIG81hQF_2OIFbzJZbdbKy_6U6LcSfGLhR7cR7rz_22q1SZwZcQl47LqifTG736kXViaFIPnKQEZaqYjhK_a2BL3CHlqchtRxnx-HjHlqWFk8VXlRWFOQwGsfGJNfDmDZYhdj39Np-1MkbD-wqmi96E1W4amn1o7igvFrBc2qbxLekHCVJUZKp4vuX0nGPpMdG2QX1C1S869608lcEGk7oHqUZiOG1ZsFR-eoqCDcowY0FUbvnKdtvi7CnkRL0w2kft_OxFyeclORBBVjL3eDP6BD4Z5-cLef8CzcFRvmM5Xd_cmLOJJXenRnqqy0V6IgWEdcjgBPKGcsYJc9xG5v15O5q6acGeSWUlbw3tOhztpsi4hhFd8QAbGLd-IQueGuJDL7yLyln_w_m2j-hVZKhZzRjqP7P7kbMvNbcXg-1WtCNLdg6zGoozOvkApDWPLJE2eg" 

Response:
{"code":200,"status":"success","data":{"user":{"id":78050,"fname":"Susanah","lname":"Doucet","email":"susanah21@gmail.com","address":"233 Prospect Place","city":"Brooklyn","state":"NY","zip":null,"createdate":"2012-02-05 20:09:02","countries_id":null,"mobile_number":null,"home_number":"3477876947","title":null,"account_status":"active","learned_about_walks":"Search Engine Browsing","is_subscribed":false,"last_time_logged_in":null,"last_ip_address_used":null,"last_purchase_date":null,"agents_id":null,"cookie_auth":null,"facebook_id":null,"contact_email":null,"guest":0,"audience_reward":null}}}
```

Note I put the swagger docs on the api itself:

Curl Request:
```
curl -X GET "http://staging-userapi.walks.org/v1/docs/swagger" -H "accept: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFiMDBlMzU3NjVhNzU3MzBhNjBkYWYwYmQzZjU3MDUwNjA5MWMwN2I2ZTZlNDI5MWMxOGZmNDI2MDY4NGRmMjgyMWM0YjNkZDA4OGRiZmYyIn0.eyJhdWQiOiIzIiwianRpIjoiYWIwMGUzNTc2NWE3NTczMGE2MGRhZjBiZDNmNTcwNTA2MDkxYzA3YjZlNmU0MjkxYzE4ZmY0MjYwNjg0ZGYyODIxYzRiM2RkMDg4ZGJmZjIiLCJpYXQiOjE1MDI0MTU3MzIsIm5iZiI6MTUwMjQxNTczMiwiZXhwIjoxNTMzOTUxNzMyLCJzdWIiOiIiLCJzY29wZXMiOltdfQ.jpme2Mlm5H_Mtj84FYm91Ik8Ztd0TmcF-GjuyEsUXeCcYu-_QcGN1cKmTilzulvzeLxvU2YIwU12POaEV3kyBWyaksHVyK2q5FctanwoSaIZiQkMUM4oPwnSS9V_3F3wrwqLeYQuRBpCMhDpw8CR9kPiN5etGXsuxGckti_Fy8e13jaRWb-mWrAeWpcbUzsRcn4WPRvbCk_JPO7LcAQz1BJM7lhmB4bCUd_qD4pIG81hQF_2OIFbzJZbdbKy_6U6LcSfGLhR7cR7rz_22q1SZwZcQl47LqifTG736kXViaFIPnKQEZaqYjhK_a2BL3CHlqchtRxnx-HjHlqWFk8VXlRWFOQwGsfGJNfDmDZYhdj39Np-1MkbD-wqmi96E1W4amn1o7igvFrBc2qbxLekHCVJUZKp4vuX0nGPpMdG2QX1C1S869608lcEGk7oHqUZiOG1ZsFR-eoqCDcowY0FUbvnKdtvi7CnkRL0w2kft_OxFyeclORBBVjL3eDP6BD4Z5-cLef8CzcFRvmM5Xd_cmLOJJXenRnqqy0V6IgWEdcjgBPKGcsYJc9xG5v15O5q6acGeSWUlbw3tOhztpsi4hhFd8QAbGLd-IQueGuJDL7yLyln_w_m2j-hVZKhZzRjqP7P7kbMvNbcXg-1WtCNLdg6zGoozOvkApDWPLJE2eg" 

Response:
{"swagger":"2.0","info":{"description":".","version":"1.0.0","title":"Walks User API","contact":{"email":"admins@walks.org"}} .....
```

And a html version:

Curl Request:
```
curl -X GET "http://staging-userapi.walks.org/v1/docs/html" -H "accept: application/json" -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImFiMDBlMzU3NjVhNzU3MzBhNjBkYWYwYmQzZjU3MDUwNjA5MWMwN2I2ZTZlNDI5MWMxOGZmNDI2MDY4NGRmMjgyMWM0YjNkZDA4OGRiZmYyIn0.eyJhdWQiOiIzIiwianRpIjoiYWIwMGUzNTc2NWE3NTczMGE2MGRhZjBiZDNmNTcwNTA2MDkxYzA3YjZlNmU0MjkxYzE4ZmY0MjYwNjg0ZGYyODIxYzRiM2RkMDg4ZGJmZjIiLCJpYXQiOjE1MDI0MTU3MzIsIm5iZiI6MTUwMjQxNTczMiwiZXhwIjoxNTMzOTUxNzMyLCJzdWIiOiIiLCJzY29wZXMiOltdfQ.jpme2Mlm5H_Mtj84FYm91Ik8Ztd0TmcF-GjuyEsUXeCcYu-_QcGN1cKmTilzulvzeLxvU2YIwU12POaEV3kyBWyaksHVyK2q5FctanwoSaIZiQkMUM4oPwnSS9V_3F3wrwqLeYQuRBpCMhDpw8CR9kPiN5etGXsuxGckti_Fy8e13jaRWb-mWrAeWpcbUzsRcn4WPRvbCk_JPO7LcAQz1BJM7lhmB4bCUd_qD4pIG81hQF_2OIFbzJZbdbKy_6U6LcSfGLhR7cR7rz_22q1SZwZcQl47LqifTG736kXViaFIPnKQEZaqYjhK_a2BL3CHlqchtRxnx-HjHlqWFk8VXlRWFOQwGsfGJNfDmDZYhdj39Np-1MkbD-wqmi96E1W4amn1o7igvFrBc2qbxLekHCVJUZKp4vuX0nGPpMdG2QX1C1S869608lcEGk7oHqUZiOG1ZsFR-eoqCDcowY0FUbvnKdtvi7CnkRL0w2kft_OxFyeclORBBVjL3eDP6BD4Z5-cLef8CzcFRvmM5Xd_cmLOJJXenRnqqy0V6IgWEdcjgBPKGcsYJc9xG5v15O5q6acGeSWUlbw3tOhztpsi4hhFd8QAbGLd-IQueGuJDL7yLyln_w_m2j-hVZKhZzRjqP7P7kbMvNbcXg-1WtCNLdg6zGoozOvkApDWPLJE2eg" 

Response:
```
<!doctype html>
<html>
  <head>
    <title>Walks User API</title>
    <style type="text/css">
      body {
        font-family: Trebuchet MS, sans-serif;
        font-size: 15px;
        color: #444;
        margin-right: 24px;
}

h1      {
        font-size: 25px;
}
h2      {
        font-size: 20px;
}
h3      {
        font-size: 16px;
        font-weight: bold;
}
hr      {
        height: 1px;
        border: 0;
        color: #ddd;
        background-color: #ddd;
}
...
```




It's also located here:
https://github.com/takewalks/userAPI/blob/master/swagger/usersapi.adoc


## Documentation generation 
swagger-codegen generate -i userapi.json -l html -o .



# 


# Postman collection: #367 - Beta User Profile API : Implementation

Postman test docs:
https://restless-star-1637.postman.co/docs/collection/view/1420307-04623a82-e39f-5358-0eaf-177ad8aea85f


# how to add packages
http://blog.cloudoki.com/creating-a-lumen-package/

Add the package to:
composer.json 

"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Walks\\WapiConnect\\": "packages/walks/wapi-connect/src",
            "Walks\\Adestra\\": "packages/walks/adestra/src"

        }
    },


Add some top level deps:
composer require phpxmlrpc/phpxmlrpc

Might need to add some php land stuff.
apt-get install php7.0-curl

composer dumpautoload







