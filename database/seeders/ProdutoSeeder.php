<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [
            [
                'nome' => 'Notebook Dell Inspiron 15',
                'descricao' => 'Notebook com processador Intel Core i5, 8GB RAM, SSD 256GB',
                'preco' => 3299.99,
                'quantidade' => 15
            ],
            [
                'nome' => 'Mouse Logitech MX Master 3',
                'descricao' => 'Mouse sem fio ergonômico com sensor de alta precisão',
                'preco' => 459.90,
                'quantidade' => 42
            ],
            [
                'nome' => 'Teclado Mecânico Keychron K2',
                'descricao' => 'Teclado mecânico wireless com switches Gateron Brown',
                'preco' => 599.00,
                'quantidade' => 28
            ],
            [
                'nome' => 'Monitor LG UltraWide 29"',
                'descricao' => 'Monitor 29 polegadas, resolução 2560x1080, IPS',
                'preco' => 1499.99,
                'quantidade' => 8
            ],
            [
                'nome' => 'Webcam Logitech C920',
                'descricao' => 'Webcam Full HD 1080p com microfone embutido',
                'preco' => 389.90,
                'quantidade' => 35
            ],
            [
                'nome' => 'Headset HyperX Cloud II',
                'descricao' => 'Headset gamer com som surround 7.1 virtual',
                'preco' => 499.99,
                'quantidade' => 22
            ],
            [
                'nome' => 'SSD Samsung 970 EVO 1TB',
                'descricao' => 'SSD NVMe M.2 com velocidade de leitura de 3500MB/s',
                'preco' => 799.00,
                'quantidade' => 18
            ],
            [
                'nome' => 'Cadeira Gamer DT3 Sports',
                'descricao' => 'Cadeira ergonômica com apoio lombar e ajuste de altura',
                'preco' => 1199.90,
                'quantidade' => 12
            ],
            [
                'nome' => 'Hub USB-C Anker 7 em 1',
                'descricao' => 'Hub com HDMI, USB 3.0, leitor de cartão SD e USB-C PD',
                'preco' => 299.00,
                'quantidade' => 45
            ],
            [
                'nome' => 'Mousepad Gamer Extended',
                'descricao' => 'Mousepad grande 90x40cm com base antiderrapante',
                'preco' => 89.90,
                'quantidade' => 67
            ],
            [
                'nome' => 'Suporte para Notebook',
                'descricao' => 'Suporte ergonômico ajustável em alumínio',
                'preco' => 129.90,
                'quantidade' => 31
            ],
            [
                'nome' => 'Microfone Blue Yeti',
                'descricao' => 'Microfone condensador USB profissional',
                'preco' => 1299.00,
                'quantidade' => 9
            ],
            [
                'nome' => 'Luminária LED de Mesa',
                'descricao' => 'Luminária ajustável com controle de temperatura de cor',
                'preco' => 149.90,
                'quantidade' => 53
            ],
            [
                'nome' => 'Pen Drive 128GB SanDisk',
                'descricao' => 'Pen drive USB 3.0 com velocidade de leitura de 130MB/s',
                'preco' => 79.90,
                'quantidade' => 120
            ],
            [
                'nome' => 'HD Externo Seagate 2TB',
                'descricao' => 'HD portátil USB 3.0 para backup',
                'preco' => 399.00,
                'quantidade' => 25
            ]
        ];

        foreach ($produtos as $produto) {
            Produto::create($produto);
        }
    }
}