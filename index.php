<?php

class HouseBuilder
{
    private const CHAR_BRICK = 'O';
    private const CHAR_BREAK = '<br>';
    private const TEMPLATE_SPACE = '<span style="opacity: 0">%s</span>';

    public static function build(int $roofHeight, int $wallHeight, int $wallWidth): string
    {
        $houseString = self::buildRoof($roofHeight, $wallWidth);
        $houseString .= self::buildWalls($wallHeight, $wallWidth);

        return $houseString;
    }

    private static function buildRoof(int $height, int $wallWidth): string
    {
        $roofString = '';
        $maxTipSize = (int)floor($wallWidth / 2);

        // Build the max amount of narrowing roof tip possible
        for ($i = min([$height, $maxTipSize]); $i > 0; $i--) {
            $roofString .= self::insertSpace($i);
            $roofString .= self::buildWalls(1, $wallWidth - ($i * 2));
        }

        // Build the excess roof height as additional walls
        $roofString .= self::buildWalls($height - $maxTipSize, $wallWidth);

        return $roofString;
    }

    private static function insertSpace(int $width): string
    {
        return sprintf(self::TEMPLATE_SPACE, str_repeat(self::CHAR_BRICK, $width));
    }

    private static function buildWalls(int $height, int $width): string
    {
        $wallString = '';

        for ($i = 0; $i < $height; $i++) {
            $wallString .= str_repeat(self::CHAR_BRICK, $width) . self::CHAR_BREAK;
        }

        return $wallString;
    }
}

echo HouseBuilder::build(2, 5, 15);
echo '<br>';
echo HouseBuilder::build(5, 5, 7);
echo '<br>';
echo HouseBuilder::build(15, 10, 30);
