function login(){
    let studentId = document.getElementById("studentId").value.trim();
    let pass = document.getElementById("pass").value.trim();
    let userError = document.getElementById("userError");
    let passError = document.getElementById("passError");

    let button = document.getElementById("loginBtn");

    button.value = "Logging In...";

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
                switch (response.role) {
                    case 0:
                        window.location.href = '/dashboard';
                        break;                
                    case 1:
                        window.location.href = '/admin';
                        break;
                }
                button.value = "LOGIN";
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

function toggleMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}