<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use App\Models\Category;
use App\Models\SubCategory;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "name" => 'الإلكترونيات',
                "subcategories" => ['الهواتف الذكية', 'أجهزة اللابتوب', 'التلفزيونات', 'الأجهزة اللوحية', 'الأجهزة الصوتية', 'الكاميرات', 'الإكسسوارات الإلكترونية'],
            ],[
                "name" => 'الملابس والأزياء',
                "subcategories" => ['الرجال', 'النساء', 'الأطفال', 'الأحذية', 'الحقائب والإكسسوارات', 'الملابس الرياضية', 'الملابس الداخلية'],
            ],[
                "name" => 'المنزل والأثاث',
                "subcategories" => ['أثاث المطبخ', 'أثاث الغرفة', 'الديكورات', 'الأدوات المنزلية', 'الإضاءة', 'الحدائق والأماكن الخارجية', 'الأجهزة المنزلية'],
            ],[
                "name" => 'الجمال والعناية الشخصية',
                "subcategories" => ['مستحضرات التجميل', 'منتجات العناية بالبشرة', 'العطور', 'العناية بالشعر', 'العناية بالجسم', 'أدوات العناية الشخصية'],
            ],[
                "name" => 'الرياضة والتسلية',
                "subcategories" => ['اللياقة البدنية', 'الألعاب الرياضية', 'الرياضات الخارجية', 'أدوات ومعدات الرياضة', 'الملابس الرياضية', 'التخييم والرحلات'],
            ],[
                "name" => 'الكتب والأدب',
                "subcategories" => ['الكتب الروائية', 'الكتب التعليمية', 'كتب الأطفال', 'الأدب العلمي', 'كتب الطهي', 'الكتب الدينية', 'المجلات والصحف'],
            ],[
                "name" => 'الأدوات والمعدات',
                "subcategories" => ['أدوات البناء والتشييد', 'الأدوات اليدوية', 'الأدوات الكهربائية', 'اللحام والتلحيم', 'الأدوات الحدائقية', 'الأدوات الصحية', 'معدات الورش'],
            ],[
                "name" => 'الحيوانات الأليفة',
                "subcategories" => ['الطعام والتغذية', 'الأسرّة والمستلزمات', 'اللعب والتسلية', 'مستلزمات التدريب', 'الرعاية الصحية', 'الإكسسوارات والملابس'],
            ],[
                "name" => 'السفر والتنقل',
                "subcategories" => ['حقائب السفر', 'الأمتعة', 'الملحقات السفر', 'أدوات التنقل', 'ملابس وإكسسوارات الرحلات', 'معدات التخييم'],
            ],[
                "name" => 'الهدايا والتحف',
                "subcategories" => ['هدايا الأعياد', 'التحف والفنون', 'هدايا الزفاف', 'هدايا الشركات', 'هدايا الأطفال', 'التحف اليدوية', 'الهدايا الشخصية'],
            ]
        ];


        $count = 1;
        foreach ($categories as $category) {
            $categoryName = $category['name'];
            $subCategories = $category['subcategories'];

            Category::create([
                'name' => $categoryName,
            ]);

            $countPlusOne = $count++;
            foreach ($subCategories as $subCatego) {
                SubCategory::create([
                    'name' => $subCatego,
                    'category' => $countPlusOne,
                ]);
            }
        }
    }
}
