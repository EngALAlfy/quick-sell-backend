<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key constraints to avoid conflicts during truncation
        Schema::disableForeignKeyConstraints();
        Client::truncate();
        Schema::enableForeignKeyConstraints();

        // Array of client data
        $clients = [
            ['name' => 'أحمد علي', 'contact_information' => 'القاهرة, 01234567890'],
            ['name' => 'محمد حسن', 'contact_information' => 'الجيزة, 01111222333'],
            ['name' => 'سارة محمود', 'contact_information' => 'الإسكندرية, 01099887766'],
            ['name' => 'إبراهيم سعيد', 'contact_information' => 'أسيوط, 01555444333'],
            ['name' => 'فاطمة أحمد', 'contact_information' => 'طنطا, 01233445566'],
            ['name' => 'ياسر عمر', 'contact_information' => 'المنصورة, 01066778899'],
            ['name' => 'منى يوسف', 'contact_information' => 'السويس, 01133445577'],
            ['name' => 'هشام علي', 'contact_information' => 'الأقصر, 01555667788'],
            ['name' => 'هبة خالد', 'contact_information' => 'الغردقة, 01222334455'],
            ['name' => 'عمرو عبد الله', 'contact_information' => 'قنا, 01122334488'],
            ['name' => 'محمود سالم', 'contact_information' => 'بني سويف, 01099887722'],
            ['name' => 'علي مصطفى', 'contact_information' => 'المنيا, 01555444344'],
            ['name' => 'إيمان عبد الرحمن', 'contact_information' => 'دمياط, 01144556677'],
            ['name' => 'خالد طارق', 'contact_information' => 'كفر الشيخ, 01299887744'],
            ['name' => 'هدى محمد', 'contact_information' => 'سوهاج, 01133445599'],
            ['name' => 'مصطفى عبد الكريم', 'contact_information' => 'مرسى مطروح, 01555667733'],
            ['name' => 'حسام عبد الله', 'contact_information' => 'بورسعيد, 01222334466'],
            ['name' => 'أسماء يوسف', 'contact_information' => 'الشرقية, 01199887700'],
            ['name' => 'عبد الرحمن أحمد', 'contact_information' => 'القليوبية, 01522334411'],
            ['name' => 'نوران سمير', 'contact_information' => 'الفيوم, 01044556688'],
            ['name' => 'زياد خالد', 'contact_information' => 'دمياط, 01233445577'],
            ['name' => 'ليلى حسين', 'contact_information' => 'الإسماعيلية, 01122334466'],
            ['name' => 'سامح إبراهيم', 'contact_information' => 'الأقصر, 01566778899'],
        ];

        // Insert clients using the create method
        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
