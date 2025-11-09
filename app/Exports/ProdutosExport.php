<?php

namespace App\Exports;

use App\Models\Produto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ProdutosExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Produto::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'Descrição',
            'Preço (R$)',
            'Quantidade',
            'Valor Total (R$)',
            'Data de Cadastro'
        ];
    }

    public function map($produto): array
    {
        return [
            $produto->id,
            $produto->nome,
            $produto->descricao,
            'R$ ' . number_format($produto->preco, 2, ',', '.'),
            $produto->quantidade,
            'R$ ' . number_format($produto->preco * $produto->quantidade, 2, ',', '.'),
            $produto->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '667eea']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 35,
            'C' => 50,
            'D' => 15,
            'E' => 12,
            'F' => 18,
            'G' => 20
        ];
    }
}