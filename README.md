# 📊 Visitor Analytics + Weather Dashboard

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4-purple?logo=php)
![Docker](https://img.shields.io/badge/Docker-ready-blue?logo=docker)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-used-blue?logo=postgresql)
![License](https://img.shields.io/badge/license-MIT-green)

---

## 🚀 Overview

This project is a Laravel-based analytics system that includes:

- 📊 Visitor tracking system (JS counter)
- 🌍 Geo-based statistics (cities)
- 📈 Hourly unique visits analytics
- 🌦 Weather data collector (scheduled job)
- 🔐 Auth-protected admin dashboard
- 🐳 Fully Dockerized environment

---

## 🧱 Tech Stack

- Laravel 11+
- PHP 8.4
- PostgreSQL
- Docker / Docker Compose
- AnyChart (data visualization)
- Vanilla JavaScript (visitor tracking)
- Laravel Jetstream / Sanctum (auth)

---

## 📦 Local Installation

### 🔧 Requirements

- Docker Desktop
- Git
- Free ports: `8080`, `8081`

---

### 📥 Clone repository

```bash
git clone <repo-url>
cd <project-folder>
````

---

### 🐳 Run project

```bash
docker compose -f docker-compose.local.yml up -d --build
```

---

### ⚙️ First run setup

On first startup, the container automatically:

* copies `.env`
* installs PHP dependencies (Composer)
* installs frontend dependencies (npm)
* builds frontend assets
* runs migrations
* generates application key
* starts PHP-FPM
* starts Laravel scheduler (`schedule:work`)

---

## 🌐 Access

| Service        | URL                                            |
| -------------- | ---------------------------------------------- |
| 🟢 Application | [http://localhost:8080](http://localhost:8080) |
| 🐘 PGAdmin     | [http://localhost:8081](http://localhost:8081) |

---

## 📡 API

### Weather API

* `GET /api/v1/weather` — returns stored weather history

### Visits API (JS Counter)

* `POST /api/v1/visits` — stores visitor data
* `OPTIONS /api/v1/visits` — CORS support

Collected data includes:

* IP address (backend)
* City (GeoIP / backend logic)
* User agent (device info)
* Visit timestamp

---

## 🌐 Web Routes

### Public

* `GET /` — landing page

### Dashboard (protected)

Requires authentication (Jetstream/Sanctum + verified users):

* `GET /dashboard` — analytics dashboard

Includes:

* 📊 hourly unique visits chart
* 🌍 city distribution pie chart
* 📈 total visits counter
* 👥 unique visitors counter

---

## ⏱ Scheduler (Weather Collector)

Laravel Scheduler is used instead of system cron.

Runs every 5 minutes:

```bash
php artisan weather:fetch
```

### What it does:

* Fetches current weather from Open-Meteo API
* Saves snapshot into database
* Logs execution into:
  `storage/logs/weather-YYYY-MM-DD.log`

---

## 📊 Features

### Visitor Tracking System

* JavaScript visitor counter script
* Unique visitor identification
* IP + city detection
* Device detection (user-agent)
* Persistent visit storage

### Analytics Dashboard

* Hourly unique visits (bar chart)
* City-based distribution (pie chart)
* Total visits counter
* Unique visitors counter
* Real-time rendered charts (AnyChart)

### Weather System

* Open-Meteo API integration
* Scheduled data collection (5 min interval)
* Historical weather storage

---

## 🐳 Architecture

```
JS Counter → Laravel API → PostgreSQL
                     ↓
        Visitor Analytics Engine
                     ↓
          Dashboard (AnyChart UI)

Weather API → Scheduler → Database Storage
```

---

## ⏱ Scheduler

Check scheduled tasks:

```bash
php artisan schedule:list
```

Run manually:

```bash
php artisan schedule:run
```

Background worker:

```bash
php artisan schedule:work
```

---

## 🧪 Useful Commands

```bash
php artisan migrate
php artisan optimize:clear
php artisan schedule:list
php artisan queue:work
```

---

## 🔐 Authentication

* Laravel Jetstream / Sanctum
* Verified user access required for dashboard
* Protected analytics panel
