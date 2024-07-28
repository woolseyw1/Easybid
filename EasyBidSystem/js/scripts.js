// scripts.js
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Initialize data table
    var contractsTable = new simpleDatatables.DataTable("#contractsTable");
});

// Fetch data function
async function fetchData(url) {
    const response = await fetch(url);
    const data = await response.json();
    return data;
}

// Display data function
function displayData(tableId, data) {
    const table = document.getElementById(tableId).getElementsByTagName('tbody')[0];
    table.innerHTML = ''; // Clear existing data
    data.forEach(row => {
        const newRow = table.insertRow();
        Object.values(row).forEach(cellData => {
            const newCell = newRow.insertCell();
            newCell.textContent = cellData;
        });
    });
}

module.exports = { fetchData, displayData };

