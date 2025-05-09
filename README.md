# 👗 Online Fashion Recommendation System

An intelligent web-based fashion recommendation platform that leverages deep learning to suggest fashion items based on user preferences and image analysis. Built using a **pre-trained CNN model (ResNet)**, and powered by **Flask, HTML/CSS/JS**, with **PHP** handling the user authentication and database operations.

---

## 🚀 Features

- 🧠 **AI-Powered Recommendations** using ResNet CNN
- 📸 **Image Upload** for fashion item recognition
- 🎨 **Responsive UI** with HTML, CSS, and JavaScript
- 🔐 **User Login & Registration** system using PHP and MySQL
- 🌐 Flask backend to serve model predictions and process logic
- 📊 Accurate and personalized fashion suggestions based on visual features

---

## 🛠️ Tech Stack

| Technology     | Purpose                               |
|----------------|----------------------------------------|
| Python + Flask | Backend API and ML model integration   |
| ResNet         | Pre-trained CNN for image recognition  |
| HTML/CSS/JS    | Frontend web design and interactivity  |
| PHP + MySQL    | User authentication and database       |

---

---

## ⚙️ How to Run

1. **Clone the repository**
   ```bash
   git clone https://github.com/Qudsiya954/fashion.git
   cd fashion
Set up Python environment

```bash

pip install -r requirements.txt
```
Run the Flask app

```bash
python app.py
```
Start the PHP server (for login system)

Make sure Apache & MySQL (e.g., via XAMPP) are running.

Place PHP files in htdocs or configure accordingly.

Visit in browser
```bash
http://localhost:5000/        # For Flask frontend
http://localhost/php-folder/  # For PHP login sy
```
🧠 Model Info
Model: Pretrained ResNet (e.g., ResNet50)

Use: Extracts deep features from fashion item images

Purpose: Enables similarity-based recommendations

📸 Sample Workflow
User logs in via PHP-based login page.

Uploads an image of a clothing item.

ResNet processes the image via Flask backend.

Suggested fashion items are shown based on visual similarity.

🛡️ Security & Considerations
User passwords are stored securely using hashing (e.g., bcrypt or SHA).

Cross-origin access is managed where necessary between Flask and PHP.

📬 Contact
Author: Qudsiya Siddique
GitHub: @Qudsiya954



