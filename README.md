# 💸 Sheetsy – Shared Expenses Management App

## 📌 Project Overview

Sheetsy is a fullstack web application built to manage shared expenses between roommates.

What started as a simple idea — tracking expenses and knowing who owes what — quickly evolved into a real-world system requiring solid business logic, data consistency, and thoughtful user experience.

This project goes beyond a basic CRUD application and focuses on solving real-life financial scenarios in shared living environments.

---

## 🚀 Features

- 🏠 Manage shared households (colocations)
- 👥 Role system (Owner / Member)
- 🔐 Secure invitation system using tokens
- 💰 Add and track expenses with categories
- ⚖️ Automatic balance calculation
- 🔄 Clear view of "who owes whom"
- ✅ Payment tracking (mark as paid)
- ⭐ Reputation system
- 📊 Admin dashboard (statistics & user management)
- 📅 Filter expenses by month
- 📱 Responsive and user-friendly interface
- 📈 Interactive dashboard for expenses and balances
- ⚡ Smooth UX for adding, filtering, and tracking payments

---

## 🧠 Technical Stack

### Backend
- **Laravel (MVC Architecture)**
- **MySQL**
- **Eloquent ORM** (hasMany, belongsToMany)
- Business logic for debt calculation
- Role & access control system

### Frontend
- **Blade Templates**
- **Tailwind CSS**
- **HTML / JavaScript**

---

## ⚙️ Key Concepts Implemented

- Data consistency in financial operations  
- Handling real-world edge cases  
- Clean backend architecture  
- Secure authentication and authorization  
- Query optimization and realistic database seeding  

---

## 💡 Example Business Logic

If an owner removes a member who still has outstanding debt, the debt is automatically transferred to the owner.

This kind of rule reflects real-world scenarios and required careful system design.

---

## 🎯 What I Learned

- Designing reliable financial logic  
- Anticipating real-world user scenarios  
- Building a clean and maintainable backend  
- Creating a responsive and practical UI  
- Thinking beyond code to design a complete system  

---

## ⏱️ Timeline

This project was built in **7 days**, focusing on rapid development while maintaining quality and structure.

---

## 🔄 Future Improvements

- Real-time updates (WebSockets)
- Integrated payment system
- Notifications system
- Advanced analytics dashboard

---

## 📬 Feedback

I’m continuously improving this project and would love to hear your feedback!
