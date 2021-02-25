<?php

namespace QUI\ERP\Accounting\Template;

use QUI;

class EventHandler
{
    /**
     * @param $Output
     * @param QUI\HtmlToPdf\Document $Document
     */
    public static function onQuiqqerErpOutputPdfCreate(
        $Output,
        QUI\HtmlToPdf\Document $Document
    ) {
        $Document->setAttribute('foldingMarks', true);

        $Document->setAttribute('marginTop', 110);
        $Document->setAttribute('marginBottom', 45);
        $Document->setAttribute('marginLeft', 0);
        $Document->setAttribute('marginRight', 0);
    }
}
