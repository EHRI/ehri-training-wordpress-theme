<?php
/**
 * Functions for duplicating Drupal functionality in WordPress.
 */

const PREG_CLASS_UNICODE_WORD_BOUNDARY = '\\x{0}-\\x{2F}\\x{3A}-\\x{40}\\x{5B}-\\x{60}\\x{7B}-\\x{A9}\\x{AB}-\\x{B1}\\x{B4}' .
    '\\x{B6}-\\x{B8}\\x{BB}\\x{BF}\\x{D7}\\x{F7}\\x{2C2}-\\x{2C5}\\x{2D2}-\\x{2DF}' .
    '\\x{2E5}-\\x{2EB}\\x{2ED}\\x{2EF}-\\x{2FF}\\x{375}\\x{37E}-\\x{385}\\x{387}\\x{3F6}' .
    '\\x{482}\\x{55A}-\\x{55F}\\x{589}-\\x{58A}\\x{5BE}\\x{5C0}\\x{5C3}\\x{5C6}' .
    '\\x{5F3}-\\x{60F}\\x{61B}-\\x{61F}\\x{66A}-\\x{66D}\\x{6D4}\\x{6DD}\\x{6E9}' .
    '\\x{6FD}-\\x{6FE}\\x{700}-\\x{70F}\\x{7F6}-\\x{7F9}\\x{830}-\\x{83E}' .
    '\\x{964}-\\x{965}\\x{970}\\x{9F2}-\\x{9F3}\\x{9FA}-\\x{9FB}\\x{AF1}\\x{B70}' .
    '\\x{BF3}-\\x{BFA}\\x{C7F}\\x{CF1}-\\x{CF2}\\x{D79}\\x{DF4}\\x{E3F}\\x{E4F}' .
    '\\x{E5A}-\\x{E5B}\\x{F01}-\\x{F17}\\x{F1A}-\\x{F1F}\\x{F34}\\x{F36}\\x{F38}' .
    '\\x{F3A}-\\x{F3D}\\x{F85}\\x{FBE}-\\x{FC5}\\x{FC7}-\\x{FD8}\\x{104A}-\\x{104F}' .
    '\\x{109E}-\\x{109F}\\x{10FB}\\x{1360}-\\x{1368}\\x{1390}-\\x{1399}\\x{1400}' .
    '\\x{166D}-\\x{166E}\\x{1680}\\x{169B}-\\x{169C}\\x{16EB}-\\x{16ED}' .
    '\\x{1735}-\\x{1736}\\x{17B4}-\\x{17B5}\\x{17D4}-\\x{17D6}\\x{17D8}-\\x{17DB}' .
    '\\x{1800}-\\x{180A}\\x{180E}\\x{1940}-\\x{1945}\\x{19DE}-\\x{19FF}' .
    '\\x{1A1E}-\\x{1A1F}\\x{1AA0}-\\x{1AA6}\\x{1AA8}-\\x{1AAD}\\x{1B5A}-\\x{1B6A}' .
    '\\x{1B74}-\\x{1B7C}\\x{1C3B}-\\x{1C3F}\\x{1C7E}-\\x{1C7F}\\x{1CD3}\\x{1FBD}' .
    '\\x{1FBF}-\\x{1FC1}\\x{1FCD}-\\x{1FCF}\\x{1FDD}-\\x{1FDF}\\x{1FED}-\\x{1FEF}' .
    '\\x{1FFD}-\\x{206F}\\x{207A}-\\x{207E}\\x{208A}-\\x{208E}\\x{20A0}-\\x{20B8}' .
    '\\x{2100}-\\x{2101}\\x{2103}-\\x{2106}\\x{2108}-\\x{2109}\\x{2114}' .
    '\\x{2116}-\\x{2118}\\x{211E}-\\x{2123}\\x{2125}\\x{2127}\\x{2129}\\x{212E}' .
    '\\x{213A}-\\x{213B}\\x{2140}-\\x{2144}\\x{214A}-\\x{214D}\\x{214F}' .
    '\\x{2190}-\\x{244A}\\x{249C}-\\x{24E9}\\x{2500}-\\x{2775}\\x{2794}-\\x{2B59}' .
    '\\x{2CE5}-\\x{2CEA}\\x{2CF9}-\\x{2CFC}\\x{2CFE}-\\x{2CFF}\\x{2E00}-\\x{2E2E}' .
    '\\x{2E30}-\\x{3004}\\x{3008}-\\x{3020}\\x{3030}\\x{3036}-\\x{3037}' .
    '\\x{303D}-\\x{303F}\\x{309B}-\\x{309C}\\x{30A0}\\x{30FB}\\x{3190}-\\x{3191}' .
    '\\x{3196}-\\x{319F}\\x{31C0}-\\x{31E3}\\x{3200}-\\x{321E}\\x{322A}-\\x{3250}' .
    '\\x{3260}-\\x{327F}\\x{328A}-\\x{32B0}\\x{32C0}-\\x{33FF}\\x{4DC0}-\\x{4DFF}' .
    '\\x{A490}-\\x{A4C6}\\x{A4FE}-\\x{A4FF}\\x{A60D}-\\x{A60F}\\x{A673}\\x{A67E}' .
    '\\x{A6F2}-\\x{A716}\\x{A720}-\\x{A721}\\x{A789}-\\x{A78A}\\x{A828}-\\x{A82B}' .
    '\\x{A836}-\\x{A839}\\x{A874}-\\x{A877}\\x{A8CE}-\\x{A8CF}\\x{A8F8}-\\x{A8FA}' .
    '\\x{A92E}-\\x{A92F}\\x{A95F}\\x{A9C1}-\\x{A9CD}\\x{A9DE}-\\x{A9DF}' .
    '\\x{AA5C}-\\x{AA5F}\\x{AA77}-\\x{AA79}\\x{AADE}-\\x{AADF}\\x{ABEB}' .
    '\\x{E000}-\\x{F8FF}\\x{FB29}\\x{FD3E}-\\x{FD3F}\\x{FDFC}-\\x{FDFD}' .
    '\\x{FE10}-\\x{FE19}\\x{FE30}-\\x{FE6B}\\x{FEFF}-\\x{FF0F}\\x{FF1A}-\\x{FF20}' .
    '\\x{FF3B}-\\x{FF40}\\x{FF5B}-\\x{FF65}\\x{FFE0}-\\x{FFFD}';


if (!function_exists('truncate_utf8')) {
    function truncate_utf8($string, $max_length, $wordsafe = FALSE, $add_ellipsis = FALSE, $min_wordsafe_length = 1) {
        $ellipsis = '';
        $max_length = max($max_length, 0);
        $min_wordsafe_length = max($min_wordsafe_length, 0);
        if (strlen($string) <= $max_length) {

            // No truncation needed, so don't add ellipsis, just return.
            return $string;
        }
        if ($add_ellipsis) {

            // Truncate ellipsis in case $max_length is small.
            $ellipsis = substr('...', 0, $max_length);
            $max_length -= strlen($ellipsis);
            $max_length = max($max_length, 0);
        }
        if ($max_length <= $min_wordsafe_length) {

            // Do not attempt word-safe if lengths are bad.
            $wordsafe = FALSE;
        }
        if ($wordsafe) {
            $matches = array();

            // Find the last word boundary, if there is one within $min_wordsafe_length
            // to $max_length characters. preg_match() is always greedy, so it will
            // find the longest string possible.
            $found = preg_match('/^(.{' . $min_wordsafe_length . ',' . $max_length . '})[' . PREG_CLASS_UNICODE_WORD_BOUNDARY . ']/u', $string, $matches);
            if ($found) {
                $string = $matches[1];
            }
            else {
                $string = substr($string, 0, $max_length);
            }
        }
        else {
            $string = substr($string, 0, $max_length);
        }
        if ($add_ellipsis) {
            $string .= $ellipsis;
        }
        return $string;
    }
}

if (!function_exists('drupal_text_summary')) {
    /**
     * https://github.com/drupal/drupal/blob/c1b1ba78d634a5b99fdb443662cc7241c719a6c4/core/modules/text/text.module#L42
     *
     * @param $text
     * @param $size
     * @return false|mixed|string
     */
    function drupal_text_summary($text, $size = 600) {

        // Find where the delimiter is in the body.
        $delimiter = strpos($text, '<!--break-->');

        // If the size is zero, and there is no delimiter, the entire body is the summary.
        if ($size == 0 && $delimiter === FALSE) {
            return $text;
        }

        // If a valid delimiter has been specified, use it to chop off the summary.
        if ($delimiter !== FALSE) {
            return substr($text, 0, $delimiter);
        }

        // If we have a short body, the entire body is the summary.
        if (mb_strlen($text) <= $size) {
            return $text;
        }

        // If the delimiter has not been specified, try to split at paragraph or
        // sentence boundaries.

        // The summary may not be longer than maximum length specified. Initial slice.
        $summary = truncate_utf8($text, $size);

        // Store the actual length of the UTF8 string -- which might not be the same
        // as $size.
        $max_right_pos = strlen($summary);

        // How much to cut off the end of the summary so that it doesn't end in the
        // middle of a paragraph, sentence, or word.
        // Initialize it to maximum in order to find the minimum.
        $min_right_pos = $max_right_pos;

        // Store the reverse of the summary. We use strpos on the reversed needle and
        // haystack for speed and convenience.
        $reversed = strrev($summary);

        // Build an array of arrays of break points grouped by preference.
        $break_points = [];

        // A paragraph near the end of sliced summary is most preferable.
        $break_points[] = ['</p>' => 0];

        // If no complete paragraph then treat line breaks as paragraphs.
        $line_breaks = ['<br />' => 6, '<br>' => 4];
        $break_points[] = $line_breaks;

        // If the first paragraph is too long, split at the end of a sentence.
        $break_points[] = ['. ' => 1, '! ' => 1, '? ' => 1, '。' => 0, '؟ ' => 1];

        // Iterate over the groups of break points until a break point is found.
        foreach ($break_points as $points) {
            // Look for each break point, starting at the end of the summary.
            foreach ($points as $point => $offset) {
                // The summary is already reversed, but the break point isn't.
                $right_pos = strpos($reversed, strrev($point));
                if ($right_pos !== FALSE) {
                    $min_right_pos = min($right_pos + $offset, $min_right_pos);
                }
            }

            // If a break point was found in this group, slice and stop searching.
            if ($min_right_pos !== $max_right_pos) {
                // Don't slice with length 0. Length must be <0 to slice from RHS.
                $summary = ($min_right_pos === 0) ? $summary : substr($summary, 0, 0 - $min_right_pos);
                break;
            }
        }

        return $summary;
    }
}