<?php

class HouseRenderer {
    private const CHAR_BRICK = 'O';
    private const CHAR_BREAK = '<br>';

    public static function render(int $roofHeight, int $wallHeight, int $wallWidth): void
    {
        self::renderRoof($roofHeight, $wallWidth);
        self::renderWalls($wallHeight, $wallWidth);
    }

    private static function renderRoof(int $height, int $wallWidth): void
    {
        $maxTipSize = floor($wallWidth / 2);

        // Render the max amount of narrowing roof tip possible
        for ($i = min([$height, $maxTipSize]); $i > 0 ; $i--) {
            self::renderSpace($i);
            echo str_repeat(self::CHAR_BRICK, $wallWidth - ($i * 2)) . self::CHAR_BREAK;
        }

        // Render the excess height as walls
        self::renderWalls($height - $maxTipSize, $wallWidth);
    }

    private static function renderSpace(int $width): void
    {
        echo '<span style="opacity: 0">' . str_repeat(self::CHAR_BRICK, $width) . '</span>';
    }

    private static function renderWalls(int $height, int $width): void
    {
        for ($i = 0; $i < $height; $i++) {
            echo str_repeat(self::CHAR_BRICK, $width) . self::CHAR_BREAK;
        }
    }
}

HouseRenderer::render(2, 5, 15);
echo '<br>';
HouseRenderer::render(5, 5, 7);
echo '<br>';
HouseRenderer::render(15, 10, 30);
