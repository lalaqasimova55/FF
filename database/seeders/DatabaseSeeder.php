<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Test User
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Test Categories
        $categories = [
            ['name' => 'İş', 'color' => '#3b82f6'],
            ['name' => 'Şəxsi', 'color' => '#ef4444'],
            ['name' => 'Layihə', 'color' => '#10b981'],
            ['name' => 'Sağlıq', 'color' => '#f59e0b'],
        ];

        $categoryModels = [];
        foreach ($categories as $cat) {
            $categoryModels[] = Category::create($cat);
        }

        // Test Tasks
        $tasks = [
            [
                'title' => 'Laravel Proyektini Tamamla',
                'description' => 'Task Management sistemi ilə CMS yaratmaq',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(5),
                'category_id' => $categoryModels[0]->id, // İş
            ],
            [
                'title' => 'Verilənlərin Bazasını Qur',
                'description' => 'MySQL verilənləri bazasını ayarlayıb migration-ları calaşdırmaq',
                'status' => 'completed',
                'deadline' => Carbon::now()->subDays(2),
                'category_id' => $categoryModels[0]->id, // İş
            ],
            [
                'title' => 'Blade Şablonlarını Yaz',
                'description' => 'Bütün görünüşləri (views) Blade-də yaza bilmək',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(3),
                'category_id' => $categoryModels[2]->id, // Layihə
            ],
            [
                'title' => 'Sporti Yerinə Yetir',
                'description' => 'Gün ərzində 30 dəqiqə idman etmək',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(1),
                'category_id' => $categoryModels[3]->id, // Sağlıq
            ],
            [
                'title' => 'Kitab Oxu',
                'description' => 'Yeni kitabdan 50 səhifə oxumaq',
                'status' => 'completed',
                'deadline' => Carbon::now()->addWeek(),
                'category_id' => $categoryModels[1]->id, // Şəxsi
            ],
            [
                'title' => 'API Endpoint-ləri Yarat',
                'description' => 'Bütün CRUD əməliyyatları üçün API qaymaqlarını açmaq',
                'status' => 'pending',
                'deadline' => Carbon::now()->addDays(7),
                'category_id' => $categoryModels[0]->id, // İş
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
