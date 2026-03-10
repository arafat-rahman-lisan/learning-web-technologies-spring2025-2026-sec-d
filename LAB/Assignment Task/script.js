function setMessage(id, messages, success=false){
  const box = document.getElementById(id);
  box.classList.remove("success");
  if(success){ box.classList.add("success"); }
  box.innerHTML = Array.isArray(messages) ? messages.join("<br>") : messages;
}

function clearMessage(id){
  const box = document.getElementById(id);
  if(box){
    box.classList.remove("success");
    box.innerHTML = "";
  }
}

function validateNameValue(name){
  if(name === "") return "Name cannot be empty";
  if(!/^[A-Za-z]/.test(name)) return "Name must start with a letter";
  if(!/^[A-Za-z][A-Za-z.\-\s]*$/.test(name)) return "Name can contain only letters, dot(.) and dash(-)";
  const words = name.trim().split(/\s+/);
  if(words.length < 2) return "Name must contain at least two words";
  return "";
}

function validateEmailValue(email){
  if(email === "") return "Email cannot be empty";
  const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if(!pattern.test(email)) return "Invalid email address";
  return "";
}

function validateGenderValue(name){
  const genders = document.getElementsByName(name);
  for(let i=0;i<genders.length;i++){
    if(genders[i].checked) return "";
  }
  return "Please select a gender";
}

function validateDOBValue(dd, mm, yyyy){
  if(dd === "" || mm === "" || yyyy === "") return "Date of Birth cannot be empty";
  if(isNaN(dd) || isNaN(mm) || isNaN(yyyy)) return "Date of Birth must be numeric";

  dd = parseInt(dd, 10);
  mm = parseInt(mm, 10);
  yyyy = parseInt(yyyy, 10);

  if(dd < 1 || dd > 31) return "Day must be between 1 and 31";
  if(mm < 1 || mm > 12) return "Month must be between 1 and 12";
  if(yyyy < 1900 || yyyy > 2016) return "Year must be between 1900 and 2016";

  const daysInMonth = new Date(yyyy, mm, 0).getDate();
  if(dd > daysInMonth) return "Invalid date";

  return "";
}

function validateDegreeValue(name){
  const degrees = document.getElementsByName(name);
  for(let i=0;i<degrees.length;i++){
    if(degrees[i].checked) return "";
  }
  return "Please select at least one degree";
}

function validateBloodGroupValue(value){
  if(value === "") return "Please select a blood group";
  return "";
}

function validateUserIdValue(userId){
  if(userId === "") return "User ID cannot be empty";
  if(isNaN(userId) || parseInt(userId, 10) <= 0) return "User ID must be a positive number";
  return "";
}

function validatePhotoValue(value){
  if(value === "") return "Picture cannot be empty";
  return "";
}

function validateNamePage(){
  const name = document.getElementById("name").value.trim();
  const err = validateNameValue(name);
  setMessage("msg", err || "Valid", !err);
  return false;
}

function validateEmailPage(){
  const email = document.getElementById("email").value.trim();
  const err = validateEmailValue(email);
  setMessage("msg", err || "Valid", !err);
  return false;
}

function validateGenderPage(){
  const err = validateGenderValue("gender");
  setMessage("msg", err || "Valid", !err);
  return false;
}

function validateDOBPage(){
  const dd = document.getElementById("dd").value.trim();
  const mm = document.getElementById("mm").value.trim();
  const yyyy = document.getElementById("yyyy").value.trim();
  const err = validateDOBValue(dd, mm, yyyy);
  setMessage("msg", err || "Valid", !err);
  return false;
}

function validateDegreePage(){
  const err = validateDegreeValue("degree");
  setMessage("msg", err || "Valid", !err);
  return false;
}

function validateBloodGroupPage(){
  const bg = document.getElementById("bloodGroup").value;
  const err = validateBloodGroupValue(bg);
  setMessage("msg", err || "Valid", !err);
  return false;
}

function validatePicturePage(){
  const userId = document.getElementById("userId").value.trim();
  const photo = document.getElementById("photo").value;

  const errors = [];
  const userErr = validateUserIdValue(userId);
  const photoErr = validatePhotoValue(photo);

  if(userErr) errors.push(userErr);
  if(photoErr) errors.push(photoErr);

  setMessage("msg", errors.length ? errors : "Valid", errors.length === 0);
  return false;
}

function validateForm(){
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const dd = document.getElementById("dd").value.trim();
  const mm = document.getElementById("mm").value.trim();
  const yyyy = document.getElementById("yyyy").value.trim();
  const bloodGroup = document.getElementById("bloodGroup").value;
  const userId = document.getElementById("userId").value.trim();
  const photo = document.getElementById("photo").value;

  const errors = [];

  const nameErr = validateNameValue(name);
  const emailErr = validateEmailValue(email);
  const genderErr = validateGenderValue("gender");
  const dobErr = validateDOBValue(dd, mm, yyyy);
  const degreeErr = validateDegreeValue("degree");
  const bloodErr = validateBloodGroupValue(bloodGroup);
  const userErr = validateUserIdValue(userId);
  const photoErr = validatePhotoValue(photo);

  if(nameErr) errors.push(nameErr);
  if(emailErr) errors.push(emailErr);
  if(genderErr) errors.push(genderErr);
  if(dobErr) errors.push(dobErr);
  if(degreeErr) errors.push(degreeErr);
  if(bloodErr) errors.push(bloodErr);
  if(userErr) errors.push(userErr);
  if(photoErr) errors.push(photoErr);

  setMessage("messageBox", errors.length ? errors : "Form submitted successfully", errors.length === 0);
  return false;
}