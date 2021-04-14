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
        $Document->setAttribute('disableSmartShrinking', true);

        $Document->setAttribute('headerSpacing', 0);
        $Document->setAttribute('marginTop', 120);
        $Document->setAttribute('marginBottom', 45);
        $Document->setAttribute('marginLeft', 0);
        $Document->setAttribute('marginRight', 0);
    }
}
