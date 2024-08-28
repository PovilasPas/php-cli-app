<?php

class Utils {
    public static function padString(string $string, int $length, string $padString = " ", int $padType = STR_PAD_RIGHT, ?string $encoding = null) :string {
        $stringLength = mb_strlen($string, $encoding);
        switch($padType) {
            case STR_PAD_LEFT:
                return str_repeat($padString, $length - $stringLength) . $string;
            case STR_PAD_BOTH:
                $padRight = floor(($length - $stringLength) / 2);
                $padLeft = $length - $stringLength - $padRight;
                return  str_repeat($padString, $padRight) . $string . str_repeat($padString, $padLeft);
            default:
                return $string . str_repeat($padString, $length - $stringLength);
        }
    }

    public static function countLinesInFile(mixed $handle, int $chunkSize = 8192) :int {
        if(!is_resource($handle)) {
            throw new InvalidArgumentException("Argument must be a valid resource type.");
        }
        fseek($handle, 0);
        $lines = 0;
        $buffer = "";
        while(!feof($handle)) {
            $buffer = fread($handle, $chunkSize);
            $lines += substr_count($buffer, "\n");
        }
        if(strlen($buffer) > 0 && $buffer[-1] != "\n") {
            $lines++;
        }
        fseek($handle, 0);
        return $lines;
    }
}