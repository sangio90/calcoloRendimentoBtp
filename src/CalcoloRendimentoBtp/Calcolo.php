<?php

namespace CalcoloRendimentoBtp;

class Calcolo
{
    protected $cedolaLordaAnnuale;

    protected $dataDiScadenza;

    protected $costo;

    protected $capitale;

    protected $tasse = 12.5;

    protected $residuo;

    protected $guadagnoNettoAnnuale;

    protected $guadagnoNettoPercentualeAnnuo;

    public function calculate()
    {

        $costo = $this->costo * 10;

//        echo sprintf("Avvio calcolo con capitale %.2f, acquisto titoli con cedola %.2f annua e con scadenza in data %s, al costo di %.2f<br><br>", $this->capitale, $this->cedolaLordaAnnuale, $this->dataDiScadenza, $this->costo);

        $residuo = $this->capitale % $costo;
        $this->residuo = $residuo;

        $quantitaAcquistata = intval($this->capitale / $costo);

//        echo sprintf("Quantità acquistata: %.2f<br><br>", $quantitaAcquistata);

        $valoreBtp = $quantitaAcquistata * 1000;

        $annoScadenza = substr($this->dataDiScadenza, 0, 4);
        $annoAttuale = date('Y');
        $anniResidui = $annoScadenza - $annoAttuale;

//        echo sprintf("Anno scadenza: %s, Anno attuale: %s, Anni residui: %s<br><br>", $annoScadenza, $annoAttuale, $anniResidui);

        $interessiLordiTotali = ($valoreBtp / 100 * $this->cedolaLordaAnnuale) * $anniResidui;

//        echo sprintf("Interessi lordi totali: %.2f<br><br>", $interessiLordiTotali);

        $interessiNettiTotali = $interessiLordiTotali - ($interessiLordiTotali / 100 * $this->tasse);

//        echo sprintf("Interessi netti totali: %.2f<br><br>", $interessiNettiTotali);

        $differenzaFraAcquistataECapitale = ($valoreBtp - $this->capitale);

//        echo sprintf("Differenza fra capitale e quantità BTP acquistata: %.2f<br><br>", $differenzaFraAcquistataECapitale);

        $guadagnoNettoTotale = $interessiNettiTotali + $differenzaFraAcquistataECapitale;

//        echo sprintf("Guadagno netto totale = %.2f<br><br>", $guadagnoNettoTotale);

        $guadagnoNettoAnnuale = $guadagnoNettoTotale / $anniResidui;
        $this->guadagnoNettoAnnuale = $guadagnoNettoAnnuale;

//        echo sprintf("Guadagno netto annuale = %.2f<br><br>", $guadagnoNettoAnnuale);

        $guadagnoNettoPercentualeAnnuo = $guadagnoNettoAnnuale / $this->capitale * 100;
        $this->guadagnoNettoPercentualeAnnuo = $guadagnoNettoPercentualeAnnuo;

//        echo sprintf("Guadagno netto percentuale = %.2f%%<br><br>", $guadagnoNettoPercentualeAnnuo);
    }

    /**
     * @return mixed
     */
    public function getResiduo()
    {
        return $this->residuo;
    }

    /**
     * @return mixed
     */
    public function getGuadagnoNettoAnnuale()
    {
        return $this->guadagnoNettoAnnuale;
    }

    /**
     * @return mixed
     */
    public function getGuadagnoNettoPercentualeAnnuo()
    {
        return $this->guadagnoNettoPercentualeAnnuo;
    }

    /**
     * @param mixed $cedolaLordaAnnuale
     */
    public function setCedolaLordaAnnuale($cedolaLordaAnnuale)
    {
        $this->cedolaLordaAnnuale = $cedolaLordaAnnuale;
    }

    /**
     * @param mixed $dataDiScadenza
     */
    public function setDataDiScadenza($dataDiScadenza)
    {
        $this->dataDiScadenza = $dataDiScadenza;
    }

    /**
     * @param mixed $costo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;
    }

    /**
     * @param mixed $capitale
     */
    public function setCapitale($capitale)
    {
        $this->capitale = $capitale;
    }


}