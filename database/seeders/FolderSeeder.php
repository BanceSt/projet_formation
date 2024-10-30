<?php

namespace Database\Seeders;

use App\Models\Folder;
use App\Models\In_folder;
use App\Models\Story;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $folders_names = [];
        $in_folder_couple = [];

        // Création de Dossiers.
        $folders  = Folder::factory(100)->make();

        // Vérification que chaque dossier à un nom uniquer par utilisateur
        foreach ($folders as $folder) {
            // le dossier a déjà été rencontrer
            if (isset($folders_names[$folder->id])) {

                $try = 0;
                $fail = true;
                $new_name = $folder->name;
                do {
                    if (!in_array($new_name, $folders_names[$folder->id])) {
                        $folders_names[$folder->id][] = $new_name;
                        $folder->name = $new_name;
                        $fail = false;
                        $try = 5;
                    }
                    $new_name = fake()->word();
                    $try++;
                } while ($try < 5);

                if ($fail) continue;

            } else {
                $folders_names[$folder->id] = [$folder->name];
            }
            $folder->save();
        };



        // Création de le relation dossier histoire
        $folders = Folder::all();
        foreach ($folders as $folder) {
            $qtn = fake()->numberBetween(0, 25);
            if ($qtn) {
                $storyIds = Story::inRandomOrder()->take($qtn)->pluck("id");
                $folder->stories()->attach($storyIds);
            }
        }

    //     foreach ($in_folders as $in_folder) {
    //         if (isset($in_folder_couple[$in_folder->story_id])) {
    //             $try = 0;
    //             $fail = true;
    //             $new_folder = $in_folder->folder_id;
    //             do {
    //                 if (!in_array($new_folder, $in_folder_couple[$in_folder->story_id])) {
    //                     $in_folder_couple[$in_folder->story_id][] = $new_folder;
    //                     $in_folder->folder_id = $new_folder;
    //                     $fail = false;
    //                     $try = 5;
    //                 }
    //                 $new_folder = Folder::inRandomOrder()->first()->id;
    //                 $try++;
    //             } while ($try < 5);

    //             if ($fail) continue;
    //         } else {
    //             $in_folder_couple[$in_folder->story_id] = [$in_folder->folder_id];
    //         }
    //         $in_folder->save();
    //     }
    }
}
