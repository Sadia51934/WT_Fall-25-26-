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

  <h2>Course Selection</h2>
  <form>
  <label>Course Name:</label>
  <input type="text" id="courseInput">

  <button type="button" onclick="addCourse()">Add Course</button>

  <div id="courseList"></div>
  </form>
  <script>
  function addCourse() {
    let courseName = document.getElementById("courseInput").value.trim();

    if (courseName === "") {
      alert("Please enter a course name.");
      return;
    }

    // Create course item container
    let courseItem = document.createElement("div");
    courseItem.className = "course-item";

    // Add the course name
    let text = document.createElement("span");
    text.textContent = courseName;
    courseItem.appendChild(text);

    // Add delete button
    let delBtn = document.createElement("button");
    delBtn.textContent = "Delete";
    delBtn.className = "delete-btn";
    delBtn.onclick = function () {
      courseItem.remove();
    };
    courseItem.appendChild(delBtn);

    // Add to list
    document.getElementById("courseList").appendChild(courseItem);

    // Clear input
    document.getElementById("courseInput").value = "";
  }
</script>
</body>
</html>