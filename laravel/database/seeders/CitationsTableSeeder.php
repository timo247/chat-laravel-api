<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citations =
            [
                "Les arbres utiles sont coupés par les hommes, et les animaux utiles sont mangés.",
                "Qui vole une agrafe est mis à mort, mais qui vole une principauté en devient le seigneur.",
                "Si le bonheur implique la dépendance, on peut dire que la tourterelle en cage est heureuse.",
                "Lorsque les saints survinrent, ils plièrent et brisèrent les hommes par les rites et la musique, afin de rendre correcte leur attitude et pronnèrent la bonté et la justice pour apaiser les coeurs. Le peuple se tendit alors vers les passions, la quête du savoir et la course aux biens matériels, sans qu'on ne puisse y mettre un terme.",
                "L'aigle vole haut dans le ciel pour éviter les flèches et le mulot creuse profond dans la terre pour éviter d'être enfumé.",
                "Toute discussion amène une division, car les hommes discutent pour faire valoir leur opinion ",
                "Le renom n'est que le valet du réel.",
                "La vie humaine est limitée, le savoir est illimité. Qui subordonne sa vie limitée à la quête d'un savoir illimité va à l'épuisement. ",
                "Le lutteur commence le combat avec une attitude loyale et finit par user de coups bas.",
                "Un champignon qui ne vit qu'un matin n'a pas conscience de la durée qui sépare le matin et le soir.",
                "Même les personnes dotées d'une médiocre perspicacité deviennent d'excellents algébristes quand il s'agit d'étudier les problèmes personnels d'autrui. ",
                "Le temps peut faire des prêts mais exige des intérêts très importants à ceux qui sont trop pressés. ",
                "La mort et la vie,la durée et la destruction, la misère et la gloire, la pauvreté et la richesse, la sagesse et l'ignorance, le blâme et la louange, la faim et la soif, le froid et le chaud, voilà les vicissitudes alternantes des choses dont le cours constitue le destin.",
            ];

        for ($i = 0; $i < sizeof($citations); $i++) {
            DB::table('citations')->insert(
                [
                    'contenu' => $citations[$i]
                ]
            );
        }
    }
}
