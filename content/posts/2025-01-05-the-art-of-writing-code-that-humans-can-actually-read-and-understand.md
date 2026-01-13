---
title: "The Art of Writing Code That Humans Can Actually Read and Understand"
date: 2025-01-05
excerpt: "Because code is read far more often than it's written."
---

# The Art of Writing Readable Code

Your code will be read hundreds of times. It will only be written once.

## Principles

### Name Things Well
```php
// Bad
$d = $u->calc($x);

// Good
$discount = $user->calculateLoyaltyDiscount($orderTotal);
```

### Keep Functions Small
If you need to scroll to see the whole function, it's too long.

### Comment the Why, Not the What
```php
// Bad: Increment counter
$counter++;

// Good: Compensate for zero-indexed array when displaying to users
$displayPosition = $index + 1;
```
