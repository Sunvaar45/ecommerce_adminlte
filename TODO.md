product attributes system:
    attributes (id, name, type)
    product_attribute_values (id, product_id, attribute_id, value)

?price and discount system
    // products table  
    $table->decimal('price', 10, 2);

    // separate discounts table
    $table->foreignId('product_id');
    $table->enum('type', ['percentage', 'fixed']);
    $table->decimal('value', 10, 2);
    $table->datetime('start_date')->nullable();
    $table->datetime('end_date')->nullable();

?inventory/stock managment