<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## How to install
``` bash
- Clone the repository 
- composer install
- cp .env.example .env
- php artisan key:generate
- cd requisitions-api && sail up
```

### API 
Some examples for create and show, overall is a CRUD, so it has all the expected endpoints, is important to take in consideration that
ID's are hidden from to the outside, the API uses only UUID as unique identified, in the services and repository level only works with ids.
### Requisitions Create
``` JSON
Endpoint: laravel.test/api/requisitions
Method: post
Body:: {
    "name": "Requisition Test",
    "description": "Test description",
    "items": [
        {
            "name": "item test 1"
        },
        {
            "name": "item test 2"
        }
    ]
}

response: {
    "data": {
        "name": "Requisition Test",
        "description": "Test description",
        "uuid": "112925fe-d7cf-49b6-af1a-83af0111bf80",
        "updated_at": "2022-04-12T15:00:33.000000Z",
        "created_at": "2022-04-12T15:00:33.000000Z",
        "items": [
            {
                "reference": "f9aad01e-c9ef-48ea-bafd-29082ea2a3ad",
                "name": "item test 1",
                "created_at": "2022-04-12T15:00:33.000000Z",
                "updated_at": "2022-04-12T15:00:33.000000Z"
            },
            {
                "reference": "c81dce2e-062c-4f11-b075-272da9e33f1f",
                "name": "item test 2",
                "created_at": "2022-04-12T15:00:33.000000Z",
                "updated_at": "2022-04-12T15:00:33.000000Z"
            }
        ]
      },
     "status": 201,
     "api_version": "v1"
    }
```
### Requisitions show
``` JSON
Endpoint: laravel.test/api/requisitions/112925fe-d7cf-49b6-af1a-83af0111bf80
Method: GET
response: {
    data": {
        "name": "Requisition Test",
        "description": "Test description",
        "reference": "112925fe-d7cf-49b6-af1a-83af0111bf80",
        "updated_at": "2022-04-12T15:00:33.000000Z",
        "created_at": "2022-04-12T15:00:33.000000Z",
        "items": [
            {
                "reference": "f9aad01e-c9ef-48ea-bafd-29082ea2a3ad",
                "name": "item test 1",
                "created_at": "2022-04-12T15:00:33.000000Z",
                "updated_at": "2022-04-12T15:00:33.000000Z"
            },
            {
                "reference": "c81dce2e-062c-4f11-b075-272da9e33f1f",
                "name": "item test 2",
                "created_at": "2022-04-12T15:00:33.000000Z",
                "updated_at": "2022-04-12T15:00:33.000000Z"
            }
        ]
    },
    "status": 200,
    "api_version": "v1"
    }
```
### Items create
``` JSON
Endpoint: laravel.test/api/items
Method: post
Body: {
    "name": "Requisition Test",
    "requisition_uuid": "112925fe-d7cf-49b6-af1a-83af0111bf80"
}
response: {
    data": {
        "name": "Item Test",
        "reference": "a60768c6-deb5-4644-a663-91a46bd7a33a",
        "updated_at": "2022-04-12T15:27:59.000000Z",
        "created_at": "2022-04-12T15:27:59.000000Z",
        "requisition": {
            "uuid": "0ad58dfc-3a60-4ef1-9307-9b5f14c4623a",
            "name": "Requisition Test",
            "description": "Test description",
            "created_at": "2022-04-12T15:22:46.000000Z",
            "updated_at": "2022-04-12T15:22:46.000000Z"
        }
    },
    "status": 201,
    "api_version": "v1"
    }
```
### Items show
``` JSON
Endpoint: laravel.test/api/items/a60768c6-deb5-4644-a663-91a46bd7a33
Method: GET
response: {
    data": {
        "name": "Item Test",
        "reference": "a60768c6-deb5-4644-a663-91a46bd7a33a",
        "updated_at": "2022-04-12T15:27:59.000000Z",
        "created_at": "2022-04-12T15:27:59.000000Z",
        "requisition": {
            "uuid": "0ad58dfc-3a60-4ef1-9307-9b5f14c4623a",
            "name": "Requisition Test",
            "description": "Test description",
            "created_at": "2022-04-12T15:22:46.000000Z",
            "updated_at": "2022-04-12T15:22:46.000000Z"
        }
    },
    "status": 200,
    "api_version": "v1"
    }
```

## How to run tests

``` bash
sail php artisan test --testsuite=Feature
```
