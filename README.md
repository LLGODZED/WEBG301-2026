# Conference Timetable Scheduler - Laravel + Docker

A basic but complete **Conference Scheduler / Study Timetable** web application for a PHP web project. It is built with **Laravel 8**, PHP, HTML5, CSS3, vanilla JavaScript, and Docker.

> Important assignment note: the uploaded brief says the framework should be **Symfony** and PHP 7. This implementation follows the user's requested framework, **Laravel**, while keeping PHP 7.4 compatibility through Laravel 8. If your lecturer strictly checks the framework, convert the same database design and features to Symfony or ask for approval first.

## Main features

- Public conference / class schedule listing.
- Calendar-like timetable view grouped by day.
- Session detail page.
- Register and login.
- Role-based authorization: `admin` and `student`.
- Admin CRUD for sessions, rooms, speakers, and tracks.
- Table relationships:
  - Track has many sessions.
  - Room has many sessions.
  - Speaker has many sessions.
  - User registers for many sessions through registrations.
- Schedule conflict validation:
  - Prevents one room from having overlapping sessions.
  - Prevents one speaker from teaching/presenting overlapping sessions.
  - Prevents a user from registering for overlapping sessions.
- API endpoint returning sessions as JSON.
- JavaScript page consuming the API and rendering cards dynamically.
- Seed data and demo users included.
- Dockerized with Apache + PHP 7.4 + MySQL 5.7.

## Demo accounts

| Role | Email | Password |
|---|---|---|
| Admin | admin@example.com | password |
| Student | student@example.com | password |

## Run with Docker

```bash
docker compose up --build
```

Open:

```text
http://localhost:8080
```

The container entrypoint will:

1. Copy `.env.example` to `.env` when `.env` is missing.
2. Generate `APP_KEY` when needed.
3. Wait for MySQL.
4. Run migrations and seeders.
5. Start Apache.

## Useful commands

```bash
# Stop containers
docker compose down

# Rebuild from scratch
docker compose down -v
docker compose up --build

# Enter app container
docker compose exec app bash

# Re-run migrations and seeders
docker compose exec app php artisan migrate:fresh --seed
```

## Assignment requirement mapping

| Requirement | Where implemented |
|---|---|
| PHP main language | Laravel controllers, models, migrations, Blade views |
| At least 10 views | `resources/views` contains more than 10 Blade pages |
| At least 4 entity models | User, Room, Speaker, Track, ConferenceSession, Registration |
| At least 4 controllers | Auth, Dashboard, public schedule, API, and 4 admin CRUD controllers |
| HTML5/CSS3 | Blade layout and `public/css/app.css` |
| CRUD actions | Admin CRUD for rooms, speakers, tracks, sessions |
| Tables have relationships | Foreign keys in migrations and Eloquent relations in models |
| Register/Login | Custom Auth controllers and views |
| Authorization | Admin middleware and role column on users |
| API + JavaScript consume API | `/api/sessions` and `/api-demo` using `public/js/schedule-api.js` |

## Suggested sitemap for your report

```text
Home
├── Schedule
│   ├── Session List
│   ├── Timetable View
│   └── Session Detail
├── API Demo
├── Login
├── Register
├── Dashboard
│   └── My Registered Sessions
└── Admin Area
    ├── Manage Sessions
    ├── Manage Rooms
    ├── Manage Speakers
    └── Manage Tracks
```

## Suggested ERD summary for your report

```text
users (id, name, email, password, role)
rooms (id, name, building, capacity)
speakers (id, name, email, phone, bio)
tracks (id, name, color, description)
conference_sessions (id, title, description, start_time, end_time, room_id, speaker_id, track_id)
registrations (id, user_id, conference_session_id, status)

rooms 1 --- * conference_sessions
speakers 1 --- * conference_sessions
tracks 1 --- * conference_sessions
users * --- * conference_sessions through registrations
```

## GitHub evidence tip

The brief asks each student to have at least 10 meaningful commits across at least 3 different days. This ZIP cannot create real GitHub history for you. After extracting it, initialize Git and commit gradually with meaningful messages, for example:

```bash
git init
git add .
git commit -m "Initial Laravel Docker project structure"
```

Then continue with feature-based commits: auth, migrations, CRUD controllers, views, API, JavaScript, styling, seeders, README, etc.
