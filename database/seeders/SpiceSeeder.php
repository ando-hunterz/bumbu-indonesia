<?php

namespace Database\Seeders;

use App\Models\Spice;
use App\Models\SpicePhoto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SpiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            "Ginger",
            "Salam",
            "Clove"
        ];

        $name_translate = [
            "Jahe",
            "Daun Salam",
            "Cengkeh"
        ];

        $province_id = [
            21,
            19,
            32
        ];

        $description = [
            "Ginger is a flowering plant whose rhizome, ginger root or ginger, is widely used as a spice and a folk medicine. It is a herbaceous perennial which grows annual pseudostems about one meter tall bearing narrow leaf blades.",
            "romatic leaves used in Indonesian cooking similar in use to the bay leaf. Bay leaves are not a good substitute so try curry leaves which can be found in Indian grocery stores.  Although it is referred to sometimes as Indian Bay Leaf it is not the same thing.  Fresh salam leaves are best if picked and left off the tree and allowed to shrivel for a few days which helps to draw out the essential oils.",
            "Clover or trefoil are common names for plants of the genus Trifolium, consisting of about 300 species of flowering plants in the legume or pea family Fabaceae originating in Europe. The genus has a cosmopolitan distribution with highest diversity in the temperate Northern Hemisphere, but many species also occur in South America and Africa, including at high altitudes on mountains in the tropics.",
        ];

        $photo_url = [
            "/img/ginger.jpg",
            "/img/salam.jpg",
            "/img/clove.jpg"
        ];

        $files = File::allFiles(public_path('img'));

        for($i = 0; $i < 3; $i++) 
        {
            $spice = Spice::create([
                'name' => $name[$i],
                'name_translate' => $name_translate[$i],
                'description' => $description[$i]
            ]);

            $spice->province()->attach($province_id[$i]);

            $spice->photos()->save(new SpicePhoto([
                'photo_url' => $photo_url[$i],
                'size' => $files[$i]->getSize(),
                'filename' => $files[$i]->getFilename()
            ]));
        };

    }
}
