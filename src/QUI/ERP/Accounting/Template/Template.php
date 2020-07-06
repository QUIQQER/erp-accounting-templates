<?php

namespace QUI\ERP\Accounting\Template;

use QUI;
use QUI\ERP\Output\OutputTemplateProviderInterface;
use QUI\Interfaces\Template\EngineInterface;

class Template implements OutputTemplateProviderInterface
{
    /**
     * Entity types
     */
    const ENTITY_TYPE_CANCELLED   = 'Canceled';
    const ENTITY_TYPE_CONTRACT    = 'Contract';
    const ENTITY_TYPE_CREDIT_NOTE = 'CreditNote';
    const ENTITY_TYPE_INVOICE     = 'Invoice';
    const ENTITY_TYPE_OFFER       = 'Offer';
    const ENTITY_TYPE_DUNNING     = 'Dunning';

    /**
     * Get all output types the template package provides templates for
     *
     * @return string[]
     */
    public static function getEntityTypes()
    {
        return [
            self::ENTITY_TYPE_CANCELLED,
            self::ENTITY_TYPE_CONTRACT,
            self::ENTITY_TYPE_CREDIT_NOTE,
            self::ENTITY_TYPE_INVOICE,
            self::ENTITY_TYPE_OFFER,
            self::ENTITY_TYPE_DUNNING
        ];
    }

    /**
     * Get all available templates for $entityType
     *
     * @param string $entityType
     * @return array
     */
    public static function getTemplates(string $entityType)
    {
        switch ($entityType) {
            case self::ENTITY_TYPE_CANCELLED:
            case self::ENTITY_TYPE_CONTRACT:
            case self::ENTITY_TYPE_CREDIT_NOTE:
            case self::ENTITY_TYPE_INVOICE:
            case self::ENTITY_TYPE_OFFER:
            case self::ENTITY_TYPE_DUNNING:
                return [
                    [
                        'id'    => 'default',
                        'title' => QUI::getLocale()->get('quiqqer/invoice-accounting-template', 'package.title')
                    ]
                ];
                break;
        }

        return [];
    }

    /**
     * Get HTML for document header area
     *
     * @param string $template
     * @param string $entityType
     * @param EngineInterface $Engine
     * @return string|false
     *
     * @throws QUI\Exception
     */
    public static function getHeaderHtml(string $template, string $entityType, EngineInterface $Engine)
    {
        $tplDir     = self::getTemplateDir();
        $tplTypeDir = $tplDir.$entityType.'/';

        if (\file_exists($tplTypeDir.'header.html')) {
            $htmlFile = $tplTypeDir.'header.html';
        } else {
            $htmlFile = $tplDir.'header.html';
        }

        $output = '';

        if (\file_exists($tplTypeDir.'header.css')) {
            $output .= '<style>'.\file_get_contents($tplTypeDir.'header.css').'</style>';
        } else {
            $output .= '<style>'.\file_get_contents($tplDir.'header.css').'</style>';
        }

        $output .= $Engine->fetch($htmlFile);

        return $output;
    }

    /**
     * Get HTML for document body area
     *
     * @param string $template
     * @param string $entityType
     * @param EngineInterface $Engine
     * @return string|false
     *
     * @throws QUI\Exception
     */
    public static function getBodyHtml(string $template, string $entityType, EngineInterface $Engine)
    {
        $tplTypeDir = self::getTemplateDir().$entityType.'/';
        $htmlFile   = $tplTypeDir.'body.html';

        if (!\file_exists($htmlFile)) {
            throw new QUI\Exception('Template file '.$htmlFile.' not found.');
        }

        $output = '';

        if (\file_exists($tplTypeDir.'body.css')) {
            $output .= '<style>'.\file_get_contents($tplTypeDir.'body.css').'</style>';
        }

        $output .= $Engine->fetch($htmlFile);

        return $output;
    }

    /**
     * Get HTML for document footer area
     *
     * @param string $template
     * @param string $entityType
     * @param EngineInterface $Engine
     * @return string|false
     *
     * @throws QUI\Exception
     */
    public static function getFooterHtml(string $template, string $entityType, EngineInterface $Engine)
    {
        $tplDir     = self::getTemplateDir();
        $tplTypeDir = $tplDir.$entityType.'/';

        if (\file_exists($tplTypeDir.'footer.html')) {
            $htmlFile = $tplTypeDir.'footer.html';
        } else {
            $htmlFile = $tplDir.'footer.html';
        }

        $output = '';

        if (\file_exists($tplTypeDir.'footer.css')) {
            $output .= '<style>'.\file_get_contents($tplTypeDir.'footer.css').'</style>';
        } else {
            $output .= '<style>'.\file_get_contents($tplDir.'footer.css').'</style>';
        }

        $output .= $Engine->fetch($htmlFile);

        return $output;
    }

    /**
     * Get main template directory
     *
     * @return string
     *
     * @throws QUI\Exception
     */
    protected static function getTemplateDir()
    {
        return QUI::getPackage('quiqqer/invoice-accounting-template')->getDir().'template/';
    }
}
