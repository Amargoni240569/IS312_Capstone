# IS312_Capstone

## Project Description
Bakers Bakery Product Review Website is a web-based application developed for the IS312 Web Application Capstone Project. The system was designed to provide customers with access to bakery products, business information, and customer interaction features such as product reviews and customer feedback.

The application allows customers and administrators to register and log in securely. Customers can browse bakery products, submit reviews, and interact with the bakery website. Administrative users can manage customer reviews and website content through backend functionalities such as updating, modifying, and deleting reviews.

This project demonstrates practical implementation of web technologies, database integration, authentication systems, CRUD operations, and collaborative development using GitHub branches.

---

## Group Members and Assigned Git Branches

| Group Member | Assigned Branch | Responsibility |
|---|---|---|
| Nathaniel Posanai | `feature/auth-Nathaniel-Posanai` | Authentication and User Login/Register |
| Abel Wamanimbo | `feature/config-Abel-Wamanimbo` | Configuration Files and Database Connection |
| Abel Wamanimbo | `feature/database-Abel-Wamanimbo` | Database Design and SQL Implementation |
| Raymond Bonaven | `feature/admin-Raymond-Bonaven` | Admin Dashboard and Backend Management |
| Raymond Pae | `feature/assets-Raymond-Pae` | Frontend Assets, CSS, Images, and UI Resources |
| Philemon Kira | `feature/public-Philemon-Kira` | Public Pages and Frontend Website Pages |

---

## Repository Branch Structure

### Main Branches
- `main` → Stable production-ready branch
- `develop` → Main development integration branch

### Feature Branches
- `feature/admin-Raymond-Bonaven`
- `feature/assets-Raymond-Pae`
- `feature/auth-Nathaniel-Posanai`
- `feature/config-Abel-Wamanimbo`
- `feature/database-Abel-Wamanimbo`
- `feature/public-Philemon-Kira`

Each member worked independently on their assigned branch before merging changes into the `develop` branch and eventually into the `main` branch.

---

## Features
- User registration
- User login and logout
- Customer and admin authentication
- Browse bakery products
- Submit customer reviews
- View customer reviews
- Admin dashboard
- Update reviews
- Delete reviews
- Contact and About pages

---

## Functional Requirements
- Users can register with a unique email address
- Users can securely log in
- Customers can browse products without logging in
- Only registered users can submit reviews
- Only administrators can update or delete reviews
- System stores user, product, and review information in the database

---

## Non-Functional Requirements
- Security through password encryption
- Fast application performance
- User-friendly interface
- Reliable system with minimal downtime

---

## Technologies Used
- PHP
- MySQL
- HTML
- CSS
- GitHub

---

## Database Design

### Conceptual Design
The conceptual design focuses on identifying the bakery business requirements and customer interaction processes. It highlights the important data entities needed for products, users, reviews, and customer feedback.

### Logical Design
The logical design defines relationships between database entities and tables to ensure proper data organization and business rule implementation.

### Database Relationship
The implemented database structure supports efficient data storage and relationships between:
- Users
- Products
- Reviews
- Administrators

---

## Application Design

### Navigation Structure

#### Main Navigation Flow
- Home Page
- Register / Login
- Dashboard
- Browse Products
- View Reviews
- Contact Page

#### Key Pages
- Login Page
- Registration Page
- Product Details Page
- Review Submission Page
- Contact Page
- About Page

---

## Core Process Flow
1. User accesses homepage
2. User registers or logs in
3. User browses bakery products
4. User selects a product
5. User views or submits reviews

---

## Project Structure
```bash
IS312_Capstone/
│
├── admin/
├── assets/
├── auth/
├── config/
├── database/
├── public/
├── README.md
