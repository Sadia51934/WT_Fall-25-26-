<!DOCTYPE html>
<html>
<head>
  <title>Form Handler</title>
  <link rel="stylesheet" href="task1.css">
</head>
<body>
 
  <h2>Student Registration</h2>
 
  <form onsubmit="return handleSubmit()">
    <label>Full Name:</label>
    <input type="text" id="name" />
 
    <label>Email:</label>
    <input type="text" id="email" />
 
    <label>Password:</label>
    <input type="password" id="password" />

    <label>Confirm Password:</label>
    <input type="password" id="confirmpassword" />
 
    <button type="register">Register</button>

    
    <!-- Output Section -->
    <div id="error"></div>
    <div id="output"></div>

  </form>

  <h2>Course Selection</h2>

  <form onsubmit="return false;">
    <label>Course Name:</label>
    <input type="text" id="courseInput" placeholder="Enter course name">

    <button onclick="addCourse()">Add Course</button>
  </form>

  <ul id="courseList"></ul>
 
  <script>
    function handleSubmit() {
      // Get values from form
      var name = document.getElementById("name").value.trim();
      var email = document.getElementById("email").value.trim();
      var password = document.getElementById("password").value.trim();
      var confirmpassword = document.getElementById("confirmpassword").value;
 
      var errorDiv = document.getElementById("error");
      var outputDiv = document.getElementById("output");
 
      // Clear previous messages
      errorDiv.innerHTML = "";
      outputDiv.innerHTML = "";
 
      // Validation
      if (name === "" || email === "" || password === "" || confirmpassword === "") {
        errorDiv.innerHTML = "Please fill in all fields.";
        return false;
      }
 
      if (!email.includes("@")) {
        alert("Email must contain '@'");
        return;
    }
 
      if (password !== confirmpassword) {
        alert("Passwords do not match!");
        return;
    }
 
      outputDiv.innerHTML = `
        <strong>Registration Complete!</strong><br><br>
        Name: ${name}<br>
        Email: ${email}<br>
      `;
 
      return false;
    }
  </script>
 
</body>
</html>