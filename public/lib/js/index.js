function login(){
    let studentId = document.getElementById("studentId").value;
    let pass = document.getElementById("pass").value;
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
            // console.log(response);
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
    // let stud_id = document.getElementById("sid").value.trim();
    let stud_pass = document.getElementById("password").value.trim();
    let stud_passC = document.getElementById("passwordC").value.trim();

    let userRole = document.getElementById("userRole").value.trim()
    let userCourse = document.getElementById("userCourse").value.trim()

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

    if (!stud_pass ||!stud_passC ||!fname ||!lname ||!DOB 
        ||!address ||!pnumber ||!gfname ||!glname ||!gaddress ||!gpnumber || !userCourse) {
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
            stud_pass: stud_pass,
            fname: fname,
            mname: mname,
            lname: lname,
            Role:userRole,
            DOB: DOB,
            address: address,
            pnumber: pnumber,
            gfname: gfname,
            gmname: gmname,
            glname: glname,
            gaddress: gaddress,
            gpnumber: gpnumber,
            stdcourse:userCourse
        },
        success: function (response) {
            console.log(response);
            
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

                        window.location.href = '/admin';
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
            // console.log(response);
            
            response = JSON.parse(response); 

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
                if(student.Role === 0){
                    newRow.innerHTML=`
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">${student.stud_id}</td>
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">${student.lname}</td>
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">${student.fname}</td>
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">${student.mname}</td>
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">
                    <button class="m-1 bg-blue-500 text-white text-lg sm:px-2 sm:py-1 rounded hover:bg-blue-600" onclick="getStudentById(${student.user_id})">INFO</button>
                    <button class="m-1 bg-blue-500 text-white text-lg sm:px-2 sm:py-1 rounded hover:bg-blue-600" onclick="set_stud_id_to_get_sub(${student.stud_id})">SUBJECTS</button>
                    <button class="m-1 bg-red-500 text-white text-lg sm:px-2 sm:py-1 rounded hover:bg-red-600" onclick="resetPass(${student.user_id})">RESET PASS</button>
                    <button class="m-1 bg-red-500 text-white text-lg sm:px-1 sm:py-1 rounded hover:bg-red-600" onclick="${buttonCTA}">${btnTxt}</button>
                    </td>
                    `;
                }                
            });
        },
        error: function(xhr, status, error) {
            console.log("An error occurred. Please try again later.",xhr,"\n",status,"\n",error);
        }
    });
}

function getStudentById(studentId){
    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: 'getStudentById',
            user_id:studentId
        },
        success: function(response) {
            // console.log(response);
            
            response = JSON.parse(response);   

            if(response.status === 'success'){
                window.location.href = "/viewstudentinfo";
            }
            else
            {
                Swal.fire({
                    icon: "error",
                    title: "Check logs for error"
                });
                console.log(response);
            }
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
        text: "Do you want to deactive student account?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText:"Yes",
        confirmButtonColor: "#d33",
        cancelButtonText:"No, go back"
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
        confirmButtonText:"Yes activate student account",
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

function resetSubjecTable(){
    const table = document.getElementById("subjectsTbl");
    const tbody = table.getElementsByTagName("tbody")[0];

    while (tbody.rows.length > 0) {
        tbody.deleteRow(0);
    }
}

function addSubject(){
    let subjectCode = document.getElementById("subCode").value.trim().toUpperCase();
    let subjectName = document.getElementById("subName").value.trim().toUpperCase();
    let subjectUnits = document.getElementById("units").value.trim().toUpperCase();
    let subjectCourse = document.getElementById("course").value.trim().toUpperCase();

    if (!subjectCode ||!subjectName ||!subjectUnits ||!subjectCourse) {
        fieldError.classList.remove("hidden");
        return;
    }

    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: "addSubject",
            sub_Code: subjectCode,
            sub_Name: subjectName,
            sub_Units: subjectUnits,
            sub_Course: subjectCourse
        },
        success: function (response) {
            let result = JSON.parse(response);  

            if (result.status === 'success') {
                Swal.fire({
                    icon: "success",
                    title: "Subject Added Successfully",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                        let subjectCode = document.getElementById("subCode");
                        let subjectName = document.getElementById("subName");
                        let subjectUnits = document.getElementById("units");
                        let subjectCourse = document.getElementById("course");

                        subjectCode.value = "";
                        subjectName.value = "";
                        subjectUnits.value = "";
                        subjectCourse.value = "";
                    });
                                          
            }
            else if(result.status === 'duplicate'){
                Swal.fire({
                    icon: "error",
                    title: "Duplicate Entry",        
                    text: "Subject Code already existed",
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

function getSubjects(){
    let tbody = document.getElementById("subjectsList");    

    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: 'getSubjects'
        },
        success: function(response) {
            response = JSON.parse(response);

            response.forEach(subject => {
                let newRow = tbody.insertRow();

                newRow.innerHTML=`
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">${subject.subject_code}</td>
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">${subject.subject_name}</td>
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">${subject.units}</td>
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">${subject.course}</td>
                    <td class="border border-slate-300 text-center sm:p-2 text-xs sm:text-lg">
                    <button class="m-1 bg-red-500 text-white text-sm sm:text-lg sm:px-2 sm:py-1 rounded hover:bg-red-600" onclick="dltSubject(${subject.subject_id})">DELETE</button>
                    </td>
                `;
            });
        },
        error: function(xhr, status, error) {
            console.log("An error occurred. Please try again later.",xhr,"\n",status,"\n",error);
        }
    });    
}

function set_stud_id_to_get_sub(sid){
    
    // console.log(sid);
    
    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: 'set_stud_id_to_get_sub',
            stud_id_to_get:sid
        },
        success: function(response) {
            response = JSON.parse(response);
            
            response.status === 'success' ? window.location.href='/viewstudentsubject' : console.log(response);   
           
        },
        error: function(xhr, status, error) {
            console.log("An error occurred. Please try again later.",xhr,"\n",status,"\n",error);
        }
    }); 
}

function getStudSub(sid,role){
    let tbody = document.getElementById("subjectsList");    

    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: 'getSubjectsBySid',
            StudSubId:sid
        },
        success: function(response) {
            
            response = JSON.parse(response);
            if(role === 0){

            }
            else if(role === 1){

            }
            response.forEach(subject => {
                let newRow = tbody.insertRow();

                newRow.innerHTML=`
                    <td class="border border-slate-300 text-center text-xs sm:text-lg">${subject.subject_code}</td>
                    <td class="border border-slate-300 text-center text-xs sm:text-lg">${subject.subject_name}</td>
                    <td class="border border-slate-300 text-center text-xs sm:text-lg">${subject.units}</td>
                    <td class="border border-slate-300 text-center text-xs sm:text-lg">${subject.time}</td>
                    <td class="border border-slate-300 text-center text-xs sm:text-lg">${subject.day}</td>
                    <td class="border border-slate-300 text-center text-xs sm:text-lg">${subject.room}</td>
                    ${
                        role === 1 ? `<td class="border border-slate-300 text-center text-sm sm:text-lg">                    
                        <button class="m-1 bg-red-500 text-white text-lg sm:px-2 sm:py-1 rounded hover:bg-red-600" onclick="dltStudSub(${sid},${subject.subject_id},${role})">DELETE</button>
                        </td>`
                        : ``
                    }
                    
                `;
            });
        },
        error: function(xhr, status, error) {
            console.log("An error occurred. Please try again later.",xhr,"\n",status,"\n",error);
        }
    });
}

function dltSubject(dltSub){
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete subject?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText:"Yes",
        confirmButtonColor: "#d33",
        cancelButtonText:"No, go back"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: './src/request/request.php',
                data: {
                    choice: "dltSubject",
                    sub_id:dltSub
                },
                success: function (response) {
                    let result = JSON.parse(response);   
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "Subject Deleted Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        resetSubjecTable();
                        getSubjects();
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

function changePassword(){
    let oldPass = document.getElementById("oldPass").value;
    let newPass = document.getElementById("newPass").value;
    let newPassC = document.getElementById("newPassC").value;

    let button = document.getElementById("changeBtn");

    button.value = "Changing...";

    if(!oldPass || !newPass || !newPassC)
    {
        fieldError.classList.remove("hidden");
        button.value = "CHANGE";
        return;
    }

    if(newPass !== newPassC)
    {
        document.getElementById("newPass").value = "";
        document.getElementById("newPassC").value = "";
        fieldError.innerText = "New Password Doesn't Match";
        fieldError.classList.remove("hidden");
        button.value = "CHANGE";
        return;
    }

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to change password?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText:"Yes",
        confirmButtonColor: "#d33",
        cancelButtonText:"No, go back"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: './src/request/request.php',
                data: {
                    choice: "changePass",
                    old_Pass:oldPass,
                    new_Pass:newPass
                },
                success: function (response) {
                    
                    let result = JSON.parse(response);   
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: "info",
                            title: "Password Changed Successfully, Logging out...",
                            showConfirmButton: false,
                            timer: 3500
                        }).then(() => {
                            document.getElementById("newPass").value = "";
                            document.getElementById("newPassC").value = "";
                            document.getElementById("oldPass").value = "";
                            button.value = "CHANGE";
                            // window.location.href = '/profile';
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
                        });                        
                    } 
                    else if(result.status === 'invalid'){
                        document.getElementById("oldPass").value = "";
                        fieldError.innerText = "Wrong Password";
                        fieldError.classList.remove("hidden");
                        button.value = "CHANGE";
                    }
                    else {
                        Swal.fire({
                            icon: "error",
                            title: "unexpected error detected",
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

function resetPass(idToRst){
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to reset password?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText:"Yes",
        confirmButtonColor: "#d33",
        cancelButtonText:"No, go back"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: './src/request/request.php',
                data: {
                    choice: "resetPass",
                    toReset:idToRst
                },
                success: function (response) {
                    
                    let result = JSON.parse(response);   
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "Password Reset Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        });                        
                    } 
                    else {
                        Swal.fire({
                            icon: "error",
                            title: "unexpected error detected",
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

function loadSubjects(){
    let select = document.getElementById("subToAdd");    

    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: 'getSubjects'
        },
        success: function(response) {  

            response = JSON.parse(response);
            
            select.innerHTML = "";

            let defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.text = "Select a Subject";
            defaultOption.disabled = true;
            defaultOption.selected = true;
            select.appendChild(defaultOption);

            response.forEach(subject => {
                
                let option = document.createElement("option");
                option.value = subject.subject_id;
                option.text = `${subject.subject_code} - ${subject.subject_name}`;
                select.appendChild(option);
            });
        },
        error: function(xhr, status, error) {
            console.log("An error occurred. Please try again later.",xhr,"\n",status,"\n",error);
        }
    });    
}

function vStudSubRstTable(){
    const table = document.getElementById("subjectsTbl");
    const tbody = table.getElementsByTagName("tbody")[0];

    while (tbody.rows.length > 0) {
        tbody.deleteRow(0);
    }
}

function addSubjectToUser(sid,role){
    let subToAdd = document.getElementById("subToAdd").value.trim()
    let dayToAdd = document.getElementById("day").value.trim()
    let timeToAdd = document.getElementById("time").value.trim()
    let roomToAdd = document.getElementById("room").value.trim()

    fieldError.classList.add("hidden");

    if(!subToAdd || !dayToAdd || !timeToAdd || !roomToAdd){
        fieldError.classList.remove("hidden");
        return;
    }

    $.ajax({
        type: "POST",
        url: './src/request/request.php',
        data: {
            choice: "addSubToStud",
            stud_id: sid,
            sub_Id: subToAdd,
            day: dayToAdd,
            time: timeToAdd,
            room: roomToAdd
        },
        success: function (response) {            
            let result = JSON.parse(response);  
            if (result.status === 'success') {
                Swal.fire({
                    icon: "success",
                    title: "Subject Added Successfully",
                    showConfirmButton: false,
                    timer: 1000
                }).then(() => {
                    vStudSubRstTable();
                    getStudSub(sid,role);
                    loadSubjects();
                    resetVSSPage();
                });
                                          
            }
            else if(result.status === 'duplicate'){
                Swal.fire({
                    icon: "error",
                    title: "Duplicate Entry",        
                    text: "Load already exist",
                    showConfirmButton: false,
                    timer: 1500
                }).then(()=>{
                    loadSubjects();
                    resetVSSPage();
                });
            }     
            else if(result.status === 'limit'){
                Swal.fire({
                    icon: "error",
                    title: "User Subject Limit",        
                    text: "User has reached the max allowed subject",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    loadSubjects();
                    resetVSSPage();
                });
            }
            else if(result.status === 'conflict'){
                Swal.fire({
                    icon: "error",
                    title: "User Time Conflict",        
                    text: "User has a subject already in that time and day",
                    showConfirmButton: false,
                    timer: 2500
                }).then(() => {
                    console.log(sid+ " " +
                        subToAdd+ " " +
                        dayToAdd+ " " +
                        timeToAdd+ " " +
                        roomToAdd);
                    
                    loadSubjects();
                    resetVSSPage();
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

function dltStudSub(sid,subId,role){
    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to delete subject?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText:"Yes",
        confirmButtonColor: "#d33",
        cancelButtonText:"No, go back"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: './src/request/request.php',
                data: {
                    choice: "dltStudSub",
                    stud_id:sid,
                    sub_id:subId
                },
                success: function (response) {
                    let result = JSON.parse(response);   
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: "success",
                            title: "Subject Deleted Successfully",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            vStudSubRstTable();
                            getStudSub(sid,role);
                            loadSubjects();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Check logs",
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

function resetVSSPage(){
    let select2 = document.getElementById("room"); 
    let select3 = document.getElementById("day"); 
    select2.selectedIndex = 0;
    select3.selectedIndex = 0;
    
    let select = document.getElementById("time");  
    select.innerHTML = "";

    let defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.text = "Select Time";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    select.appendChild(defaultOption);
}

function setTime(){
    let day = document.getElementById("day").value.trim();
    let select = document.getElementById("time");  
    
    $MWF = ["7:00-8:00 AM",
        "8:00-9:00 AM",
        "9:00-10:00 AM",
        "10:00-11:00 AM",
        "11:00-12:00 PM",
        "12:00-1:00 PM",
        "1:00-2:00 PM",
        "2:00-3:00 PM",
        "3:00-4:00 PM",
        "4:00-5:00 PM",
        "5:00-6:00 PM",
        "6:00-7:00 PM",
        "7:00-8:00 PM"
    ]
    $TTH = [
        "7:30-9:00 AM",
        "9:00-10:30 AM",
        "10:30-12:00 PM",
        "12:00-1:30 PM",
        "1:30-3:00 PM",
        "3:00-4:30 PM",
        "4:30-6:00 PM",
        "6:00-7:30 PM"
    ]
    $SAT = [
        "7:00-10:00 AM",
        "10:00-1:00 PM",
        "1:00-4:00 PM",
        "4:00-7:00 PM"
    ]
    select.innerHTML = "";

    let defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.text = "Select Time";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    select.appendChild(defaultOption);

    if(day === 'MWF'){
        $MWF.forEach(time => {            
            let option = document.createElement("option");
            option.value = time;
            option.text = time;
            select.appendChild(option);
        });
    }
    else if(day === 'TTH'){
        $TTH.forEach(time => {            
            let option = document.createElement("option");
            option.value = time;
            option.text = time;
            select.appendChild(option);
        });
    }
    else if(day === 'SAT'){
        $SAT.forEach(time => {            
            let option = document.createElement("option");
            option.value = time;
            option.text = time;
            select.appendChild(option);
        });
    }
}