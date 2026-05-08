document.addEventListener("DOMContentLoaded", () => {

    let employees = [];

    const tbody = document.getElementById('employeeList');
    const searchName = document.getElementById('searchName');
    const searchId = document.getElementById('searchId');

    function renderList(data) {
        tbody.innerHTML = '';

        data.forEach(emp => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${emp.employee_name}</td>
                <td>${emp.employee_id}</td>
            `;
            tbody.appendChild(tr);
        });

        const emptyRows = Math.max(0, 20 - data.length);
        for (let i = 0; i < emptyRows; i++) {
            const tr = document.createElement('tr');
            tr.innerHTML = `<td>&nbsp;</td><td>&nbsp;</td>`;
            tbody.appendChild(tr);
        }
    }

    function filterList() {
        const nameQuery = searchName.value;
        const idQuery = searchId.value;

        const filtered = employees.filter(emp =>
            emp.employee_name.includes(nameQuery) &&
            emp.employee_id.toString().includes(idQuery)
        );

        renderList(filtered);
    }

    searchName.addEventListener('input', filterList);
    searchId.addEventListener('input', filterList);

    async function fetchData() {
        try {
            const response = await fetch("get_employees.php");
            employees = await response.json();
            renderList(employees);
        } catch (error) {
            console.error("データ取得エラー:", error);
        }
    }

    fetchData();
});
