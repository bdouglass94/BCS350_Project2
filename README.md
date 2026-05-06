# BCS350_Project2

# quizApp Web Application

## Project Overview

quizApp is a PHP/MySQL web application where users can create accounts, take randomized quizzes, track scores, and compete on a leaderboard. The application uses a client-server architecture and is deployed online using InfinityFree hosting.

---

# Features

## Main Features

- User signup and login system
- Randomized quiz questions
- 10-question quiz
- Quiz results page
- Replay quiz functionality
- User profile page with play history
- Leaderboard page displaying top players
- Score and quiz history stored in MySQL database

## Extra Features
- 10-minute quiz timer
- 10-question or 20-question quiz selection
- Timer auto-submits quiz when time expires
- Retro arcade themed UI

---

# Technologies Used

## Frontend
- HTML
- CSS
- JavaScript

## Backend
- PHP
- MySQL

## Hosting
- InfinityFree

---

# How to Run the Project

1. Upload all project files to the hosting service `htdocs` folder.
2. Create a MySQL database in InfinityFree.
3. Import the `schema.sql` file into phpMyAdmin.
4. Update `db.php` with your database credentials.
5. Open the hosted URL in a browser.

---

# Hosted Website URL

https://quiz-app-douglass.infinityfreeapp.com

---

# Database Schema

## users Table

| Column | Type |
|---|---|
| id | INT |
| username | VARCHAR |
| password_hash | VARCHAR |
| created_at | TIMESTAMP |

## quiz_attempts Table

| Column | Type |
|---|---|
| id | INT |
| user_id | INT |
| score | INT |
| total_questions | INT |
| percentage | DECIMAL |
| time_taken | INT |
| created_at | TIMESTAMP |

---

# Author

Brandon Douglass
