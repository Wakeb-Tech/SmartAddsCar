<?php

use Illuminate\Database\Seeder;

class ModelClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //  $model_classes = ['Hyundai_accent', 'Hyundai_elantra', 'Hyundai_santafe', 'Hyundai_sonata', 'Hyundai_tucson', 'Toyota_camry', 'Toyota_corolla', 'Toyota_landcruiser', 'lexus_ES', 'lexus_GS', 'lexus_LS', 'lexus_gx'];
        $model_classes = [
            'Chevrolet_Malibo',
            'Ford_Expdition',
            'GMC_Yukon',
            'Hyundai_Accent',
            'Hyundai_Elantra',
            'Hyundai_Santafe',
            'Hyundai_Sonata',
            'Hyundai_Tucson',
            'Nessan_Maxima',
            'Nessan_Patrol',
            'Nessan_Pickup',
            'Nessan__Altima',
            'Toyota_Camry',
            'Toyota_Corolla',
            'Toyota_FJ',
            'Toyota_Fortunter',
            'Toyota_Hilux',
            'Toyota_Landcruiser',
            'Toyota_Rava4',
            'Toyota_Yaris',
            'kia_Cerato',
            'kia_Sportage',
            'lexus_ES',
            'lexus_GS',
            'lexus_LS',
            'lexus_GX'
            ];
        
        foreach ($model_classes as $model) {
            \App\ModelClass::create(['class_name' => $model,'model_id'=>1]);
        }
    }
}
