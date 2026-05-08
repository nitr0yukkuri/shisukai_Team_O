// 実際の運用ではAPI等からデータを取得する想定
let employees = [];

const tbody = document.getElementById('employeeList');
const searchName = document.getElementById('searchName');
const searchId = document.getElementById('searchId');

// リスト描画関数
function renderList(data) {
    tbody.innerHTML = '';

    // データ行の生成
    data.forEach(emp => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${emp.name}</td><td>${emp.id}</td>`;
        tbody.appendChild(tr);
    });

    // ワイヤーフレームの見た目に合わせるため、表示行数を増やして下の余白を減らす
    const emptyRows = Math.max(0, 20 - data.length);
    for (let i = 0; i < emptyRows; i++) {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>&nbsp;</td><td>&nbsp;</td>`;
        tbody.appendChild(tr);
    }
}

// 検索フィルタリング関数
function filterList() {
    const nameQuery = searchName.value;
    const idQuery = searchId.value;
    const filtered = employees.filter(emp =>
        emp.name.includes(nameQuery) && emp.id.includes(idQuery)
    );
    renderList(filtered);
}

// イベントリスナーの設定
searchName.addEventListener('input', filterList);
searchId.addEventListener('input', filterList);

// 初期表示 (モックデータがないため空の行が描画されます)
renderList(employees);

/* // サーバーからデータを取得する場合の例:
async function fetchData() {
  try {
    const response = await fetch('/api/employees');
    employees = await response.json();
    renderList(employees);
  } catch (error) {
    console.error('データ取得エラー:', error);
  }
}
// fetchData(); 
*/