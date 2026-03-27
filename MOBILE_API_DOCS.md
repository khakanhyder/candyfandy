# CandyFandy Mobile API Documentation

**Base URL:** `https://candyfandy.com/dev/index.php`
**API Version:** 1.0
**Format:** All responses are JSON
**Charset:** UTF-8

---

## Table of Contents

1. [Authentication](#1-authentication)
2. [Products](#2-products)
3. [Categories](#3-categories)
4. [Search](#4-search)
5. [Account](#5-account)
6. [Cart](#6-cart)
7. [Orders](#7-orders)
8. [Wishlist](#8-wishlist)
9. [Response Format](#9-response-format)
10. [Error Codes](#10-error-codes)

---

## Authentication

All protected endpoints require a Bearer token in the request header:

```
Authorization: Bearer <your_token_here>
```

Tokens are returned on login and registration. Tokens expire after **30 days**.

---

## 1. Authentication

### 1.1 Login

Authenticate a customer and receive an access token.

**Endpoint**
```
POST ?route=mobile/auth/login
```

**Request Headers**
```
Content-Type: application/x-www-form-urlencoded
```

**Request Body**
| Field    | Type   | Required | Description        |
|----------|--------|----------|--------------------|
| email    | string | Yes      | Customer email     |
| password | string | Yes      | Customer password  |

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/auth/login
Content-Type: application/x-www-form-urlencoded

email=john@example.com&password=secret123
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "token": "a3f8c2e1d4b7f9a0c3e6d8b1f2a4c7e9d0b3f5a8c1e4d7b0f2a5c8e1d4b7f0a2",
  "customer": {
    "customer_id": 5,
    "firstname": "John",
    "lastname": "Doe",
    "email": "john@example.com",
    "telephone": "+1234567890"
  }
}
```

**Error Response** `401 Unauthorized`
```json
{
  "success": false,
  "error": "Invalid email or password"
}
```

---

### 1.2 Register

Create a new customer account.

**Endpoint**
```
POST ?route=mobile/auth/register
```

**Request Headers**
```
Content-Type: application/x-www-form-urlencoded
```

**Request Body**
| Field     | Type   | Required | Description                    |
|-----------|--------|----------|--------------------------------|
| firstname | string | Yes      | First name (max 32 chars)      |
| lastname  | string | Yes      | Last name (max 32 chars)       |
| email     | string | Yes      | Valid email address            |
| telephone | string | Yes*     | Phone number (*if required)    |
| password  | string | Yes      | Password (min 4, max 40 chars) |
| confirm   | string | Yes      | Must match password            |

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/auth/register
Content-Type: application/x-www-form-urlencoded

firstname=John&lastname=Doe&email=john@example.com&telephone=1234567890&password=secret123&confirm=secret123
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "token": "a3f8c2e1d4b7f9a0c3e6d8b1f2a4c7e9d0b3f5a8c1e4d7b0f2a5c8e1d4b7f0a2",
  "customer_id": 12,
  "message": "Account created successfully"
}
```

**Validation Error Response** `422`
```json
{
  "success": false,
  "errors": {
    "email": "Email is already registered",
    "password": "Password must be between 4 and 40 characters"
  }
}
```

---

### 1.3 Logout

Invalidate the current access token.

**Endpoint**
```
POST ?route=mobile/auth/logout
```

**Request Headers**
```
Authorization: Bearer <token>
```

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/auth/logout
Authorization: Bearer a3f8c2e1d4b7f9a0...
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

---

## 2. Products

### 2.1 List Products

Returns a paginated list of products. No authentication required.

**Endpoint**
```
GET ?route=mobile/product
```

**Query Parameters**
| Parameter       | Type    | Required | Default      | Description                                      |
|-----------------|---------|----------|--------------|--------------------------------------------------|
| page            | integer | No       | 1            | Page number                                      |
| limit           | integer | No       | 20           | Items per page (max 100)                         |
| category_id     | integer | No       | —            | Filter by category ID                            |
| manufacturer_id | integer | No       | —            | Filter by brand/manufacturer ID                  |
| sort            | string  | No       | p.date_added | Sort field (p.name, p.price, p.date_added, p.sort_order) |
| order           | string  | No       | DESC         | Sort direction: ASC or DESC                      |

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/product&page=1&limit=20&category_id=25&sort=p.price&order=ASC
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "product_id": 101,
      "name": "Haribo Gold Bears",
      "model": "HRB-001",
      "sku": "SKU-HRB-001",
      "image": "https://candyfandy.com/dev/upload/image/catalog/products/haribo.jpg",
      "price": 2.99,
      "special": 1.99,
      "tax_class_id": 9,
      "quantity": 150,
      "rating": 4,
      "reviews": 23,
      "manufacturer": "Haribo",
      "date_available": "2024-01-01"
    }
  ],
  "pagination": {
    "page": 1,
    "limit": 20,
    "total": 85,
    "total_pages": 5
  }
}
```

---

### 2.2 Product Detail

Returns full details of a single product including images, options, reviews, and related products.

**Endpoint**
```
GET ?route=mobile/product/info
```

**Query Parameters**
| Parameter  | Type    | Required | Description |
|------------|---------|----------|-------------|
| product_id | integer | Yes      | Product ID  |

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/product/info&product_id=101
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": {
    "product_id": 101,
    "name": "Haribo Gold Bears",
    "model": "HRB-001",
    "sku": "SKU-HRB-001",
    "image": "https://candyfandy.com/dev/upload/image/catalog/products/haribo.jpg",
    "price": 2.99,
    "special": 1.99,
    "tax_class_id": 9,
    "quantity": 150,
    "rating": 4,
    "reviews": 23,
    "manufacturer": "Haribo",
    "date_available": "2024-01-01",
    "description": "<p>Classic Haribo Gold Bears in a 200g bag...</p>",
    "minimum": 1,
    "weight": "0.20",
    "weight_class": "kg",
    "length": "10.00",
    "width": "5.00",
    "height": "3.00",
    "length_class": "cm",
    "images": [
      "https://candyfandy.com/dev/upload/image/catalog/products/haribo-1.jpg",
      "https://candyfandy.com/dev/upload/image/catalog/products/haribo-2.jpg"
    ],
    "options": [
      {
        "product_option_id": 12,
        "name": "Size",
        "type": "select",
        "required": true,
        "values": [
          {
            "product_option_value_id": 34,
            "name": "200g",
            "image": "",
            "price": 0.00,
            "price_prefix": "+",
            "quantity": 100
          },
          {
            "product_option_value_id": 35,
            "name": "500g",
            "image": "",
            "price": 2.00,
            "price_prefix": "+",
            "quantity": 50
          }
        ]
      }
    ],
    "reviews": [
      {
        "author": "Jane S.",
        "rating": 5,
        "text": "Absolutely love these! Great quality.",
        "date_added": "2024-03-10"
      }
    ],
    "related": [
      {
        "product_id": 102,
        "name": "Haribo Worms",
        "image": "https://candyfandy.com/dev/upload/image/catalog/products/worms.jpg",
        "price": 2.49,
        "special": null
      }
    ]
  }
}
```

**Error Response** `400`
```json
{
  "success": false,
  "error": "Product not found"
}
```

---

## 3. Categories

### 3.1 List Categories

Returns categories. Pass `parent_id=0` (default) for top-level categories.

**Endpoint**
```
GET ?route=mobile/category
```

**Query Parameters**
| Parameter | Type    | Required | Default | Description                                  |
|-----------|---------|----------|---------|----------------------------------------------|
| parent_id | integer | No       | 0       | Parent category ID. 0 = top-level categories |

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/category
GET https://candyfandy.com/dev/upload/index.php?route=mobile/category&parent_id=20
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "category_id": 20,
      "parent_id": 0,
      "name": "Gummy Candy",
      "description": "All types of gummy and jelly candy",
      "image": "https://candyfandy.com/dev/upload/image/catalog/categories/gummy.jpg",
      "sort_order": 1
    },
    {
      "category_id": 21,
      "parent_id": 0,
      "name": "Chocolate",
      "description": "Premium chocolate bars and treats",
      "image": "https://candyfandy.com/dev/upload/image/catalog/categories/chocolate.jpg",
      "sort_order": 2
    }
  ]
}
```

---

### 3.2 Category Detail

Returns a single category with its child categories.

**Endpoint**
```
GET ?route=mobile/category/info
```

**Query Parameters**
| Parameter   | Type    | Required | Description |
|-------------|---------|----------|-------------|
| category_id | integer | Yes      | Category ID |

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/category/info&category_id=20
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": {
    "category_id": 20,
    "parent_id": 0,
    "name": "Gummy Candy",
    "description": "All types of gummy and jelly candy",
    "image": "https://candyfandy.com/dev/upload/image/catalog/categories/gummy.jpg",
    "sort_order": 1,
    "children": [
      {
        "category_id": 25,
        "name": "Gummy Bears",
        "image": "https://candyfandy.com/dev/upload/image/catalog/categories/bears.jpg"
      },
      {
        "category_id": 26,
        "name": "Gummy Worms",
        "image": "https://candyfandy.com/dev/upload/image/catalog/categories/worms.jpg"
      }
    ]
  }
}
```

---

## 4. Search

### 4.1 Search Products

Search products by keyword.

**Endpoint**
```
GET ?route=mobile/search
```

**Query Parameters**
| Parameter   | Type    | Required | Default | Description                                   |
|-------------|---------|----------|---------|-----------------------------------------------|
| q           | string  | Yes      | —       | Search keyword                                |
| page        | integer | No       | 1       | Page number                                   |
| limit       | integer | No       | 20      | Items per page (max 100)                      |
| category_id | integer | No       | —       | Limit search to a specific category           |
| description | integer | No       | 0       | Set to 1 to also search product descriptions  |

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/search&q=haribo&page=1&limit=20
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "query": "haribo",
  "data": [
    {
      "product_id": 101,
      "name": "Haribo Gold Bears",
      "model": "HRB-001",
      "image": "https://candyfandy.com/dev/upload/image/catalog/products/haribo.jpg",
      "price": 2.99,
      "special": 1.99,
      "rating": 4,
      "reviews": 23
    }
  ],
  "pagination": {
    "page": 1,
    "limit": 20,
    "total": 4,
    "total_pages": 1
  }
}
```

**Error Response** `400`
```json
{
  "success": false,
  "error": "Search query (q) is required"
}
```

---

## 5. Account

> All account endpoints require `Authorization: Bearer <token>`

### 5.1 Get Profile

**Endpoint**
```
GET ?route=mobile/account
```

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/account
Authorization: Bearer <token>
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": {
    "customer_id": 5,
    "firstname": "John",
    "lastname": "Doe",
    "email": "john@example.com",
    "telephone": "1234567890",
    "newsletter": false,
    "customer_group_id": 1,
    "date_added": "2024-01-15 10:30:00"
  }
}
```

---

### 5.2 Edit Profile

**Endpoint**
```
POST ?route=mobile/account/edit
```

**Request Body**
| Field     | Type   | Required | Description                            |
|-----------|--------|----------|----------------------------------------|
| firstname | string | Yes      | First name                             |
| lastname  | string | Yes      | Last name                              |
| telephone | string | No       | Phone number                           |
| newsletter| integer| No       | 1 = subscribed, 0 = not subscribed     |
| password  | string | No       | New password (leave empty to keep current) |
| confirm   | string | No*      | Required if password is provided       |

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/account/edit
Authorization: Bearer <token>
Content-Type: application/x-www-form-urlencoded

firstname=John&lastname=Smith&telephone=9876543210
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "message": "Profile updated successfully"
}
```

---

### 5.3 Get Addresses

**Endpoint**
```
GET ?route=mobile/account/addresses
```

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/account/addresses
Authorization: Bearer <token>
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "address_id": 3,
      "firstname": "John",
      "lastname": "Doe",
      "company": "",
      "address_1": "123 Candy Lane",
      "address_2": "Apt 4B",
      "city": "New York",
      "postcode": "10001",
      "zone": "New York",
      "zone_id": 3635,
      "country": "United States",
      "country_id": 223,
      "default": true
    }
  ]
}
```

---

### 5.4 Add Address

**Endpoint**
```
POST ?route=mobile/account/address_add
```

**Request Body**
| Field      | Type    | Required | Description       |
|------------|---------|----------|-------------------|
| firstname  | string  | Yes      | First name        |
| lastname   | string  | Yes      | Last name         |
| address_1  | string  | Yes      | Street address    |
| address_2  | string  | No       | Apartment / suite |
| company    | string  | No       | Company name      |
| city       | string  | Yes      | City              |
| postcode   | string  | No       | ZIP / postcode    |
| country_id | integer | Yes      | Country ID        |
| zone_id    | integer | No       | State/Zone ID     |
| default    | integer | No       | 1 = set as default|

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/account/address_add
Authorization: Bearer <token>
Content-Type: application/x-www-form-urlencoded

firstname=John&lastname=Doe&address_1=123 Candy Lane&city=New York&country_id=223&zone_id=3635&postcode=10001&default=1
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "address_id": 7,
  "message": "Address added"
}
```

---

## 6. Cart

> All cart endpoints require `Authorization: Bearer <token>`

### 6.1 Get Cart

**Endpoint**
```
GET ?route=mobile/cart
```

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/cart
Authorization: Bearer <token>
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": {
    "items": [
      {
        "cart_id": 14,
        "product_id": 101,
        "name": "Haribo Gold Bears",
        "model": "HRB-001",
        "image": "https://candyfandy.com/dev/upload/image/catalog/products/haribo.jpg",
        "quantity": 2,
        "price": 2.99,
        "total": 5.98,
        "options": [
          {
            "name": "Size",
            "value": "200g"
          }
        ]
      }
    ],
    "totals": [
      { "code": "sub_total", "title": "Sub-Total", "value": 5.98 },
      { "code": "shipping",  "title": "Flat Shipping Rate", "value": 5.00 },
      { "code": "total",     "title": "Total", "value": 10.98 }
    ],
    "total": 10.98,
    "item_count": 2,
    "has_shipping": true
  }
}
```

---

### 6.2 Add to Cart

**Endpoint**
```
POST ?route=mobile/cart/add
```

**Request Body**
| Field       | Type    | Required | Description                              |
|-------------|---------|----------|------------------------------------------|
| product_id  | integer | Yes      | Product ID to add                        |
| quantity    | integer | No       | Quantity (default: 1)                    |
| option      | array   | No       | Product options e.g. `option[12]=34`     |

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/cart/add
Authorization: Bearer <token>
Content-Type: application/x-www-form-urlencoded

product_id=101&quantity=2&option[12]=34
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "message": "Product added to cart",
  "data": { ... }
}
```

> `data` contains the full updated cart (same as Get Cart response)

---

### 6.3 Update Cart Item

**Endpoint**
```
POST ?route=mobile/cart/update
```

**Request Body**
| Field    | Type    | Required | Description                          |
|----------|---------|----------|--------------------------------------|
| cart_id  | integer | Yes      | Cart item ID (from Get Cart response)|
| quantity | integer | Yes      | New quantity. Send 0 to remove item  |

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/cart/update
Authorization: Bearer <token>
Content-Type: application/x-www-form-urlencoded

cart_id=14&quantity=3
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "message": "Cart updated",
  "data": { ... }
}
```

---

### 6.4 Remove Cart Item

**Endpoint**
```
POST ?route=mobile/cart/remove
```

**Request Body**
| Field   | Type    | Required | Description                          |
|---------|---------|----------|--------------------------------------|
| cart_id | integer | Yes      | Cart item ID (from Get Cart response)|

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/cart/remove
Authorization: Bearer <token>
Content-Type: application/x-www-form-urlencoded

cart_id=14
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "message": "Item removed from cart",
  "data": { ... }
}
```

---

### 6.5 Clear Cart

**Endpoint**
```
POST ?route=mobile/cart/clear
```

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/cart/clear
Authorization: Bearer <token>
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "message": "Cart cleared"
}
```

---

## 7. Orders

> All order endpoints require `Authorization: Bearer <token>`

### 7.1 List Orders

**Endpoint**
```
GET ?route=mobile/order
```

**Query Parameters**
| Parameter | Type    | Required | Default | Description              |
|-----------|---------|----------|---------|--------------------------|
| page      | integer | No       | 1       | Page number              |
| limit     | integer | No       | 10      | Orders per page (max 50) |

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/order&page=1&limit=10
Authorization: Bearer <token>
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "order_id": 88,
      "status": "Complete",
      "date_added": "2024-03-15 14:22:00",
      "total": "10.98",
      "currency_code": "USD",
      "products": 2
    }
  ],
  "pagination": {
    "page": 1,
    "limit": 10,
    "total": 3,
    "total_pages": 1
  }
}
```

---

### 7.2 Order Detail

**Endpoint**
```
GET ?route=mobile/order/info
```

**Query Parameters**
| Parameter | Type    | Required | Description |
|-----------|---------|----------|-------------|
| order_id  | integer | Yes      | Order ID    |

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/order/info&order_id=88
Authorization: Bearer <token>
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": {
    "order_id": 88,
    "invoice_no": "INV-2024-0088",
    "status": "Complete",
    "date_added": "2024-03-15 14:22:00",
    "payment_method": "Credit Card",
    "shipping_method": "Flat Rate",
    "payment_address": {
      "firstname": "John",
      "lastname": "Doe",
      "address_1": "123 Candy Lane",
      "city": "New York",
      "country": "United States"
    },
    "shipping_address": {
      "firstname": "John",
      "lastname": "Doe",
      "address_1": "123 Candy Lane",
      "city": "New York",
      "country": "United States"
    },
    "products": [
      {
        "order_product_id": 55,
        "product_id": 101,
        "name": "Haribo Gold Bears",
        "model": "HRB-001",
        "quantity": 2,
        "price": 2.99,
        "total": 5.98,
        "options": [
          { "name": "Size", "value": "200g" }
        ]
      }
    ],
    "totals": [
      { "code": "sub_total", "title": "Sub-Total", "value": 5.98 },
      { "code": "shipping",  "title": "Flat Shipping Rate", "value": 5.00 },
      { "code": "total",     "title": "Total", "value": 10.98 }
    ],
    "history": [
      {
        "status": "Pending",
        "comment": "",
        "date_added": "2024-03-15 14:22:00"
      },
      {
        "status": "Complete",
        "comment": "Your order has been shipped.",
        "date_added": "2024-03-16 09:10:00"
      }
    ],
    "comment": "Please leave at the door.",
    "currency_code": "USD",
    "currency_value": 1.0
  }
}
```

---

## 8. Wishlist

> All wishlist endpoints require `Authorization: Bearer <token>`

### 8.1 Get Wishlist

**Endpoint**
```
GET ?route=mobile/wishlist
```

**Example Request**
```http
GET https://candyfandy.com/dev/upload/index.php?route=mobile/wishlist
Authorization: Bearer <token>
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "data": [
    {
      "product_id": 101,
      "name": "Haribo Gold Bears",
      "model": "HRB-001",
      "image": "https://candyfandy.com/dev/upload/image/catalog/products/haribo.jpg",
      "price": 2.99,
      "special": 1.99,
      "rating": 4
    }
  ]
}
```

---

### 8.2 Add to Wishlist

**Endpoint**
```
POST ?route=mobile/wishlist/add
```

**Request Body**
| Field      | Type    | Required | Description |
|------------|---------|----------|-------------|
| product_id | integer | Yes      | Product ID  |

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/wishlist/add
Authorization: Bearer <token>
Content-Type: application/x-www-form-urlencoded

product_id=101
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "message": "Product added to wishlist"
}
```

---

### 8.3 Remove from Wishlist

**Endpoint**
```
POST ?route=mobile/wishlist/remove
```

**Request Body**
| Field      | Type    | Required | Description |
|------------|---------|----------|-------------|
| product_id | integer | Yes      | Product ID  |

**Example Request**
```http
POST https://candyfandy.com/dev/upload/index.php?route=mobile/wishlist/remove
Authorization: Bearer <token>
Content-Type: application/x-www-form-urlencoded

product_id=101
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "message": "Product removed from wishlist"
}
```

---

## 9. Response Format

All API responses follow this structure:

**Success**
```json
{
  "success": true,
  "data": { ... }
}
```

**Success with message**
```json
{
  "success": true,
  "message": "Action completed"
}
```

**Error**
```json
{
  "success": false,
  "error": "Human readable error message"
}
```

**Validation Error**
```json
{
  "success": false,
  "errors": {
    "field_name": "Error for this field",
    "email": "Email is already registered"
  }
}
```

---

---
11. Location

### 11.1 List Countries

Returns all active countries.

**Endpoint**
```
GET ?route=mobile/location/countries
```

**Success Response** `200 OK`
```json
{
  "success": true,
  "countries": [
    {
      "country_id": 223,
      "name": "United States",
      "iso_code_2": "US",
      "iso_code_3": "USA",
      "postcode_required": true
    }
  ]
}
```

---

### 11.2 List Zones (States)

Returns all zones/states for a given country.

**Endpoint**
```
GET ?route=mobile/location/zones
```

**Query Parameters**
| Parameter  | Type    | Required | Description |
|------------|---------|----------|-------------|
| country_id | integer | Yes      | Country ID  |

**Success Response** `200 OK`
```json
{
  "success": true,
  "country_id": 223,
  "zones": [
    {
      "zone_id": 3635,
      "name": "New York",
      "code": "NY"
    }
  ]
}
```

---

## 10. Error Codes


| HTTP Status | Meaning                                  |
|-------------|------------------------------------------|
| 200         | Success                                  |
| 400         | Bad request / missing required parameter |
| 401         | Unauthorized — token missing or expired  |
| 422         | Validation error — check `errors` field  |

---

## Quick Reference

| Method | Endpoint                          | Auth | Description           |
|--------|-----------------------------------|------|-----------------------|
| POST   | `mobile/auth/login`               | No   | Login                 |
| POST   | `mobile/auth/register`            | No   | Register              |
| POST   | `mobile/auth/logout`              | Yes  | Logout                |
| GET    | `mobile/product`                  | No   | List products         |
| GET    | `mobile/product/info`             | No   | Product detail        |
| GET    | `mobile/category`                 | No   | List categories       |
| GET    | `mobile/category/info`            | No   | Category detail       |
| GET    | `mobile/search`                   | No   | Search products       |
| GET    | `mobile/account`                  | Yes  | Get profile           |
| POST   | `mobile/account/edit`             | Yes  | Edit profile          |
| GET    | `mobile/account/addresses`        | Yes  | Get addresses         |
| POST   | `mobile/account/address_add`      | Yes  | Add address           |
| GET    | `mobile/cart`                     | Yes  | Get cart              |
| POST   | `mobile/cart/add`                 | Yes  | Add to cart           |
| POST   | `mobile/cart/update`              | Yes  | Update cart item      |
| POST   | `mobile/cart/remove`              | Yes  | Remove cart item      |
| POST   | `mobile/cart/clear`               | Yes  | Clear cart            |
| GET    | `mobile/order`                    | Yes  | List orders           |
| GET    | `mobile/order/info`               | Yes  | Order detail          |
| GET    | `mobile/wishlist`                 | Yes  | Get wishlist          |
| POST   | `mobile/wishlist/add`             | Yes  | Add to wishlist       |
| POST   | `mobile/wishlist/remove`          | Yes  | Remove from wishlist  |
| GET    | `mobile/location/countries`        | No   | List countries        |
| GET    | `mobile/location/zones`            | No   | List zones (states)   |


---

*For support contact the backend developer.*
