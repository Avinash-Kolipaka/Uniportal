# UniPortal — Event Management Platform

A full-stack Laravel 10 web application for event management and collaboration between Proposers and End-Users, with an admin approval workflow.

---

## Tech Stack

| Layer        | Technology                          |
|--------------|-------------------------------------|
| Backend      | Laravel 10, PHP 8.2                 |
| Frontend     | Blade Templates + Tailwind CSS v3   |
| Database     | SQLite (or MySQL)                   |
| Auth         | Laravel Breeze (extended)           |
| Interactivity| Alpine.js                           |

---

## Credentials

| Role     | Email                   | Password  | Unique ID  |
|----------|-------------------------|-----------|------------|
| Admin    | admin@uniportal.com     | password  | ADMIN-001  |
| Proposer | proposer1@uniportal.com | password  | PROP-001   |
| End-User | user1@uniportal.com     | password  | USER-001   |

---

## Setup Instructions

### 1. Clone / Navigate to the project
```bash
cd unip
```

### 2. Install PHP dependencies
```bash
composer install
```

### 3. Configure environment
```bash
# .env is pre-configured for SQLite
# For MySQL, edit .env and update DB_CONNECTION, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

### 4. Generate application key
```bash
php artisan key:generate
```

### 5. Run migrations and seed database
```bash
php artisan migrate:fresh --seed
```

### 6. Create storage symlink
```bash
php artisan storage:link
```

### 7. Install Node dependencies and build assets
```bash
npm install && npm run dev
```

### 8. Start the development server
```bash
php artisan serve
```

Visit `http://localhost:8000`

---

## Features

- ✅ **Role-based authentication**: Admin, Proposer, End-User
- ✅ **Approval workflow**: New users start as "Pending"; Admin approves/rejects
- ✅ **Admin dashboard**: User management & event management with stats
- ✅ **Proposer dashboard**: Full event CRUD with image upload (max 2MB, jpg/png/webp)
- ✅ **End-user event browsing**: Search, filter by category/theme/location/date
- ✅ **Express Interest**: End-users can save events; Proposers see interested users
- ✅ **My Interests page**: End-users see all their saved events
- ✅ **Attendees page**: Proposers view interested users per event
- ✅ **Responsive design**: Tailwind CSS with mobile navigation
- ✅ **Flash toast notifications**: Success/error messages
- ✅ **CSRF protection**: All forms
- ✅ **Image storage**: Laravel public disk with storage:link

---

## Routes Overview

| Route                          | Middleware           | Description                    |
|-------------------------------|----------------------|--------------------------------|
| `/`                            | public               | Landing page with featured events |
| `/events`                      | public               | Browse all active events        |
| `/events/{id}`                 | public               | Event detail page               |
| `/register`, `/login`          | guest                | Authentication pages            |
| `/admin/users`                 | auth, approved, admin| User management table           |
| `/admin/events`                | auth, approved, admin| Event management table          |
| `/proposer/events`             | auth, approved, proposer | My events dashboard        |
| `/proposer/events/create`      | auth, approved, proposer | Create event form          |
| `/my-interests`                | auth, approved       | End-user saved interests        |

---

## Switching to MySQL

1. Create a MySQL database named `uniportal`
2. Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uniportal
DB_USERNAME=root
DB_PASSWORD=your_password
```
3. Re-run `php artisan migrate:fresh --seed`
