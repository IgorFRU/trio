<?php

namespace App\Exports;

use App\Product;

use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style;

class ProductsExport
{
    static $products;
    static $fileName;
    static $spreadsheet;
    static $sheet;

    static $styleBold = [
        'font' => [
            'bold' => true,
        ],
    ];

    static $styleBlackBorders = [
        'borders' => [
            'outline' => [
                'borderStyle' => Style\Border::BORDER_THICK,
                'color' => ['argb' => '000000000'],
            ],
        ],
    ];

    static $styleSmall = [
        'font' => [
            'size' => '8',
        ],
    ];

    static $styleBig = [
        'font' => [
            'size' => '16',
        ],
    ];

    /**
     * main method of class
     *
     * @param Project $project
     * @param string $method
     * @return void
     */
    public static function export(Product $products)
    {
        self::$products = $products;
        self::$fileName = 'Export_Stroy82_' . \Carbon\Carbon::now()->toDateTimeString() . '.xls';
        self::$spreadsheet = new Spreadsheet();
        // $method = Str::camel($method);
        // self::$method(self::$products, $method);
    }

    public function fillFile() {
        
    }

    public static function createFile() {
        $writer = new Xlsx(self::$spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . self::$fileName . '"');
        // header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter(self::$spreadsheet, 'Xls');
        $writer->save('php://output');

        return $writer;
    }

    /**
     * Filling and styling cell
     *
     * @param string $cell
     * @param string $row
     * @param string $value
     * @param array $style
     * @param string $width
     * @param string $height
     * @return void
     */
    public static function setCellValue(string $cell, string $row, string $value, array $style = NULL, string $width = NULL, string $height = NULL) {
        if (!is_null($width)) {
            self::$sheet->getColumnDimension($cell)->setWidth($width);
        }
        if (!is_null($height)) {
            self::$sheet->getRowDimension($row)->setRowHeight($height);
        }
        self::$sheet->setCellValue($cell . $row, $value);
        if (!is_null($style)) {
            foreach ($style as $key => $value) {
                self::$sheet->getStyle($cell . $row)->applyFromArray($value);
            }
        }
    }

}