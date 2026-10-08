// ===============================
// CLINIC QUEUE SYSTEM
// ===============================


let patients = JSON.parse(localStorage.getItem("patients")) || [];
let history = JSON.parse(localStorage.getItem("history")) || [];


let queueNumber =
    Number(localStorage.getItem("queueNumber")) || 1;


let currentServing =
    JSON.parse(localStorage.getItem("currentServing")) || null;




// ===============================
// SAVE DATA
// ===============================


function saveData() {
    localStorage.setItem("patients", JSON.stringify(patients));
    localStorage.setItem("history", JSON.stringify(history));
    localStorage.setItem("queueNumber", queueNumber);
    localStorage.setItem(
        "currentServing",
        JSON.stringify(currentServing)
    );
}




// ===============================
// REGISTER PATIENT
// ===============================


const registerForm = document.getElementById("registerForm");


if (registerForm) {


    registerForm.addEventListener("submit", function(event) {


        event.preventDefault();


        const name = document.getElementById("name").value;
        const age = document.getElementById("age").value;
        const contact = document.getElementById("contact").value;
        const priority = document.getElementById("priority").value;


        const patient = {


            id: Date.now(),


            queue:
                "Q-" +
                String(queueNumber).padStart(3, "0"),


            name: name,


            age: age,


            contact: contact,


            priority: priority,


            registeredAt: new Date().toISOString(),


            status: "Waiting"
        };


        patients.push(patient);


        queueNumber++;


        saveData();


        const result =
            document.getElementById("registrationResult");


        result.classList.remove("hidden");


        result.innerHTML = `
            <p>Patient successfully registered!</p>


            <h2>${patient.queue}</h2>


            <p>
                <strong>${patient.name}</strong>
            </p>


            <p>
                Please wait for your number to be called.
            </p>
        `;


        registerForm.reset();


    });


}




// ===============================
// PRIORITY ORDER
// ===============================


function priorityValue(priority) {


    const values = {


        emergency: 1,


        senior: 2,


        pwd: 3,


        regular: 4


    };


    return values[priority] || 4;
}




// ===============================
// SORT QUEUE
// ===============================


function getWaitingPatients() {


    return patients
        .filter(patient => patient.status === "Waiting")
        .sort((a, b) => {


            const priorityDifference =
                priorityValue(a.priority) -
                priorityValue(b.priority);


            if (priorityDifference !== 0) {
                return priorityDifference;
            }


            return new Date(a.registeredAt) -
                   new Date(b.registeredAt);


        });
}




// ===============================
// CALL NEXT PATIENT
// ===============================


function callNext() {


    const waiting = getWaitingPatients();


    if (waiting.length === 0) {


        alert("There are no patients waiting.");


        return;
    }


    // Complete previous patient
    if (currentServing) {


        const previous =
            patients.find(
                p => p.id === currentServing.id
            );


        if (previous) {


            previous.status = "Completed";


            history.push({


                ...previous,


                completedAt:
                    new Date().toISOString()


            });


        }


    }


    const nextPatient = waiting[0];


    nextPatient.status = "Serving";


    currentServing = nextPatient;


    saveData();


    updateQueuePage();


    updateWaitingDisplay();


}




// ===============================
// COMPLETE PATIENT
// ===============================


function completePatient(id) {


    const patient =
        patients.find(p => p.id === id);


    if (!patient) return;


    patient.status = "Completed";


    history.push({


        ...patient,


        completedAt:
            new Date().toISOString()


    });


    if (
        currentServing &&
        currentServing.id === id
    ) {


        currentServing = null;


    }


    saveData();


    updateQueuePage();


    updateWaitingDisplay();


}




// ===============================
// SKIP PATIENT
// ===============================


function skipPatient(id) {


    const patient =
        patients.find(p => p.id === id);


    if (!patient) return;


    patient.status = "Cancelled";


    history.push({


        ...patient,


        cancelledAt:
            new Date().toISOString()


    });


    if (
        currentServing &&
        currentServing.id === id
    ) {


        currentServing = null;


    }


    saveData();


    updateQueuePage();


    updateWaitingDisplay();


}




// ===============================
// DISPLAY PRIORITY
// ===============================


function priorityLabel(priority) {


    const labels = {


        emergency: "Emergency",


        senior: "Senior",


        pwd: "PWD",


        regular: "Regular"


    };


    return labels[priority] || "Regular";
}




// ===============================
// PRIORITY HTML
// ===============================


function priorityHTML(priority) {


    return `
        <span class="priority priority-${priority}">
            ${priorityLabel(priority)}
        </span>
    `;


}




// ===============================
// WAITING TIME
// ===============================


function getWaitingTime(date) {


    const start = new Date(date);


    const now = new Date();


    const difference =
        Math.floor(
            (now - start) / 60000
        );


    if (difference < 1) {


        return "Less than 1 min";


    }


    return difference + " min";


}




// ===============================
// STAFF QUEUE TABLE
// ===============================


function updateQueuePage() {


    const table =
        document.getElementById("queueTable");


    if (!table) return;


    const waiting =
        getWaitingPatients();


    table.innerHTML = "";


    waiting.forEach(patient => {


        table.innerHTML += `


            <tr>


                <td>
                    <strong>
                        ${patient.queue}
                    </strong>
                </td>


                <td>
                    ${patient.name}
                </td>


                <td>
                    ${patient.age}
                </td>


                <td>
                    ${priorityHTML(patient.priority)}
                </td>


                <td>
                    ${getWaitingTime(patient.registeredAt)}
                </td>  


               <td>


    <button
        class="success-btn"
        onclick="startSpecificPatient(${patient.id})"
    >
        Call
    </button>


    <button
        class="complete-btn"
        onclick="completePatient(${patient.id})"
    >
        Complete
    </button>


    <button
        class="danger-btn"
        onclick="skipPatient(${patient.id})"
    >
        Skip
    </button>


</td>




            </tr>


        `;


    });


    if (waiting.length === 0) {


        table.innerHTML = `


            <tr>


                <td
                    colspan="6"
                    style="text-align:center;"
                >
                    No patients waiting.
                </td>


            </tr>


        `;


    }


    const current =
        document.getElementById("staffCurrent");


    if (current) {


        current.textContent =
            currentServing
                ? currentServing.queue
                : "---";


    }


}




// ===============================
// CALL SPECIFIC PATIENT
// ===============================


function startSpecificPatient(id) {


    if (currentServing) {


        const previous =
            patients.find(
                p => p.id === currentServing.id
            );


        if (previous) {


            previous.status = "Completed";


            history.push({


                ...previous,


                completedAt:
                    new Date().toISOString()


            });


        }


    }


    const patient =
        patients.find(p => p.id === id);


    if (!patient) return;


    patient.status = "Serving";


    currentServing = patient;


    saveData();


    updateQueuePage();


    updateWaitingDisplay();


}




// ===============================
// WAITING DISPLAY
// ===============================


function updateWaitingDisplay() {


    const servingNumber =
        document.getElementById("nowServing");


    const servingName =
        document.getElementById("servingName");


    if (!servingNumber) return;


    if (currentServing) {


        servingNumber.textContent =
            currentServing.queue;


        servingName.textContent =
            currentServing.name;


    } else {


        servingNumber.textContent =
            "---";


        servingName.textContent =
            "Please wait...";


    }


    const nextPatients =
        document.getElementById("nextPatients");


    if (!nextPatients) return;


    const waiting =
        getWaitingPatients().slice(0, 3);


    nextPatients.innerHTML = "";


    for (let i = 0; i < 3; i++) {


        if (waiting[i]) {


            nextPatients.innerHTML += `


                <div class="patient-card">


                    <span>
                        ${waiting[i].queue}
                    </span>


                    <p>
                        ${waiting[i].name}
                    </p>


                </div>


            `;


        } else {


            nextPatients.innerHTML += `


                <div class="patient-card">


                    <span>---</span>


                    <p>Waiting...</p>


                </div>


            `;


        }


    }


}




// ===============================
// HISTORY PAGE
// ===============================


function updateHistoryPage() {


    const table =
        document.getElementById("historyTable");


    if (!table) return;


    table.innerHTML = "";


    history
        .slice()
        .reverse()
        .forEach(patient => {


            const date =
                new Date(
                    patient.completedAt ||
                    patient.cancelledAt
                ).toLocaleString();


            table.innerHTML += `


                <tr>


                    <td>
                        <strong>
                            ${patient.queue}
                        </strong>
                    </td>


                    <td>
                        ${patient.name}
                    </td>


                    <td>
                        ${patient.age}
                    </td>


                    <td>
                        ${priorityHTML(patient.priority)}
                    </td>


                    <td>
                        ${patient.status}
                    </td>


                    <td>
                        ${date}
                    </td>


                </tr>


            `;


        });


}




// ===============================
// AUTOMATIC REFRESH
// ===============================


updateQueuePage();


updateWaitingDisplay();


updateHistoryPage();


setInterval(() => {


    updateQueuePage();


    updateWaitingDisplay();


}, 30000);


