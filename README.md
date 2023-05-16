# laravel-api-permission

Permission application based on Laravel

### Description

You need to create the following structure:
  - Users
  - Roles
  - Permissions

Conditions:
1) User can have roles and can have permissions.
2) Role can have permissions.

It is important to make good connections in Eloquent models.
Create some test users with assigned roles and permissions.
Frontend is not needed.
You can make several API endpoints where roles and rights for user will be assigned.

It is also necessary to make an API where it will be:
  - output all roles of the selected user
  - display all permissions of the selected user

It will be a plus if you make a listener for assigning roles and permissions with recording changes to the log (you can make a table in the database or in a file).
You can use whatever you like, but make the roles and permissions system yourself.

### Installation

```sh
$ cd /path/to/htdocs
$ git clone https://github.com/volmir/laravel-api-permission.git
$ cd laravel-api-permission
```

### Usage

Run application in Postman. 
See export collection in **/docs** directory.
