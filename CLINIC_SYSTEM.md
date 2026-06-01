# Clinic Appointment Management System

## Project Overview
A comprehensive clinic appointment management system developed for a private clinic in Nyarungenge District to manage patient appointments, doctor schedules, and medical records efficiently.

## System Features

### 1. Authentication
- User registration and login
- Secure session management
- Dashboard access control

### 2. Patient Management
- Add, view, edit, and delete patient records
- Store patient information (name, phone, email, address, date of birth)
- View patient appointment history

### 3. Doctor Management
- Add, view, edit, and delete doctor profiles
- Store specialization and professional information
- Track doctor appointments

### 4. Appointment Management
- Schedule appointments between patients and doctors
- View all appointments
- Update appointment status (pending, confirmed, completed, cancelled)
- Add notes to appointments

### 5. Daily Schedule
- View appointments scheduled for a specific day
- Navigate between dates
- Quick access to appointment details

## Database Structure

### Users Table
- `id` - Primary Key
- `name` - User name
- `email` - Email address
- `password` - Hashed password
- `timestamps` - Created/Updated dates

### Patients Table
- `patient_id` - Primary Key
- `name` - Patient name
- `phone` - Phone number
- `email` - Email address (nullable)
- `address` - Address (nullable)
- `date_of_birth` - Date of birth (nullable)
- `timestamps` - Created/Updated dates

### Doctors Table
- `doctor_id` - Primary Key
- `name` - Doctor name
- `specialization` - Medical specialization
- `phone` - Phone number (nullable)
- `email` - Email address (nullable)
- `bio` - Professional biography (nullable)
- `timestamps` - Created/Updated dates

### Appointments Table
- `appointment_id` - Primary Key
- `patient_id` - Foreign Key (Patient)
- `doctor_id` - Foreign Key (Doctor)
- `appointment_date` - Date and time of appointment
- `status` - Status (pending, confirmed, completed, cancelled)
- `notes` - Appointment notes (nullable)
- `timestamps` - Created/Updated dates

## Functional Requirements Implemented

### ✓ Authentication
- User registration with validation
- Login with email and password
- Logout functionality
- Protected routes using middleware

### ✓ CRUD Operations
- **Patients**: Create, Read, Update, Delete
- **Doctors**: Create, Read, Update, Delete
- **Appointments**: Create, Read, Update, Delete

### ✓ Appointment Scheduling
- Schedule appointments with patient and doctor
- Set appointment date and time
- Add notes to appointments
- Track appointment status

### ✓ Daily Appointment Scheduling
- View all appointments for a specific day
- Filter appointments by date
- Quick access to today's schedule
- Visual card layout for easy scanning

## Project Structure

```
myapp/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AuthController.php
│   │       ├── PatientController.php
│   │       ├── DoctorController.php
│   │       └── AppointmentController.php
│   └── Models/
│       ├── User.php
│       ├── Patient.php
│       ├── Doctor.php
│       └── Appointment.php
├── database/
│   └── migrations/
│       ├── *_create_patients_table.php
│       ├── *_create_doctors_table.php
│       └── *_create_appointments_table.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── patients/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── doctors/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── appointments/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   ├── show.blade.php
│       │   └── daily.blade.php
│       └── dashboard.blade.php
└── routes/
    └── web.php
```

## Getting Started

### 1. Run Migrations
```bash
php artisan migrate
```

### 2. Create Admin User (Register)
Visit the registration page and create your account.

### 3. Access the System
- Login with your credentials
- Navigate to Dashboard
- Start managing patients, doctors, and appointments

## Routes

### Authentication Routes
- `GET /login` - Show login form
- `POST /login` - Process login
- `GET /register` - Show registration form
- `POST /register` - Process registration
- `POST /logout` - Logout user

### Dashboard
- `GET /dashboard` - Main dashboard

### Patients
- `GET /patients` - List all patients
- `GET /patients/create` - Show create form
- `POST /patients` - Store new patient
- `GET /patients/{patient}` - Show patient details
- `GET /patients/{patient}/edit` - Show edit form
- `PUT /patients/{patient}` - Update patient
- `DELETE /patients/{patient}` - Delete patient

### Doctors
- `GET /doctors` - List all doctors
- `GET /doctors/create` - Show create form
- `POST /doctors` - Store new doctor
- `GET /doctors/{doctor}` - Show doctor details
- `GET /doctors/{doctor}/edit` - Show edit form
- `PUT /doctors/{doctor}` - Update doctor
- `DELETE /doctors/{doctor}` - Delete doctor

### Appointments
- `GET /appointments` - List all appointments
- `GET /appointments/create` - Show create form
- `POST /appointments` - Store new appointment
- `GET /appointments/{appointment}` - Show appointment details
- `GET /appointments/{appointment}/edit` - Show edit form
- `PUT /appointments/{appointment}` - Update appointment
- `DELETE /appointments/{appointment}` - Delete appointment
- `GET /appointments/daily` - View today's schedule
- `GET /appointments/daily/{date}` - View schedule for specific date

## Key Features

### Dashboard
- Total number of patients
- Total number of doctors
- Total appointments count
- Today's appointments count
- Quick action buttons

### Patient Management
- Pagination for large patient lists
- Contact information management
- Appointment history tracking
- Patient details view

### Doctor Management
- Specialization tracking
- Professional information
- Appointment history
- Doctor availability view

### Appointment System
- Real-time appointment scheduling
- Status tracking (pending, confirmed, completed, cancelled)
- Patient and doctor information linking
- Appointment notes feature
- Daily schedule view with date filtering

## Technical Stack
- **Framework**: Laravel 11
- **Database**: SQLite (can be changed to MySQL/PostgreSQL)
- **Frontend**: Bootstrap 5
- **ORM**: Eloquent
- **Authentication**: Laravel Built-in Authentication

## Issues Resolved
- ✓ Appointments not recognized → Proper database schema with relationships
- ✓ Long waiting times → Efficient daily schedule view
- ✓ Lost patient records → Centralized database storage
- ✓ Poor scheduling → Advanced appointment scheduling system

## Future Enhancements
- SMS/Email notifications for appointments
- Appointment reminders
- Patient billing system
- Medical records upload
- Doctor availability calendar
- Appointment cancellation requests
- Patient feedback/ratings
- Report generation

## Usage Tips
1. Always schedule appointments with valid patient and doctor IDs
2. Use the daily schedule view for quick appointment management
3. Update appointment status as visits are completed
4. Add notes for important appointment details
5. Keep patient information up to date

## Support
For issues or questions, contact the clinic administrator.

---
**System Version**: 1.0
**Last Updated**: April 30, 2026
**Status**: Production Ready
