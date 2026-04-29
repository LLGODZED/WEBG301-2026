<?php

namespace Database\Seeders;

use App\Models\ConferenceSession;
use App\Models\Registration;
use App\Models\Room;
use App\Models\Speaker;
use App\Models\Track;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Registration::truncate();
        ConferenceSession::truncate();
        Room::truncate();
        Speaker::truncate();
        Track::truncate();
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $admin = User::create([
            'name' => 'Conference Administrator',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $students = collect([
            ['name' => 'Nguyen Minh Anh', 'email' => 'minhanh@student.edu.vn'],
            ['name' => 'Tran Bao Long', 'email' => 'baolong@student.edu.vn'],
            ['name' => 'Le Thu Ha', 'email' => 'thuha@student.edu.vn'],
            ['name' => 'Pham Gia Huy', 'email' => 'giahuy@student.edu.vn'],
            ['name' => 'Vo Khanh Linh', 'email' => 'khanhlinh@student.edu.vn'],
            ['name' => 'Hoang Duc Nam', 'email' => 'ducnam@student.edu.vn'],
            ['name' => 'Do Mai Chi', 'email' => 'maichi@student.edu.vn'],
            ['name' => 'Bui Quang Vinh', 'email' => 'quangvinh@student.edu.vn'],
        ])->mapWithKeys(function ($student) {
            $created = User::create([
                'name' => $student['name'],
                'email' => $student['email'],
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);

            return [$student['email'] => $created];
        });

        User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $rooms = collect([
            [
                'name' => 'Auditorium A',
                'building' => 'Main Conference Hall',
                'capacity' => 180,
                'description' => 'Large auditorium with stage, projector, sound system and livestream support.',
            ],
            [
                'name' => 'Room B101',
                'building' => 'Business School Block',
                'capacity' => 55,
                'description' => 'Medium classroom for theory-based sessions and group discussions.',
            ],
            [
                'name' => 'Lab C202',
                'building' => 'Technology Center',
                'capacity' => 36,
                'description' => 'Computer lab with developer workstations for hands-on programming workshops.',
            ],
            [
                'name' => 'Studio D3',
                'building' => 'Digital Media Building',
                'capacity' => 40,
                'description' => 'Interactive studio for UI/UX, presentation practice and design activities.',
            ],
            [
                'name' => 'Seminar E204',
                'building' => 'Library Wing',
                'capacity' => 32,
                'description' => 'Quiet seminar room for advanced technical discussions.',
            ],
            [
                'name' => 'Innovation Lab F1',
                'building' => 'Startup Hub',
                'capacity' => 45,
                'description' => 'Flexible room for project clinics, mentoring and teamwork activities.',
            ],
        ])->mapWithKeys(function ($room) {
            return [$room['name'] => Room::create($room)];
        });

        $speakers = collect([
            [
                'name' => 'Dr. Linh Nguyen',
                'email' => 'linh.nguyen@conference.edu.vn',
                'phone' => '0901 100 001',
                'bio' => 'Senior lecturer in web engineering, MVC architecture and PHP application development.',
            ],
            [
                'name' => 'Mr. Minh Tran',
                'email' => 'minh.tran@conference.edu.vn',
                'phone' => '0901 100 002',
                'bio' => 'Backend engineer specializing in Laravel, RESTful API design and application security.',
            ],
            [
                'name' => 'Ms. An Pham',
                'email' => 'an.pham@conference.edu.vn',
                'phone' => '0901 100 003',
                'bio' => 'Frontend developer focused on HTML5, CSS3, responsive layouts and accessible interfaces.',
            ],
            [
                'name' => 'Dr. Sara Lee',
                'email' => 'sara.lee@conference.edu.vn',
                'phone' => '0901 100 004',
                'bio' => 'Cloud and DevOps lecturer with experience in Docker-based deployment workflows.',
            ],
            [
                'name' => 'Prof. David Wilson',
                'email' => 'david.wilson@conference.edu.vn',
                'phone' => '0901 100 005',
                'bio' => 'Database systems professor teaching ERD design, normalization and SQL optimization.',
            ],
            [
                'name' => 'Ms. Mai Le',
                'email' => 'mai.le@conference.edu.vn',
                'phone' => '0901 100 006',
                'bio' => 'Agile coach helping student teams plan, track and present software projects effectively.',
            ],
            [
                'name' => 'Mr. Hoang Pham',
                'email' => 'hoang.pham@conference.edu.vn',
                'phone' => '0901 100 007',
                'bio' => 'Software architect focusing on clean controllers, service layers and maintainable code.',
            ],
            [
                'name' => 'Ms. Rachel Chen',
                'email' => 'rachel.chen@conference.edu.vn',
                'phone' => '0901 100 008',
                'bio' => 'Product designer teaching user stories, site maps and evidence-based interface design.',
            ],
        ])->mapWithKeys(function ($speaker) {
            return [$speaker['name'] => Speaker::create($speaker)];
        });

        $tracks = collect([
            [
                'name' => 'Laravel & PHP Development',
                'color' => '#dc2626',
                'description' => 'MVC, routing, controllers, Blade views, validation and Laravel best practices.',
            ],
            [
                'name' => 'Database & ERD Design',
                'color' => '#16a34a',
                'description' => 'Relational database design, entity relationships, migrations and practical SQL.',
            ],
            [
                'name' => 'Frontend & User Experience',
                'color' => '#2563eb',
                'description' => 'HTML5, CSS3, responsive design, usability and JavaScript interaction.',
            ],
            [
                'name' => 'API & JavaScript Integration',
                'color' => '#7c3aed',
                'description' => 'REST API endpoints, JSON responses and consuming APIs with JavaScript.',
            ],
            [
                'name' => 'DevOps & Deployment',
                'color' => '#ea580c',
                'description' => 'Docker, environment variables, database containers and deployment preparation.',
            ],
            [
                'name' => 'Project Defense & Teamwork',
                'color' => '#0891b2',
                'description' => 'User stories, report evidence, source code explanation and public defense practice.',
            ],
        ])->mapWithKeys(function ($track) {
            return [$track['name'] => Track::create($track)];
        });

        $sessions = [
            [
                'title' => 'Opening Keynote: Building a Realistic Conference Scheduler',
                'description' => 'Overview of the conference timetable problem, core entities, user roles and project grading expectations.',
                'date' => '2026-05-18',
                'start' => '08:00',
                'end' => '09:00',
                'room' => 'Auditorium A',
                'speaker' => 'Dr. Linh Nguyen',
                'track' => 'Project Defense & Teamwork',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 160,
            ],
            [
                'title' => 'User Stories and Requirement Prioritization Workshop',
                'description' => 'Students convert real scheduling needs into user stories with clear roles, goals and acceptance criteria.',
                'date' => '2026-05-18',
                'start' => '09:15',
                'end' => '10:45',
                'room' => 'Studio D3',
                'speaker' => 'Ms. Rachel Chen',
                'track' => 'Project Defense & Teamwork',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 36,
            ],
            [
                'title' => 'ERD Design for Rooms, Speakers, Sessions and Registrations',
                'description' => 'Hands-on ERD design covering one-to-many and many-to-many relationships in the scheduler database.',
                'date' => '2026-05-18',
                'start' => '09:15',
                'end' => '10:45',
                'room' => 'Room B101',
                'speaker' => 'Prof. David Wilson',
                'track' => 'Database & ERD Design',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 50,
            ],
            [
                'title' => 'Laravel Routing, Controllers and Blade Views',
                'description' => 'Practical implementation of routes, resource controllers and reusable Blade layouts for the web application.',
                'date' => '2026-05-18',
                'start' => '11:00',
                'end' => '12:30',
                'room' => 'Lab C202',
                'speaker' => 'Mr. Minh Tran',
                'track' => 'Laravel & PHP Development',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 34,
            ],
            [
                'title' => 'Responsive Timetable UI with HTML5 and CSS3',
                'description' => 'Build a readable schedule layout that works on desktop and mobile screens using semantic markup and CSS.',
                'date' => '2026-05-18',
                'start' => '13:30',
                'end' => '15:00',
                'room' => 'Studio D3',
                'speaker' => 'Ms. An Pham',
                'track' => 'Frontend & User Experience',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 38,
            ],
            [
                'title' => 'SQL Constraints, Foreign Keys and Data Integrity',
                'description' => 'Explain how migrations, foreign keys and unique constraints protect schedule and registration data.',
                'date' => '2026-05-18',
                'start' => '13:30',
                'end' => '15:00',
                'room' => 'Room B101',
                'speaker' => 'Prof. David Wilson',
                'track' => 'Database & ERD Design',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 52,
            ],
            [
                'title' => 'Schedule Conflict Rules and Service Layer Design',
                'description' => 'Implement business rules that prevent room conflicts, speaker conflicts and overlapping student registrations.',
                'date' => '2026-05-18',
                'start' => '15:15',
                'end' => '16:45',
                'room' => 'Seminar E204',
                'speaker' => 'Mr. Hoang Pham',
                'track' => 'Laravel & PHP Development',
                'level' => 'Advanced',
                'status' => 'published',
                'max_attendees' => 30,
            ],
            [
                'title' => 'Authentication and Role-Based Authorization',
                'description' => 'Build login, register, admin-only pages and student registration flows using role checks.',
                'date' => '2026-05-19',
                'start' => '08:00',
                'end' => '09:30',
                'room' => 'Lab C202',
                'speaker' => 'Mr. Minh Tran',
                'track' => 'Laravel & PHP Development',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 34,
            ],
            [
                'title' => 'Docker Compose for Laravel and MySQL',
                'description' => 'Configure PHP, Apache and MySQL services so the application can run consistently on any laptop.',
                'date' => '2026-05-19',
                'start' => '08:00',
                'end' => '09:30',
                'room' => 'Innovation Lab F1',
                'speaker' => 'Dr. Sara Lee',
                'track' => 'DevOps & Deployment',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 42,
            ],
            [
                'title' => 'Creating REST API Endpoints for Published Sessions',
                'description' => 'Expose schedule data as JSON and structure API responses for frontend use.',
                'date' => '2026-05-19',
                'start' => '09:45',
                'end' => '11:15',
                'room' => 'Lab C202',
                'speaker' => 'Mr. Minh Tran',
                'track' => 'API & JavaScript Integration',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 34,
            ],
            [
                'title' => 'JavaScript Fetch API Timetable Demo',
                'description' => 'Consume the Laravel API with JavaScript and render live schedule cards without a page refresh.',
                'date' => '2026-05-19',
                'start' => '11:30',
                'end' => '12:30',
                'room' => 'Lab C202',
                'speaker' => 'Ms. An Pham',
                'track' => 'API & JavaScript Integration',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 34,
            ],
            [
                'title' => 'Accessible Navigation and Form Validation Feedback',
                'description' => 'Improve usability with clear navigation, visible validation errors and accessible form structure.',
                'date' => '2026-05-19',
                'start' => '11:30',
                'end' => '12:30',
                'room' => 'Studio D3',
                'speaker' => 'Ms. Rachel Chen',
                'track' => 'Frontend & User Experience',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 38,
            ],
            [
                'title' => 'Admin CRUD Clinic: Rooms, Tracks and Speakers',
                'description' => 'Guided practice for maintaining independent entity models through admin CRUD interfaces.',
                'date' => '2026-05-19',
                'start' => '13:30',
                'end' => '15:00',
                'room' => 'Innovation Lab F1',
                'speaker' => 'Ms. Mai Le',
                'track' => 'Project Defense & Teamwork',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 42,
            ],
            [
                'title' => 'Eloquent Relationships and Query Optimization',
                'description' => 'Use belongsTo, hasMany and belongsToMany relationships while avoiding inefficient query patterns.',
                'date' => '2026-05-19',
                'start' => '15:15',
                'end' => '16:45',
                'room' => 'Seminar E204',
                'speaker' => 'Prof. David Wilson',
                'track' => 'Database & ERD Design',
                'level' => 'Advanced',
                'status' => 'published',
                'max_attendees' => 30,
            ],
            [
                'title' => 'Security Review: Input Validation and Mass Assignment',
                'description' => 'Review validation rules, fillable model properties and safe request handling in Laravel controllers.',
                'date' => '2026-05-20',
                'start' => '08:00',
                'end' => '09:30',
                'room' => 'Room B101',
                'speaker' => 'Mr. Hoang Pham',
                'track' => 'Laravel & PHP Development',
                'level' => 'Advanced',
                'status' => 'published',
                'max_attendees' => 50,
            ],
            [
                'title' => 'Deployment Checklist and Environment Troubleshooting',
                'description' => 'Prepare the application for project defense by checking environment files, ports, migrations and seeders.',
                'date' => '2026-05-20',
                'start' => '09:45',
                'end' => '11:15',
                'room' => 'Innovation Lab F1',
                'speaker' => 'Dr. Sara Lee',
                'track' => 'DevOps & Deployment',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 42,
            ],
            [
                'title' => 'Student Timetable Planning and Conflict-Free Registration',
                'description' => 'Students test registration workflows and confirm that overlapping sessions are blocked correctly.',
                'date' => '2026-05-20',
                'start' => '09:45',
                'end' => '11:15',
                'room' => 'Auditorium A',
                'speaker' => 'Ms. Mai Le',
                'track' => 'Project Defense & Teamwork',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 150,
            ],
            [
                'title' => 'API Testing with Browser and JavaScript Console',
                'description' => 'Inspect JSON data, confirm HTTP responses and debug frontend API consumption issues.',
                'date' => '2026-05-20',
                'start' => '11:30',
                'end' => '12:30',
                'room' => 'Lab C202',
                'speaker' => 'Mr. Minh Tran',
                'track' => 'API & JavaScript Integration',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 34,
            ],
            [
                'title' => 'UI Polish: Cards, Badges and Timetable Readability',
                'description' => 'Refine schedule cards, track colors, status labels and user-friendly information hierarchy.',
                'date' => '2026-05-20',
                'start' => '13:30',
                'end' => '15:00',
                'room' => 'Studio D3',
                'speaker' => 'Ms. An Pham',
                'track' => 'Frontend & User Experience',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 38,
            ],
            [
                'title' => 'Controller Responsibility and Service Extraction',
                'description' => 'Refactor business logic out of controllers and explain code organization during defense.',
                'date' => '2026-05-20',
                'start' => '15:15',
                'end' => '16:45',
                'room' => 'Seminar E204',
                'speaker' => 'Mr. Hoang Pham',
                'track' => 'Laravel & PHP Development',
                'level' => 'Advanced',
                'status' => 'published',
                'max_attendees' => 30,
            ],
            [
                'title' => 'Final Defense Rehearsal: Functional Demo Flow',
                'description' => 'Teams rehearse login, CRUD, registration, timetable display and API demonstration in a timed sequence.',
                'date' => '2026-05-21',
                'start' => '08:30',
                'end' => '10:00',
                'room' => 'Auditorium A',
                'speaker' => 'Ms. Mai Le',
                'track' => 'Project Defense & Teamwork',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 150,
            ],
            [
                'title' => 'Source Code Explanation for Technical Questions',
                'description' => 'Prepare explanations for migrations, models, controllers, routes, authorization middleware and services.',
                'date' => '2026-05-21',
                'start' => '10:15',
                'end' => '11:45',
                'room' => 'Room B101',
                'speaker' => 'Dr. Linh Nguyen',
                'track' => 'Project Defense & Teamwork',
                'level' => 'Intermediate',
                'status' => 'published',
                'max_attendees' => 50,
            ],
            [
                'title' => 'Cancelled Backup Session: Legacy Deployment Discussion',
                'description' => 'Backup discussion kept in the system to show how cancelled sessions are displayed and managed.',
                'date' => '2026-05-21',
                'start' => '13:00',
                'end' => '14:00',
                'room' => 'Seminar E204',
                'speaker' => 'Dr. Sara Lee',
                'track' => 'DevOps & Deployment',
                'level' => 'Intermediate',
                'status' => 'cancelled',
                'max_attendees' => 30,
            ],
            [
                'title' => 'Closing Panel: Lessons Learned and Further Improvements',
                'description' => 'Panel discussion about what went well, what did not go well and realistic next improvements for the scheduler.',
                'date' => '2026-05-21',
                'start' => '14:15',
                'end' => '15:30',
                'room' => 'Auditorium A',
                'speaker' => 'Dr. Linh Nguyen',
                'track' => 'Project Defense & Teamwork',
                'level' => 'Beginner',
                'status' => 'published',
                'max_attendees' => 160,
            ],
        ];

        $createdSessions = collect();

        foreach ($sessions as $session) {
            $start = Carbon::parse($session['date'] . ' ' . $session['start']);
            $end = Carbon::parse($session['date'] . ' ' . $session['end']);

            $createdSessions->put($session['title'], ConferenceSession::create([
                'title' => $session['title'],
                'description' => $session['description'],
                'start_time' => $start,
                'end_time' => $end,
                'room_id' => $rooms[$session['room']]->id,
                'speaker_id' => $speakers[$session['speaker']]->id,
                'track_id' => $tracks[$session['track']]->id,
                'level' => $session['level'],
                'status' => $session['status'],
                'max_attendees' => $session['max_attendees'],
            ]));
        }

        $registrationPlans = [
            'minhanh@student.edu.vn' => [
                'Opening Keynote: Building a Realistic Conference Scheduler',
                'ERD Design for Rooms, Speakers, Sessions and Registrations',
                'Laravel Routing, Controllers and Blade Views',
                'Responsive Timetable UI with HTML5 and CSS3',
                'Authentication and Role-Based Authorization',
                'Creating REST API Endpoints for Published Sessions',
                'Admin CRUD Clinic: Rooms, Tracks and Speakers',
                'Security Review: Input Validation and Mass Assignment',
                'API Testing with Browser and JavaScript Console',
                'Final Defense Rehearsal: Functional Demo Flow',
                'Closing Panel: Lessons Learned and Further Improvements',
            ],
            'baolong@student.edu.vn' => [
                'Opening Keynote: Building a Realistic Conference Scheduler',
                'User Stories and Requirement Prioritization Workshop',
                'Laravel Routing, Controllers and Blade Views',
                'SQL Constraints, Foreign Keys and Data Integrity',
                'Docker Compose for Laravel and MySQL',
                'JavaScript Fetch API Timetable Demo',
                'Admin CRUD Clinic: Rooms, Tracks and Speakers',
                'Deployment Checklist and Environment Troubleshooting',
                'UI Polish: Cards, Badges and Timetable Readability',
                'Source Code Explanation for Technical Questions',
                'Closing Panel: Lessons Learned and Further Improvements',
            ],
            'thuha@student.edu.vn' => [
                'Opening Keynote: Building a Realistic Conference Scheduler',
                'ERD Design for Rooms, Speakers, Sessions and Registrations',
                'Responsive Timetable UI with HTML5 and CSS3',
                'Authentication and Role-Based Authorization',
                'Creating REST API Endpoints for Published Sessions',
                'Accessible Navigation and Form Validation Feedback',
                'Student Timetable Planning and Conflict-Free Registration',
                'UI Polish: Cards, Badges and Timetable Readability',
                'Final Defense Rehearsal: Functional Demo Flow',
                'Source Code Explanation for Technical Questions',
            ],
            'giahuy@student.edu.vn' => [
                'Opening Keynote: Building a Realistic Conference Scheduler',
                'User Stories and Requirement Prioritization Workshop',
                'Laravel Routing, Controllers and Blade Views',
                'Schedule Conflict Rules and Service Layer Design',
                'Docker Compose for Laravel and MySQL',
                'JavaScript Fetch API Timetable Demo',
                'Eloquent Relationships and Query Optimization',
                'Security Review: Input Validation and Mass Assignment',
                'API Testing with Browser and JavaScript Console',
                'Final Defense Rehearsal: Functional Demo Flow',
            ],
            'khanhlinh@student.edu.vn' => [
                'Opening Keynote: Building a Realistic Conference Scheduler',
                'ERD Design for Rooms, Speakers, Sessions and Registrations',
                'Laravel Routing, Controllers and Blade Views',
                'Responsive Timetable UI with HTML5 and CSS3',
                'Authentication and Role-Based Authorization',
                'Creating REST API Endpoints for Published Sessions',
                'Admin CRUD Clinic: Rooms, Tracks and Speakers',
                'Deployment Checklist and Environment Troubleshooting',
                'Controller Responsibility and Service Extraction',
                'Closing Panel: Lessons Learned and Further Improvements',
            ],
            'ducnam@student.edu.vn' => [
                'Opening Keynote: Building a Realistic Conference Scheduler',
                'User Stories and Requirement Prioritization Workshop',
                'SQL Constraints, Foreign Keys and Data Integrity',
                'Schedule Conflict Rules and Service Layer Design',
                'Docker Compose for Laravel and MySQL',
                'Creating REST API Endpoints for Published Sessions',
                'Admin CRUD Clinic: Rooms, Tracks and Speakers',
                'Student Timetable Planning and Conflict-Free Registration',
                'API Testing with Browser and JavaScript Console',
                'Source Code Explanation for Technical Questions',
                'Closing Panel: Lessons Learned and Further Improvements',
            ],
            'maichi@student.edu.vn' => [
                'Opening Keynote: Building a Realistic Conference Scheduler',
                'ERD Design for Rooms, Speakers, Sessions and Registrations',
                'Laravel Routing, Controllers and Blade Views',
                'Responsive Timetable UI with HTML5 and CSS3',
                'Docker Compose for Laravel and MySQL',
                'JavaScript Fetch API Timetable Demo',
                'Eloquent Relationships and Query Optimization',
                'Deployment Checklist and Environment Troubleshooting',
                'UI Polish: Cards, Badges and Timetable Readability',
                'Final Defense Rehearsal: Functional Demo Flow',
            ],
            'quangvinh@student.edu.vn' => [
                'Opening Keynote: Building a Realistic Conference Scheduler',
                'User Stories and Requirement Prioritization Workshop',
                'Laravel Routing, Controllers and Blade Views',
                'Schedule Conflict Rules and Service Layer Design',
                'Authentication and Role-Based Authorization',
                'Creating REST API Endpoints for Published Sessions',
                'Admin CRUD Clinic: Rooms, Tracks and Speakers',
                'Security Review: Input Validation and Mass Assignment',
                'Controller Responsibility and Service Extraction',
                'Closing Panel: Lessons Learned and Further Improvements',
            ],
        ];

        foreach ($registrationPlans as $studentEmail => $sessionTitles) {
            foreach ($sessionTitles as $title) {
                if (!isset($students[$studentEmail]) || !$createdSessions->has($title)) {
                    continue;
                }

                Registration::create([
                    'user_id' => $students[$studentEmail]->id,
                    'conference_session_id' => $createdSessions[$title]->id,
                    'status' => 'registered',
                ]);
            }
        }
    }
}