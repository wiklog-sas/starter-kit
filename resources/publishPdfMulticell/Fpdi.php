<?php

namespace App\Classes\PDF;

use Exception;
use setasign\Fpdi\Fpdi as PdfFpdi;

class Fpdi extends PdfFpdi
{
    /**
     * Ajout de nouvelle fonts
     * http://www.fpdf.org/makefont/index.php
     */

    /**
     * @return void
     *
     * @throws Exception
     */
    public function Footer()
    {
        $this->SetXY(180, 272);
        $this->SetFont('Helvetica', '', 9);
        $this->SetTextColor(30, 30, 30);
        $this->Cell(0, 10, 'Page '.$this->PageNo().' / {nbPages}');
    }

    /**
     * @codeCoverageIgnore
     *
     * @see https://gist.github.com/johnballantyne/4089627
     *
     * @param  mixed  $w
     * @param  mixed  $h
     * @param  mixed  $txt
     * @param  mixed  $border
     * @param  string  $align
     */
    public function GetMultiCellHeight($w, $h, $txt, $border = null, $align = 'J'): float
    {
        // Calculate MultiCell with automatic or explicit line breaks height
        // $border is un-used, but I kept it in the parameters to keep the call
        //   to this function consistent with MultiCell()
        $cw = &$this->CurrentFont['cw'];
        if ($w === 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] === "\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $ns = 0;
        $height = 0;
        while ($i < $nb) {
            // Get next character
            $c = $s[$i];
            if ($c === "\n") {
                // Explicit line break
                if ($this->ws > 0) {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                //Increase Height
                $height += $h;
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;

                continue;
            }
            if ($c === ' ') {
                $sep = $i;
                $ls = $l;
                $ns++;
            } else {
                $ls = 0;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                // Automatic line break
                if ($sep === -1) {
                    if ($i === $j) {
                        $i++;
                    }
                    if ($this->ws > 0) {
                        $this->ws = 0;
                        $this->_out('0 Tw');
                    }
                    //Increase Height
                    $height += $h;
                } else {
                    if ($align === 'J') {
                        $this->ws = $ns > 1 ? ($wmax - $ls) / 1000 * $this->FontSize / ($ns - 1) : 0;
                        $this->_out(sprintf('%.3F Tw', $this->ws * $this->k));
                    }
                    //Increase Height
                    $height += $h;
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $ns = 0;
            } else {
                $i++;
            }
        }
        // Last chunk
        if ($this->ws > 0) {
            $this->ws = 0;
            $this->_out('0 Tw');
        }

        //Increase Height
        return floatval($height + $h);
    }
}
