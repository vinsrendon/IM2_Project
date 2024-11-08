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
                document.getElementById("studentId").value = "";
                document.getElementById("pass").value = "";
                passError.innerText = response.message;
                passError.classList.remove("hidden");
                button.value = "LOGIN";
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
    let stud_id = document.getElementById("sid").value.trim();
    let stud_pass = document.getElementById("password").value.trim();
    let stud_passC = document.getElementById("passwordC").value.trim();

    let fname = document.getElementById("fname").value.trim();
    let mname = document.getElementById("mname").value.trim();
    let lname = document.getElementById("lname").value.trim();
    let DOB = document.getElementById("DOB").value.trim();
    let address = document.getElementById("address").value.trim();
    let pnumber = document.getElementById("pnumber").value.trim();

    let gfname = document.getElementById("gfname").value.trim();
    let gmname = document.getElementById("gmname").value.trim();
    let glname = document.getElementById("glname").value.trim();
    let gaddress = document.getElementById("gaddress").value.trim();
    let gpnumber = document.getElementById("gpnumber").value.trim();

    fieldError.classList.add("hidden");
    passError.classList.add("hidden");

    if (!stud_id ||!stud_pass ||!stud_passC ||!fname ||!lname ||!DOB 
        ||!address ||!pnumber ||!gfname ||!glname ||!gaddress ||!gpnumber) {
        fieldError.classList.remove("hidden");
        return;
    }

    if(stud_pass !== stud_passC){
        passError.classList.remove("hidden");
        return;
    }
    
    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: "addUser",
            stud_id: stud_id,
            stud_pass: stud_pass,
            fname: fname,
            mname: mname,
            lname: lname,
            DOB: DOB,
            address: address,
            pnumber: pnumber,
            gfname: gfname,
            gmname: gmname,
            glname: glname,
            gaddress: gaddress,
            gpnumber: gpnumber
        },
        success: function (response) {
            let result = JSON.parse(response);  

            if (result.status === 'success') {
                Swal.fire({
                    icon: "success",
                    title: "User Added Successfully",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                        let stud_id = document.getElementById("sid");
                        let stud_pass = document.getElementById("password");
                        let stud_passC = document.getElementById("passwordC");

                        let fname = document.getElementById("fname");
                        let mname = document.getElementById("mname");
                        let lname = document.getElementById("lname");
                        let DOB = document.getElementById("DOB");
                        let address = document.getElementById("address");
                        let pnumber = document.getElementById("pnumber");

                        let gfname = document.getElementById("gfname");
                        let gmname = document.getElementById("gmname");
                        let glname = document.getElementById("glname");
                        let gaddress = document.getElementById("gaddress");
                        let gpnumber = document.getElementById("gpnumber");

                        stud_id.value = "";
                        stud_pass.value = "";
                        stud_passC.value = "";
                        fname.value = "";
                        mname.value = "";
                        lname.value = "";
                        DOB.value = "";
                        address.value = "";
                        pnumber.value = "";
                        gfname.value = "";
                        gmname.value = "";
                        glname.value = "";
                        gaddress.value = "";
                        gpnumber.value = "";
                    });
                                          
            }
            else if(result.status === 'duplicate'){
                Swal.fire({
                    icon: "error",
                    title: "Duplicate Entry",        
                    text: "Student ID already existed",
                    showConfirmButton: false,
                    timer: 1500
                });
            }     
            else
            {
                console.log(result);                
            }           
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
        },
    });     
}


function getStudents(){
    let tbody = document.getElementById("studentsList");    

    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: 'getStudents'
        },
        success: function(response) {
            response = JSON.parse(response);
            console.log(response);
            

            response.forEach(student => {
                let newRow = tbody.insertRow();

                let buttonCTA =``;
                let btnTxt = "";

                if(student.Flag === 0){
                    buttonCTA = `activateStud(${student.user_id})`;
                    btnTxt = "ACTIVATE";
                }                    
                else{
                    buttonCTA = `deactivateStud(${student.user_id})`;
                    btnTxt = "DEACTIVATE";
                }                  
                newRow.innerHTML=`
                    <td class="border border-slate-300 text-center">${student.stud_id}</td>
                    <td class="border border-slate-300 text-center">${student.lname}</td>
                    <td class="border border-slate-300 text-center">${student.fname}</td>
                    <td class="border border-slate-300 text-center">${student.mname}</td>
                    <td class="border border-slate-300 text-center">
                    <button class="m-1 bg-blue-500 text-white text-lg px-2 py-1 rounded hover:bg-blue-600" onclick="test(${student.user_id})">INFO</button>
                    <button class="m-1 bg-blue-500 text-white text-lg px-2 py-1 rounded hover:bg-blue-600" onclick="test(${student.user_id})">SUBJECT</button>
                    <button class="m-1 bg-red-500 text-white text-lg px-1 py-1 rounded hover:bg-red-600" onclick="${buttonCTA}">${btnTxt}</button>
                    </td>
                `;
            });
        },
        error: function(xhr, status, error) {
            console.log("An error occurred. Please try again later.",xhr,"\n",status,"\n",error);
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

function deactivateStud(toDeact){
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete student?",
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
                    choice: "deactivate",
                    toDeactivate:toDeact
                },
                success: function (response) {
                    let result = JSON.parse(response);   
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "User Deactivated Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        resetTable();
                        getStudents();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Check logs for error",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(result);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                },
            });
        }
    });
}

function activateStud(toAct){
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to activate student?",
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
                    choice: "activate",
                    toActivate:toAct
                },
                success: function (response) {
                    let result = JSON.parse(response);   
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "User Activated Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        resetTable();
                        getStudents();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Check logs for error",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(result);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                },
            });
        }
    });
}

function resetTable(){
    const table = document.getElementById("studentsTbl");
    const tbody = table.getElementsByTagName("tbody")[0];

    while (tbody.rows.length > 0) {
        tbody.deleteRow(0);
    }
}