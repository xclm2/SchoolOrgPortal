<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = [];
        $users = DB::table('users')->where('role','!=', 'admin')->get('id');
        foreach ($users as $user) {
            $userIds[] = $user->id;
        }

        $userIds = array_flip($userIds);

        $orgIds = [];
        $organizations = DB::table('organization')->get('id');
        foreach($organizations as $organization) {
            $orgIds[] = $organization->id;
        }

        $members = [];

        do {
            foreach($orgIds as $orgId) {
                if (empty($userIds)) {
                    break;
                }

                $userID = array_rand($userIds);
                $members[] = ['organization_id' => $orgId, 'user_id' => $userID];
                unset($userIds[$userID]);
            }
        } while (! empty($userIds));

        DB::table('organization_member')->insert($members);
    }
}
