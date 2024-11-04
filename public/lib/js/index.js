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


function getStudents(){
    let table = document.getElementById("studentsList");

    let newRow = table.insertRow();

    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: 'getStudents'
        },
        success: function(response) {
            // console.log(response);
            response = JSON.parse(response);
            // console.log(response);
            newRow.innerHTML=`
                <td class="border border-slate-300 text-center">${response.stud_id}</td>
                <td class="border border-slate-300 text-center">${response.lname}</td>
                <td class="border border-slate-300 text-center">${response.fname}</td>
                <td class="border border-slate-300 text-center">${response.mname}</td>
                <td class="border border-slate-300 text-center">
                <button class="m-1 bg-blue-500 text-white text-lg px-2 py-1 rounded hover:bg-blue-600" onclick="test(${response.stud_id})">INFO</button>
                <button class="m-1 bg-blue-500 text-white text-lg px-2 py-1 rounded hover:bg-blue-600" onclick="test(${response.stud_id})">SUBJECT</button>
                <button class="m-1 bg-red-500 text-white text-lg px-1 py-1 rounded hover:bg-red-600" onclick="test(${response.stud_id})">DEACTIVATE</button>
                </td>
            `;
        },
        error: function(xhr, status, error) {
            console.log("An error occurred. Please try again later.");
        }
    });
}

function toggleMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}

function test(a){
    alert("test "+ a);
}