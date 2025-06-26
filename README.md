
# 📝 TaskManager Web App

A full-stack web application to manage personal tasks with user authentication, built using PHP, MySQL, HTML, CSS, Bootstrap and deployed live using InfinityFree.

### 🌐 Live Demo:
🔗 [https://taskmanagerweb.fwh.is](https://taskmanagerweb.fwh.is)

---

## 🚀 Features

- 🔐 Secure user registration and login
- ➕ Add tasks with deadlines and descriptions
- 🖊️ Edit and update existing tasks
- ❌ Delete tasks
- ✅ Mark tasks as completed
- 🧑‍💻 User-specific task dashboard with session handling

---

## 🛠️ Tech Stack

| Frontend      | Backend       | Database  | Hosting        |
|---------------|---------------|-----------|----------------|
| HTML, CSS     | PHP           | MySQL     | InfinityFree   |
| Bootstrap 5   | XAMPP (local) | phpMyAdmin| File Manager / FTP |

---

## 📸 Screenshots

| Login Page | Dashboard |
|------------|-----------|
| ![Login](screenshots/login.png) | ![Dashboard](screenshots/dashboard.png) |

> 📌 Add these screenshots to a `screenshots/` folder in your repo if you want GitHub previews.

---

## 📁 Project Structure
'''bash
taskmanager/
├── index.php              # Login Page
├── register.php           # User Registration Page
├── dashboard.php          # User Dashboard (after login)
├── add_task.php           # Script to add a new task
├── edit_task.php          # Script to edit existing task
├── delete_task.php        # Script to delete a task
├── logout.php             # Ends user session
├── db.php                 # Database connection (reused across pages)
├── screenshots/           # Screenshots for GitHub README (if included)
│   ├── login.png
│   └── dashboard.png
└── README.md              # Project documentation


---

## 🔧 How to Run Locally

1. Clone this repository
2. Start XAMPP → Apache + MySQL
3. Import `taskmanager.sql` into phpMyAdmin
4. Update `db.php` with your local DB credentials
5. Open `http://localhost/taskmanager/` in browser

---

## 🌍 Deployment

Hosted using **InfinityFree.net**  
- Files uploaded via File Manager
- Database created and imported via phpMyAdmin
- `db.php` updated with remote credentials

---

## 👩‍💻 Author

**Mamathi Sathiya**  
Front-End & Full-Stack Learner  
💼 Portfolio: *coming soon*

---


