<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
let table = new DataTable('#myTable');
let table1 = new DataTable('#myTable1');
let table3 = new DataTable('#myTable3');
let table4 = new DataTable('#myTable4');

// $('#myTable').DataTable({
//     responsive: true
// });
// $('#myTable1').DataTable({
//     responsive: true
// });
</script>

<script>
// This javascript was written specially for edit buttons in data tables so that event listeners would fire on each page

const edits = document.getElementsByClassName("editbuttons");
Array.from(edits).forEach(edit => {
    table.on('click', 'tbody tr', function() {
        let data = table.row(this).data();
        const updateTitleField = document.getElementById("updatetitle");
        updateTitleField.value = data[2];
        const updateDescriptionField = document.getElementById("updatedescription");
        updateDescriptionField.value = data[3];
        const ticketNumber = document.getElementById("hidden_ticket_no");
        let updateTicketNumber = data[1];
        let expectedUpdateTicketNumber = updateTicketNumber.substr(124, 6);
        ticketNumber.value = expectedUpdateTicketNumber;

    });
});


// This javascript was written specially for delete buttons in data tables so that event listeners would fire on each page
const closeButtons = document.getElementsByClassName("closeticketbuttons");
Array.from(closeButtons).forEach(closeButton => {
    table.on('click', 'tbody tr', function() {
        let data = table.row(this).data();
        const ticketNumber = document.getElementById("hidden_close_ticket");
        let extractTicketNumber = data[1];
        let expectedTicketNumber = extractTicketNumber.substr(124, 6);
        ticketNumber.value = expectedTicketNumber;
        let deleteMessage = document.querySelector(".deleteMessage");
        deleteMessage.innerText = "Are you sure you want to close the ticket " + expectedTicketNumber +
            " - " + data[2];

    });
});


const editDepartments = document.querySelectorAll(".editdeptbuttons");
Array.from(editDepartments).forEach(editDept => {
    table3.on("click", "tbody tr", function() {
        let data = table3.row(this).data();
        let updateDepartment = document.querySelector("#updatedepartment");
        updateDepartment.value = data[2];
        let updateDepartmentid = document.querySelector("#department_id");
        updateDepartmentid.value = data[1];
    })
})


const deleteDepartments = document.querySelectorAll(".deletedeptbuttons");
Array.from(deleteDepartments).forEach(deleteDept => {
    table3.on("click", "tbody tr", function() {
        let data = table3.row(this).data();
        let deleteDepartment = document.querySelector("#deletedepartmentid");
        deleteDepartment.value = data[1];
        let deleteDepartmentMessage = document.querySelector("#deletedepartmentmessage");
        deleteDepartmentMessage.innerText = "Are you sure you want to delete department " + data[2] +
            " ?";


    })
})

const editAgentButtons = document.querySelectorAll(".editagentbuttons");
Array.from(editAgentButtons).forEach((editAgentButton) => {
    table4.on("click", "tbody tr", function() {
        let data = table4.row(this).data();
        const updateAgentEmail = document.querySelector("#updateagentemail");
        updateAgentEmail.value = data[1];
        const hiddenUpdateAgentEmail = document.querySelector("#hiddenupdateagentemail");
        hiddenUpdateAgentEmail.value = data[1];
        const updateAgentFname = document.querySelector("#updatefname");
        updateAgentFname.value = data[2];
        const updateAgentLname = document.querySelector("#updatelname");
        updateAgentLname.value = data[3];
        const updateAgentDepartment = document.querySelector("#update_associated_department");
        updateAgentDepartment.value = data[4];
    })
});


const deleteAgentButtons = document.querySelectorAll(".deleteagentbuttons");
Array.from(deleteAgentButtons).forEach((deleteAgentButton) => {
    table4.on("click", "tbody tr", function() {
        let data = table4.row(this).data();
        const hiddenUsername = document.querySelector("#hiddenusername");
        hiddenUsername.value = data[1];
        const deleteAgentMessage = document.querySelector("#deleteagentmessage");
        deleteAgentMessage.innerText = "Are you sure you want to delete Agent - " + data[1];
    })
})


// const updatePhoneButton = document.querySelector("#updatephonenumberbutton");
// updatePhoneButton.addEventListener("click", () => {
//     const showPhoneUpdateForm = document.querySelector("#showhideupdatephonenumber");
//     showPhoneUpdateForm.toggleAttribute("style");
// })
</script>





</body>

</html>