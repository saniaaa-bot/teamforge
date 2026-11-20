# TeamForge - Multi-User Project Management SaaS

TeamForge is a full-stack, multi-user project management application built with Laravel. It allows teams to organize their work in isolated workspaces, create projects, and manage tasks with priorities and statuses.

## 🚀 Features

- **Multi-User Workspaces:** Users can create isolated workspaces with strict data access controls.
- **Role-Based Access:** Only the workspace owner can create projects and access the workspace data.
- **Project Management:** Create and organize multiple projects inside a workspace.
- **Task Engine:** Add tasks with titles, priorities (Low, Medium, High), and status (To Do, Done).
- **Interactive UI:** Toggle task completion with a single click (strikethrough effect).
- **Live Analytics Dashboard:** Real-time calculation of total workspaces, projects, and pending/completed tasks.
- **Automated Testing:** Includes feature tests for access denial, validation, and task lifecycle.

## 💻 Tech Stack

- **Backend:** Laravel 12 (PHP 8.2)
- **Frontend:** Blade Templates, Tailwind CSS
- **Database:** SQLite
- **Authentication:** Laravel Breeze

## ⚙️ Setup Instructions

1. Clone the repository:
   ```bash
   git clone https://github.com/saniaaa-bot/teamforge.git