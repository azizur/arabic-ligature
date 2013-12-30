<?php
/**
 * Plugin Name: Arabic Ligature
 * Plugin URI: http://wordpress.org/plugins/arabic-ligature/
 * Description: Arabic Ligature will encode common Arabic phrases to respective Ligature using Unicode representation.
 * Version: 0.2.0
 * Author: Azizur Rahman
 * Author URI: http://azizur.com
 * License: GPLv2 or later
 */

/*  Copyright (c) 2013 Azizur Rahman (email: azizur@prodevstudio.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class arabic_ligature {

    const UNICODE_CODE = 0;
    const UNICODE_HTML_DEC = 1;
    const UNICODE_HTML_HEX = 2;
    const UNICODE_HTML_URL = 3;

    private $_ligature_map;

    private $_ligatures = array(
        array( // bismillah ar-rahman ar-raheem
            // shortcode
            array('bismillah', 'basmala'),
            // meta: array('Unicode Code Point','HTML Entity (Decimal)','HTML Entity (Hexadecimal)','URL Escape Code')
            array('U+FDFD', '&#65021;', '&#xFDFD;', '%EF%B7%BD'),
            // arabic
            '&#1576;&#1587;&#1605; &#1575;&#1604;&#1604;&#1607; &#1575;&#1604;&#1585;&#1581;&#1605;&#1606; &#1575;&#1604;&#1585;&#1581;&#1610;&#1605;',
            'bismi-llāhi r-raḥmāni r-raḥīm',
            'In the name of God, most Gracious, most Compassionate'
        ),
        array( // sallallahou alayhe wasallam
            array('pbuh', 'saw', 'saaw', 'saas', 'saww'),
            array('U+FDFA','&#65018;','&#xFDFA;','%EF%B7%BA'),
            '&#1589;&#1604;&#1609; &#1575;&#1604;&#1604;&#1607; &#1593;&#1604;&#1610;&#1607; &#1608;&#1587;&#1604;&#1605;&#8206;',
            'ṣall Allāhu ʿalay-hi wa-sallam',
            'May Allāh honor him and grant him peace'
        ),
        array( // Jalla Jalaluh/Jallajalalouhou/Subḥānahu wa ta'āla
            array('swt', 'jallajalaluh', 'jallajalalouhou'),
            array('U+FDFB','&#65019;','&#xFDFB;','%EF%B7%BB'),
            '&#1587;&#1576;&#1581;&#1575;&#1606;&#1607; &#1608; &#1578;&#1593;&#1575;&#1604;&#1609;',
            'Subḥānahu wa ta`āla',
            'May He be Glorified and Exalted'
        ),
        array( // Allah
            array('allah'),
            array('U+FDF2','&#65010;','&#xFDF2;','%EF%B7%B2'),
            '&#1575;&#1604;&#1604;&#1607;',
            'Allāh',
            'Allah (God)'
        ),
        array( // As-salamu alaykum
            array('salaam', 'sallam'),
            array('','&#1575;&#1604;&#1587;&#1604;&#1575;&#1605;','&#1575;&#1604;&#1587;&#1604;&#1575;&#1605;',''),
            '&#1575;&#1604;&#1587;&#1604;&#1575;&#1605;',
            'As-salamu alaykum',
            'Peace be upon you'
        ),
        array( // `Alayhi s-salām
            array('sa', 'alayhis'),
            array('U+FDFA','&#65018;','&#xFDFA;','%EF%B7%BA'),
            '&#1589;&#1604;&#1609; &#1575;&#1604;&#1604;&#1607; &#1593;&#1604;&#1610;&#1607; &#1608;&#1587;&#1604;&#1605;&#8206;',
            'ʿalay-hi wa-sallam',
            'May Allāh honor him and grant him peace'
        ),
    );

    function __construct() {
        $this->_denormalise_ligatures();
        $this->_register_filters();
    }

    private function _register_filters() {
        add_filter( 'wp_title', array($this, 'filter_wp_title'), 100);
        add_filter( 'the_content', array($this, 'filter_the_content'), 20);
//        add_action( 'wp_head', array($this, 'style'));
    }

    public function style() {
        $style = '<style>';
        $style .= '.arabic-ligature {';
        $style .= ' font-family: "Times New Roman", sans-serif;';
        $style .= '}';
        $style .= '</style>';
        echo $style;
    }

    public function filter_wp_title($title) {

        foreach($this->_ligature_map as $key=>$entry) {
            $pattern[] = "/\[$key\]/i";
            $replacement[] = array_shift($entry);
        }

        return preg_replace($pattern, $replacement, $title);
    }

    public function filter_the_content($content) {

        foreach($this->_ligature_map as $shortcode=>$data) {
            $pattern[] = "/\[$shortcode\]/im";
            $replacement[] = sprintf(
                '<span class="arabic-ligature" title="%s (%s) %s">%s</span>',
                $data['arabic'],
                $data['transliteration'],
                $data['translation'],
                $data['ligature']
            );
        }

        $content = preg_replace($pattern, $replacement, $content);

        return $content;
    }

    private function _denormalise_ligatures() {

        foreach ($this->_ligatures as $entry) {
            list($short_codes, $ligature_codes, $arabic, $transliteration, $translation) = $entry;

            foreach ($short_codes as $code) {
                $this->_ligature_map[$code] = array(
                    'ligature' => $ligature_codes[self::UNICODE_HTML_DEC],
                    'arabic' => $arabic,
                    'transliteration' => $transliteration,
                    'translation' => $translation
                );
            }
        }

    }
}
$arabic_ligature = new arabic_ligature();