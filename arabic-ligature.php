<?php
/**
 * Plugin Name: Arabic Ligature
 * Plugin URI: http://wordpress.org/plugins/arabic-ligature/
 * Description: Arabic Ligature will encode common Arabic phrases to respective Ligature using Unicode representation.
 * Version: 0.1.0
 * Author: Azizur Rahman
 * Author URI: http://azizur.com
 * License: GPLv2 or later
 */

/*  Copyright 2013 Azizur Rahman (contact: http://azizur.com/contact/)

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

    private $_ligature_map;

    private $_ligatures = array(
        array( // bismillah ar-rahman ar-raheem
            // shortcode
            array('bismillah', 'basmala'),
            // meta: array('Unicode Code Point','HTML Entity (Decimal)','HTML Entity (Hexadecimal)','URL Escape Code')
            array('U+FDFD', '&#65021;', '&#xFDFD;', '%EF%B7%BD'),
            'arabic',
            'bismi-llāhi r-raḥmāni r-raḥīm',
            'In the name of God, most Gracious, most Compassionate'
        ),
        array( // sallallahou alayhe wasallam
            // shortcode
            array('pbuh', 'saw', 'saaw', 'saas', 'saww', 'alayhis'),
            // meta: array('Unicode Code Point','HTML Entity (Decimal)','HTML Entity (Hexadecimal)','URL Escape Code')
            array('U+FDFA','&#65018;','&#xFDFA;','%EF%B7%BA'),
            'arabic',
            'ʿalayhi as-salām',
            'Peace be upon him'
        ),
    );

    function __construct() {
        add_filter( 'wp_title', array($this, 'filter_wp_title'), 100);

        $this->_denormalise_ligatures();
        $this->_register_shortcodes();
    }

    public function filter_wp_title($title) {
        return do_shortcode($title);
    }

    function shortcode(){
        $args = func_get_args();
        $shortcode =  array_pop($args);
        return $this->_transform_ligature($shortcode);
    }

    private function _transform_ligature($ligature) {

        if(!array_key_exists($ligature, $this->_ligature_map)) {
            return $ligature;
        }

        return $this->_ligature_map[$ligature][0];
    }

    private function _register_shortcodes() {
        if(!isset($this->_ligature_map)) {
            $this->_denormalise_ligatures();
        }

        foreach(array_keys($this->_ligature_map) as $shortcode) {
            add_shortcode($shortcode, array($this, 'shortcode'));
        }
    }

    private function _denormalise_ligatures() {
        foreach ($this->_ligatures as $ligature) {
            list($keys, $meta, $transliteration, $translation) = $ligature;

            foreach ($keys as $key) {
                $this->_ligature_map[$key] = array($meta[2], $transliteration, $translation);
            }
        }
    }
}
$arabic_ligature = new arabic_ligature();