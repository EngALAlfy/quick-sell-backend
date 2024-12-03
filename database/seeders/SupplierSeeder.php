<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key constraints to avoid conflicts during truncate
        Schema::disableForeignKeyConstraints();
        Supplier::truncate();
        Schema::enableForeignKeyConstraints();

        // Array of supplier data
        $suppliers = [
            ['name' => 'شركة مصر للتجارة', 'contact_information' => 'القاهرة, 01234567890'],
            ['name' => 'النيل للمستلزمات', 'contact_information' => 'الجيزة, 01111222333'],
            ['name' => 'المتحدة للتوريدات', 'contact_information' => 'الإسكندرية, 01099887766'],
            ['name' => 'الأهرام للاستيراد', 'contact_information' => 'أسيوط, 01555444333'],
            ['name' => 'الدلتا للتوزيع', 'contact_information' => 'طنطا, 01233445566'],
            ['name' => 'العربية للتجارة', 'contact_information' => 'المنصورة, 01066778899'],
            ['name' => 'الشرق للمعدات', 'contact_information' => 'السويس, 01133445577'],
            ['name' => 'وادي النيل للتجارة', 'contact_information' => 'الأقصر, 01555667788'],
            ['name' => 'البحر الأحمر للتوريدات', 'contact_information' => 'الغردقة, 01222334455'],
            ['name' => 'صعيد مصر للتجارة', 'contact_information' => 'قنا, 01122334488'],
        ];

        // Insert suppliers using the create method
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
