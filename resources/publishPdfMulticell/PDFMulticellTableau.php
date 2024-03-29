<?php

namespace App\Classes\PDF;

use App\Classes\PDF\Fpdi as FPDF;

/**
 * @Author oliver@fpdf.org
 *
 * Ce script a pour but de montrer comment réaliser un tableau à partir de MultiCells.
 * Un MultiCell revenant à la ligne, le principe de base consiste à mémoriser la position courante, écrire le MultiCell et se repositionner à droite.
 * Il y a cependant une difficulté si le tableau est de grande taille : le saut de page. Avant d'écrire une rangée, il est nécessaire de savoir si elle va tenir ou provoquer un saut. Si elle déborde, il faut d'abord effectuer un saut de page manuellement.
 * Pour cela, il faut connaître la hauteur de la rangée ; c'est le maximum des hauteurs des MultiCells la composant. Pour connaître la hauteur d'un MultiCell, la méthode NbLines() est utilisée : elle renvoie le nombre de lignes qu'occupe un MultiCell.
 */
class PDFMulticellTableau extends FPDF
{
    /** @var mixed */
    protected $widths;

    /** @var array */
    protected $aligns;

    /**
     * Liste des largeurs des colonnes des tableaux
     *
     * @param  array<int>  $w  liste des largeurs des colonnes
     * @return void
     */
    public function SetWidths($w)
    {
        // Set the array of column widths
        $this->widths = $w;
    }

    /**
     * @param  array  $a
     * @return void
     */
    public function SetAligns($a)
    {
        // Set the array of column alignments
        $this->aligns = $a;
    }

    /**
     * Ajouter une ligne au tableau
     *
     * @param  array<string|int>  $data  liste des données de la ligne à ajouter
     * @return void
     */
    public function Row($data)
    {
        // Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }
        $h = 5 * $nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = $this->aligns[$i] ?? 'L';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x, $y, $w, $h);
            // Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    /**
     * @param  int  $h  hauteur
     * @return void
     */
    public function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
        }
    }

    /**
     * Retourne le nombre de ligne que va prendre une multicell en fonction du texte contenu
     *
     * @param  int  $w  largeur
     * @param  string|int  $txt  contenu de la cellule
     * @return int $nl nombre de ligne que va prendre la cellule
     */
    public function NbLines($w, $txt)
    {
        // Compute the number of lines a MultiCell of width w will take
        if (! isset($this->CurrentFont)) {
            $this->Error('No font has been set');
        }
        $cw = $this->CurrentFont['cw'];
        if ($w === 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', (string) $txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] === "\n") {
            $nb--;
        }
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c === "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;

                continue;
            }
            if ($c === ' ') {
                $sep = $i;
            }
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep === -1) {
                    if ($i === $j) {
                        $i++;
                    }
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }

        return $nl;
    }
}
