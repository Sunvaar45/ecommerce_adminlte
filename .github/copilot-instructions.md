# E-commerce AdminLTE - AI Assistant Guidelines

## Architecture Overview

This is a Laravel-based e-commerce admin panel using AdminLTE 3 theme. The system manages products, categories, attributes, and images with a **soft-delete pattern** where `status` column controls visibility:
- `0`: Inactive 
- `1`: Active
- `2`: Soft-deleted

## Core Data Model

**Hierarchical Structure**: Categories → Products → Images/Attributes
- `categories` (id, name, sort_order, status)
- `products` (id, name, description, price, has_discount, discount_price, stock, category_id, status)
- `product_images` (id, product_id, image_url, is_main, sort_order, status) 
- `attributes` (id, name, type, status)
- `product_attribute_values` (id, product_id, attribute_id, value, sort_order, status)

## Critical Patterns

### 1. Soft Delete System
**Always use `AdminActionsController`** for deletions - it implements cascade soft-deleting:
```php
// CORRECT: Uses cascade logic
Route::get('/delete/{table}/{id}', [AdminActionsController::class, 'delete'])

// The controller handles:
// - Categories: soft-deletes products + their images/attributes  
// - Products: soft-deletes images + attribute values
// - Attributes: soft-deletes associated product attribute values
```

### 2. Custom Blade Components
**All forms use reusable components** with array-based naming for bulk updates:
```php
// Standard pattern for editing lists:
<x-text-input 
    :namePrefixBracket="'products[' . $i . ']'"
    :namePrefixDot="'products.' . $i . '.'"
    :column="'name'"
    :model="$product"
    :required="true"
/>
```

**Available components**: `x-text-input`, `x-dropdown-input`, `x-price-input`, `x-checkbox-input`, `x-textarea-input`, `x-integer-input`, `x-toggle-state`, `x-remove-button`, `x-add-button`, `x-update-buttons`

### 3. Controller Pattern
**Edit + Update pattern** for all CRUD operations:
- `edit()`: Display forms with existing data + new record row
- `update()`: Handle both bulk updates and new record creation
- Use `$request->has('add')` to detect new record submissions

### 4. File Upload Handling
**Use the `handleFileUpload` trait**:
```php
use App\handleFileUpload;

class Controller extends Controller {
    use handleFileUpload;
    
    protected function handleImageUpload($request, 'image', 'product-images', $oldFileName)
}
```

## Route Structure
- All admin routes prefixed with `/admin/`
- Admin actions (delete, toggle) use `/admin-actions/` prefix
- RESTful but simplified: only `edit` (GET) and `update` (POST)

## Development Commands
```bash
# Laravel development server
php artisan serve

# Database migrations
php artisan migrate
php artisan migrate:fresh --seed

# Clear caches
php artisan config:clear
php artisan view:clear
```

## Key Files to Reference
- `app/Http/Controllers/AdminActionsController.php` - Soft delete logic
- `routes/web.php` - Route patterns
- `config/defaults.php` - Default values for new records
- `resources/views/components/` - Reusable form components
- Database migrations for schema understanding

## Status Field Convention
**Always query non-deleted records**: `whereIn('status', [0, 1])` to exclude soft-deleted (status=2) records. Use `AdminActionsController::setActiveState()` for toggling active/inactive status.
