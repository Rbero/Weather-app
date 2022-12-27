<?php
declare(strict_types=1);

namespace Homework\WeatherReport\Model;

use Magento\Framework\App\Response\Http\FileFactory;

/**
 *
 * @package Homework\WeatherReport\Model
 */
class GeneratePdf
{
    const ROWS_PER_PAGE = 30;
    const REPORT_FILE_NAME = 'historic-report.pdf';

    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * GeneratePdf constructor.
     * @param FileFactory $fileFactory
     */
    public function __construct(
        FileFactory $fileFactory
    )
    {
        $this->fileFactory = $fileFactory;
    }

    /**
     * @param $reportItems
     * @throws \Zend_Pdf_Exception
     */
    public function generate($reportItems)
    {
        if(isset($reportItems['data']) && is_array($reportItems['data']) && count($reportItems['data'])) {
            $arrayChunk = array_chunk($reportItems['data'], self::ROWS_PER_PAGE);
            $counter = 0;
            $pdf = new \Zend_Pdf();
            foreach($arrayChunk as $array) {
                $pdf->pages[] = $pdf->newPage(\Zend_Pdf_Page::SIZE_LETTER);
                $this->drawPdf($array, $pdf, $counter);
                $counter++;
            }

            $this->fileFactory->create(
                self::REPORT_FILE_NAME,
                $pdf->render(),
                \Magento\Framework\App\Filesystem\DirectoryList::VAR_DIR,
                'application/pdf'
            );
        }
    }

    protected function drawPdf($reportItems, $pdf, $counter)
    {
        $page = $pdf->pages[$counter];
        $style = new \Zend_Pdf_Style();
        $style->setLineColor(new \Zend_Pdf_Color_Rgb(0, 0, 0));
        $font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_TIMES);
        $style->setFont($font, 15);
        $page->setStyle($style);
        $width = $page->getWidth();
        $hight = $page->getHeight();
        $x = 0;
        $pageTopalign = 850;
        $this->y = 850 - 100;

        $style->setFont($font, 14);
        $page->setStyle($style);

        $style->setFont($font, 13);
        $page->setStyle($style);
        $style->setFont($font, 11);
        $page->setStyle($style);
        if (isset($reportItems[0]['city']) && isset($reportItems[0]['country'])) {
            $page->drawText(__("Location : %1", $reportItems[0]['city'] . ',' . $reportItems[0]['country']), $x + 50, $this->y, 'UTF-8');
        }

        $style->setFont($font, 10);
        $page->setStyle($style);
        $add = 9;
        $yPad = 10;
        $count = 0;
        foreach ($reportItems as $report) {
            $yPad = $yPad + 20;
            $page->drawText($report['date'], $x + 50, $this->y - $yPad, 'UTF-8');
            $page->drawText($report['temp_min'] . '/' . $report['temp_max'] . '°C', $x + 230, $this->y - $yPad, 'UTF-8');
            $page->drawText($report['weather_description'], $x + 370, $this->y - $yPad, 'UTF-8');
        }
    }
}
