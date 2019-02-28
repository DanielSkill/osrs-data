<?php

return [
    /**
     * List of endpoints for each hiscore type
     */
    'endpoints' => [
        "normal" => "http://services.runescape.com/m=hiscore_oldschool/index_lite.ws?player=",
        "ironman" => "http://services.runescape.com/m=hiscore_oldschool_ironman/index_lite.ws?player=",
        "ultimate" => "http://services.runescape.com/m=hiscore_oldschool_ultimate/index_lite.ws?player=",
        "hardcore" => "http://services.runescape.com/m=hiscore_oldschool_hardcore_ironman/index_lite.ws?player=",
        "deadman" => "http://services.runescape.com/m=hiscore_oldschool_deadman/index_lite.ws?player=",
        "seasonal" => "http://services.runescape.com/m=hiscore_oldschool_seasonal/index_lite.ws?player="
    ],

    /**
     * List of skills in order
     */
    'skills' => [
        "Overall",
        "Attack",
        "Defence",
        "Strength",
        "Hitpoints",
        "Ranged",
        "Prayer",
        "Magic",
        "Cooking",
        "Woodcutting",
        "Fletching",
        "Fishing",
        "Firemaking",
        "Crafting",
        "Smithing",
        "Mining",
        "Herblore",
        "Agility",
        "Thieving",
        "Slayer",
        "Farming",
        "Runecrafting",
        "Hunter",
        "Construction"
    ],

    /**
     * List of minigames
     */
    'minigames' => [
        "Bounty_Hunter",
        "Bounty_Hunter_Rogues",
        "Clue_Scrolls_All",
        "Clue_Scrolls_Easy",
        "Clue_Scrolls_Medium",
        "Clue_Scrolls_Hard",
        "Clue_Scrolls_Elite",
        "Clue_Scrolls_Master",
        "LMS"
    ],

    'options' => [
        'refresh_timeout' => 3600 // 1 minute
    ]
];
