<?php

return [
    'id-1' => function () {
        return [1, 2, 3];
    },
    'id-2' => function ($a, $b) {
        return [$a, $b, 3];
    },
];
