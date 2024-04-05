<?php

namespace App\Classes\PDF;

/**
 * Version : 3.0
 * Date : 26/03/2024
 */
class PDFMulticellTableauModel extends PDFMulticellTableau
{
    /** @var string path du template */
    private $template;

    /** @var bool bordure tableau active ou non */
    private $has_bordure = true;

    /** @var float hauteur par defaut des cellules et multicellules */
    private float $hauteurCelluleDefaut = 5;

    /** @var array<array<mixed>>|null tableau associatif par colonne
     *
     * 'font_familly' => 'helvetica' police
     * 'font_style' => 'BUI' – Bold('B'), Underline ('U'), Italique ('I'), Normal ('') – style de la police
     * 'font_size' => 8.2 – taille de la police
     */
    private $config_colonnes = null;

    /** @var bool affiche ou non les numéros de page dans le footer */
    private bool $has_numerotation_page = false;

    /**
     * @param  string  $template  path
     *
     * @return void
     */
    public function __construct(?string $template = null)
    {
        parent::__construct();
        $this->template = $template;
    }

    /**
     * Set les méta du pdf
     *
     * @param  string|null  $title  titre
     * @param  string|null  $subjet  sujet
     * @param  string|null  $author  autheur (défaut: env('APP_NAME'))
     * @param  string|null  $creator  créateur (défaut: config('app.name'))
     * @param  string|null  $keywords  mots-clés (defaut: $subject)
     *
     * @return void
     */
    public function initMeta(?string $title = null, ?string $subjet = null, ?string $author = null, ?string $creator = null, ?string $keywords = null)
    {
        $this->SetAuthor($author ?? env('APP_NAME') ?? null, true);
        $this->SetTitle($title ?? null, true);
        $this->SetSubject($subjet ?? null, true);
        $this->SetCreator($creator ?? config('app.name') ?? null, true);
        $this->SetKeywords($keywords ?? $subjet ?? null, true);
    }

    /**
     * Méthode se déclanchant lors de l'ajout d'une page via la méthode ajouterPage().
     * Se déclanche aussi lors d'un saut de page automatique (CheckPageBreak())
     *
     * Utile pour les contenues commun entre pages d'un même template
     *
     * A surcharger
     *
     * @return void
     */
    public function addStatiqueContent()
    {
    }

    /**
     * Ajoute une page (page blanche par défaut)
     *
     * @param  string  $template  path du template (1ère page) (defaut: page blanche)
     * @param  bool  $adjustPageSize  defaut = true
     * @param  bool  $callStaticContentFunction  faire appeler la fonction addStatiqueContent()
     * @param  int  $numero_page  numero de la page à importer depuis le template
     *
     * @return void
     */
    public function ajouterPage(?string $template = null, bool $adjustPageSize = true, bool $callStaticContentFunction = true, int $numero_page = 1)
    {
        $this->AddPage($this->CurOrientation);
        if ($template !== null) {
            $this->setSourceFile($template);
            $template_id = $this->importPage($numero_page);
            $this->useTemplate($template_id, ['adjustPageSize' => $adjustPageSize]);
        }

        if ($callStaticContentFunction) {
            $this->addStatiqueContent();
        }
    }

    /**
     * Ajoute toutes les pages d'un template
     *
     * @param  string  $template
     * @param  bool  $adjustPageSize  defaut = true
     *
     * @return void
     */
    public function ajouterPagesFrom(string $template, bool $adjustPageSize = true)
    {
        $nb_pages = $this->setSourceFile($template);
        for ($num_page = 1; $num_page <= $nb_pages; $num_page++) {
            $this->AddPage($this->CurOrientation);
            $template_id = $this->importPage($num_page);
            $this->useTemplate($template_id, ['adjustPageSize' => $adjustPageSize]);
        }
    }

    /**
     * Ajoute les pages d'un template depuis la page $debut à la page $to 
     *
     * @param  string  $template
     * @param  int  $from  debut = 1
     * @param  int  $to  fin = 1
     * @param  bool  $adjustPageSize  defaut = true
     *
     * @return void
     */
    public function ajouterPagesFromTo(string $template, int $from = 1, int $to = 1, bool $adjustPageSize = true)
    {
        $this->setSourceFile($template);
        for ($num_page = $from; $num_page <= $to; $num_page++) {
            $this->AddPage($this->CurOrientation);
            $template_id = $this->importPage($num_page);
            $this->useTemplate($template_id, ['adjustPageSize' => $adjustPageSize]);
        }
    }


    /**
     * Converti une chaine de caractère en UTF-8.
     *
     * @param  string  $txt
     *
     * @return string|false
     */
    public function toUtf8(string $txt)
    {
        return iconv('UTF-8', 'windows-1252', str_replace(' ', ' ', $txt));
    }

    /**
     * Crée une cellule,
     * il s'agit d'une amélioration de la fonction Cell()
     *
     * @param  string  $txt  texte
     * @param  float  $w  largeur, si 0 va jusqu'à la marge droite
     * @param  float  $h  hauteur (hauteurCelluleDefaut par defaut)
     * @param  string|int  $border  bordure 'LTRB'
     * @param  int  $ligneSuivante  Indique ou placer la position après l'appel (0 = à droite, 1 = début ligne suivante, 2 = dessous)
     * @param  string  $align  alignement 'LCRJ'
     * @param  bool  $fill  remplissage de la cellule
     * @param  array<int>  $textColor  couleur du texte rgb
     * @param  string  $textStyle  style du texte BUI
     * @param  float  $textSize  taille de la police
     * @param  mixed  $link
     * @param  bool  $toUtf8  en utf8
     *
     * @return void
     */
    public function cellule(
        string $txt = '',
        float $w = 0,
        float $h = null,
        mixed $border = 0,
        int $ligneSuivante = 1,
        string $align = 'J',
        bool $fill = false,
        ?array $textColor = null,
        ?string $textStyle = null,
        ?float $textSize = null,
        mixed $link = '',
        bool $toUtf8 = true
    ) {
        $couleur_actuel = $this->TextColor;
        $text_style_actuel = $this->FontStyle;
        $taille_actuel = $this->FontSizePt;

        if (is_null($h)) {
            $h = $this->hauteurCelluleDefaut;
        }

        if ($textColor !== null) {
            $this->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        }
        if ($textStyle !== null) {
            $this->setFont($this->FontFamily, $textStyle);
        }
        if ($textSize !== null) {
            $this->SetFontSize($textSize);
        }

        $this->cell($w, $h, $toUtf8 ? $this->toUtf8($txt) : $txt, $border, $ligneSuivante, $align, $fill, $link);

        $this->TextColor = $couleur_actuel;
        $this->setFont($this->FontFamily, $text_style_actuel, $taille_actuel);
    }

    /**
     * Crée une cellule avec saut automatique de ligne,
     * il s'agit d'une amélioration de la fonction MultiCell()
     *
     * @param  string  $txt  texte
     * @param  float  $w  largeur, si 0 va jusqu'à la marge droite
     * @param  float  $h  hauteur (hauteurCelluleDefaut par defaut)
     * @param  string|int  $border  bordure 'LTRB'
     * @param  int  $ligneSuivante  Indique ou placer la position après l'appel (0 = à droite, 1 = début ligne suivante, 2 = dessous)
     * @param  string  $align  alignement 'LCRJ'
     * @param  bool  $fill  remplissage de la cellule
     * @param  array<int>  $textColor  couleur du texte rgb
     * @param  string  $textStyle  style du texte BUI
     * @param  float  $textSize  taille de la police
     * @param  bool  $toUtf8  en utf8
     *
     * @return void
     */
    public function multicellule(
        string $txt = '',
        float $w = 0,
        float $h = null,
        mixed $border = 0,
        int $ligneSuivante = 1,
        string $align = 'J',
        bool $fill = false,
        ?array $textColor = null,
        ?string $textStyle = null,
        ?float $textSize = null,
        bool $toUtf8 = true
    ) {
        $x = $this->GetX();
        $y = $this->GetY();
        $couleur_actuel = $this->TextColor;
        $text_style_actuel = $this->FontStyle;

        if (is_null($h)) {
            $h = $this->hauteurCelluleDefaut;
        }

        if ($textColor !== null) {
            $this->SetTextColor($textColor[0], $textColor[1], $textColor[2]);
        }
        if ($textStyle !== null) {
            $this->SetFont($this->FontFamily, $textStyle);
        }
        if ($textSize !== null) {
            $this->SetFontSize($textSize);
        }

        $this->MultiCell($w, $h, $toUtf8 ? $this->toUtf8($txt) : $txt, $border, $align, $fill);

        if ($ligneSuivante === 2) {
            $this->SetX($x);
        } elseif ($ligneSuivante === 0) {
            $this->SetXY($x + $w, $y);
        }

        $this->TextColor = $couleur_actuel;
        $this->setFont($this->FontFamily, $text_style_actuel);
    }

    /**
     * Ajouter une ligne au tableau
     *
     * @param  array<string|int>  $data  liste des données de la ligne à ajouter
     *
     * @return void
     */
    public function row($data, bool $toUtf8 = true)
    {
        $actual_font_familly = null;
        $actual_font_style = null;
        $actual_font_size = null;

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

            if ($i === 0 && $this->lMargin !== null) {     //ajoute une marge à gauche à chaque fois qu'on change de page
                $this->SetX($this->lMargin);
                $x = $this->lMargin;
            }

            // Draw the border
            if ($this->has_bordure) {                  //Ajoute la bordure ou non
                $this->Rect($x, $y, $w, $h);
            }

            if ($this->config_colonnes !== null) {
                if (count($this->config_colonnes) <= count($data)) {    // vérifie si le nombre de colonne à config est le même que le nombre de donnée
                    //Sauvegarde des valeurs pour utiliser celle de la config du tableau
                    $actual_font_familly = $this->FontFamily;
                    $actual_font_style = $this->FontStyle;
                    $actual_font_size = $this->FontSizePt;

                    $this->SetFont(
                        $this->config_colonnes[$i]['font_familly'] ?? $this->FontFamily,
                        $this->config_colonnes[$i]['font_style'] ?? $this->FontStyle,
                        $this->config_colonnes[$i]['font_size'] ?? $this->FontSizePt,
                    );
                } else {
                    dd('Le nombre de colonne config est supérieur au nombre de données');
                }
            }

            // Print the text
            $this->MultiCell($w, 4, $toUtf8 ? $this->toUtf8($data[$i]) : $data[$i], 0, $a);
            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);

            //retour au valeur normal via les valeurs sauvegardées
            if ($this->config_colonnes !== null && count($this->config_colonnes) <= count($data)) {
                $this->SetFont(
                    $actual_font_familly,
                    $actual_font_style,
                    $actual_font_size,
                );
            }
        }
        // Go to the next line
        $this->Ln($h);
    }

    /**
     * @param  int  $h  hauteur
     *                  Note : Pour régler la marge inférieur de saut de ligne, voir SetAutoPageBreak(true, $margeRestante)
     *
     * @return void
     */
    public function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->config_colonnes = null;
            $this->ajouterPage($this->template);
        }
    }

    /**
     * Retourne la largeur de la page (sans les marges)
     *
     * @return float
     */
    public function getLargeurPage()
    {
        return $this->w - $this->lMargin - $this->rMargin;
    }

    /**
     * Retourne la hauteur de la page (sans les marges)
     *
     * @return float
     */
    public function getHauteurPage()
    {
        return $this->h - $this->tMargin - $this->bMargin;
    }

    /**
     * Retourne la marge gauche
     *
     * @return float
     */
    public function getMargeGauche()
    {
        return $this->lMargin;
    }

    /**
     * Retourne la marge droite
     *
     * @return float
     */
    public function getMargeDroite()
    {
        return $this->rMargin;
    }

    /**
     * Retourne la marge du haut
     *
     * @return float
     */
    public function getMargeHaut()
    {
        return $this->tMargin;
    }

    /**
     * Retourne la marge du bas
     *
     * @return float
     */
    public function getMargeBas()
    {
        return $this->bMargin;
    }

    /**
     * Cette fonction surcharge celle de classe FPDF et gère le haut de page.
     * Elle est appellé à chaque changement de page
     *
     * @return void
     */
    public function Header()
    {
    }

    /**
     * Cette fonction surcharge celle de classe FPDF et gère le pied de page, il est possible de retirer les numéros des pages avec SetNumerotationPage();
     * Elle est appellé à chaque changement de page
     *
     * @return void
     */
    public function Footer()
    {
        if ($this->has_numerotation_page) {
            $this->SetXY(180, 272);
            $this->SetFont('Helvetica', '', 9);
            $this->SetTextColor(30, 30, 30);
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' / {nbPages}');
        }
    }

    /**
     * Set et get la position sur l'abscisse (x),
     *
     * @param  float  $x  Valeur de l'abscisse. Si la valeur est négative, elle est relative de la droite de la page (max: 210 (A4))
     *
     * @return float
     */
    public function x(?float $x = null)
    {
        if ($x !== null) {
            $this->SetX($x);
        }

        return $this->GetX();
    }

    /**
     * Set et get la position sur l'ordonné (y)
     *
     * @param  float  $y  Valeur de l'ordonné. Si la valeur est négative, elle est relative de la droite de la page (max: 210 (A4))
     *
     * @return float
     */
    public function y(?float $y = null)
    {
        if ($y !== null) {
            $this->SetY($y);
        }

        return $this->GetY();
    }

    /**
     * Définit l’abscisse et l’ordonnée de la position courante. Si les valeurs transmises sont négatives,
     * Ils sont relatifs respectivement à droite et en bas de la page, alias de SetXY()
     *
     * @param  float  $x  Valeur de l’abscisse (max: 210 (A4))
     * @param  float  $y  Valeur de l’ordonnée (max: 297 (A4))
     *
     * @return void
     */
    public function xy(float $x, float $y)
    {
        $this->SetXY($x, $y);
    }

    /**
     * Retourne le template
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set le template à utiliser pour l'ajout de page
     *
     * @param  string  $template
     *
     * @return PDFMulticellTableauModel
     */
    public function setTemplate($template): self
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Retourne si les bordures des cases du tableau sont activées.
     * Seulement via la méthode Row()
     *
     * @return bool
     */
    public function getHasBorder()
    {
        return $this->has_bordure;
    }

    /**
     * Configure les bordures pour les cellules des tableaux.
     * Seulement via la méthode Row()
     *
     * @param  bool  $has_bordure
     *
     * @return PDFMulticellTableauModel
     */
    public function setHasBorder(bool $has_bordure): self
    {
        $this->has_bordure = $has_bordure;

        return $this;
    }

    /**
     * Retourne la configuration des colonnes pour les tableaux via Row()
     *
     * @return array
     */
    public function getConfigColonnes()
    {
        return $this->config_colonnes;
    }

    /**
     * Configure les colonnes des tableaux via la méthode Row()
     *
     * @param  array  $config_colonnes
     *
     * @return PDFMulticellTableauModel
     */
    public function setConfigColonnes($config_colonnes): self
    {
        $this->config_colonnes = $config_colonnes;

        return $this;
    }

    /**
     * Configure la valeur de la taille de la police et la stock.
     * Méthode à appeler si utilisation de tableau via Row() pour changer la taille de la police
     *
     * @param  float  $size
     *
     * @return void
     */
    public function SetFontSize($size)
    {
        parent::SetFontSize($size);
    }

    /**
     * Set la marge gauche (alias de SetLeftMargin)
     * Remplace l'ancien x_table
     *
     * @param  float  $distance
     *
     * @return void
     */
    public function setMargeGauche(float $distance)
    {
        $this->SetLeftMargin($distance);
    }

    /**
     * Set la marge droite (alias de SetRightMargin)
     *
     * @param  float  $distance
     *
     * @return void
     */
    public function setMargeDroite(float $distance)
    {
        $this->SetRightMargin($distance);
    }

    /**
     * Set la marge du haut (alias de SetTopMargin)
     *
     * @param  float  $distance
     *
     * @return void
     */
    public function setMargeHaut(float $distance)
    {
        $this->SetTopMargin($distance);
    }

    /**
     * Set la marge du bas
     *
     * @param  float  $distance
     *
     * @return void
     */
    public function setMargeBas(float $distance)
    {
        $this->bMargin = $distance;
    }

    /**
     * Active la numérotation des pages dans le footer
     *
     * @param  bool  $has_numerotation_page
     *
     * @return void
     */
    public function SetNumerotationPage(bool $has_numerotation_page)
    {
        $this->has_numerotation_page = $has_numerotation_page;
    }

    /**
     * Get la hauteur par défaut des cellules et multicellules
     * 
     * @return float
     */
    public function getHauteurCelluleDefaut(): float
    {
        return $this->hauteurCelluleDefaut;
    }

    /**
     * Set la hauteur par défaut des cellules et multicellules
     * 
     * @param float $hauteurCelluleDefaut valeur
     * @return void
     */
    public function setHauteurCelluleDefaut(float $hauteurCelluleDefaut)
    {
        $this->hauteurCelluleDefaut = $hauteurCelluleDefaut;
    }

    /** *************************************************************************************************************
     *                                              DOCUMENTATION FPDF
     * **************************************************************************************************************
     * Surcharge pour intégrer la documentation des méthodes
     */

    /**
     * Crée un lien interne et renvoie son identifiant.
     * Un lien interne est une zone cliquable qui dirige vers un autre endroit dans le document.
     * L’identifiant peut ensuite être passé à Cell(), Write(), Image() ou Link(). La destination est défini avec SetLink().
     *
     * @return int
     */
    public function addLink()
    {
        return parent::AddLink();
    }

    /**
     * Créée une cellule. Le coin supérieur gauche de la cellule correspond à la position actuelle.
     * La position actuelle se déplace vers la droite ou vers la ligne suivante.
     * Si le saut de page automatique est activé et que la cellule dépasse la limite, un saut de page est fait avant la sortie.
     *
     * @param  float  $w  Largeur de la cellule, si 0, jusqu'à la marge droite
     * @param  float  $h  Hauteur de la cellule
     * @param  string  $txt  Texte
     * @param  mixed  $border  Indique si la cellule doit avoir une bordure. Les valeurs possibles sont : 0 (aucune), 1 (toutes les bordures), ou 'LTRB' (gauche, haut, droite, bas)
     * @param  int  $ln  Indique ou placer la position après l'appel (0 = à droite, 1 = début ligne suivante, 2 = dessous)
     * @param  string  $align  Alignement dans la cellule (L = gauche, C = centré, R = droite, J = justifié)
     * @param  bool  $fill  Indique si le cellule est remplie (true) via la couleur défini dans setFillColor()
     * @param  mixed  $link  URL ou identifiant renvoyé par AddLink()
     *
     * @return void
     */
    public function cell($w, $h = 0, $txt = '', $border = 0, $ln = 0, $align = '', $fill = false, $link = '')
    {
        parent::Cell($w, $h, $txt, $border, $ln, $align, $fill, $link);
    }

    /**
     * Retourne l'abscisse de la position actuel
     *
     * @return float
     */
    public function getX()
    {
        return parent::GetX();
    }

    /**
     * Retourne l'ordonnée de la position actuel
     *
     * @return float
     */
    public function getY()
    {
        return parent::GetY();
    }

    /**
     * Met une image. La taille qu’il prendra sur la page peut être spécifiée de différentes manières :
     * - Largeur et hauteur explicites (exprimées en unité utilisateur ou en ppp)
     * - Dimension explicite, l’autre étant calculée automatiquement afin de conserver les proportions d’origine
     * - Aucune dimension explicite, auquel cas l’image est mise à 96 dpi.
     * La transparence est prise en charge.
     * Le format peut être spécifié explicitement ou déduit de l’extension du fichier.
     *
     * @see http://fpdf.org/en/doc/image.htm
     *
     * @param  string  $file  Chemin d’accès ou URL de l’image.
     * @param  float  $x  Abscisse du coin supérieur gauche, si non spécifié, prend la position actuel
     * @param  float  $y  Ordonnée du coin supérieur gauche, si non spécifié, prend la position actuel
     * @param  float  $w  Largeur de l'image
     * @param  float  $h  Hauteur de l'image
     * @param  string  $type  Format de l'image (JPG, JPEG, PNG, GIF (voir doc))
     * @param  mixed  $link  URL ou identifiant renvoyé par AddLink().
     *
     * @return void
     */
    public function image($file, $x = null, $y = null, $w = 0, $h = 0, $type = '', $link = '')
    {
        parent::Image($file, $x, $y, $w, $h, $type, $link);
    }

    /**
     * Effectue un saut de ligne et retoure l'abscisse à la marge de gauche
     *
     * @param  float  $h  Hauteur du saut de ligne (defaut = hauteur de la dernière cellule)
     *
     * @return void
     */
    public function ln($h = null)
    {
        parent::Ln($h);
    }

    /**
     * Envoyez le document vers une destination donnée : navigateur, fichier ou chaîne de caractères. Dans le cas d’un navigateur, l’attribut La visionneuse PDF peut être utilisée ou un téléchargement peut être forcé.
     * La méthode appelle d’abord Close() si nécessaire pour fermer le document.
     *
     * @param  string  $dest  Destination où envoyer le document. Il peut s’agir de l’un des éléments suivants :
     *                        - I: envoie le fichier en ligne au navigateur. La visionneuse PDF est utilisée si elle est disponible.
     *                        - D: envoie au navigateur et force le téléchargement d’un fichier avec le nom donné par $name.
     *                        - F: enregistre dans un fichier local avec le nom donné par $name (peut inclure un chemin d’accès).
     *                        - S: renvoie le document sous forme de chaîne de caractères.
     * @param  string  $name  Nom du fichier. Il est ignoré en cas de destination S
     * @param  bool  $isUTF8  Indique s’il est encodé en ISO-8859-1 ou UTF-8. Utilisé uniquement pour les destinations I et D.
     *
     * @return string
     */
    public function output($dest = '', $name = '', $isUTF8 = false)
    {
        return parent::Output($dest, $name, $isUTF8);
    }

    /**
     * Cette méthode permet d’imprimer du texte avec des sauts de ligne.
     * Ils peuvent être automatiques (dès que le texte atteint le bord droit de la cellule)
     * ou explicite (via le caractère \n). Autant de cellules si nécessaire sont sorties, l’une en dessous de l’autre.
     *
     * @param  float  $w  Largeur des cellules, si 0 va jusqu'à la marge droite
     * @param  float  $h  Hauteur des cellules
     * @param  string  $txt  Texte
     * @param  mixed  $border  Indique si la cellule doit avoir une bordure. Les valeurs possibles sont : 0 (aucune), 1 (toutes les bordures), ou 'LTRB' (gauche, haut, droite, bas)
     * @param  string  $align  Alignement dans la cellule (L = gauche, C = centré, R = droite, J = justifié)
     * @param  bool  $fill  Indique si le cellule est remplie (true) via la couleur défini dans setFillColor()
     *
     * @return void
     */
    public function multiCell($w, $h, $txt, $border = 0, $align = 'J', $fill = false)
    {
        parent::MultiCell($w, $h, $txt, $border, $align, $fill);
    }

    /**
     * Imprime une chaîne de caractères. L’origine se trouve à gauche du premier caractère, sur la ligne de base.
     * Cette méthode permet de placer une chaîne de caractères précisément sur la page,
     * mais elle est généralement plus facile à utiliser Cell(), MultiCell() ou Write()
     * qui sont les méthodes standard pour imprimer du texte.
     *
     * @param  float  $x  Abscisse de l’origine (x)
     * @param  float  $y  Ordonnée de l’origine (y)
     * @param  string  $txt  Texte
     *
     * @return void
     */
    public function text($x, $y, $txt)
    {
        parent::Text($x, $y, $txt);
    }

    /**
     * Dessine un rectangle. il peut être dessiné avec seulement les bordures, seulement le contenue, ou les deux.
     *
     * @param  float  $x  Abscisse du coin supérieur gauche.
     * @param  float  $y  Ordonnée du coin supérieur gauche.
     * @param  float  $w  Largeur
     * @param  float  $h  Hauteur
     * @param  string  $style  Style de rendu :
     *                         - D: contour
     *                         - F: remplissage
     *                         - DF: contour et remplissage
     *
     * @return void
     */
    public function rect($x, $y, $w, $h, $style = '')
    {
        parent::Rect($x, $y, $w, $h, $style = '');
    }

    /**
     * Active ou désactive le mode de saut de page automatique.
     * Lors de l’activation, le deuxième paramètre est la distance à partir du bas de la page qui définit la limite de déclenchement.
     * Par défaut, l’option est activé et la distance est de 2 cm.
     *
     * @param  bool  $auto  Indique si le saut de page automatique est actif.
     * @param  float  $margin  Distance par rapport au bas de la page.
     *
     * @return void
     */
    public function setAutoPageBreak($auto, $margin = 0)
    {
        parent::SetAutoPageBreak($auto, $margin);
    }

    /**
     * Définit la couleur utilisée pour toutes les opérations de dessin (lignes, rectangles et bordures de cellules).
     * Il peut être exprimé en composantes RVB ou en niveaux de gris.
     * La méthode peut être appelée avant la première page est créée et la valeur est conservée d’une page à l’autre.
     *
     * @param  int  $r  Composante rouge (0-255). Si $g et $b non indiqué = niveaux de gris
     * @param  int  $g  Composante vert (0-255)
     * @param  int  $b  Composante bleu (0-255)
     *
     * @return void
     */
    public function setDrawColor($r, $g = null, $b = null)
    {
        parent::SetDrawColor($r, $g, $b);
    }

    /**
     * Définit la couleur utilisée pour toutes les opérations de remplissage (rectangles remplis et arrière-plans de cellules).
     * Il peut être exprimé en composantes RVB ou en niveaux de gris.
     * La méthode peut être appelée avant la première page est créée et la valeur est conservée d’une page à l’autre.
     *
     * @param  int  $r  Composante rouge (0-255). Si $g et $b non indiqué = niveaux de gris
     * @param  int  $g  Composante vert (0-255)
     * @param  int  $b  Composante bleu (0-255)
     *
     * @return void
     */
    public function setFillColor($r, $g = null, $b = null)
    {
        parent::SetFillColor($r, $g, $b);
    }

    /**
     * Définit la police. Obligatoire de l'appeler au moins une fois avant d'écrire du texte
     *
     * @param  string  $family  Police :
     *                          - Courier (fixed-width)
     *                          - Helvetica or Arial
     *                          - Symbol
     *                          - ZapfDingbats (U et I ne fonctionne pas)
     * @param  string  $style  Style de la police (peut-être combiné) :
     *                         - '' (normal)
     *                         - 'I' (italique)
     *                         - 'B' (gras)
     *                         - 'U' (souligné)
     * @param  float  $size  Taille de la police en points (défaut: 12)
     *
     * @return void
     */
    public function setFont($family, $style = '', $size = 0)
    {
        parent::SetFont($family, $style, $size);
    }

    /**
     * Définit la page et la position vers lesquelles pointe un lien.
     *
     * @param  int  $link  L’identificateur de lien renvoyé par AddLink().
     * @param  float  $y  Ordonnée de la position cible (-1 = position actuel, 0 = haut de la page)
     * @param  int  $page  Numéro de la page cible (-1 = page actuel)
     *
     * @return mixed
     */
    public function setLink($link, $y = 0, $page = -1)
    {
        return parent::SetLink($link, $y, $page);
    }

    /**
     * Set la position sur l'abscisse (x).
     *
     * @param  float  $x  Valeur de l'abscisse. Si la valeur est négative, elle est relative de la droite de la page (max: 210 (A4))
     *
     * @return void
     */
    public function setX($x)
    {
        parent::SetX($x);
    }

    /**
     * Définit l’abscisse et l’ordonnée de la position courante.
     * Si les valeurs transmises sont négatives, Ils sont relatifs respectivement à droite et en bas de la page.
     *
     * @param  float  $x  Valeur de l’abscisse (max: 210 (A4))
     * @param  float  $y  Valeur de l’ordonnée (max: 297 (A4))
     *
     * @return void
     */
    public function setXY($x, $y)
    {
        parent::SetXY($x, $y);
    }

    /**
     * Set la position sur l’ordonnée  (y).
     *
     * @param  float  $y  Valeur de l’ordonnée. (max: 297 (A4))
     * @param  bool  $resetX  Si true, la position sur l’abscisse (x) est réinitialisée.
     *
     * @return void
     */
    public function setY($y, $resetX = true)
    {
        parent::SetY($y, $resetX);
    }

    /**
     * Cette méthode imprime le texte à partir de la position actuelle.
     * Lorsque la marge de droite est atteinte (ou que le \n caractère) un saut de ligne se produit et le texte continue à partir de la marge de gauche.
     * À la sortie de la méthode, La position actuelle est laissée juste à la fin du texte.
     * Il est possible de mettre un lien sur le texte.
     *
     * @param  float  $h  hauteur de la ligne
     * @param  string  $txt  texte
     * @param  mixed  $link  URL ou identifiant renvoyé par AddLink().
     *
     * @return void
     */
    public function write($h, $txt, $link = '')
    {
        parent::Write($h, $txt, $link);
    }
}
