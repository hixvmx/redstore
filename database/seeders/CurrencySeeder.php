<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            'دولار أمريكي',
            'يورو',
            'ين ياباني',
            'جنيه إسترليني',
            'دولار أسترالي',
            'دولار كندي',
            'فرنك سويسري',
            'يوان صيني',
            'كرونة سويدية',
            'دولار نيوزيلندي',
            'كرونة نرويجية',
            'روبية هندية',
            'ريال برازيلي',
            'راند جنوب أفريقي',
            'درهم إماراتي',
            'روبل روسي',
            'ليرة تركية',
            'دولار سنغافوري',
            'زلوتي بولندي',
            'وون كوري جنوبي',
            'بات تايلاندي',
            'بيزو مكسيكي',
            'رنجت ماليزي',
            'روبية إندونيسية',
            'ريال سعودي',
            'ريال قطري',
            'شيكل إسرائ'
        ];

        foreach ($currencies as $currency) {
            Currency::create([
                'name' => $currency,
            ]);
        }
    }
}
