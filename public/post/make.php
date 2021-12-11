<?php

$model = "User";

$properties = [
    [
        'var'=>'id',
        'type'=>'string',
        'default' => "",
        'allowOverride'=>true,
        'description'=>'The unique id of the Record'
    ],
    [
        'var'=>'createdAt',
        'type'=>'string',
        'default' => "",
        'allowOverride'=>true,
        'description'=>'When the created has been created'
    ],
    [
        'var'=>'updatedAt',
        'type'=>'string',
        'default' => "",
        'allowOverride'=>true,
        'description'=>'When the record has been updated'
    ],
    [
        'var'=>'private',
        'type'=>'array',
        'default' => "",
        'allowOverride'=>true,
        'description'=>'Private data of the payload'
    ],
    [
        'var'=>'public',
        'type'=>'array',
        'default' => "",
        'allowOverride'=>true,
        'description'=>'Public data of the payload'
    ],
    [
        'var'=>'meta',
        'type'=>'array',
        'default' => "",
        'allowOverride'=>true,
        'description'=>'Internal data of the payload'
    ]
];

$tab = "&nbsp;&nbsp;&nbsp;&nbsp;";

foreach ($properties as $key => $property) {
    echo "private ".$property['type']." | null $".$property['var'].";<br>";
}

echo "<br><br><br>";

echo "public function __construct(<br>
        {$tab}array $"."__args"."<br>
        {$tab})<br>{<br>";

            # Constructor
            foreach ($properties as $key => $property) {
                if (!$property["allowOverride"]) {
                    echo "{$tab}# ".$property['description']."<br>";
                    echo "{$tab}$"."this->".$property['var']." = $"."__args['".$property['var']."']"." ?? ".$property['default'].";";
                }
                else {
                    echo "{$tab}$"."this->".$property['var']." = $"."__args['".$property['var']."'] ?? ".$property['default'].";";
                }
                echo "<br>";
            }

        echo "}<br><br><br>";

foreach ($properties as $key => $property) {
    echo "# ".$property['description']."<br>";
    echo "public function {$property['var']} (";
    if (!$property["allowOverride"]) {
        echo " ) ";
    }
    else {
        echo "<br>{$tab}{$property['type']} $".$property['var']." = NULL<br>
            {$tab})<br>";
    }
    echo "{<br>";

    if (!$property["allowOverride"]) {
        echo "{$tab}return $"."this->".$property['var'].";<br>";
    }
    else {
        echo "{$tab}# Getter<br>";
        echo "{$tab}if (NULL===$".$property['var'].") return $"."this->".$property['var'].";<br>";
        echo "{$tab}# Override<br>
        {$tab}"."$"."this->".$property['var']." = $".$property['var'].";<br>
        {$tab}return NULL;<br>";
    }
    echo "}"."<br><br><br>";
}

echo "<style>body{font-family:monospace;}</style>";
