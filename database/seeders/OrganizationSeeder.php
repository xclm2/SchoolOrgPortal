<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = [];
        foreach($this->getOrganizations() as $organization => $description) {
            $organizations[] = [
                'name' => $organization,
                'description' => $description,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('organization')->insert($organizations);
    }

    public function getOrganizations()
    {
        return [
            "Supreme Student Government(SSG)" => "The official governing body representing the student community, organizing school-wide events and addressing student concerns.",
            "Code Hex" => "A club for tech enthusiasts and aspiring developers, focused on coding, software development, and hackathons.",
            "Primera Bida" => "A performing arts group showcasing Filipino culture through theater, music, and dance.",
            "Kultura de Filipino" => "A cultural organization celebrating Filipino heritage through events, workshops, and exhibitions.",
            "Catholic/Scap BCC-unit" => "A Catholic group promoting faith and community service within the school.",
            "BCC Dance Company" => "An organization for dancers, offering opportunities to perform in various styles including modern, hip-hop, and cultural dance.",
            "BCC's Musicality" => "A club dedicated to musicians and singers, offering platforms for performances and musical expression.",
            "EL Teatro Artists" => "A theater group passionate about acting, directing, and stage production, performing plays and dramas.",
            "Crafty Creator" => "An art and crafts organization, encouraging creativity through various mediums like painting, sculpting, and DIY projects.",
            "BCC Drum Corps" => "A marching band specializing in drum and percussion performances for school events and parades.",
            "Gender United" => "An advocacy group that promotes gender equality, inclusivity, and awareness about LGBTQ+ issues.",
            "Cocina Elegante" => "A culinary club for aspiring chefs, offering workshops and cooking events to enhance culinary skills.",
            "Ink well Society" => "A club for writers and poets, providing a space for members to share and develop their written works.",
            "Ka Sangga- Squad" => "A support and outreach group focused on social services and community development programs.",
            "Speakiconics" => "A public speaking and debate club that trains students in effective communication and argumentation.",
            "The page turners" => "A reading club for book lovers, organizing book discussions and literary events.",
            "BCC Nightingales" => "An organization for aspiring nurses and healthcare students, providing peer support and community service opportunities.",
            "BCC'S Illustrator" => "A group for visual artists, specializing in illustration, design, and digital art.",
            "Christian Campus Ministry" => "A Christian organization that fosters spiritual growth and fellowship through Bible studies and worship services.",
            "BCC ACES" => "An academic excellence society that provides tutoring, workshops, and resources for students striving for high academic achievement."
        ];
    }
}
