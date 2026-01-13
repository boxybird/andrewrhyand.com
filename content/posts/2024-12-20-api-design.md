---
title: "API Design"
date: 2024-12-20
excerpt: "Principles for building APIs that developers love."
---

# API Design

## Core Principles

### Be Consistent
Pick conventions and stick to them. `snake_case` or `camelCase`—just be consistent.

### Use HTTP Semantics
- `GET` for reading
- `POST` for creating
- `PUT/PATCH` for updating
- `DELETE` for deleting

### Return Useful Errors
```json
{
  "error": "validation_failed",
  "message": "The email field is required.",
  "field": "email"
}
```

### Version Your API
`/api/v1/users` gives you room to evolve.
