# How to name a pivot table in many-to-many in Laravel

The default naming convention of `Laravel` many-to-many pivot table is
`xxxxx_yyyyy`, where `xxxxx` and `yyyyy` are names of related tables, in
**singular** form, in **alphabetical** order.

**Example**: pivot table between `users` and `locations` should be called
`location_user`.

The wrong names would be `location_users` (because it's not singular) or
`user_location` (because "user" and "location" is not in alphabetical order).

If you follow those naming conventions, you can define the `belongsToMany`
relation without extra parameters:

**`app/Models/User.php`**

```php
public function locations()
{
    return $this->belongsToMany(Location::class);
}
```

If you name this table differently, you need to pass its name as a second
parameter:

```php
public function locations()
{
    return $this->belongsToMany(Location::class, 'users_locations');
}
```

---

```php
public function getCategories(){
     return $this->belongsToMany(Category::class,'post_categories','pct_pst_id','pct_ctg_id');
    // 'post_categories' is the pivot table
    // 'pct_pst_id' is foreign key present in post_categories of the current model
    // 'pct_ctg_id' is foreign key present in post_categories of the model we are relating with
}
```
