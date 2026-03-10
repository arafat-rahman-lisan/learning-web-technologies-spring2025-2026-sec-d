function validateName() {
    var name = document.getElementById("name").value.trim();
    if (name === "")
    {
        alert("Name must be filled out ");
        return false;
    }
    return true;
};

function validateEmail() {
    var email = document.getElementById("email").value.trim();
    if(email === "")
    {
        alert("Email must be filled out");
        return false;
    }
    return true
};

function validateGender()
{
    var gender = document.getElementsByName("gender");
    var selected = false;
        for (var i = 0;i<gender.length;i++)
        {
            if(gender[i].checked)
            {
                selected=true;
            }
        }
    if(!selected)
    {
        alert("Please select a gender");
        return false;
    }   

};