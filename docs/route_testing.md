- reset migrations before running tests with `php artisan migrate:refresh`

- update the payload and base url as needed


POST `/api/v1/auth/login`

```
curl -X POST http://localhost:8000/api/v1/auth/login -d '{"email":"tpain2105@gmails.com", "password":"password1"}' -H "Content-Type: application/json"
```

POST `/api/v1/auth/logout`

```
curl -X POST http://localhost:8000/api/v1/auth/logout -H "Content-Type: application/json" -H "Authorization: Bearer <your-token>"
```

POST `/api/v1/auth/me`

```
curl -X POST http://localhost:8000/api/v1/auth/me -H "Content-Type: application/json" -H "Authorization: Bearer <your-token>"
```

POST `/api/v1/auth/refresh`

```
curl -X POST http://localhost:8000/api/v1/auth/refresh -H "Content-Type: application/json" -H "Authorization: Bearer <your-token>"
```

GET `/api/v1/user`

```
curl -X GET http://localhost:8000/api/v1/user -H "Content-Type: application/json" -H "Authorization: Bearer <your-token>"
```

GET `/api/v1/user/{id}`

```
curl -X GET http://localhost:8000/api/v1/user/1 -H "Content-Type: application/json" -H "Authorization: Bearer <your-token>"
```

POST `/api/v1/user`

```
curl -X POST http://localhost:8000/api/v1/user -d '{"username":"tpain2105", "email":"tpain2105@gmails.com", "password":"password1"}' -H "Content-Type: application/json" -H "Authorization: Bearer <your-token>"
```

PUT `/api/v1/user/{id}`

```
curl -X PUT http://localhost:8000/api/v1/user/1 -d '{"username":"tpain2011", "email":"tpain2011@gmails.com"}' -H "Content-Type: application/json" -H "Authorization: Bearer <your-token>"
```

DELETE `/api/v1/user/{id}`

```
curl -X DELETE http://localhost:8000/api/v1/user/1 -H "Content-Type: application/json" -H "Authorization: Bearer <your-token>"
```
