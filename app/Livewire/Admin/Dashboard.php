<?php
namespace App\Livewire\Admin;

use App\Models\Course;
use App\Models\Metrics;
use App\Models\Organization;
use App\Models\User;
use App\Reporting\Metrics\Events;
use Illuminate\Support\Facades\DB;

class Dashboard extends AbstractComponent
{
    const DATASET = [
        'label' => '',
        'borderWidth' => 2,
        'borderColor' => '#cb0c9f',
        'pointRadius' => 2,
        'data' => [],
        'maxBarThickness' => 6,
    ];

    public function mount()
    {
        $this->userChartDataset();
    }

    public function render()
    {
        $totalEvents = Organization::all()->count();
        $totalUsers  = User::all()->count();
        $events = new Organization\Post();
        $upcomingEvents = $events->getPost();
        return view('dashboard', [
            'totalEvents' => Organization\Post::all()->count(),
            'totalUsers' => $totalUsers,
            'totalOrganizations' => Organization::all()->count(),
            'upcomingEvents' => $upcomingEvents->paginate(100),
            'organizations' => Organization\Post::paginate(5)
        ]);
    }

    public function userChartDataset()
    {
        $datasets = [];
        $labels = [];

        foreach (Course::all() as $course) {
            $dataset = self::DATASET;
            $dataset['label'] = $course->name;
            $users = DB::table('metrics')->select('*')
                ->where('code', '=', "users_$course->id")
                ->where('start_date', '>=', date('Y-m-d 00:00:00', strtotime('-6 days')))
                ->orderBy('start_date');
            foreach ($users->get() as $user) {
                $labels[] = date('Y-m-d' , strtotime($user->start_date));

                $dataset['data'][] = $user->total;
                $dataset['borderColor'] = $this->getColor();
            }

            $datasets[] = $dataset;
        }

        return json_encode(['datasets' => $datasets, 'labels' => array_unique($labels)]);
    }

    public function eventsChartDataset()
    {
        $datasets = [];
        $labels = [];
        $dataset = [];

        foreach (Organization::all() as $index => $org) {
            $data = DB::table('metrics')->select('*')
                ->where('code', '=', "events_org_$org->id")
                ->orderByDesc('start_date')->get()->first();
            if (empty($data)) {
                continue;
            }

            $labels[$index] = $org->name;

            $dataset['data'][] = $data->total;
        }
        $datasets[] = $dataset;

        return json_encode(['datasets' => $datasets, 'labels' => array_unique($labels)]);
    }

    public function getChartOrganizationsDataset()
    {
        $courses = Organization::query()->selectRaw('COUNT(*) as total, course_id, courses.name')
            ->leftJoin('courses', 'courses.id', '=', 'course_id')->groupByRaw('organization.course_id, courses.name')->get();

        $datasets = [];
        $labels = [];
        $dataset = [];
        foreach ($courses as $course) {
            $labels[] = $course->name ?? 'Open';
            $dataset['data'][] = $course->total;
        }

        $datasets[] = $dataset;
        return json_encode(['datasets' => $datasets, 'labels' => $labels]);
    }

    protected function getColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}
