<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menu = [
            // Appetizers
            ['item_name' => 'Samosa', 'description' => 'Crispy fried pastries with savory filling', 'price' => 3000, 'category' => 'appetizer', 'status' => 'available'],
            ['item_name' => 'Spring Rolls', 'description' => 'Fresh vegetable spring rolls', 'price' => 3500, 'category' => 'appetizer', 'status' => 'available'],
            ['item_name' => 'Chicken Wings', 'description' => 'Spiced chicken wings', 'price' => 5000, 'category' => 'appetizer', 'status' => 'available'],

            // Main Courses
            ['item_name' => 'Matoke & Fish', 'description' => 'Traditional Ugandan dish with fried fish', 'price' => 12000, 'category' => 'main', 'status' => 'available'],
            ['item_name' => 'Ugali & Beans', 'description' => 'Corn meal with beans and vegetables', 'price' => 8000, 'category' => 'main', 'status' => 'available'],
            ['item_name' => 'Rice & Chicken Stew', 'description' => 'Fragrant rice with tender chicken', 'price' => 10000, 'category' => 'main', 'status' => 'available'],
            ['item_name' => 'Beef Soup', 'description' => 'Hearty beef soup with vegetables', 'price' => 9500, 'category' => 'main', 'status' => 'available'],
            ['item_name' => 'Grilled Tilapia', 'description' => 'Fresh grilled tilapia with lemon sauce', 'price' => 15000, 'category' => 'main', 'status' => 'available'],
            ['item_name' => 'Posho & Greens', 'description' => 'Corn porridge with collard greens', 'price' => 7500, 'category' => 'main', 'status' => 'available'],

            // Desserts
            ['item_name' => 'Banana Cake', 'description' => 'Moist banana cake', 'price' => 4000, 'category' => 'dessert', 'status' => 'available'],
            ['item_name' => 'Fruit Salad', 'description' => 'Fresh seasonal fruit salad', 'price' => 3000, 'category' => 'dessert', 'status' => 'available'],
            ['item_name' => 'Chocolate Mousse', 'description' => 'Rich chocolate mousse', 'price' => 5500, 'category' => 'dessert', 'status' => 'available'],

            // Beverages
            ['item_name' => 'Fresh Juice', 'description' => 'Fresh squeezed fruit juice', 'price' => 2000, 'category' => 'beverage', 'status' => 'available'],
            ['item_name' => 'Soft Drink', 'description' => 'Coca-Cola, Fanta, Sprite', 'price' => 1500, 'category' => 'beverage', 'status' => 'available'],
            ['item_name' => 'Coffee', 'description' => 'Hot coffee', 'price' => 1500, 'category' => 'beverage', 'status' => 'available'],
            ['item_name' => 'Tea', 'description' => 'Hot tea', 'price' => 1000, 'category' => 'beverage', 'status' => 'available'],
            ['item_name' => 'Smoothie', 'description' => 'Tropical fruit smoothie', 'price' => 3500, 'category' => 'beverage', 'status' => 'available'],
        ];

        foreach ($menu as $item) {
            Menu::create($item);
        }
    }
}
