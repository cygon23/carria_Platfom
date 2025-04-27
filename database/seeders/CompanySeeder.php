<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $company = Company::create([
            'name' => 'JA Africa',
            'about' => 'JA Africa is a global leader in cloud computing and AI solutions...',
            'offer' => 'We offer innovative cloud solutions, AI-powered analytics...',
            'location' => 'Arusha, TZ',
            'image_path' => 'assets/images/jobs/ia.jpg'
        ]);

        $company->jobPositions()->createMany([
            [
                'title' => 'Cloud Engineer',
                'description' => 'Join our team of cloud engineers...',
                'image_path' => 'assets/images/com/ai.jpg'
            ],
            [
                'title' => 'AI Research Specialist',
                'description' => 'Work on cutting-edge AI projects...',
                'image_path' => 'assets/images/com/ai1.jpg'
            ],
            [
                'title' => 'Data Scientist',
                'description' => 'Analyze big data and build models...',
                'image_path' => 'assets/images/com/ai2.jpg'
            ]
        ]);

    }
}
