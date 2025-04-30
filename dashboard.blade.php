
<div class="dashboard-container">
    <div class="dashboard-stats-grid">
        <!-- Total Users Card -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>Total Users</h3>
                <p class="stat-number" id="totalUsers">0</p>
            </div>
        </div>

        <!-- Total Products Card -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-content">
                <h3>Total Products</h3>
                <p class="stat-number" id="totalProducts">0</p>
            </div>
        </div>

        <!-- Total Categories Card -->
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-content">
                <h3>Total Categories</h3>
                <p class="stat-number" id="totalCategories">0</p>
            </div>
        </div>
    </div>

    <div class="dashboard-charts-grid">
        <!-- Monthly Sales Chart -->
        <div class="chart-card">
            <h3>Monthly Sales</h3>
            <canvas id="monthlySalesChart"></canvas>
        </div>

        <!-- Product Distribution Chart -->
        <div class="chart-card">
            <h3>Products by Category</h3>
            <canvas id="productDistributionChart"></canvas>
        </div>
    </div>

    <!-- Recent Users Table -->
    <div class="recent-users-card">
        <h3>Recent Users</h3>
        <div class="table-responsive">
            <table class="table" id="recentUsersTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Joined Date</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 20px;
    background-color: #f8f9fa;
}

.dashboard-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    transition: transform 0.2s;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    background: #4e73df;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
}

.stat-content h3 {
    margin: 0;
    font-size: 0.9rem;
    color: #5a5c69;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0;
    color: #2e59d9;
}

.dashboard-charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.chart-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.recent-users-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table-responsive {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
}

.table th {
    background-color: #f8f9fc;
    padding: 12px;
    text-align: left;
    font-weight: 600;
    color: #4e73df;
}

.table td {
    padding: 12px;
    border-top: 1px solid #e3e6f0;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fetch dashboard stats
    fetch('/admin/dashboard/stats')
        .then(response => response.json())
        .then(data => {
            updateDashboardStats(data);
            createMonthlySalesChart(data.monthly_sales);
            createProductDistributionChart(data.product_stats);
            updateRecentUsersTable(data.recent_users);
        });
});

function updateDashboardStats(data) {
    document.getElementById('totalUsers').textContent = data.total_users;
    document.getElementById('totalProducts').textContent = data.total_products;
    document.getElementById('totalCategories').textContent = data.total_categories;
}

function createMonthlySalesChart(data) {
    const ctx = document.getElementById('monthlySalesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.map(item => item.month),
            datasets: [{
                label: 'Monthly Sales',
                data: data.map(item => item.total),
                borderColor: '#4e73df',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

function createProductDistributionChart(data) {
    const ctx = document.getElementById('productDistributionChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: data.map(item => item.name),
            datasets: [{
                data: data.map(item => item.count),
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

function updateRecentUsersTable(users) {
    const tbody = document.querySelector('#recentUsersTable tbody');
    tbody.innerHTML = users.map(user => `
        <tr>
            <td>${user.name}</td>
            <td>${user.email}</td>
            <td>${new Date(user.created_at).toLocaleDateString()}</td>
        </tr>
    `).join('');
}
</script>
