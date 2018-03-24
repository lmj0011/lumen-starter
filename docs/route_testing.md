- reset migrations before running tests with `php artisan migrate:refresh`

- update the payload and base url as needed

GET `/api/v1/user`

```
curl -X GET http://localhost:8000/api/v1/user -H "Content-Type: application/json"
```

GET `/api/v1/user/{id}`

```
curl -X GET http://localhost:8000/api/v1/user/1 -H "Content-Type: application/json"
```

POST `/api/v1/user`

```
curl -X POST http://localhost:8000/api/v1/user -d '{"username":"tpain2105", "email":"tpain2105@gmails.com", "password":"password1"}' -H "Content-Type: application/json"
```

PUT `/api/v1/user/{id}`

```
curl -X PUT http://localhost:8000/api/v1/user/1 -d '{"username":"tpain2011", "email":"tpain2011@gmails.com"}' -H "Content-Type: application/json"
```

DELETE `/api/v1/user/{id}`

```
curl -X DELETE http://localhost:8000/api/v1/user/1 -H "Content-Type: application/json"
```
