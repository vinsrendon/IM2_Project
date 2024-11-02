function login(){
    let studentId = document.getElementById("studentId").value.trim();
    let pass = document.getElementById("pass").value.trim();
    let userError = document.getElementById("userError");
    let passError = document.getElementById("passError");

    userError.classList.add("hidden");
    passError.classList.add("hidden");

    let isValid = true;

    if (studentId === '') {
        userError.classList.remove("hidden");
        isValid = false;
    }

    if (pass === '') {
        passError.classList.remove("hidden");
        isValid = false;
    }

    if (!isValid) {
        return;
    }
    
    // AJAX request to handle login
    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: 'login',
            stud_id: studentId,
            stud_pass: pass
        },
        success: function(response) {
            console.log(response);
            response = JSON.parse(response);
            if (response.status === 'success') {
                document.getElementById("studentId").value = "";
                document.getElementById("pass").value = "";
                window.location.href = '/dashboard';
            } else {
                passError.innerText = response.message;
                passError.classList.remove("hidden");
            }
        },
        error: function(xhr, status, error) {
            passError.innerText = "An error occurred. Please try again later.";
            passError.classList.remove("hidden");
        }
    });
}

function logout(){
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to logout?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText:"Yes",
        cancelButtonText:"No"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: './src/request/request.php',
                data: {
                    choice: "logout"
                },
                success: function (response) {
                    let result = JSON.parse(response);   
                    if (result.status === 'success') {
                        window.location.href = '/';
                    } else {
                        alert(result.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                },
            });
        }
    });
}

function addUser(){
    
}