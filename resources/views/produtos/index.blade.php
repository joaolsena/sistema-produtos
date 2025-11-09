
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema de Gerenciamento de Produtos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            border-bottom: 2px solid #eee;
        }

        .tab {
            padding: 12px 24px;
            border: none;
            background: none;
            cursor: pointer;
            font-weight: 600;
            color: #718096;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .tab.active {
            color: #667eea;
            border-bottom-color: #667eea;
        }

        .tab:hover {
            color: #667eea;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .content-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .stat-card h3 {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: bold;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: #f7fafc;
            padding: 20px;
            border-radius: 12px;
        }

        .chart-card h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .controls {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
        }

        .filter-group {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #667eea;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        button {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: #48bb78;
            color: white;
        }

        .btn-success:hover {
            background: #38a169;
        }

        .btn-danger {
            background: #f56565;
            color: white;
        }

        .btn-danger:hover {
            background: #e53e3e;
        }

        .btn-secondary {
            background: #a0aec0;
            color: white;
        }

        .btn-secondary:hover {
            background: #718096;
        }

        .btn-export {
            background: #38b2ac;
            color: white;
        }

        .btn-export:hover {
            background: #319795;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f7fafc;
            color: #4a5568;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            cursor: pointer;
            user-select: none;
        }

        th:hover {
            background: #edf2f7;
        }

        th.sortable::after {
            content: " ⇅";
            opacity: 0.3;
        }

        th.sorted-asc::after {
            content: " ↑";
            opacity: 1;
        }

        th.sorted-desc::after {
            content: " ↓";
            opacity: 1;
        }

        tr:hover {
            background: #f7fafc;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .actions button {
            padding: 8px 16px;
            font-size: 12px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 25px;
            padding: 20px 0;
        }

        .pagination button {
            padding: 8px 16px;
            min-width: 40px;
        }

        .pagination .page-info {
            color: #4a5568;
            font-size: 14px;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header {
            margin-bottom: 20px;
        }

        .modal-header h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4a5568;
            font-weight: 600;
            font-size: 14px;
        }

        .modal-footer {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 25px;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: #c6f6d5;
            color: #22543d;
            border: 1px solid #9ae6b4;
        }

        .alert-error {
            background: #fed7d7;
            color: #742a2a;
            border: 1px solid #fc8181;
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: #718096;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #718096;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-low {
            background: #fed7d7;
            color: #742a2a;
        }

        .badge-medium {
            background: #feebc8;
            color: #7c2d12;
        }

        .badge-high {
            background: #c6f6d5;
            color: #22543d;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }

            .header, .content-card {
                padding: 20px;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            .actions {
                flex-direction: column;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    
    <div class="container">
        
        <div class="header">
            <h1>🛍️ Sistema de Gerenciamento de Produtos</h1>
            <p style="color: #718096; margin-top: 5px;">Gerencie seu estoque de forma eficiente</p>
            
            <div class="tabs">
                <button class="tab active" onclick="switchTab('dashboard')">📊 Dashboard</button>
                <button class="tab" onclick="switchTab('produtos')">📦 Produtos</button>
            </div>
        </div>

        <div id="alertContainer"></div>

        <!-- Tab Dashboard -->
        <div id="dashboard-tab" class="tab-content active">
            <div class="content-card">
                <div class="stats-grid" id="statsContainer">
                    <div class="loading">Carregando estatísticas...</div>
                </div>

                <div class="charts-grid">
                    <div class="chart-card">
                        <h3>Produtos por Faixa de Preço</h3>
                        <canvas id="priceChart"></canvas>
                    </div>
                    <div class="chart-card">
                        <h3>Produtos Mais Caros (Top 5)</h3>
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>⚠️ Produtos com Baixo Estoque (menos de 10 unidades)</h3>
                    <div id="lowStockContainer"></div>
                </div>
            </div>
        </div>

        <!-- Tab Produtos -->
        <div id="produtos-tab" class="tab-content">
            <div class="content-card">
                <div class="controls">
                    <div class="search-box">
                        <input type="text" id="searchInput" placeholder="🔍 Pesquisar produtos pelo nome...">
                    </div>
                    <button class="btn-export" onclick="exportarExcel()">📊 Exportar Excel</button>
                    <button class="btn-primary" onclick="openModal()">+ Novo Produto</button>
                </div>

                <div class="filter-group">
                    <div>
                        <input type="number" id="precoMin" placeholder="Preço mínimo" step="0.01">
                    </div>
                    <div>
                        <input type="number" id="precoMax" placeholder="Preço máximo" step="0.01">
                    </div>
                    <div>
                        <input type="number" id="quantidadeMin" placeholder="Quantidade mínima">
                    </div>
                    <button class="btn-secondary" onclick="limparFiltros()">Limpar Filtros</button>
                </div>

                <div id="tableContainer">
                    <div class="loading">Carregando produtos...</div>
                </div>

                <div id="paginationContainer"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="produtoModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Novo Produto</h2>
            </div>
            <form id="produtoForm">
                <input type="hidden" id="produtoId">
                
                <div class="form-group">
                    <label for="nome">Nome *</label>
                    <input type="text" id="nome" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao"></textarea>
                </div>

                <div class="form-group">
                    <label for="preco">Preço (R$) *</label>
                    <input type="number" id="preco" step="0.01" min="0.01" required>
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade *</label>
                    <input type="number" id="quantidade" min="0" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        let currentPage = 1;
        let perPage = 10;
        let sortBy = 'id';
        let sortOrder = 'desc';
        let priceChart, topProductsChart;

        document.addEventListener('DOMContentLoaded', function() {
            carregarDashboard();
            carregarProdutos();
            
            let searchTimeout;
            document.getElementById('searchInput').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    currentPage = 1;
                    carregarProdutos();
                }, 500);
            });

            ['precoMin', 'precoMax', 'quantidadeMin'].forEach(id => {
                document.getElementById(id).addEventListener('change', () => {
                    currentPage = 1;
                    carregarProdutos();
                });
            });

            document.getElementById('produtoForm').addEventListener('submit', salvarProduto);
        });

        function switchTab(tab) {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            event.target.classList.add('active');
            document.getElementById(tab + '-tab').classList.add('active');

            if (tab === 'dashboard') {
                carregarDashboard();
            }
        }

        async function carregarDashboard() {
            try {
                const response = await fetch('/api/produtos/dashboard');
                const data = await response.json();

                if (data.success) {
                    renderizarDashboard(data.data);
                }
            } catch (error) {
                console.error('Erro ao carregar dashboard:', error);
            }
        }

        function renderizarDashboard(stats) {
            const statsHtml = `
                <div class="stat-card">
                    <h3>Total de Produtos</h3>
                    <div class="value">${stats.total_produtos}</div>
                </div>
                <div class="stat-card">
                    <h3>Valor Total do Estoque</h3>
                    <div class="value">R$ ${parseFloat(stats.valor_total_estoque).toLocaleString('pt-BR', {minimumFractionDigits: 2})}</div>
                </div>
                <div class="stat-card">
                    <h3>Produtos com Baixo Estoque</h3>
                    <div class="value">${stats.produtos_baixo_estoque}</div>
                </div>
                <div class="stat-card">
                    <h3>Preço Médio</h3>
                    <div class="value">R$ ${parseFloat(stats.preco_medio).toFixed(2)}</div>
                </div>
            `;
            document.getElementById('statsContainer').innerHTML = statsHtml;

            if (priceChart) priceChart.destroy();
            const priceCtx = document.getElementById('priceChart').getContext('2d');
            priceChart = new Chart(priceCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Até R$ 100', 'R$ 100-500', 'R$ 500-1000', 'Acima de R$ 1000'],
                    datasets: [{
                        data: [
                            stats.produtos_por_faixa_preco.ate_100,
                            stats.produtos_por_faixa_preco['100_500'],
                            stats.produtos_por_faixa_preco['500_1000'],
                            stats.produtos_por_faixa_preco.acima_1000
                        ],
                        backgroundColor: ['#48bb78', '#4299e1', '#ed8936', '#f56565']
                    }]
                }
            });

            if (topProductsChart) topProductsChart.destroy();
            const topCtx = document.getElementById('topProductsChart').getContext('2d');
            topProductsChart = new Chart(topCtx, {
                type: 'bar',
                data: {
                    labels: stats.produtos_mais_caros.map(p => p.nome.substring(0, 20)),
                    datasets: [{
                        label: 'Preço (R$)',
                        data: stats.produtos_mais_caros.map(p => p.preco),
                        backgroundColor: '#667eea'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            if (stats.produtos_baixo_estoque_detalhes.length > 0) {
                const lowStockHtml = `
                    <table>
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${stats.produtos_baixo_estoque_detalhes.map(p => `
                                <tr>
                                    <td>${p.nome}</td>
                                    <td><span class="badge badge-low">${p.quantidade} unidades</span></td>
                                    <td>R$ ${parseFloat(p.preco).toFixed(2)}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;
                document.getElementById('lowStockContainer').innerHTML = lowStockHtml;
            } else {
                document.getElementById('lowStockContainer').innerHTML = '<p style="text-align: center; color: #48bb78; padding: 20px;">✅ Todos os produtos estão com estoque adequado!</p>';
            }
        }

        async function carregarProdutos() {
            try {
                const search = document.getElementById('searchInput').value;
                const precoMin = document.getElementById('precoMin').value;
                const precoMax = document.getElementById('precoMax').value;
                const quantidadeMin = document.getElementById('quantidadeMin').value;

                const params = new URLSearchParams({
                    page: currentPage,
                    per_page: perPage,
                    sort_by: sortBy,
                    sort_order: sortOrder
                });

                if (search) params.append('search', search);
                if (precoMin) params.append('preco_min', precoMin);
                if (precoMax) params.append('preco_max', precoMax);
                if (quantidadeMin) params.append('quantidade_min', quantidadeMin);

                const response = await fetch(`/api/produtos?${params}`);
                const data = await response.json();

                if (data.success) {
                    renderizarTabela(data.data);
                    renderizarPaginacao(data.pagination);
                }
            } catch (error) {
                mostrarAlerta('Erro ao carregar produtos', 'error');
                console.error(error);
            }
        }

        function renderizarTabela(produtos) {
            const container = document.getElementById('tableContainer');

            if (produtos.length === 0) {
                container.innerHTML = `
                    <div class="empty-state">
                        <h3>Nenhum produto encontrado</h3>
                        <p>Tente ajustar os filtros ou adicione novos produtos!</p>
                    </div>
                `;
                return;
            }

            const html = `
                <table>
                    <thead>
                        <tr>
                            <th class="sortable" onclick="ordenar('id')">ID</th>
                            <th class="sortable" onclick="ordenar('nome')">Nome</th>
                            <th>Descrição</th>
                            <th class="sortable" onclick="ordenar('preco')">Preço</th>
                            <th class="sortable" onclick="ordenar('quantidade')">Quantidade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${produtos.map(produto => {
                            let badge = 'badge-high';
                            if (produto.quantidade < 10) badge = 'badge-low';
                            else if (produto.quantidade < 20) badge = 'badge-medium';
                            
                            return `
                                <tr>
                                    <td>${produto.id}</td>
                                    <td>${produto.nome}</td>
                                    <td>${produto.descricao || '-'}</td>
                                    <td>R$ ${parseFloat(produto.preco).toFixed(2)}</td>
                                    <td><span class="badge ${badge}">${produto.quantidade}</span></td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn-primary" onclick="editarProduto(${produto.id})">Editar</button>
                                            <button class="btn-danger" onclick="confirmarExclusao(${produto.id})">Excluir</button>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }).join('')}
                    </tbody>
                </table>
            `;

            container.innerHTML = html;

            document.querySelectorAll('th.sortable').forEach(th => {
                th.classList.remove('sorted-asc', 'sorted-desc');
            });
            const sortedHeader = document.querySelector(`th[onclick="ordenar('${sortBy}')"]`);
            if (sortedHeader) {
                sortedHeader.classList.add(sortOrder === 'asc' ? 'sorted-asc' : 'sorted-desc');
            }
        }

        function renderizarPaginacao(pagination) {
            if (pagination.last_page <= 1) {
                document.getElementById('paginationContainer').innerHTML = '';
                return;
            }

            const html = `
                <div class="pagination">
                    <button class="btn-secondary" onclick="mudarPagina(${pagination.current_page - 1})" ${pagination.current_page === 1 ? 'disabled' : ''}>
                        ← Anterior
                    </button>
                    <span class="page-info">
                        Página ${pagination.current_page} de ${pagination.last_page} 
                        (${pagination.from}-${pagination.to} de ${pagination.total})
                    </span>
                    <button class="btn-secondary" onclick="mudarPagina(${pagination.current_page + 1})" ${pagination.current_page === pagination.last_page ? 'disabled' : ''}>
                        Próxima →
                    </button>
                </div>
            `;

            document.getElementById('paginationContainer').innerHTML = html;
        }

        function mudarPagina(page) {
            currentPage = page;
            carregarProdutos();
        }

        function ordenar(campo) {
            if (sortBy === campo) {
                sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
            } else {
                sortBy = campo;
                sortOrder = 'asc';
            }
            carregarProdutos();
        }

        function limparFiltros() {
            document.getElementById('searchInput').value = '';
            document.getElementById('precoMin').value = '';
            document.getElementById('precoMax').value = '';
            document.getElementById('quantidadeMin').value = '';
            currentPage = 1;
            carregarProdutos();
        }

        function exportarExcel() {
    window.location.href = '/api/produtos/exportar-excel';
}


        function openModal(titulo = 'Novo Produto') {
            document.getElementById('modalTitle').textContent = titulo;
            document.getElementById('produtoModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('produtoModal').classList.remove('active');
            document.getElementById('produtoForm').reset();
            document.getElementById('produtoId').value = '';
        }

        async function salvarProduto(e) {
            e.preventDefault();

            const id = document.getElementById('produtoId').value;
            const dados = {
                nome: document.getElementById('nome').value,
                descricao: document.getElementById('descricao').value,
                preco: document.getElementById('preco').value,
                quantidade: document.getElementById('quantidade').value
            };

            try {
                const url = id ? `/api/produtos/${id}` : '/api/produtos';
                const method = id ? 'PUT' : 'POST';

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(dados)
                });

                const data = await response.json();

                if (data.success) {
                    mostrarAlerta(data.message, 'success');
                    closeModal();
                    carregarProdutos();
                    carregarDashboard();
                } else {
                    const erros = Object.values(data.errors).flat().join('<br>');
                    mostrarAlerta(erros, 'error');
                }
            } catch (error) {
                mostrarAlerta('Erro ao salvar produto', 'error');
                console.error(error);
            }
        }

        async function editarProduto(id) {
            try {
                const response = await fetch(`/api/produtos/${id}`);
                const data = await response.json();

                if (data.success) {
                    const produto = data.data;
                    document.getElementById('produtoId').value = produto.id;
                    document.getElementById('nome').value = produto.nome;
                    document.getElementById('descricao').value = produto.descricao || '';
                    document.getElementById('preco').value = produto.preco;
                    document.getElementById('quantidade').value = produto.quantidade;
                    openModal('Editar Produto');
                }
            } catch (error) {
                mostrarAlerta('Erro ao carregar produto', 'error');
                console.error(error);
            }
        }

        function confirmarExclusao(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                excluirProduto(id);
            }
        }

        async function excluirProduto(id) {
            try {
                const response = await fetch(`/api/produtos/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const data = await response.json();

                if (data.success) {
                    mostrarAlerta(data.message, 'success');
                    carregarProdutos();
                    carregarDashboard();
                } else {
                    mostrarAlerta(data.message, 'error');
                }
            } catch (error) {
                mostrarAlerta('Erro ao excluir produto', 'error');
                console.error(error);
            }
        }

        function mostrarAlerta(mensagem, tipo) {
            const container = document.getElementById('alertContainer');
            const alertClass = tipo === 'success' ? 'alert-success' : 'alert-error';
            
            container.innerHTML = `
                <div class="alert ${alertClass}">
                    ${mensagem}</div>
            `;
        setTimeout(() => {
            container.innerHTML = '';
        }, 5000);
    }
</script>
</body>
</html>