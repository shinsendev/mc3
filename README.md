# Welcome to the MC² API

MC² is a research project about Hollywood Musicals.
MC3 is the new Symfony 5 API of the project. The project is available online here : http://api.mc2.website/api

## Start

```
make start
```

### Create fixtures

Only for dev environment.
```
make fixtures
```

### Deploy

````
make deploy
````

## Admin - Kelly

Kelly is the administration tool for managing imports and data of MC3.

### Commands

#### Create an admin

```
php bin/console admin:create
```

#### Change password

```
php bin/console admin:password newpassword
```

#### Delete admin
```
php bin/console admin:delete
```
