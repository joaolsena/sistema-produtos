<?php

namespace App\Http\Controllers;
use App\Exports\ProdutosExport;
use Maatwebsite\Excel\Facades\Excel;


use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    // Exibir página principal
    public function index()
    {
        return view('produtos.index');
    }

    // Listar todos os produtos (API) com paginação e filtros
    public function listar(Request $request)
    {
        $query = Produto::query();

        // Pesquisa por nome
        if ($request->has('search') && $request->search != '') {
            $query->where('nome', 'like', '%' . $request->search . '%');
        }

        // Filtro por preço mínimo
        if ($request->has('preco_min') && $request->preco_min != '') {
            $query->where('preco', '>=', $request->preco_min);
        }

        // Filtro por preço máximo
        if ($request->has('preco_max') && $request->preco_max != '') {
            $query->where('preco', '<=', $request->preco_max);
        }

        // Filtro por quantidade mínima
        if ($request->has('quantidade_min') && $request->quantidade_min != '') {
            $query->where('quantidade', '>=', $request->quantidade_min);
        }

        // Ordenação
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // Paginação
        $perPage = $request->get('per_page', 10);
        $produtos = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $produtos->items(),
            'pagination' => [
                'total' => $produtos->total(),
                'per_page' => $produtos->perPage(),
                'current_page' => $produtos->currentPage(),
                'last_page' => $produtos->lastPage(),
                'from' => $produtos->firstItem(),
                'to' => $produtos->lastItem()
            ]
        ]);
    }

    // Dashboard com estatísticas
    public function dashboard()
    {
        $stats = [
            'total_produtos' => Produto::count(),
            'valor_total_estoque' => Produto::sum(\DB::raw('preco * quantidade')),
            'produtos_baixo_estoque' => Produto::where('quantidade', '<', 10)->count(),
            'preco_medio' => Produto::avg('preco'),
            'produtos_por_faixa_preco' => [
                'ate_100' => Produto::where('preco', '<=', 100)->count(),
                '100_500' => Produto::whereBetween('preco', [100, 500])->count(),
                '500_1000' => Produto::whereBetween('preco', [500, 1000])->count(),
                'acima_1000' => Produto::where('preco', '>', 1000)->count(),
            ],
            'produtos_mais_caros' => Produto::orderBy('preco', 'desc')->limit(5)->get(),
            'produtos_baixo_estoque_detalhes' => Produto::where('quantidade', '<', 10)->orderBy('quantidade')->get(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    
   public function exportarExcel()
{
    return Excel::download(new ProdutosExport, 'produtos_' . date('Y-m-d_H-i-s') . '.xlsx');
}

    // Exibir detalhes de um produto
    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $produto
        ]);
    }

    // Criar novo produto
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0.01',
            'quantidade' => 'required|integer|min:0'
        ], [
            'nome.required' => 'O campo nome não pode estar vazio',
            'preco.required' => 'O campo preço é obrigatório',
            'preco.numeric' => 'O preço deve ser um número',
            'preco.min' => 'O preço deve ser um número positivo',
            'quantidade.required' => 'O campo quantidade é obrigatório',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro',
            'quantidade.min' => 'A quantidade deve ser um número positivo'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $produto = Produto::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Produto criado com sucesso',
            'data' => $produto
        ], 201);
    }

    // Atualizar produto
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não encontrado'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0.01',
            'quantidade' => 'required|integer|min:0'
        ], [
            'nome.required' => 'O campo nome não pode estar vazio',
            'preco.required' => 'O campo preço é obrigatório',
            'preco.numeric' => 'O preço deve ser um número',
            'preco.min' => 'O preço deve ser um número positivo',
            'quantidade.required' => 'O campo quantidade é obrigatório',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro',
            'quantidade.min' => 'A quantidade deve ser um número positivo'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $produto->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Produto atualizado com sucesso',
            'data' => $produto
        ]);
    }

    // Excluir produto
    public function destroy($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json([
                'success' => false,
                'message' => 'Produto não encontrado'
            ], 404);
        }

        $produto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produto excluído com sucesso'
        ]);
    }
}